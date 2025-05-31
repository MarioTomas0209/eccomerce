<div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- SKU -->
        <div>
            <x-label value="SKU" />
            <x-input type="text" 
                     wire:model.defer="product.sku"
                     class="w-full" />
            <x-input-error for="product.sku" />
        </div>

        <!-- Nombre -->
        <div>
            <x-label value="Name" />
            <x-input type="text" 
                     wire:model.live="product.name"
                     class="w-full" />
            <x-input-error for="product.name" />
        </div>

        <!-- Descripción -->
        <div class="col-span-2">
            <x-label value="Description" />
            <textarea wire:model.defer="product.description"
                      class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            <x-input-error for="product.description" />
        </div>

        <!-- Precio -->
        <div>
            <x-label value="Price" />
            <x-input type="number" 
                     wire:model.defer="product.price"
                     step=".01"
                     class="w-full" />
            <x-input-error for="product.price" />
        </div>

        <!-- Subcategoría -->
        <div>
            <x-label value="Subcategory" />
            <select wire:model.defer="product.subcategory_id"
                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Seleccione una subcategoría</option>
                {{-- @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach --}}
            </select>
            <x-input-error for="product.subcategory_id" />
        </div>
        
        <!-- Subcategoría -->
        <div>
            <x-label value="Subcategory" />
            <select wire:model.defer="product.subcategory_id"
                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Seleccione una subcategoría</option>
                {{-- @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach --}}
            </select>
            <x-input-error for="product.subcategory_id" />
        </div>

        <!-- Imagen -->
        <div class="col-span-2">
            <x-label value="Image" />
            <div class="flex items-center">
                <input type="file" 
                       wire:model="image"
                       accept="image/*"
                       class="flex-1 border p-2 rounded-lg" />

                <div wire:loading wire:target="image" class="ml-4">
                    <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-indigo-500"></div>
                </div>
            </div>
            <x-input-error for="image" />

            {{-- @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mt-4 h-32 w-auto object-cover" />
            @endif --}}
        </div>
    </div>

    <div class="flex justify-end mt-6 gap-x-4">
        <x-button type="button"
                  wire:click="$set('open', false)"
                  class="bg-gray-500 hover:bg-gray-600">
            Cancelar
        </x-button>

        <x-button type="submit"
                  wire:loading.attr="disabled"
                  wire:target="save, image"
                  class="bg-blue-500 hover:bg-blue-600">
            <span wire:loading.remove wire:target="save">Crear producto</span>
            <span wire:loading wire:target="save">Creando...</span>
        </x-button>
    </div>

</div>
