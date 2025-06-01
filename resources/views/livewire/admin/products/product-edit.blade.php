<div class="max-w-4xl mx-auto p-6">
    <form wire:submit="store" class="space-y-6">
        <!-- Image Upload Section -->
        <figure class="relative mb-6 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden hover:border-indigo-500 transition-colors duration-200">
            <div class="absolute top-4 right-4 z-10">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white shadow-md cursor-pointer text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-camera mr-2"></i>
                    Update image
                    <input type="file" class="hidden" accept="image/*" wire:model="image">
                </label>
            </div>
            <div class="aspect-w-16 aspect-h-9">
                <img class="w-full h-full object-cover object-center" src="{{ $image ? $image->temporaryUrl() : asset('storage/' . $productEdit['image_path']) }}" alt="Product preview image">
            </div>
        
        </figure>
        @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- SKU -->
                <div>
                    <x-label value="SKU" class="text-gray-700 font-semibold" />
                    <x-input type="text" wire:model.defer="productEdit.sku" class="w-full mt-1" placeholder="Enter SKU" />
                    @error('productEdit.sku')
                    <p class="text-red-500 text-sm mt-1">El campo SKU es obligatorio</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <x-label value="Name" class="text-gray-700 font-semibold" />
                    <x-input type="text" wire:model.live="productEdit.name" class="w-full mt-1" placeholder="Enter product name" />
                    @error('productEdit.name')
                    <p class="text-red-500 text-sm mt-1">El campo Nombre es obligatorio</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <x-label value="Description" class="text-gray-700 font-semibold" />
                    <textarea wire:model.defer="productEdit.description" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Enter product description"></textarea>
                    @error('productEdit.description')
                        <p class="text-red-500 text-sm mt-1">El campo Descripción es obligatorio</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Price -->
                <div>
                    <x-label value="Price" class="text-gray-700 font-semibold" />
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                        <x-input type="number" wire:model.defer="productEdit.price" step=".01" class="w-full pl-7" placeholder="0.00" />
                    </div>
                    @error('productEdit.price')
                        <p class="text-red-500 text-sm mt-1">El campo Precio es obligatorio</p>
                    @enderror
                </div>

                <!-- Categories Section -->
                <div class="space-y-6">
                    <!-- Families -->
                    <div>
                        <x-label value="Families" class="text-gray-700 font-semibold" />
                        <select wire:model.live="family_id" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select a family</option>
                            @foreach ($families as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('family_id')
                            <p class="text-red-500 text-sm mt-1">El campo Familia es obligatorio</p>
                        @enderror
                    </div>

                    <!-- Categories -->
                    <div>
                        <x-label value="Categories" class="text-gray-700 font-semibold" />
                        <select wire:model.live="category_id" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="" disabled>Select a category</option>
                            @foreach ($this->categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-sm mt-1">El campo Categoría es obligatorio</p>
                        @enderror
                    </div>

                    <!-- Subcategories -->
                    <div>
                        <x-label value="Subcategories" class="text-gray-700 font-semibold" />
                        <select wire:model.live="productEdit.subcategory_id" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="" disabled>Select a subcategory</option>
                            @foreach ($this->subcategories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('productEdit.subcategory_id')
                        <p class="text-red-500 text-sm mt-1">El campo Subcategoría es obligatorio</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6">
            <x-button type="submit" wire:loading.attr="disabled" wire:target="save, image" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200">
                <span wire:loading.remove wire:target="save">
                    Update
                </span>
                <span wire:loading wire:target="save">
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Creando...
                </span>
            </x-button>
        </div>
    </form>
</div>