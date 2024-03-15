<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Repositories\Admin\AdminRepository;
use App\Services\Admin\AdminService;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class AdminController extends Controller
{
    public function __construct(private AdminService $adminService)
    {

    }

    public function index()
    {
        try {
            $admins = $this->adminService->index();
            return new BaseWithResponseResource(['admins' => $admins], 'show admins');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(AdminRequest $request)
    {
        try {
            $data = [
                'email' => $request->email,
                'name'=>$request->name,
                'password'=>$request->password
            ];
            $this->adminService->store($data);
            return new BaseWithResponseResource(['admin' => null], 'add admin');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $admin = $this->adminService->show($id);
            return new BaseWithResponseResource(['admin' => $admin], 'show admin');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function update(AdminRequest $request, string $id)
    {
        try {
            $data = [
                'id'=>$id,
                'email' => $request->email,
                'name'=>$request->name,
                'password'=>$request->password
            ];
             $this->adminService->update($data,$id);
            return new BaseWithResponseResource(['admin' => null], 'update admin');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->adminService->destroy($id);
            return new BaseWithResponseResource(['admin' => null], 'delete admin');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
