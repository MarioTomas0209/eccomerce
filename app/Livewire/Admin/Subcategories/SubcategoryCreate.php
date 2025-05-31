<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryCreate extends Component
{
    public $families;
    public $subcategory = [
        'family_id' => '',
        'category_id' => '',
        'name' => '',
    ];

    public function mount()
    {
        $this->families = Family::orderBy('name', 'asc')->get();
    }

    public function updatedSubcategoryFamilyId()
    {
        $this->subcategory['category_id'] = '';
    }

    #[Computed]
    public function categories() 
    {
        return Category::where('family_id', $this->subcategory['family_id'])->orderBy('name', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }

    public function save()
    {
        $this->validate([
            'subcategory.family_id' => 'required|integer|exists:families,id',
            'subcategory.category_id' => 'required|integer|exists:categories,id',
            'subcategory.name' => 'required|string|max:255',
        ]);

        $subcategory = Subcategory::create($this->subcategory);
        
        return redirect()->route('admin.subcategories.index')->with("success", "Subcategory {$subcategory->name} created successfully");
    }
}
