<form wire:submit="save">

    <div class="mb-4">
        <x-label class="mb-2">
            Family
        </x-label>

        <select name="category_id" class="w-full select" wire:model.live="subcategoryEdit.family_id">
            <option value="" disabled>Select Family</option>

            @foreach ($families as $item )
            <option value="{{ $item->id }}">
                {{ $item->name }}
            </option>
            @endforeach
        </select>

        @error('subcategoryEdit.category_id')
        <p class="text-red-500 text-sm mt-2">
            Selecciona una familia
        </p>
        @enderror
    </div>

    <div class="mb-4">
        <x-label class="mb-2">
            Name
        </x-label>

        <x-input wire:model="subcategoryEdit.name" class="w-full" placeholder="Enter subcategoryEdit name" />

        @error('subcategoryEdit.name')
        <p class="text-red-500 text-sm mt-2">
            El nombre es requerido
        </p>
        @enderror
    </div>

    <div class="mb-4">
        <x-label class="mb-2">
            Category
        </x-label>

        <select class="w-full select" wire:model.live="subcategoryEdit.category_id">
            <option value="" disabled>Select category</option>

            @foreach ($this->categories as $item )
            <option value="{{ $item->id }}" {{ old('category_id')==$item->id ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
            @endforeach
        </select>

        @error('subcategoryEdit.category_id')
        <p class="text-red-500 text-sm mt-2">
            Selecciona una categoría
        </p>
        @enderror
    </div>

    <div class="flex justify-end">
        <x-button class="btn btn-blue">
            Update
        </x-button>
    </div>

</form>