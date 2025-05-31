<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategories',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => $subcategory->name, 
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-red">
            Back
        </a>
    </x-slot>

    <div class="card">
        <div class="card-body">
            @livewire('admin.subcategories.subcategory-edit', ['subcategory' => $subcategory])
        </div>
    </div>

</x-admin-layout>