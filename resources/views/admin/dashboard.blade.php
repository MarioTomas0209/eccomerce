<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
    ]
]">
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">

                {{-- <div>
                    Hola
                </div> --}}

                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold">
                        Bienvenido, {{ Auth::user()->name }}
                    </h2>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="text-sm text-blue-500 hover:text-blue-700">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-center">
            <h2 class="text-xl font-semibold">
                Nombre de la empresa
            </h2>
        </div>

    </div>

</x-admin-layout>
