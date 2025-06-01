<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;
    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'price' => '',
        'image_path' => '',
        'subcategory_id' => '',
    ];
    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;

    public function mount()
    {
        $this->families = Family::orderBy('name')->get();
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
        $this->product['subcategory_id'] = '';
    }

    public function updatedCategoryId()
    {
        $this->product['subcategory_id'] = '';
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
        return view('livewire.admin.products.product-create');
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image|max:2048',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'required',
            'product.price' => 'required|numeric|min:0',
            'product.subcategory_id' => 'required|exists:subcategories,id',

            'family_id' =>'required|exists:families,id',
            'category_id' =>'required|exists:categories,id',
        ]);

        $this->product['image_path'] = $this->image->store('products');

        $product = Product::create($this->product);    

        return redirect()->route('admin.products.index')->with("success", "Product {$product->name} created successfully.");
    }
}
