<?php
namespace App\Repositories\Division;

use App\Models\Division;
use App\Repositories\EloquentRepository;

class DivisionEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Division::class;
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllByNameAsc()
    {
        // get all with deleted is null
        return $this->_model->whereNull('deleted_date')
        ->orderBy('name', 'asc')->get();
    }


}
