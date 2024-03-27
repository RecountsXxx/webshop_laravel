<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Category\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}

    public function index()
    {
        try {
            $categories =  $this->categoryService->show_all();
            return new BaseWithResponseResource(['categories'=>$categories], 'show categories','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $category =  $this->categoryService->show_per_id($id);
            return new BaseWithResponseResource(['category'=>$category], 'show category','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function get_products_on_category(string $id)
    {
        try {
            $products =  $this->categoryService->show_products_on_category($id);
            return new BaseWithResponseResource(['products'=>$products], 'show products on category','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
