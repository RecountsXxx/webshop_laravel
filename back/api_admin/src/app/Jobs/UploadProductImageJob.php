<?php

namespace App\Jobs;

use App\Services\Product\ProductService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadProductImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(ProductService $productService)
    {
         foreach ($this->data['image_paths'] as $key => $imagePath) {
            $imageContent = Storage::disk('local')->get($imagePath);
            $productService->uploadImages($this->data['id'], $imageContent);
        }
    }
}

