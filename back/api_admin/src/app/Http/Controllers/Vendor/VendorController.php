<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;
use App\Http\Requests\Vendor\VendorRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Jobs\UpdateCategoryImageJob;
use App\Jobs\UpdateVendorImageJob;
use App\Jobs\UploadCategoryImageJob;
use App\Jobs\UploadVendorImageJob;
use App\Services\Category\CategoryService;;

use App\Services\Vendor\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct(private VendorService $vendorService){}

    public function index()
    {
        try {
            $vendors = $this->vendorService->index();
            return new BaseWithResponseResource(['vendors'=>$vendors], 'show vendors');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(VendorRequest $request)
    {
        try {
            $imagePath = $request->file('image')->store('images');

            $data = [
                'vendor_name' => $request->vendor_name,
                'description' => $request->description,
                'image' =>$imagePath,
            ];

            UploadVendorImageJob::dispatch($data)->onQueue('upload.images.jobs');

            return new BaseWithResponseResource(['vendor' => null], 'created vendor');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }



    public function show(string $id)
    {
        try {
            $vendor = $this->vendorService->show($id);
            return new BaseWithResponseResource(['vendor'=>$vendor], 'show vendor');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function update(UpdateVendorRequest $request, string $id)
    {
        try {
            $data = [
                'id'=>$id,
                'vendor_name' => $request->vendor_name,
                'description' => $request->description,
            ];
            $this->vendorService->update($data);


            if($request->image){
                $image_path = $request->file('image')->store('images');
                $data = [
                    'id'=>$id,
                    'image_path'=>$image_path,
                ];

                UpdateVendorImageJob::dispatch($data)->onQueue('upload.images.jobs');
            }


            return new BaseWithResponseResource(['vendor' => null], 'updated vendor');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->vendorService->destroy($id);
            return new BaseWithResponseResource(['vendor'=>'destroy'], 'delete vendor');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}

