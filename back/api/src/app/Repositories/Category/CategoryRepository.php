<?php

namespace App\Repositories\Category;

use App\Models\Category\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function __construct( Category $category)
    {
        parent::__construct($category);
    }
    public function getPaginatedCategories(){
        return $this->paginate(2);
    }
    public function get_product_on_category($category_id)
    {
        $category = $this->findOrFail($category_id);
       return $category->products()->with('images')->paginate(12);
    }

}
