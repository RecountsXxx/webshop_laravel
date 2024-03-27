<?php

namespace App\Services\Vendor\VendorUser;

use App\Models\Vendor\VendorUsers\VendorUser;
use App\Repositories\Vendor\VendorUser\VendorUserRepository;

class VendorUserService
{
    public function __construct(private VendorUserRepository $userRepository){}


    public function store(array $data): VendorUser
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
