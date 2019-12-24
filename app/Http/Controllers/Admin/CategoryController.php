<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        //injection
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(CategoryRequest $request)
    public function store(CategoryRequest $request)
    {
        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $createCategory = $this->categoryService->create($data);

        if ($createCategory) {
            return redirect('admin/categories')->with('success', 'Create success!');
        } else {
            return back()->with('error', 'Create failed!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryService->getCategoryById($id);

        return view('admin.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $updateCategory = $this->categoryService->update($id, $data);

        if ($updateCategory) {
            return redirect('admin/categories')->with('success', 'Update success!');
        } else {
            return back()->with('error', 'Update failed!');
        }
    }

    /**
     * Confirm deleting category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDestroy($id)
    {
        $categories = $this->categoryService->getCategoryById($id);

        return view('admin.categories.destroy', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteCategory = $this->categoryService->delete($id);

        if ($deleteCategory) {
            return redirect('admin/categories')->with('success', 'Delete success!');
        } else {
            return back()->with('error', 'Delete failed!');
        }
    }
}
