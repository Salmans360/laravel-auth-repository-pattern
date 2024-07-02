<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Dummy;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class DataController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        //$data = Dummy::all(); // Fetch data from the database
        $data = $this->userRepository->getAll();

        return $this->success($data,'Dummmy Data retrieved successfully');
    }

    public function create(Request $request)
    {
        $data = $this->userRepository->create($request->all());
        return $this->success($data, 'Data created successfully');
    }

    public function update(Request $request, User $data)
    {
        $updatedData = $this->userRepository->update($data, $request->all());
        return $this->success($updatedData, 'Data updated successfully');
    }
}
