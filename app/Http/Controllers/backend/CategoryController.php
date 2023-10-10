<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('category-list');
        $categories=Category::select('id','category_name','created_at')->latest('id')->get();
        return view('backend.pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('category-create');
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('category-create');
        $validation=$request->validate([
            'category_name'=>'required|string|max:255',
        ]);

        $category=Category::create([
            'category_name'=>$request->category_name,
        ]);
        Toastr::success('Category created successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('category-edit');
        $category=Category::findOrFail($id);
        return view('backend.pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('category-edit');
        $validation=$request->validate([
            'category_name'=>'required|string|max:255',
        ]);
        $category=Category::findOrFail($id);
        $category->update([
            'category_name'=>$request->category_name,
        ]);
        Toastr::success('Category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('category-delete');
        $category=Category::findOrFail($id);
        $category->delete();
        Toastr::success('Category deleted successfully');
        return redirect()->route('category.index');
    }
}
