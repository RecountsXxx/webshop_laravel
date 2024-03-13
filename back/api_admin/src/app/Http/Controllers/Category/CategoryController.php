<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Jobs\UploadCategoryImageJob;
use App\Services\Category\CategoryService;;
use Illuminate\Http\Request;

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
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
