<?php

namespace App\Services\User;

use App\Models\Brand\Brand;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\User\User;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function __construct(private UserRepository $userRepository){}


    public function store(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function show(string $id){
        return $this->userRepository->findOrFail($id);
    }

    public function destroy(string $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->delete($user);
    }

    public function update(array $data)
    {
        $user = $this->userRepository->findOrFail($data['id']);
        $this->userRepository->update($user, $data);
    }

    public function index()
    {
        return $this->userRepository->getPaginateUsers();
    }

}
