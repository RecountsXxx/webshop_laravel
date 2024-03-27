<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Brand\BrandService;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService){}

    public function index()
    {
        try {
            $brands =  $this->brandService->show_all();
            return new BaseWithResponseResource(['brands'=>$brands], 'show brands','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $brand =  $this->brandService->show_per_id($id);
            return new BaseWithResponseResource(['brand'=>$brand], 'show brand','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function get_products_on_brand(string $id)
    {
        try {
            $products =  $this->brandService->get_products_on_brand($id);
            return new BaseWithResponseResource(['products'=>$products], 'show product on brand','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
