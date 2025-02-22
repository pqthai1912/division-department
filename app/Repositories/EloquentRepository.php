<?php

namespace App\Repositories;

use App\Utils\CarbonTimeUtil;
use Illuminate\Support\Facades\DB;

abstract class EloquentRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        // get all with deleted is null
        return $this->_model->whereNull('deleted_date')->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        // $result = $this->_model->find($id);

        // return $result;
        try {
            $result = $this->_model->where($this->_model->getKeyName(), $id)
                ->whereNull('deleted_date'); // find id where not deleted
            return $result->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        try {
            DB::beginTransaction();
            $result = $this->_model->create($attributes);
            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }
            return $result->fresh();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        try {
            $query = $this->find($id);
            $query->fill($attributes);
            DB::beginTransaction();
            $result = $query->save();
            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        // $result = $this->find($id);
        // if ($result) {
        //     // $result->delete();

        //     return true;
        // }

        // return false;
        try {
            // find id and update col deleted_date
            $query = $this->find($id);
            $query->fill(['deleted_date' => CarbonTimeUtil::getTimeNow()]);
            DB::beginTransaction();
            $result = $query->save();
            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

}
