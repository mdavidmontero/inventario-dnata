<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return view('admin.purchase-orders.index');
    }

    public function create()
    {
        return view('admin.purchase-orders.create');
    }
    public function pdf(PurchaseOrder $purchaseOrder)
    {
        $pdf = Pdf::loadView('admin.purchase-orders.pdf', [
            'purchaseOrder' => $purchaseOrder
        ]);
        return $pdf->download("order_compra-{$purchaseOrder->id}.pdf");
    }
}
