<?php

namespace App\Repositories;

use App\Models\HolidaySet;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HolidaySetRepository implements HolidaySetRepositoryInterface
{
    public function getAll($paginate = true, $perPage = 10)
    {
        if ($paginate) {
            return HolidaySet::orderBy('id', 'desc')->paginate($perPage);
        } else {
            return HolidaySet::all();
        }
    }

    public function create(array $data)
    {
        return HolidaySet::create($data);
    }

    public function update($id, array $attributes)
    {

    }

    public function findOne($id){

        try{
            $holidays = HolidaySet::findOrFail($id);
            return $holidays;

        } catch (ModelNotFoundException $e) {
            // User not found, return null or throw an exception
            return null;
        }
    }

    public function delete($id){
        try{
            // Find the user by ID
            $holidays = $this->findOne($id);
            return $holidays->delete();

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function search($key, $value)
    {
        $query = HolidaySet::query();

        if ($value !== null) {
            $query->where($key, 'like', '%' . $value . '%');
        }


        return $query->paginate(env('PER_PAGE_RESULT'));
    }

}
