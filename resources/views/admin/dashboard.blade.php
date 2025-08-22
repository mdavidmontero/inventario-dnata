<x-admin-layout title="Dashboard | Inventario" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Prueba',
    ],
]">
    <x-slot name="action">
        Hola desde el admin
    </x-slot>
    Hola desde el admin
    <x-wire-button>Prueba</x-wire-button>

</x-admin-layout>
