@foreach ($comments as $comment)
<div class="comment_list">
    <div class="review_item @if($comment->parent_id != null) reply @endif">
        <div class="media">
            <div class="d-flex">
                <img alt="" src="img/product/single-product/review-1.png">
                </img>
            </div>
            <div class="media-body">
                <h4 class="parent_name" id="parent_comment">{{ $comment->user ? $comment->user->name : '' }}</h4>
                <h5>
                    {{ $comment->created_at }}
                </h5>
                <button type="button" class="reply_btn">
                    Reply
                </button>
            </div>
        </div>
        @if ($comment->parent)
        <p>
            <a href="#parent_comment" style="font-weight: 700;">
                {{ $comment->parent->user->name }}
            </a> {{ $comment->content }}
        </p>
        @else
        <p>
            {{ $comment->content }}
        </p>
        @endif
    </div> @include('client.products.comment', ['comments'=> $comment->replies])
    <div class="comment_reply display_none">
        <form class="row contact_form">
            <div class="col-md-12">
                <div class="form-group">
                    <textarea class="form-control reply_content" name="reply_content" placeholder="Reply message" rows="1"></textarea>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <button data-product-id="{{ $product->id }}" data-parent-id="{{ $comment->id }}" class="btn submit_btn submit_reply" type="submit" value="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach
