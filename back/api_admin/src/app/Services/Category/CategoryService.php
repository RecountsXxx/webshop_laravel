<?php

namespace app\Services\Category;

use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductImagesRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository){}


    public function store(array $data): Category
    {
        $category = $this->categoryRepository->create($data);

        $path = $category->id . '/' . 'image.webp';
        Storage::disk('category_images')->put($path, file_get_contents(storage_path('app/' . $data['image'])));

        $path = asset('storage/category_images/' . $category->id . '/image.webp');

        $this->categoryRepository->update($category, ['image' => $path]);

        return $category;
    }

    public function show(string $id){
       return $this->categoryRepository->findOrFail($id);
    }

    public function destroy(string $id)
    {
        $product = $this->categoryRepository->findOrFail($id);
        $this->categoryRepository->delete($product);
    }

    public function update(array $data)
    {
        $category = $this->categoryRepository->findOrFail($data['id']);
        $this->categoryRepository->update($category, $data);
    }

    public function updateImage($data)
    {
        $fileName = 'image.webp';
        $path = $data['id'] . '/' . $fileName;
        Storage::disk('category_images')->put($path, file_get_contents(storage_path('app/' . $data['image_path'])));
        $url = asset('storage/category_images/' . $path);
    }

    public function index()
    {
        return $this->categoryRepository->getPaginateCategories();
    }

}
