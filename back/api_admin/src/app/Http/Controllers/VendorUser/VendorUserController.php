<?php

namespace App\Http\Controllers\VendorUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdminRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\VendorUser\VendorUserRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Repositories\VendorUser\VendorUserRepository;
use App\Services\User\UserService;
use App\Services\VendorUser\VendorUserService;

class VendorUserController extends Controller
{
    public function __construct(private VendorUserService $userService)
    {

    }

    public function index()
    {
        try {
            $users = $this->userService->index();
            return new BaseWithResponseResource(['users' => $users], 'show users');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(VendorUserRequest $request)
    {
        try {
            $data = [
                'email' => $request->email,
                'name'=>$request->name,
                'password'=>$request->password
            ];
            $this->userService->store($data);
            return new BaseWithResponseResource(['user' => null], 'add user');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userService->show($id);
            return new BaseWithResponseResource(['user' => $user], 'show user');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function update(VendorUserRequest $request, string $id)
    {
        try {
            $data = [
                'id'=>$id,
                'email' => $request->email,
                'name'=>$request->name,
                'password'=>$request->password
            ];
             $this->userService->update($data,$id);
            return new BaseWithResponseResource(['user' => null], 'update user');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->userService->destroy($id);
            return new BaseWithResponseResource(['user' => null], 'delete user');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
