<?php

namespace App\Http\Controllers\Vendor\JoinToVendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\JoinToVendors\JoinToVendorsRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Vendor\JoinToVendors\JoinToVendorsService;

class JoinToVendorsController extends Controller
{
    public function __construct(private JoinToVendorsService $forTheVendorsService){}

    public function __invoke(JoinToVendorsController $request)
    {
        $data = [
            'shop_name'=>$request->shop_name,
            'email'=>$request->email,
            'description'=>$request->description,
        ];
        try {
            $this->forTheVendorsService->store($data);
            return new BaseWithResponseResource(['request'=>null], 'create request for join vendors','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
