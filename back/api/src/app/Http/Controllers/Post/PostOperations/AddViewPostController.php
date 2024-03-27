<?php

namespace App\Http\Controllers\Post\PostOperations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ViewRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostOperations;

class AddViewPostController extends Controller
{
    public function __construct(private PostOperations $featuresService){}

    public function __invoke(ViewRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->featuresService->addViewsToPost($request->post_id);
            return new BaseWithResponseResource(null, 'Added view','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
