<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\AppointmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends BaseController
{
    protected $appointmentRepository;

    public function __construct(AppointmentRepositoryInterface $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage        = $request->input('per_page', 10);
            $appointments   = $this->appointmentRepository->getAll(true, $perPage);

            return $this->success($appointments,'Data retrieved successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return $this->error('An error occurred while fetching locations.', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
            'location_id'       => 'required',
            'dealer_id'         => 'required',
            'market_id'         => 'required',
            'requested_services'=> 'required',
            'vehicle_year'      => 'required',
            'vehicle_make'      => 'required',
            'vehicle_model'     => 'required',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required',
            'phone'             => 'required',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), 422);
        }

        try {
            $data = $this->appointmentRepository->create($request->all());
            return $this->success($data, 'Appointment created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return $this->error('An error occurred'.$e->getMessage(), 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $appointment = $this->appointmentRepository->findOne($id);
            return $this->success($appointment, 'Appointment Retrieved successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return $this->error('An error occurred'.$e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
