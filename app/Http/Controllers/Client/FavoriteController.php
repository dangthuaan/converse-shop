<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FavoriteService;
use Illuminate\Support\Facades\Log;
use App\Favorite;
use App\Product;

class FavoriteController extends Controller
{
    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoriteProducts = Favorite::paginate(config('pagination.favorite_page_size'));
        return view('client.favorites.index', compact('favoriteProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->product_id;
        $userId = auth()->id();
        $product = $this->favoriteService->getProductById($productId);

        $data = [
            'user_id' => $userId,
            'product_id' => $productId,
            'price' => $product->price,
            'sale' => $product->sale,
        ];

        $createFavoriteData = $this->favoriteService->createFavoriteData($data);

        return response()->json([
            'status' => $createFavoriteData,
        ]);
    }
}
