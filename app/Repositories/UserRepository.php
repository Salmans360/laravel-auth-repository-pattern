<?php

namespace App\Repositories;

use App\Models\Dummy;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function getAll($paginate = true, $perPage = 10)
    {
        if ($paginate) {
            return User::paginate($perPage);
        } else {
            return User::all();
        }
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $attributes)
    {
        try {

            // Find the user by ID
            $user = $this->findOne($id);
            //$user = User::findOrFail($id);

            // Update the user attributes using Eloquent
            $user->update([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
            ]);

            return $user;
        } catch (ModelNotFoundException $e) {
            // User not found, return null or throw an exception
            return null;
        }
    }

    public function findOne($id){

        try{
            $user = User::findOrFail($id);
            return $user;

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
        $query = User::query();

        if ($value !== null) {
            $query->where($key, 'like', '%' . $value . '%');
        }


        return $query->paginate(env('PER_PAGE_RESULT'));
    }

}
