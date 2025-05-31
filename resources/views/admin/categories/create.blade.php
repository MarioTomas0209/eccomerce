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
        'name' => 'New', 
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-red">
            Back
        </a>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <x-label class="mb-2">
                        Name
                    </x-label>

                    <x-input name="name" class="w-full" placeholder="Enter category name" value="{{ old('name') }}" />

                    <x-input-error for="name" />
                </div>

                <div class="mb-4">
                    <x-label class="mb-2">
                        Family
                    </x-label>

                    <select name="family_id" class="w-full select">
                        <option value="">Select family</option>

                        @foreach ($families as $item )
                            <option value="{{ $item->id }}" {{ old('family_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('family_id')
                        <p class="text-red-500 text-sm mt-2">
                            El campo family es obligatorio.
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-button class="btn btn-blue">
                        Create
                    </x-button>
                </div>

            </form>
        </div>
    </div>

</x-admin-layout>