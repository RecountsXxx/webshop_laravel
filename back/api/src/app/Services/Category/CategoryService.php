<?php

namespace App\Services\Category;
use App\Repositories\Category\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository){}

    public function show_all()
    {
        return $this->categoryRepository->getPaginatedCategories();
    }
    public function show_per_id($id)
    {
        return $this->categoryRepository->findOrFail($id);
    }
    public function show_products_on_category($category_id)
    {
        return $this->categoryRepository->get_product_on_category($category_id);
    }
}
