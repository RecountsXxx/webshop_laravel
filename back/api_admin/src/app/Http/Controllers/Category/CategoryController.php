<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Jobs\Category\UpdateCategoryImageJob;
use App\Jobs\Category\UpdatePostImageJob;
use App\Jobs\Category\UploadCategoryImageJob;
use App\Jobs\Category\UploadPostImageJob;
use App\Services\Category\CategoryService;

;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}

    public function index()
    {
        try {
            $categories = $this->categoryService->index();
            return new BaseWithResponseResource(['categories'=>$categories], 'show categories');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $imagePath = $request->file('image')->store('images');

            $data = [
                'category_name' => $request->category_name,
                'description' => $request->description,
                'image' =>$imagePath,
            ];

            UploadCategoryImageJob::dispatch($data)->onQueue('upload.images.jobs');

            return new BaseWithResponseResource(['category' => null], 'created category');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $category = $this->categoryService->show($id);
            return new BaseWithResponseResource(['category'=>$category], 'show category');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $data = [
                'id'=>$id,
                'category_name' => $request->category_name,
                'description' => $request->description,
            ];
            $this->categoryService->update($data);


            if($request->image){
                $image_path = $request->file('image')->store('images');
                $data = [
                    'id'=>$id,
                    'image_path'=>$image_path,
                ];

                UpdateCategoryImageJob::dispatch($data)->onQueue('upload.images.jobs');
            }


            return new BaseWithResponseResource(['category' => null], 'updated category');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->categoryService->destroy($id);
            return new BaseWithResponseResource(['category'=>'destroy'], 'delete category');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
