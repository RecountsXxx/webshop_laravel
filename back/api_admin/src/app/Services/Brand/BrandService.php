<?php

namespace App\Services\Brand;

use App\Models\Brand\Brand;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public function __construct(private BrandRepository $brandRepository){}


    public function store(array $data): Brand
    {
        $brand = $this->brandRepository->create($data);

        $path = $brand->id . '/' . 'image.webp';
        Storage::disk('brand_images')->put($path, file_get_contents(storage_path('app/' . $data['image'])));

        $path = asset('storage/brand_images/' . $brand->id . '/image.webp');

        $this->brandRepository->update($brand, ['image' => $path]);

        return $brand;
    }

    public function show(string $id){
        return $this->brandRepository->findOrFail($id);
    }

    public function destroy(string $id)
    {
        $brand = $this->brandRepository->findOrFail($id);
        $this->brandRepository->delete($brand);
    }

    public function update(array $data)
    {
        $brand = $this->brandRepository->findOrFail($data['id']);
        $this->brandRepository->update($brand, $data);
    }

    public function updateImage($data)
    {
        $fileName = 'image.webp';
        $path = $data['id'] . '/' . $fileName;
        Storage::disk('brand_images')->put($path, file_get_contents(storage_path('app/' . $data['image_path'])));
        $url = asset('storage/brand_images/' . $path);
    }

    public function index()
    {
        return $this->brandRepository->getPaginateBrands();
    }

}
