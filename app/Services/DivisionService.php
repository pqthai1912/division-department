<?php

namespace App\Services;

use App\Utils\MessagesUtil;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class DivisionService
{
    // handle input of add/update to return array of input data
    // public function handleInput(Request $request)
    // {
    //     $input = $request->all();
    //     return [
    //         '' => $input['name'],
    //         '' => $input[''],
    //     ];
    // }

    // handle input of add/update to return array of input data for csv
    public function handleInputCSV($row)
    {
        $dataRow = [
            "name" => $row['division_name'],
            "note" => $row['division_note'],
            "division_leader_id" => $row['division_leader'],
            "division_floor_num" => $row['floor_number'],
        ];
        // if has id in row

        if ($row['id'] != '') {
            $dataRow['id'] = $row['id']; //add to array to update
        }
        return $dataRow;
    }

    // public function checkFormatFile($import, $fileCSV, $expectedHeaders)
    // {
    //     $errorMessage1 = MessagesUtil::getMessage('ECL095');
    //     // get header
    //     try {
    //         $headings = (new HeadingRowImport)->toArray($fileCSV);
    //         // check col name is like expectedHeaders
    //         foreach ($expectedHeaders as $header) {
    //             if (!in_array($header, $headings[0][0])) {
    //                 return redirect()->back()->with('error', $errorMessage1);
    //             }
    //         }

    //         $rows = Excel::toArray($import, $fileCSV)[0];

    //         // if all row is null
    //         if ($rows === []) {
    //             return redirect()->back()->with('error', $errorMessage1);
    //         }

    //         // Handle empty data between rows
    //         $this->checkEmptyData($rows, $fileCSV, $errorMessage1);

    //     } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    //         // file is null
    //         return redirect()->back()->with('error', $errorMessage1);
    //     }
    // }

    // private function checkEmptyData($rows, $fileCSV, $errorMessage1)
    // {
    //     foreach ($rows as $row) {
    //         // check for import of maatwebsite if empty row between rows
    //         if ($row['id'] == null && $row['division_name'] == null &&
    //          $row['division_note'] == null && $row['division_leader'] == null &&
    //           $row['floor_number'] == null && $row['delete'] == null) {
    //             return redirect()->back()->with('error', $errorMessage1);
    //         }

    //     }

    //     $file = new \SplFileObject($fileCSV);
    //     $file->setFlags(\SplFileObject::READ_CSV |
    //      \SplFileObject::DROP_NEW_LINE); // get header + line-breaks of a row
    //     $data = [];
    //     foreach ($file as $row) {
    //         $data[] = $row;
    //     }
    //     $rowCount = count($data) - 1; // count data not include header
    //     // Check has empty line when case maatwebiste skip last empty
    //     if ($rowCount != count($rows)) {
    //         return redirect()->back()->with('error', $errorMessage1);
    //     }
    // }
}
