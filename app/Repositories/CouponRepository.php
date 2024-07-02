<?php

namespace App\Repositories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CouponRepository implements CouponRepositoryInterface
{
    public function getAll($paginate = true, $perPage = 10)
    {
        if ($paginate) {
            return Coupon::orderBy('id', 'desc')->paginate($perPage);
        } else {
            return Coupon::all();
        }
    }

    public function create(array $data)
    {
        return Coupon::create($data);
    }

    public function update($id, array $attributes)
    {
        try {

            // Find the user by ID
            $coupon = $this->findOne($id);

            // Update the user attributes using Eloquent
            $coupon->update([
                'code' => $attributes['code'],
                'type' => $attributes['type'],
                'amount' => $attributes['amount'],
                'minimum_amount' => $attributes['minimum_amount'],
                'usage_limit' => $attributes['usage_limit'],
                'usage_count' => $attributes['usage_count'],
                'date_expires' => $attributes['date_expires'],
                'description' => $attributes['description'],
            ]);

            return $coupon;
        } catch (ModelNotFoundException $e) {
            // User not found, return null or throw an exception
            return null;
        }
    }

    public function findOne($id){

        try{
            $coupon = Coupon::findOrFail($id);
            return $coupon;

        } catch (ModelNotFoundException $e) {
            // User not found, return null or throw an exception
            return null;
        }
    }

    public function delete($id){
        try{
            // Find the user by ID
            $coupon = $this->findOne($id);
            return $coupon->delete();

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function search($key, $value)
    {
        $query = Coupon::query();

        if ($value !== null) {
            $query->where($key, 'like', '%' . $value . '%');
        }


        return $query->paginate(env('PER_PAGE_RESULT'));
    }

}
