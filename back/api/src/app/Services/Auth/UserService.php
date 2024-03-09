<?php

namespace App\Services\Auth;

use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function __construct(private UserRepository $userRepository){}

    public function create(array $data): Model
    {
        $user = $this->userRepository->create($data);
        return $user;
    }
    public function findOrFail($email)
    {
        return $this->userRepository->get(['email'=>$email],true);
    }

}
