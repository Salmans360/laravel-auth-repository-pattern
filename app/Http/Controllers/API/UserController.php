<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->userRepository->getAll();

        return $this->success($data,'Data retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), 422);
        }

        $data = $this->userRepository->create($request->all());
        return $this->success($data, 'Data created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user =  $this->userRepository->findOne($id);
        // Check if user was not found
        if (!$user) {
            return $this->error('User not found', 404);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), 422);
        }

        $updatedData = $this->userRepository->update($id, $request->all());

        // Check if user was not found
        if (!$updatedData) {
            return $this->error('User not found', 404);
        }
        return $this->success($updatedData, 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user =  $this->userRepository->findOne($id);
        // Check if user was not found
        if (!$user) {
            return $this->error('User not found', 404);
        }
        $this->userRepository->delete($id);
        return $this->success(array(), 'Data deleted successfully');
    }

    /*
     *
     */
    public function search(Request $request)
    {
        $searchKey = $request->input('search_key');
        $searchValue = $request->input('search_value');

        $users = $this->userRepository->search($searchKey, $searchValue);
        return $users;
    }
}
