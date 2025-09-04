<x-admin-layout title="Almacenes | Inventario" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Almacenes',
    ],
]">

    <x-slot name="action">
        <x-wire-button green href="{{ route('admin.warehouses.import') }}">
            <i class="fas fa-file-import"></i>
            Importar</x-wire-button>
        <x-wire-button blue href="{{ route('admin.warehouses.create') }}">
            <i class="fas fa-plus"></i>
            Nuevo</x-wire-button>
    </x-slot>
    @livewire('admin.datatables.warehouse-table')
    @push('js')
        <script>
            forms = document.querySelectorAll(".delete-form")
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Estas seguro?",
                        text: "No podras revertir esta acción",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                })
            });
        </script>
    @endpush
</x-admin-layout>
