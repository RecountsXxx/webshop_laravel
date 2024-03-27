<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Jobs\Brand\UpdateBrandImageJob;
use App\Jobs\Brand\UploadBrandImageJob;
use App\Services\Brand\BrandService;

;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService){}

    public function index()
    {
        try {
            $brands = $this->brandService->index();
            return new BaseWithResponseResource(['brands'=>$brands], 'show brands');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(BrandRequest $request)
    {
        try {
            $imagePath = $request->file('image')->store('images');

            $data = [
                'brand_name' => $request->brand_name,
                'description' => $request->description,
                'image' =>$imagePath,
            ];

            UploadBrandImageJob::dispatch($data)->onQueue('upload.images.jobs');

            return new BaseWithResponseResource(['brand' => null], 'created brand');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }



    public function show(string $id)
    {
        try {
            $brand = $this->brandService->show($id);
            return new BaseWithResponseResource(['brand'=>$brand], 'show brand');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function update(UpdateBrandRequest $request, string $id)
    {
        try {
            $data = [
                'id'=>$id,
                'brand_name' => $request->brand_name,
                'description' => $request->description,
            ];
            $this->brandService->update($data);


            if($request->image){
                $image_path = $request->file('image')->store('images');
                $data = [
                    'id'=>$id,
                    'image_path'=>$image_path,
                ];

                UpdateBrandImageJob::dispatch($data)->onQueue('upload.images.jobs');
            }


            return new BaseWithResponseResource(['brand' => null], 'updated brand');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->brandService->destroy($id);
            return new BaseWithResponseResource(['brand'=>'destroy'], 'delete brand');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}

