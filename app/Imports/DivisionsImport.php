<?php

namespace App\Imports;

use App\Constants\CommonConstant;
use App\Models\Division;
use App\Repositories\Division\DivisionEloquentRepository;
use App\Rules\MaxLengthRule;
use App\Services\DivisionService;
use App\Utils\MessagesUtil;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class DivisionsImport implements ToModel, WithHeadingRow, WithCustomCsvSettings,
WithUpserts, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

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

    public function getCsvSettings(): array
    {
        return [
            'input_encoding'         => 'UTF-8',
            'delimiter'              => ',',
            'enclosure'              => '',
            'line_ending'            => PHP_EOL,
            'use_bom'                => true,
            'include_separator_line' => false,
            'excel_compatibility'    => false,

        ];
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        // to know that update division
        return 'id';
    }

    public function model(array $row)
    {
        // check row has 'Y' first and id != null
        if (($row['delete'] == 'Y' || $row['delete'] == '"Y"') && $row['id'] != null) {
            $this->divisionRepository->delete($row['id']);
            return null; // delete and skip this row
        }

        $dataRow = $this->divisionService->handleInputCSV($row);

        // if has id
        if ($row['id'] != null) {
            // set created/updated_date due to not support observer
            $division = Division::find($row['id']);
            if ($division) {
                $dataRow['created_date'] = $division->created_date;
                $dataRow['updated_date'] = now();
            }
        }else {
            // case add division
            $dataRow['created_date'] = now();
            $dataRow['updated_date'] = now();
        }

        // add new/update division
        return new Division($dataRow);
    }

    public function rules(): array
    {
        return [
            'id' =>  ['nullable', CommonConstant::NUMBER,
            Rule::exists('division', 'id')->where(function ($query) {
                return $query->whereNull('deleted_date'); // only accept id wasn't deleted
            })],
            'division_name' =>  ['required', new MaxLengthRule(255, 'Division Name')],
            'division_leader' => ['required', CommonConstant::NUMBER],
            'floor_number' => ['required', CommonConstant::NUMBER],
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'id.numeric' => MessagesUtil::getMessage('ECL010', ['ID']),
            'id.exists' => MessagesUtil::getMessage('ECL094', ['ID']),
            'division_name.required' => MessagesUtil::getMessage('ECL001', ['Division Name']),
            'division_leader.required' => MessagesUtil::getMessage('ECL001', ['Division Leader']),
            'division_leader.numeric' => MessagesUtil::getMessage('ECL010', ['Division Leader']),
            'floor_number.required' => MessagesUtil::getMessage('ECL001', ['Floor Number']),
            'floor_number.numeric' => MessagesUtil::getMessage('ECL010', ['Floor Number']),
        ];
    }
}
