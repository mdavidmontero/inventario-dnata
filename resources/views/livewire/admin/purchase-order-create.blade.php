<div>
    <x-wire-card>
        <form wire:submit='save' class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
                <x-wire-native-select label='Tipo de Comprobante' wire:model='voucher_type'>
                    <option value="1">Factura</option>
                    <option value="2">Boleta</option>
                </x-wire-native-select>
                <x-wire-input label='Serie' wire:model='serie' placeholder="Serie del comprobante" disabled />
                <x-wire-input label='Correlativo' wire:model='correlative' placeholder="Correlativo del comprobante"
                    disabled />
                <x-wire-input label='Fecha' wire:model='date' type='date' />

            </div>

            <x-wire-select label='Proveedor' wire:model='supplier_id' :async-data="[
                'api' => route('api.suppliers.index'),
                'method' => 'POST',
            ]" option-label="name"
                option-value="id" placeholder="Selecciona un proveedor" />

            <div class="flex space-x-4">
                <x-wire-select label='Productos' wire:model='product_id' :async-data="[
                    'api' => route('api.products.index'),
                    'method' => 'POST',
                ]" option-label="name"
                    option-value="id" placeholder="Selecciona un producto" class="flex-1" />
                <div class="flex-shrink-0">
                    <x-wire-button type="button" class="mt-6.5" blue>Agregar Producto</x-wire-button>
                </div>
            </div>
        </form>

    </x-wire-card>
</div>
