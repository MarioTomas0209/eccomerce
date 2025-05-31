<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Families',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'New', 
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.families.index') }}" class="btn btn-red">
            Back
        </a>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.families.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <x-label class="mb-2">
                        Name
                    </x-label>

                    <x-input name="name" class="w-full" placeholder="Enter family name" value="{{ old('name') }}" />

                    <x-input-error for="name" />
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