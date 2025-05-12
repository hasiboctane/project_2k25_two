<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return [
            new Middleware('permission:view categories', only: ['index', 'show']),
            new Middleware('permission:create categories', only: ['create', 'store']),
            new Middleware('permission:edit categories', only: ['edit', 'update']),
            new Middleware('permission:delete categories', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $path = null;
        if($request->hasFile('image')){
            $originalImage = $request->file('image');
            $imageName = 'category-'.time() . '.' . $originalImage->extension();

            $path = Storage::disk('public')->putFileAs('categories',$originalImage, $imageName);
        }

        Category::create([
            'name' =>$request->name,
            'image' => $path
        ]);
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // dd($request->all());
        $path = $category->image;
        if($request->hasFile('image')){
            if($category->image){
                Storage::disk('public')->delete($category->image);
            }
            $originalImage = $request->file('image');
            $imageName = 'category-'.time().'.'.$originalImage->extension();
            $path = Storage::disk('public')->putFileAs('categories', $originalImage, $imageName);
        }
        $category->update([
            'name' => $request->name,
            'image' => $path
        ]);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        // through ajax
        try {
            // Delete the image from storage
            if($category->image){
                Storage::disk('public')->delete($category->image);
            }
            // Delete the category from the database
            $category->delete();
            return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete category'], 500);
        }


    }
    public function ajaxStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255'
        ]);

        $category = Category::create(['name' => $request->name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category added successfully',
            'category' => $category
        ]);
    }
}
