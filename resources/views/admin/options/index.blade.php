<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Options',
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.products.index') }}" class="btn btn-red">
            Back
        </a>
    </x-slot>

    @livewire('admin.options.manage-options')


</x-admin-layout>