<?php

namespace App\Services\Vendor;

use App\Models\Brand\Brand;
use App\Models\Category\Category;
use App\Models\Vendor\Vendor;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Vendor\VendorRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VendorService
{
    public function __construct(private VendorRepository $vendorRepository){}


    public function store(array $data): Vendor
    {
        $vendor = $this->vendorRepository->create($data);

        $path = $vendor->id . '/' . 'image.webp';
        Storage::disk('vendor_images')->put($path, file_get_contents(storage_path('app/' . $data['image'])));

        $path = asset('storage/vendor_images/' . $vendor->id . '/image.webp');

        $this->vendorRepository->update($vendor, ['image' => $path]);

        return $vendor;
    }

    public function show(string $id){
        return $this->vendorRepository->findOrFail($id);
    }

    public function destroy(string $id)
    {
        $vendor = $this->vendorRepository->findOrFail($id);
        $this->vendorRepository->delete($vendor);
    }

    public function update(array $data)
    {
        $vendor = $this->vendorRepository->findOrFail($data['id']);
        $this->vendorRepository->update($vendor, $data);
    }

    public function updateImage($data)
    {
        $fileName = 'image.webp';
        $path = $data['id'] . '/' . $fileName;
        Storage::disk('vendor_images')->put($path, file_get_contents(storage_path('app/' . $data['image_path'])));
        $url = asset('storage/vendor_images/' . $path);
    }

    public function index()
    {
        return $this->vendorRepository->getPaginateVendors();
    }

}

