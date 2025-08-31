<x-admin-layout title="Ordenes de Compra | Inventario" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ordenes de Compra',
    ],
]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.purchase-orders.create') }}">Nuevo</x-wire-button>
    </x-slot>
</x-admin-layout>
