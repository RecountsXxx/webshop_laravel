<?php

namespace App\Jobs;

use App\Models\Vendor\Vendor;
use App\Services\Category\CategoryService;
use App\Services\Vendor\VendorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateVendorImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(VendorService $vendorService)
    {
        $vendorService->updateImage($this->data);
    }
}

