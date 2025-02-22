<?php

namespace App\Utils;

class PaginateUtil
{
    /**
     * Handle paginate asc
     * @param mixed $queryModel
     * @param string $sortByCol
     * @param int $recordPerPage
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function paginateModelAsc($queryModel, $sortByCol = '', $recordPerPage = 10)
    {
        // add condition where deleted_date is null
        $queryModel = $queryModel->whereNull('deleted_date');

        // if has a column need to sort priority
        if ($sortByCol) {
            $queryModel = $queryModel->orderBy($sortByCol, 'asc');
        }

        // order by id asc due to need sort by id
        return $queryModel->orderBy('id', 'asc')->paginate($recordPerPage);
    }

    /**
     * Handle paginate all with asc order
     * @param mixed $queryModel
     * @param string $sortByCol
     * @param int $recordPerPage
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function paginateModelAllAsc($queryModel, $sortByCol = '', $recordPerPage = 10)
    {
        // if has a column need to sort priority
        if ($sortByCol) {
            $queryModel = $queryModel->orderBy($sortByCol, 'asc');
        }
        // return paginate with order asc
        return $queryModel->orderBy('id', 'asc')->paginate($recordPerPage);
    }
}
