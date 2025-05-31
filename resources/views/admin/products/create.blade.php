<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Products',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => 'New', 
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.products.index') }}" class="btn btn-red">
            Back
        </a>
    </x-slot>

    <div class="card">
        <div class="card-body">
           @livewire('admin.products.product-create')
        </div>
    </div>


</x-admin-layout>