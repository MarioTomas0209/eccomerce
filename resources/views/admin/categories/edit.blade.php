<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categories',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => $category->name, 
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-red">
            Back
        </a>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-label class="mb-2">
                        Name
                    </x-label>

                    <x-input name="name" class="w-full" placeholder="Enter category name" value="{{ old('name', $category->name) }}" />

                    <x-input-error for="name" />
                </div>

                <div class="mb-4">
                    <x-label class="mb-2">
                        Family
                    </x-label>

                    <select name="family_id" class="w-full select">
                        <option value="">Select family</option>
                        @foreach ($families as $item)
                            <option value="{{ $item->id }}" 
                                {{ old('family_id', $category->family_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('family_id')
                        <p class="text-red-500 text-sm mt-2">
                            Selecciona una familia
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-button class="btn btn-blue">
                        Update
                    </x-button>
                </div>

            </form>
        </div>
    </div>

</x-admin-layout>