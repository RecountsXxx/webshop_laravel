<?php

namespace App\Http\Controllers\JoinToVendors;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\JoinToVendors\JoinToVendorsService;

class JoinToVendorsController extends Controller
{
    public function __construct(private JoinToVendorsService $forTheVendorsService){}

    public function index()
    {
        try {
           $requests = $this->forTheVendorsService->index();
            return new BaseWithResponseResource(['requests'=>$requests], 'show request for join vendors','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function addToVendors(string $id)
    {
        try {
            $this->forTheVendorsService->addToVendors($id);
            return new BaseWithResponseResource(['request'=>null], 'join to vendors','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function destroy(string $id)
    {
        try {
            $this->forTheVendorsService->destroy($id);
            return new BaseWithResponseResource(['request'=>null], 'delete request for join vendors','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
