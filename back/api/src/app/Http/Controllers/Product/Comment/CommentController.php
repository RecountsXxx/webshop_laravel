<?php

namespace App\Http\Controllers\Product\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Comment\CommentRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Product\Comment\CommentService;

class CommentController extends Controller
{
    public function __construct(private CommentService $commentService){}


    public function show(string $id){
        try {
            $comments = $this->commentService->show_on_product($id);
            return new BaseWithResponseResource(['comments'=>$comments], 'show comments on product','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(CommentRequest $request)
    {
        $data = [
            'text'=>$request->text,
            'product_id'=>$request->product_id,
            'author_id'=>$request->author_id,
            'rating'=>$request->rating,
        ];
        try {
            $this->commentService->store($data);
            return new BaseWithResponseResource(['comment'=>null], 'create comment','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
