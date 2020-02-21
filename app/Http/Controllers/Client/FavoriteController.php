<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FavoriteService;
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
        $favoriteProductIds = Favorite::where('user_id', auth()->id())->pluck('product_id')->toArray();

        $favoriteProducts = Product::whereIn('id', $favoriteProductIds)->get();

        $productImage = $favoriteProducts->pluck('first_image', 'id');

        return view('client.favorites.index', compact('favoriteProducts', 'productImage'));
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

        $data = [
            'user_id' => $userId,
            'product_id' => $productId,
        ];

        $createFavoriteData = $this->favoriteService->createFavoriteData($data);

        return response()->json([
            'status' => $createFavoriteData,
        ]);
    }

    /**
     * Delete created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $productId = $request->product_id;
        $userId = auth()->id();

        $deleteFavoriteData = $this->favoriteService->deleteFavoriteData($userId, $productId);

        return response()->json([
            'status' => $deleteFavoriteData,
        ]);
    }
}
