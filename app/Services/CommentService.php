<?php

namespace App\Services;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class CommentService
{
    /**
     * Store user's comments in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment($commentData)
    {
        try {
            Comment::create($commentData);
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }
}
