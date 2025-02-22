<?php

namespace App\Http\Controllers\User;

use App\Constants\UserConstant;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SearchRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Division\DivisionEloquentRepository;
use App\Repositories\User\UserEloquentRepository;
use App\Services\UserService;
use App\Utils\MessagesUtil;
use App\Utils\PaginateUtil;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    protected $userRepository;
    protected $userService;
    protected $divisionRepository;

    public function __construct(
        UserEloquentRepository $userRepository,
        UserService $userService,
        DivisionEloquentRepository $divisionRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->divisionRepository = $divisionRepository;
    }

    public function index()
    {
        // return a page no record
        return view('pages.users.index-user');
    }

    public function indexSearch()
    {
        if (request()->session()->exists('users')) {
            // get data users from session
            $inputSearch = Session::get('users');
            // search and paging users
            $queryUsers = $this->userRepository->search($inputSearch);
            $users = PaginateUtil::paginateModelAsc($queryUsers, 'name');
            return view('pages.users.index-user', compact('users'));
        }

        // return a page no record
        return view('pages.users.index-user');
    }

    // set session input data for search users
    public function search(SearchRequest $request)
    {
        switch ($request->input('action')) {
            case 'search':
                $userSearch = $this->userService->handleSearch($request);
                // save to session
                Session::put('users', $userSearch);
                break;
            default:
                Session::forget('users');
                break;
        }

        return redirect()->route('user.index.search');
    }

    // Conditional Export (csv)
    public function exportCSV(Request $request)
    {
        // check position_id is 0 and searched
        if ($request->session()->exists('users') &&
            auth()->user()->position_id == UserConstant::GENERAL_DIRECTOR[0]) {
            // get data users from session
            $inputSearch = Session::get('users');
            $dt = Carbon::now('Asia/Ho_Chi_Minh'); // get time hcm
            $fileName = 'list_user_'.$dt->format('YmdHis').'.csv';
            // Session::flash('success', 'Task was successful!');
            return Excel::download(new UsersExport($inputSearch), $fileName);
        }
        return redirect()->route('user.index.search');
     }

    public function create()
    {
        // prevent other users go to this except administrators
        if (auth()->user()->position_id != UserConstant::GENERAL_DIRECTOR[0]) {
            // logout and redirect to login
            auth()->logout();
            return redirect()->route('login');
        }
        // get all divisions with key-value
        $divisions = $this->divisionRepository->getAllByNameAsc()->pluck('name', 'id')->toArray();
        return view('pages.users.add-user', compact('divisions'));
    }

    public function store(StoreUserRequest $request)
    {
        // create new user
        $user = $this->userRepository->create($this->userService->handleInputAdd($request));

        // if registered successfully
        if ($user) {
            return redirect()->route('user.index');
        }
        return redirect()->back()->with('error', MessagesUtil::getMessage('ECL093'));
    }

    // public function show($id)
    // {
    //     //
    // }

    public function edit($id)
    {
        // get specific user through id
        try {
            $user = $this->userRepository->find($id);
            // prevent other users go to this except owner and administrators
            if ($user->id != auth()->user()->id &&
             auth()->user()->position_id != UserConstant::GENERAL_DIRECTOR[0]) {
                // logout and redirect to login
                auth()->logout();
                return redirect()->route('login');
            }
            // get all divisions with key-value
            $divisions = $this->divisionRepository->getAllByNameAsc()->pluck('name', 'id')->toArray();

            return view('pages.users.edit-user', compact('divisions', 'user'));
        } catch (Exception $e) {
            // catch error when access no record is available
            $response = response(MessagesUtil::getMessage('ECL064'), 404);
            if ($message = Session::get('error')) {
                $response = response($message, 403);
            }

            return $response;
        }


    }


    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->userRepository->find($id); // make sure has id -> catch if not found
            $data = $this->userService->handleInputEdit($request, auth()->user()->position_id);
            // update user's data
            $user = $this->userRepository->update($user->id, $data);
            // check user is updated
            if ($user) {
                return redirect()->route('user.index');
            }
            return redirect()->back()->with('error', MessagesUtil::getMessage('ECL093'));
        } catch (Exception $e) {
            // catch error when update fail
            return redirect()->back()->with('error', MessagesUtil::getMessage('ECL093'));
        }
    }

    public function destroy($id)
    {
        // if user is logged in equal owner
        if ((int) $id === auth()->user()->id) {
            return response()->json(['error_msg' => MessagesUtil::getMessage('ECL086')]);
        }
        if ($user = User::where(['id' => $id, 'deleted_date' => null])->first()) {
            // update user's data
            $userDel = $this->userRepository->delete($user->id);
            // check user is deleted
            if ($userDel) {
                return response()->json(['redirect' => route('user.index')]);
            }
        }
        Session::flash('error', MessagesUtil::getMessage('ECL093'));
        return response()->json(['error' => MessagesUtil::getMessage('ECL093')]);
    }

    public function checkEmailUnique(Request $request)
    {
        $originalEmail = $request->original_email ?? '';
        $email = $request->email;
        if ($email == $originalEmail && $email != '') {
            // Email address hasn't changed, so it's valid
            $response = "true";
        } else {
            // if email has changed
            // if email already exists
            if (User::where('email', $email)->first()) {
                $response = "false";
            } else {
                $response = "true";
            }
        }

        return $response;
    }
}
