<?php

namespace App\Exports;

use App\Constants\CommonConstant;
use App\Repositories\User\UserEloquentRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithCustomCsvSettings
{
    private $inputSearch;
    public function __construct($inputSearch)
    {
        $this->inputSearch = $inputSearch;
    }

    public function getCsvSettings(): array
    {
        return [
            'enclosure' => '' // remove ""
        ];
    }

    //assign headers
    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Email',
            'Division ID',
            'Division Name',
            'Entered Date',
            'Position',
            'Created Date',
            'Updated Date',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // init object
        $userRepository = new UserEloquentRepository();
        // search and get users
        $users = (Object) $userRepository->search($this->inputSearch);
        return $users->orderBy('name', 'asc')->orderBy('id', 'asc')->get();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->email,
            $row->division_id,
            $row->divisionName($row->division_id),
            date(CommonConstant::DATE_FORMAT, strtotime($row->entered_date)),
            $row->position($row->position_id),
            date(CommonConstant::DATE_FORMAT, strtotime($row->created_date)),
            date(CommonConstant::DATE_FORMAT, strtotime($row->updated_date)),
        ];
    }

}
