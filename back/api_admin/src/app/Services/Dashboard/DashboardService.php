<?php

namespace App\Services\Dashboard;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\JoinToVendors\JoinToVendorsRepository;
use app\Repositories\Product\Order\CommentRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Vendor\VendorRepository;
use App\Repositories\VendorUser\VendorUserRepository;

class DashboardService
{
    protected $brandRepository;
    protected $userRepository;
    protected $adminRepository;
    protected $vendorRepository;
    protected $productRepository;
    protected $categoryRepository;
    protected $orderRepository;
    protected $joinToVendorsRepository;
    protected $vendorUsersRepository;
    public function __construct(
        ProductRepository       $productRepository,
        UserRepository          $userRepository,
        AdminRepository         $adminRepository,
        VendorRepository        $vendorRepository,
        BrandRepository         $brandRepository,
        CategoryRepository      $categoryRepository,
        CommentRepository       $orderRepository,
        JoinToVendorsRepository $joinToVendorsRepository,
        VendorUserRepository    $vendorUserRepository,
    ) {
        [
            $this->productRepository,
            $this->userRepository,
            $this->adminRepository,
            $this->vendorRepository,
            $this->brandRepository,
            $this->categoryRepository,
            $this->orderRepository,
            $this->joinToVendorsRepository,
            $this->vendorUsersRepository,

        ] = func_get_args();
    }

    public function index()
    {
        $stats = [
            'products' => $this->productRepository->count(),
            'users' => $this->userRepository->count(),
            'admins' => $this->adminRepository->count(),
            'brands' => $this->brandRepository->count(),
            'vendors' => $this->vendorRepository->count(),
            'categories' => $this->categoryRepository->count(),
            'orders' => $this->orderRepository->count(),
            'join_to_vendors' => $this->joinToVendorsRepository->count(),
            'vendor_users' => $this->vendorUsersRepository->count(),
        ];

        return $stats;
    }
}
