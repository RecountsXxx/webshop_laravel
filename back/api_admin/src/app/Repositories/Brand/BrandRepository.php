<?php

namespace App\Repositories\Brand;

use App\Models\Brand\Brand;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class BrandRepository extends BaseRepository
{
    public function __construct( Brand $brand)
    {
        parent::__construct($brand);
    }
    public function getPaginateBrands()
    {
        return $this->paginate(12);
    }

    public function count()
    {
        return DB::table('brands')->count();
    }
}
