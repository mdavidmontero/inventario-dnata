<x-admin-layout title="Productos | Inventario" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
    ],
]">
    @push('css')
        <style>
            table th span,
            table td {
                font-size: 0.75rem !important;
            }

            .image-product {
                width: 5rem;
                height: 3rem;
                object-fit: cover;
                object-position: center;
            }
        </style>
    @endpush

    <x-slot name="action">
        <x-wire-button green href="{{ route('admin.products.import') }}">
            <i class="fas fa-file-import"></i>
            Importar</x-wire-button>
        <x-wire-button blue href="{{ route('admin.products.create') }}">
            <i class="fas fa-plus"></i>
            Nuevo</x-wire-button>
    </x-slot>
    @livewire('admin.datatables.product-table')
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
