<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Dompdf\Dompdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders() {
        return view('Admin.Orders.list');
    }



    public function printInvoicePDF($id): Factory|View|Application {
        $order = Order::where('id', $id)->with('orderProducts', 'user', 'address', 'phone')->first()->toArray();

        $html = view('Admin.invoice_template')->with(compact('order'))->render();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        return view('Admin.invoice')->with(compact('order'));
    }
}
