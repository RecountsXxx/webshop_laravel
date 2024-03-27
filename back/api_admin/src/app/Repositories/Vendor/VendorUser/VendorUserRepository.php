<?php

namespace App\Repositories\Vendor\VendorUser;

use App\Models\Vendor\VendorUsers\VendorUser;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class VendorUserRepository extends BaseRepository
{
    public function __construct( VendorUser $user)
    {
        parent::__construct($user);
    }

    public function getPaginateUsers()
    {
        return $this->model->with('vendor')->paginate(12);
    }

    public function count()
    {
        return DB::table('vendor_users')->count();
    }

    public function findByEmail($email)
    {
        return VendorUser::where('email', $email)->first();
    }
}
