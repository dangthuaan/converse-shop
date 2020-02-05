<?php

namespace App\Http\Controllers\Client;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Comment;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('categories')->paginate(config('pagination.product_page_size'));

        if ($request->has('size')) {
            $sizeName = $request->size;
            $sizeArray = explode(',', $sizeName);

            $products = Product::whereHas('categories', function (Builder $query) use ($sizeArray) {
                $query->whereIn('name', $sizeArray);
            })->paginate(config('pagination.product_page_size'));
        }

        return view('client.products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('client.products.show', compact('product'));
    }
}
