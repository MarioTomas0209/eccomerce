<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')
            ->with('family')
            ->paginate(10)
            ->withQueryString()
            ->onEachSide(1);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families = Family::orderBy('name', 'asc')->get();

        return view('admin.categories.create', compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'family_id' => 'required|integer|exists:families,id',
        ]);

        $category = Category::create($request->all());

        return redirect()->route('admin.categories.index')->with("success", "Category {$category->name} created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $families = Family::orderBy('name', 'asc')->get();
        return view('admin.categories.edit', compact('category', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'family_id' => 'required|integer|exists:families,id',
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with("success", "Category {$category->name} updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->subcategories->count() > 0) {
            session()->flash('error', "Category {$category->name} cannot be deleted because it has subcategories");
            return redirect()->route('admin.categories.index');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with("success", "Category {$category->name} deleted successfully");
    }
}
