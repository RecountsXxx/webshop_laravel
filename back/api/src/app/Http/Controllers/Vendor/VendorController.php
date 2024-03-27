<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Vendor\VendorService;

class VendorController extends Controller
{
    public function __construct(private VendorService $vendorService){}

    public function index()
    {
        try {
            $vendors =  $this->vendorService->show_all();
            return new BaseWithResponseResource(['vendors'=>$vendors], 'show vendors','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $vendor =  $this->vendorService->show_per_id($id);
            return new BaseWithResponseResource(['vendor'=>$vendor], 'show vendor per id','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function get_products_on_vendor(string $id)
    {
        try {
            $products =  $this->vendorService->get_products_on_vendor($id);
            return new BaseWithResponseResource(['products'=>$products], 'show product on vendor','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
