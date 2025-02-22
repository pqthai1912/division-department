<?php

namespace App\Services;

use App\Constants\UserConstant;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Str;

class UserService
{
    // handle input of add/update to return array of input data
    public function handleInputAdd(Request $request)
    {
        $input = $request->all();
        return [
            'name' => $input['name'],
            'email' => $input['email'],
            'division_id' => $input['division_id'],
            'entered_date' => $input['entered_date'],
            'position_id' => $input['position_id'],
            'password' => Hash::make($input['password']),
        ];

    }

    public function handleInputEdit(Request $request, $role)
    {
        $input = $request->all();
        $data = [];
        // check user what is role so that decide input to edit
        // if role is 0 => edit all input
        if ($role == UserConstant::GENERAL_DIRECTOR[0]) {
            $data = [
                'name' => $input['name'],
                'email' => $input['email'],
                'division_id' => $input['division_id'],
                'entered_date' => $input['entered_date'],
                'position_id' => $input['position_id'],
            ];
        }

        // if typed in password's field
        if ($input['password']) {
            $data['password'] = Hash::make($input['password']);
        }

        return $data;
    }

    public function handleSearch(Request $request)
    {
        $enteredDateFrom = '';
        if ($request->input('entered_date_from')) {
            $enteredDateFrom = Carbon::createFromFormat(
                'Y/m/d',
                $request->input('entered_date_from')
            )->format('Y-m-d');
        }
        $enteredDateTo = '';
        if ($request->input('entered_date_to')) {
            $enteredDateTo = Carbon::createFromFormat(
                'Y/m/d',
                $request->input('entered_date_to')
            )->format('Y-m-d');
        }

        return array(
            "name" => $request->input('name'),
            "entered_date_from" => $enteredDateFrom,
            "entered_date_to" => $enteredDateTo,
        );
    }
}
