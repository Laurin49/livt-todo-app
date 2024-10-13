<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::all();
    return inertia('Category/Index', [
      'categories' => $categories
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return inertia('Category/Create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request)
  {
    Category::create(
      $request->validated()
    );
    return redirect()
      ->route('categories.index')
      ->with('message', "Category has been created successfully.");
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category)
  {
    return inertia('Category/Show', [
      'category' => CategoryResource::make($category)
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    return inertia('Category/Edit', [
      'category' => CategoryResource::make($category)
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCategoryRequest $request, Category $category)
  {
    $category->update($request->validated());
    return redirect()
      ->route('categories.index')
      ->with('message', "Category has been updated successfully.");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    $category->delete();
    return redirect()
      ->route('categories.index')
      ->with('message', "Category has been deleted successfully.");
  }
}
