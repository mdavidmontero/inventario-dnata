<?php

namespace App\Livewire\Admin;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Quote;
use Livewire\Component;

class MovementCreate extends Component
{
    public $type = 1;
    public $serie = 'M001';
    public $correlative;
    public $date;

    public $warehouse_id;
    public $reason_id;
    public $total = 0;
    public $observation;

    public $product_id;

    public $products = [];

    public function boot()
    {
        // Verifica si hay errores de validación
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                $html = "<ul class='text-left'>";
                foreach ($errors as  $error) {
                    $html .= "<li class='text-red-500'>{$error[0]}</li>";
                }
                $html .= "</ul>";
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '!Error de validación!',
                    'html' => $html,
                ]);
            }
        });
    }

    public function mount()
    {
        $this->correlative = Movement::max('correlative') + 1;
    }
    public function updated($property, $value)
    {
        if ($property === 'type') {
            $this->reset('reason_id');
        }
    }

    public function addProduct()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
        ], [], [
            'product_id' => 'Producto'
        ]);

        $existig = collect($this->products)->firstWhere('id', $this->product_id);

        if ($existig) {
            $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => 'Producto Existente',
                'text' => 'El producto ya existe en el pedido',
            ]);
            return;
        }
        $product = Product::find($this->product_id);
        $this->products[] = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'subtotal' => $product->price,
        ];
        $this->reset('product_id');
    }

    public function save()
    {
        $this->validate([
            'type' => 'required|in:1,2',
            'serie' => 'required|string|max:10',
            'correlative' => 'required|numeric|min:1',
            'date' => 'nullable|date',
            'warehouse_id' => 'required|exists:warehouses,id',
            'reason_id' => 'required|exists:reasons,id',
            'total' => 'required|numeric|min:0',
            'observation' => 'nullable|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:0',
            'products.*.price' => 'required|numeric|min:0',
        ], [], [
            'type' => 'Tipo de movimiento',
            'warehouse_id' => 'Almacen',
            'reason_id' => 'Motivo',
            'observation' => 'Observaciones',
            'products.*.id' => 'Producto',
            'products.*.quantity' => 'Cantidad',
            'products.*.price' => 'Precio',
        ]);

        $movement = Movement::create([
            'type' => $this->type,
            'serie' => $this->serie,
            'correlative' => $this->correlative,
            'date' => $this->date ?? now(),
            'warehouse_id' => $this->warehouse_id,
            'total' => $this->total,
            'observation' => $this->observation,
            'reason_id' => $this->reason_id,
        ]);

        foreach ($this->products as $product) {
            $movement->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['price'] * $product['quantity'],
            ]);
        }
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '!Bien Hecho!',
            'text' => 'Movimiento creado con éxito',
        ]);
        return redirect()->route('admin.movements.index');
    }

    public function render()
    {
        return view('livewire.admin.movement-create');
    }
}
