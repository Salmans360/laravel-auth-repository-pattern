<?php

namespace App\Repositories;

use App\Models\Dealer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DealerRepository implements DealerRepositoryInterface
{
    public function getAll($paginate = true, $perPage = 10)
    {
        if ($paginate) {
            return Dealer::orderBy('id', 'desc')->paginate($perPage);
        } else {
            return Dealer::all();
        }
    }

    public function create(array $data)
    {
        return Dealer::create($data);
    }

    public function update($id, array $attributes)
    {
        try {

            // Find the user by ID
            $user = $this->findOne($id);
            //$user = User::findOrFail($id);

            // Update the user attributes using Eloquent
            $user->update($attributes);

            return $user;
        } catch (ModelNotFoundException $e) {
            // User not found, return null or throw an exception
            return null;
        }
    }

    public function findOne($id){

        try{
            $dealer = Dealer::findOrFail($id);
            return $dealer;

        } catch (ModelNotFoundException $e) {
            // User not found, return null or throw an exception
            return null;
        }
    }

    public function delete($id){
        try{
            // Find the user by ID
            $user = $this->findOne($id);
            return $user->delete();

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }


    public function search($key, $value)
    {
        $query = Dealer::query();

        if ($value !== null) {
            $query->where($key, 'like', '%' . $value . '%');
        }


        return $query->paginate(env('PER_PAGE_RESULT'));
    }

}
