<?php

namespace App\Http\Controllers\Post\PostOperations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\LikeRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostOperations;

class AddLikePostController extends Controller
{

    public function __construct(private PostOperations $featuresService){}

    public function __invoke(LikeRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->featuresService->addLikeToPost($request->post_id);
            return new BaseWithResponseResource(null, 'Added like','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
