<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;
    public $productEdit;

    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;



    public function mount($product)
    {
        $this->productEdit = $product->only(
            'sku',
            'name',
            'description',
            'price',
            'image_path',
            'subcategory_id'
        );

        $this->families = Family::orderBy('name', 'ASC')->get();
        $this->category_id = $product->subcategory->category->id;
        $this->family_id = $product->subcategory->category->family_id;
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->js("alert('There are errors in the form. Please check the fields.')");
            }
        });
    }

    public function updatedFamilyId()
    {
        $this->category_id = '';
        $this->productEdit['subcategory_id'] = '';
    }

    public function updatedCategoryId()
    {
        $this->productEdit['subcategory_id'] = '';
    }

    #[Computed]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->orderBy('name')->get();
    }

    #[Computed]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }

    public function store()
    {
        $this->validate([
            'image' => 'nullable|image|max:2048',
            'productEdit.sku' => 'required|unique:products,sku,' . $this->product->id,
            'productEdit.name' => 'required|max:255',
            'productEdit.description' => 'required',
            'productEdit.price' =>'required|numeric|min:0',
            'productEdit.subcategory_id' =>'required|exists:subcategories,id',
            'family_id' =>'required|exists:families,id',
            'category_id' =>'required|exists:categories,id',
        ]);

        if ($this->image) {
            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');
        }

        $product = $this->product->update($this->productEdit);

        return redirect()->route('admin.products.index')->with("success", "Product {$this->productEdit['name']} updated successfully");
       
    }
}
