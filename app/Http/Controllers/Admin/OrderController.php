<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Aid;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\OrdersProduct;
use Dompdf\Dompdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    public function showOrders(): Factory|View|Application {
        if(isSeller()) {
            $orders = Order::getSellerOrders();
        } else {
            $orders = Order::orders();
        }

        $orders = $orders->latest()->get();

        return view('admin.orders.list', ['orders' => $orders]);
    }

    public function showOrder($id): Factory|View|Application {
        $order = Order::where('id', $id)
            ->with('user', 'address', 'coupon', 'orderProducts', 'orderLogs')->first();

        //  FROM ORDER MODEL
        if(isSeller()) {
            $orderProducts = $order->whereHas('product', function($query) {
                $query->where('seller_id', Auth::id());
            })->with(['product' => function($query) {
                $query->where('seller_id', Auth::id());
            }]);
        } else {
            $orderProducts = $order->with('product');
        }

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

        return view('admin.orders.view')->with(compact('order', 'orderStatuses'));
    }

    public function updateOrderStatus(Request $request, $id): RedirectResponse {
        $order = Order::find($id);

        if($request->input('status') === 'Completed') {
            $request->validate([
                'courier' => 'required|alpha',
                'tracking_number' => 'required|integer|unique:orders',
            ]);

            $order->courier = $request->input('courier');
            $order->tracking_number = $request->input('tracking_number');
        }

        $order->status = $request->input('status');
        $order->save();

        OrdersLog::create([
            'order_id' => $id,
            'status' => $request->input('status'),
        ]);

        return Aid::updateOk("Order Status Updated.");
    }

    public function showInvoice($id): Factory|View|Application {
        $order = Order::where('id', $id)->with('orderProducts', 'user', 'address')->first();

        return view('admin.orders.invoice')->with(compact('order'));
    }



    public function processInvoicePDF($id): Factory|View|Application {
        $order = Order::with('orderProducts', 'user', 'address')->find($id);

        $html = view('admin.orders.invoice_template')->with(compact('order'))->render();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4');    // (Optional) Setup the paper size and orientation
        $dompdf->render();              // Render the HTML as PDF
        $dompdf->stream();              // Output the generated PDF to Browser

        return view('admin.invoice')->with(compact('order'));
    }


    public function orderReady(Request $request, $id, $checked): JsonResponse|Redirector|Application|RedirectResponse {
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
