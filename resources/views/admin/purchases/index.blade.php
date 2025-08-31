<x-admin-layout title="Compras | Inventario" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Compras',
    ],
]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.purchases.create') }}">Nuevo</x-wire-button>
    </x-slot>

    @livewire('admin.datatables.purchase-table')
</x-admin-layout>
