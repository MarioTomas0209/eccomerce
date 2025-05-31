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
        'name' => 'New', 
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-red">
            Back
        </a>
    </x-slot>

    <div class="card">
        <div class="card-body">
            
            @livewire('admin.subcategories.subcategory-create')

        </div>
    </div>

</x-admin-layout>