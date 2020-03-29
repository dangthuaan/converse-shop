<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Favorite;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categories')->orderBy('created_at', 'desc')->paginate(config('pagination.product_page_size'));

        $parentCategory = Category::with('parent')->get()->pluck('parent.name', 'id');

        $data = ['products' => $products, 'parentCategory' => $parentCategory];

        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::with('children')->whereNull('parent_id')->get();

        return view('admin.products.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->only([
            'image',
            'name',
            'gender',
            'category',
            'description',
            'publish_date',
            'price',
            'sale'
        ]);

        $data['publish_date'] = Carbon::parse($request->publish_date)->toDateString();

        $data['user_id'] = auth()->id();

        $data['image'] = $this->productService->saveImage($data['image']);

        $data['category'] = $this->productService->getCategoryId($data['category']);

        $categoryIds = $request->category;
        $createProduct = $this->productService->create($data, $categoryIds);

        if ($createProduct) {
            return redirect('admin/products')->with('success', 'Create success!');
        }

        return back()->with('error', 'Create failed!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('categories')->findOrFail($id);

        $parentCategories = Category::with('children')->whereNull('parent_id')->get();

        return view('admin.products.edit', compact('product', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->only([
            'image',
            'name',
            'gender',
            'category',
            'description',
            'publish_date',
            'price',
            'sale'
        ]);

        $data['publish_date'] = Carbon::parse($request->publish_date)->toDateString();

        $userFavorites = Favorite::with('user')->where('product_id', $id)->get();

        $data['user_id'] = auth()->id();

        if (isset($data['image'])) {
            $data['image'] = $this->productService->saveImage($data['image']);
        }

        $data['category'] = $this->productService->getCategoryId($data['category']);

        $updateProduct = $this->productService->update($id, $data, $userFavorites);

        if ($updateProduct) {
            return redirect('admin/products')->with('success', 'Update success!');
        }

        return back()->with('error', 'Update failed!');
    }

    /**
     * Confirm deleting category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id)
    {
        $product = $this->productService->getProductById($id);

        return view('admin.products.confirmDelete', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteProduct = $this->productService->delete($id);

        if ($deleteProduct) {
            return redirect('admin/products')->with('success', 'Delete success!');
        }

        return back()->with('error', 'Delete failed!');
    }
}
