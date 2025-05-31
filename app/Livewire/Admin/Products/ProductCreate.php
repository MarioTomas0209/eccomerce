<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;

class ProductCreate extends Component
{
    public $product = [
        'sku' => '',
       'name' => '',
       'description' => '',
       'price' => '',
       'image_path' => '',
       'subcategory_id' => '',
    ];
    public $families;

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
