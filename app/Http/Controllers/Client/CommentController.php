<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Store user's comments in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $data = $request->only([
            'product_id',
            'content',
        ]);

        $data['user_id'] = auth()->id();

        Comment::create($data);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Store user's reply comments in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReply(Request $request)
    {
        $data = $request->only([
            'product_id',
            'parent_id',
            'content',
        ]);

        $data['user_id'] = auth()->id();

        Comment::create($data);

        return response()->json([
            'status' => true,
        ]);
    }
}
