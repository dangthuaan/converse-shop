<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Store user's comments in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {
        $data = $request->only([
            'product_id',
            'content',
        ]);

        $data['user_id'] = auth()->id();

        $storeComment = $this->commentService->storeComment($data);

        return response()->json([
            'status' => $storeComment,
        ]);
    }

    /**
     * Store user's reply comments in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCommentReply(Request $request)
    {
        $data = $request->only([
            'product_id',
            'parent_id',
            'content',
        ]);

        $data['user_id'] = auth()->id();

        $storeCommentReply = $this->commentService->storeComment($data);

        return response()->json([
            'status' => $storeCommentReply,
        ]);
    }
}
