<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;

class PostService
{
    public function __construct(private PostRepository $postRepository){}

    public  function index()
    {
        return $this->postRepository->getPaginatedPosts();
    }
    public  function show($id)
    {
        return $this->postRepository->findOrFail($id);
    }
}
