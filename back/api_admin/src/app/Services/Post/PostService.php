<?php

namespace App\Services\Post;

use App\Models\Post\Post;
use App\Repositories\Post\PostRepository;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function __construct(private PostRepository $postRepository){}


    public function store(array $data): Post
    {
        $post = $this->postRepository->create($data);

        $path = $post->id . '/' . 'image.webp';
        Storage::disk('post_images')->put($path, file_get_contents(storage_path('app/' . $data['image'])));

        $path = asset('storage/post_images/' . $post->id . '/image.webp');

        $this->postRepository->update($post, ['image' => $path]);

        return $post;
    }

    public function show(string $id){
        return $this->postRepository->findOrFail($id);
    }

    public function destroy(string $id)
    {
        $post = $this->postRepository->findOrFail($id);
        $this->postRepository->delete($post);
    }

    public function update(array $data)
    {
        $post = $this->postRepository->findOrFail($data['id']);
        $this->postRepository->update($post, $data);
    }

    public function updateImage($data)
    {
        $fileName = 'image.webp';
        $path = $data['id'] . '/' . $fileName;
        Storage::disk('post_images')->put($path, file_get_contents(storage_path('app/' . $data['image_path'])));
        $url = asset('storage/post_images/' . $path);
    }

    public function index()
    {
        return $this->postRepository->getPaginatedPosts();
    }

}
