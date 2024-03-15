<?php

namespace App\Services\Admin;

use App\Models\Admin\Admin;
use App\Models\Brand\Brand;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    public function __construct(private AdminRepository $adminRepository){}


    public function store(array $data): Admin
    {
        return $this->adminRepository->create($data);
    }

    public function show(string $id){
        return $this->adminRepository->findOrFail($id);
    }

    public function destroy(string $id)
    {
        $admin = $this->adminRepository->findOrFail($id);
        $this->adminRepository->delete($admin);
    }

    public function update(array $data)
    {
        $admin = $this->adminRepository->findOrFail($data['id']);
        $this->adminRepository->update($admin, $data);
    }

    public function index()
    {
        return $this->adminRepository->getPaginateAdmins();
    }

}
