<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use App\Http\Requests\Division\ImportDivisionRequest;
use App\Imports\DivisionsImport;
use App\Models\Division;
use App\Repositories\Division\DivisionEloquentRepository;
use App\Services\DivisionService;
use App\Utils\MessagesUtil;
use App\Utils\PaginateUtil;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class DivisionController extends Controller
{
    protected $divisionRepository;
    protected $divisionService;

    public function __construct(
        DivisionEloquentRepository $divisionRepository,
        DivisionService $divisionService
    )
    {
        $this->divisionRepository = $divisionRepository;
        $this->divisionService = $divisionService;
    }

    public function index()
    {
        // return divisions with pagination
        $divisions = PaginateUtil::paginateModelAllAsc(new Division);
        return view('pages.divisions.index-division', compact('divisions'));
    }

    public function importCSV(ImportDivisionRequest $request)
    {
        // do import csv files
        $import = new DivisionsImport(
            $this->divisionRepository,
            $this->divisionService,
        );
        $fileCSV = $request->file('file_csv');
        $expectedHeaders = ['id', 'division_name', 'division_note',
                            'division_leader', 'floor_number', 'delete'];
        $errorMessage1 = MessagesUtil::getMessage('ECL095');
        // get header
        try {
            $headings = (new HeadingRowImport)->toArray($fileCSV);
            // check col name is like expectedHeaders
            foreach ($expectedHeaders as $header) {
                if (!in_array($header, $headings[0][0])) {
                    return redirect()->back()->with('error', $errorMessage1);
                }
            }

            $rows = Excel::toArray($import, $fileCSV)[0];

            // if all row is null
            if ($rows === []) {
                return redirect()->back()->with('error', $errorMessage1);
            }
            foreach ($rows as $row) {
                // check for import of maatwebsite if empty row between rows
                if ($row['id'] == null && $row['division_name'] == null &&
                 $row['division_note'] == null && $row['division_leader'] == null &&
                  $row['floor_number'] == null && $row['delete'] == null) {
                    return redirect()->back()->with('error', $errorMessage1);
                }

            }

            $file = new \SplFileObject($fileCSV);
            $file->setFlags(\SplFileObject::READ_CSV |
             \SplFileObject::DROP_NEW_LINE); // get header + line-breaks of a row
            $data = [];
            foreach ($file as $row) {
                $data[] = $row;
            }
            $rowCount = count($data) - 1; // count data not include header
            // Check has empty line when case maatwebiste skip last empty
            if ($rowCount != count($rows)) {
                return redirect()->back()->with('error', $errorMessage1);
            }

        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            // file is null
            return redirect()->back()->with('error', $errorMessage1);
        }

        // rollback if has fatal errors
        DB::beginTransaction();
        try {
            $import->import($request->file('file_csv'));
            // if has errors
            if (count($import->failures()) > 0) {
                DB::rollback();
                return redirect()->back()->with('failures', $import->failures());
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
            return redirect()->back()->with('error', MessagesUtil::getMessage('ECL093'));
        }

        return redirect()->back()->with('success', MessagesUtil::getMessage('ECL092'));

    }

}
