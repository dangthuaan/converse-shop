<?php

namespace App\Http\Controllers\Client;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Product;
use App\Category;
use App\Favorite;

class ProductController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('categories')->paginate(config('pagination.product_page_size'));

        $parentCategories = Category::with('children')->whereNull('parent_id')->get();

        $favoriteProducts = Favorite::where('user_id', auth()->id())->pluck('product_id')->toArray();

        if ($request->has('categories')) {
            $categoriesName = $request->get('categories');
            $categoriesArray = explode(',', $categoriesName);

            $products = Product::whereHas('categories', function (Builder $query) use ($categoriesArray) {
                $query->whereIn('name', $categoriesArray);
            })->paginate(config('pagination.product_page_size'));
        }

        return view('client.products.index', compact('products', 'favoriteProducts', 'parentCategories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentCategory = Category::with('parent')->get()->pluck('parent.name', 'id');
        $product = Product::with('categories')->findOrFail($id);
        $images = explode('|', $product->image);

        $productSession = $this->orderService->getProductSession();
        $orderSession = session('order_session');

        $favoriteProducts = Favorite::where('user_id', auth()->id())->pluck('product_id')->toArray();

        $data = [
            'parentCategory' => $parentCategory,
            'product' => $product,
            'images' => $images,
            'product_session' => $productSession,
            'order_session' => $orderSession,
            'favoriteProducts' => $favoriteProducts,
        ];

        return view('client.products.show', $data);
    }
}
