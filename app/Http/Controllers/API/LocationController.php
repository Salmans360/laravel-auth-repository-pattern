<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepositoryInterface;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    protected $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        //$this->middleware('auth');
        $this->locationRepository = $locationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = $this->locationRepository->getAll(false);
        return $this->success($locations,'Data retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $location = $this->locationRepository->findOne($id);
            return $this->success($location,'Data retrieved successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it in any other appropriate way
            return $this->error('An error occurred while fetching location.', 500);
        }
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

    public function getLocationsWithinRadius(Request $request){

        try {
            $lat = $request->input('lat');
            $lng = $request->input('lng');
            $radius = $request->input('radius', 300); // Default radius is 10 kilometers

            $locations = $this->locationRepository->getLocationsWithinRadius($lat, $lng, $radius);

            return $this->success($locations,'Data retrieved successfully');
        } catch (\Exception $e) {
            // Log the exception or handle it in any other appropriate way
            return $this->error('An error occurred while fetching locations.', 500);
        }
    }
}
