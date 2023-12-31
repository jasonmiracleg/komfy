<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bookkeeping;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\Variant;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function verify_paid($bill_id)
    {
        $bill = Bill::find($bill_id);
        $bill->update([
            'is_paid' => '1'
        ]);
        $bill->save();

        $bookkeepingData = [
            'account_id' => 1,
            'title' => '',
            'description' => '',
            'amount' => 0,
        ];

        foreach ($bill->orders as $order) {
            $bookkeepingData['bill_id'] = $bill->id;
            $bookkeepingData['title'] = 'Pembelian ' . $order->ordered->variants->product_name . ' ' . $order->ordered->variant_name;
            $bookkeepingData['description'] = 'Pembelian oleh ' . $order->user->name;
            $bookkeepingData['amount'] = $order->order_price;
            Bookkeeping::create($bookkeepingData);
        }

        return redirect()->route('order.admin');
    }

    public function verify_cash($bill_id)
    {
        $bill = Bill::find($bill_id);
        $bill->update([
            'is_cash' => '1'
        ]);
        $bill->save();

        return redirect()->route('order.admin');
    }
}
