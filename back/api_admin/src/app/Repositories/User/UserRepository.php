<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function __construct( User $user)
    {
        parent::__construct($user);
    }

    public function getPaginateUsers()
    {
        return $this->paginate(12);
    }

    public function count()
    {
        return DB::table('users')->count();
    }
}
