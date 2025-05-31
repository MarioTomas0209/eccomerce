<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::orderBy('id', 'desc')
            ->with('category.family')
            ->paginate(10)
            ->withQueryString()
            ->onEachSide(1);

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $subcategory = Subcategory::create($request->all());

        return redirect()->route('admin.subcategories.index')->with("success", "Subcategory {$subcategory->name} created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'category_id' =>'required|integer|exists:categories,id',
        ]);
        $subcategory->update($request->all());
        return redirect()->route('admin.subcategories.index')->with("success", "Subcategory {$subcategory->name} updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->products->count() > 0) {
            session()->flash('error', "Subcategory {$subcategory->name} cannot be deleted because it has products");
            return redirect()->route('admin.subcategories.index');
        }
        
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with("success", "Subcategory {$subcategory->name} deleted successfully");
    }
}
