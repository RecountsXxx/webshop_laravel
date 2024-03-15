<?php

namespace App\Services\JoinToVendors;

use App\Jobs\SendVendorsDataMailJob;
use App\Notifications\SendVendorsDataNotification;
use App\Repositories\JoinToVendors\JoinToVendorsRepository;
use App\Repositories\Vendor\VendorRepository;
use App\Repositories\VendorUser\VendorUserRepository;
use OpenApi\Attributes\Info;

class JoinToVendorsService
{
    public function __construct(private JoinToVendorsRepository $forTheVendorsRepository, private VendorUserRepository $userRepository, private VendorRepository $vendorRepository){}

    public function index()
    {
        return $this->forTheVendorsRepository->getPaginateRequests();
    }

    public function destroy($id)
    {
        $vendorRequest = $this->forTheVendorsRepository->findOrFail($id);
        \Laravel\Prompts\info('EMail: ' . $vendorRequest->email);
        SendVendorsDataMailJob::dispatch(null,['email'=>$vendorRequest->email])->onQueue('upload.images.jobs');
        $this->forTheVendorsRepository->delete($vendorRequest);

        return response()->json(['message' => 'Vendor declined'], 200);
    }

    public function addToVendors($id)
    {
        $vendorRequest = $this->forTheVendorsRepository->findOrFail($id);

        $existingUser = $this->userRepository->findByEmail($vendorRequest->email);
        if ($existingUser) {
            return response()->json(['error' => 'Email already exists'], 400);
        }

        $data = [
            'name'=> $vendorRequest->shop_name,
            'email'=>$vendorRequest->email,
            'password' => time()
        ];
        $vendor_user = $this->userRepository->create($data);

        $vendor_shop = $this->vendorRepository->create([
            'image'=>'https://t4.ftcdn.net/jpg/04/81/13/43/360_F_481134373_0W4kg2yKeBRHNEklk4F9UXtGHdub3tYk.jpg',
            'vendor_name' => $vendorRequest->shop_name,
            'description'=>'Enter your description!',
        ]);

        $this->userRepository->update($vendor_user,['vendor_id' => $vendor_shop->id]);

        SendVendorsDataMailJob::dispatch($vendor_user,$data)->onQueue('upload.images.jobs');
        $this->forTheVendorsRepository->delete($vendorRequest);

        return response()->json(['message' => 'Vendor added successfully'], 200);
    }

}
