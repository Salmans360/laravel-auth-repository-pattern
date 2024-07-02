<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\CouponRepositoryInterface;
use App\Repositories\LocationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends BaseController
{
    protected $couponRepository;
    protected $locationRepository;

    public function __construct(CouponRepositoryInterface $couponRepository, LocationRepositoryInterface $locationRepository)
    {
        $this->couponRepository = $couponRepository;
        $this->locationRepository = $locationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'code' => 'required|string|max:255',
            'type' => 'required',
            'amount' => 'required',
            'date_expires' => 'required|date'
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), 422);
        }

        $data = $this->couponRepository->create($request->all());
        return $this->success($data, 'Data created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coupon =  $this->couponRepository->findOne($id);
        // Check if user was not found
        if (!$coupon) {
            return $this->error('Coupon not found', 404);
        }

        return $coupon;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation rules
        $rules = [
            'code' => 'required|string|max:255',
            'type' => 'required',
            'amount' => 'required',
            'date_expires' => 'required|date'
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), 422);
        }

        $data = $this->couponRepository->update($id, $request->all());
        return $this->success($data, 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user =  $this->couponRepository->findOne($id);
        // Check if user was not found
        if (!$user) {
            return $this->error('Coupon not found', 404);
        }
        $this->couponRepository->delete($id);
        return $this->success(array(), 'Data deleted successfully');
    }

    /**
     * Get coupons by location ID.
     *
     * @param $id The ID of the location.
     * @return \Illuminate\Http\JsonResponse JSON response containing coupons associated with the location.
     */
    public function getCouponsByLocations($id)
    {
        try {
            // Retrieve the location by ID
            $response = $this->locationRepository->findOne($id);

            // Get the coupons associated with the location
            //$coupons = $location->coupons;

            // Return the coupons as JSON response
            return $this->success($response, 'Data retrieved successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return $this->error('An error occurred while fetching coupons.'.$e->getMessage(), 500);
        }
    }
}
