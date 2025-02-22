<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\EloquentRepository;

class UserEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function search(array $inputSearch)
    {
        // query by condition search
        $users = User::whereNull('deleted_date');
        if (!$inputSearch['name'] && !$inputSearch['entered_date_from'] && !$inputSearch['entered_date_to']) {
            // search with no condition
            return $users;
        } else {
            if ($inputSearch['name']) {
                $users = $users->where('name', 'LIKE', "%" . $inputSearch['name'] . "%");
            }
            // search by range date
            if ($inputSearch['entered_date_from'] && $inputSearch['entered_date_to']) {
                $users = $users->whereBetween('entered_date', [
                    $inputSearch['entered_date_from'],
                    $inputSearch['entered_date_to']
                ]);
            } elseif ($inputSearch['entered_date_from']) {
                $users = $users->where('entered_date', '>=', $inputSearch['entered_date_from']);
            } elseif ($inputSearch['entered_date_to']) {
                $users = $users->where('entered_date', '<=', $inputSearch['entered_date_to']);
            }
            return $users;
        }

    }
}
