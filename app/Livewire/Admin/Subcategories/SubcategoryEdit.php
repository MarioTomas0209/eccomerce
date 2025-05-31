<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $subcategory;
    public $families;

    public $subcategoryEdit;

    public function mount($subcategory)
    {
        $this->families = Family::orderBy('name', 'asc')->get();
        $this->subcategoryEdit = [
            'family_id' => $subcategory->category->family_id,
            'category_id' => $subcategory->category_id,
            'name' => $subcategory->name,
        ];
    }

    public function updatedSubcategoryEditFamilyId()
    {
        $this->subcategoryEdit['category_id'] = '';
    }

    #[Computed]
    public function categories()
    {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->orderBy('name', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }

    public function save()
    {
        $this->validate([
            'subcategoryEdit.family_id' => 'required',
            'subcategoryEdit.category_id' => 'required',
            'subcategoryEdit.name' => 'required',
        ]);

        $this->subcategory->update($this->subcategoryEdit);

        return redirect()->route('admin.subcategories.index')->with("success", "Subcategory {$this->subcategoryEdit['name']} updated successfully");
    }
}
