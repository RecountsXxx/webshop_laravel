<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Jobs\Post\UpdatePostImageJob;
use App\Jobs\Post\UploadPostImageJob;
use App\Services\Post\PostService;

class PostController extends Controller
{
    public function __construct(private PostService $postService){}

    public function index(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $posts = $this->postService->index();
            return new BaseWithResponseResource(['posts'=> $posts], 'show posts', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function store(PostRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $imagePath = $request->file('image')->store('images');
            $data = [
                'title'=>$request->title,
                'text'=>$request->text,
                'image'=>$imagePath,
            ];
            UploadPostImageJob::dispatch($data)->onQueue('upload.images.jobs');
            return new BaseWithResponseResource(null, 'create post', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function update(UpdatePostRequest $request, string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $data = [
                'id'=>$id,
                'title'=>$request->title,
                'text'=>$request->text,
            ];

            $this->postService->update($data);


            if($request->image){
                $image_path = $request->file('image')->store('images');
                $data = [
                    'id'=>$id,
                    'image_path'=>$image_path,
                ];

                UpdatePostImageJob::dispatch($data)->onQueue('upload.images.jobs');
            }

            return new BaseWithResponseResource(null, 'update post', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function show(string $id)
    {
        try {
            $post = $this->postService->show($id);
            return new BaseWithResponseResource(['post'=>$post], 'show post');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function destroy(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->postService->destroy($id);
            return new BaseWithResponseResource(null, 'delete post', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
