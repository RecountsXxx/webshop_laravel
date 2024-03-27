<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostOnCategoryRequest;
use App\Http\Requests\Post\PostOnUserRequest;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostService;
use OpenApi\Attributes as OAT;

class PostController extends Controller
{

    public function __construct(private PostService $postService)
    {

    }

    public function index()
    {
        try {
           $posts = $this->postService->index();
            return new BaseWithResponseResource(['posts'=>$posts], 'show posts','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function show(string $id)
    {
        try {
           $post =  $this->postService->show($id);
            return new BaseWithResponseResource(['post'=>$post], 'show post','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
