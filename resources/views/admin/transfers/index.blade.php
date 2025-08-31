<x-admin-layout title="Transferencias | Inventario" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Transferencias',
    ],
]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.transfers.create') }}">Nuevo</x-wire-button>
    </x-slot>

    @livewire('admin.datatables.transfer-table')
</x-admin-layout>
