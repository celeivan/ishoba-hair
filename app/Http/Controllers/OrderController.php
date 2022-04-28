<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{


    public function customerOrder(Order $order)
    {
        return view('pages.customer.order', ['order' => $order]);
    }

    public function create(Request $request)
    {
        if (\Cart::getContent()->count() == 0) {
            return redirect()->route('public.shop');
        }

        if ($request->session()->has('shippingMethod')) {
            $shippingMethod = $request->session()->get('shippingMethod');
        } else {
            $shippingMethod = null;
        }

        // Add validators to ensure no other customer has similar number or email
        // Check if radio for new customer is selected through JS

        $customer = Customer::where('emailAddress', $request->emailAddress)->first();
        //TODO: generate unique order reference system
        if (!$customer) {

            $customer = Customer::create($request->only(
                'firstNames',
                'lastName',
                'emailAddress',
                'contactNo',
                'distributorCode',
            ));

            $customer->update([
                'password' => Hash::make('Cust0m3rP'),
            ]);

            //TODO: Dispatch an email with password and login url
        }

        if ($customer) {
            $orderReference = $customer->id . rand(10000, 99999);

            $order = Order::create([
                'customer_id' => $customer->id,
                'order_reference' => $orderReference,
                'total' => \Cart::getTotal(),
                'shippingAddress' => $request->shippingAddress,
                'shippingNote' => $request->shippingNote,
                'discountCode' => $request->discountCode,
            ]);

            if ($order) {
                foreach (\Cart::getContent() as $item) {
                    OrderItems::create([
                        'order_id' => $order->id,
                        'product_id' => $item->id,
                        'qty' => $item->quantity,
                    ]);
                }
                return redirect()->route('public.confirm-order', $order->order_reference);
            }
        } else {
            return "Customer could not be created or located";
        }
    }

    public function confirmOrder(Request $request, Order $order)
    {
        if ($request->session()->has('shippingMethod')) {
            $shippingMethod = $request->session()->get('shippingMethod');
        } else {
            $shippingMethod = null;
        }

        // $merchant_id = '11787500';
        // $merchant_key = 'agc0i8d0wzrep';
        // $passPhrase = "The Boys Stood 2";
        $merchant_id = '10004535';
        $merchant_key = 'df13dnlhjdck9';
        $passPhrase = "TicketInTES";

        if ($shippingMethod && $shippingMethod == 'courier') {
            $cartTotal = $order->total + Order::$shippingFee;
        } else {
            $cartTotal = $order->total;
        }

        $data = [
            'merchant_id' => $merchant_id,
            'merchant_key' => $merchant_key,
            'return_url' => '',
            'cancel_url' => '',
            'notify_url' => '',
            'name_first' => $order->customer->firstNames,
            'name_last' => $order->customer->lastName,
            'email_address' => $order->customer->emailAddress,
            'cell_number' => $order->customer->contactNo,
            'm_payment_id' => $order->order_reference,
            'amount' => number_format(sprintf('%.2f', $cartTotal), 2, '.', ''),
            'item_name' => "IShoba Hair- ISH-" . $order->order_reference,
            'item_description' => "IShoba Hair products order incl shipping",
        ];

        $signature = $this->generateSignature($data, $passPhrase);
        $data['signature'] = $signature;
        return view('pages.confirmOrder', ['order' => $order, 'pfData' => $data, 'shippingMethod' => $shippingMethod]);
    }

    private function generateSignature($data, $passPhrase = null)
    {
        // Create parameter string
        $pfOutput = '';
        foreach ($data as $key => $val) {
            if ($val !== '') {
                $pfOutput .= $key . '=' . urlencode(trim($val)) . '&';
            }
        }
        // Remove last ampersand
        $getString = substr($pfOutput, 0, -1);
        if ($passPhrase !== null) {
            $getString .= '&passphrase=' . urlencode(trim($passPhrase));
        }
        return md5($getString);
    }
}
