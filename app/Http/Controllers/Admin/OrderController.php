<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\OrdersProduct;
use Dompdf\Dompdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders(): Factory|View|Application {
        if(isSeller()) {
            $orders = Order::getSellerOrders();
        } else {
            $orders = Order::orders();
        }

        $orders = $orders->latest()->get()->toArray();

        return view('Admin.Orders.list')->with(compact('orders'));
    }

    public function showOrder($id): Factory|View|Application {
        $order = Order::where('id', $id)
            ->with('user', 'address', 'coupon', 'orderProducts', 'orderLogs')->first()->toArray();

        $orderStatuses = [
            'New',
            'Pending',
            'In Process',
            'Hold',
            'Paid',
            'Completed',
            'Cancelled',
            'Delivered',
        ];

        return view('Admin.Orders.view')->with(compact('order', 'orderStatuses'));
    }

    public function updateOrderStatus(Request $request, $id): RedirectResponse {
        $order = Order::find($id);

        if($request->status === 'Completed') {
            $request->validate([
                'courier' => 'required|alpha',
                'tracking_number' => 'required|integer|unique:orders',
            ]);

            $order->courier = $request->courier;
            $order->tracking_number = $request->tracking_number;
        }

        $order->status = $request->status;
        $order->save();

        OrdersLog::create([
            'order_id' => $id,
            'status' => $request->status,
        ]);

        $message = "Order Status Updated.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function showInvoice($id): Factory|View|Application {
        $order = Order::where('id', $id)->with('orderProducts', 'user', 'address')->first()->toArray();

        return view('Admin.Orders.invoice')->with(compact('order'));
    }



    public function processInvoicePDF($id): Factory|View|Application {
        $order = Order::where('id', $id)->with('orderProducts', 'user', 'address')->first()->toArray();

        $html = view('Admin.Orders.invoice_template')->with(compact('order'))->render();

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


    public function orderReady(Request $request, $id, $checked) {
        if($request->ajax()) {
            $orderProduct = OrdersProduct::find($id);

            $orderProduct->is_ready = $checked;
            $orderProduct->save();

            if($orderProduct->is_ready) {
                $message = 'Your order is now ready.';
            } else {
                $message = 'Your order is no longer ready.';
            }
            return response()->json(['status' => true, 'message' => $message]);
        }

        return accessDenied();
    }
}
