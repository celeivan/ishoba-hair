<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Models\OrderComments;
use App\Mail\SendOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            if (!empty($order->shippingAddress)) {
                $shippingMethod = 'courier';
            } else {
                $shippingMethod = 'collect';
            }
        }

        if (!empty($shippingMethod) && $shippingMethod == 'courier') {
            $cartTotal = \Cart::getTotal() + Order::$shippingFee;
        } else {
            $cartTotal = \Cart::getTotal();
        }

        // Add validators to ensure no other customer has similar number or email
        // Check if radio for new customer is selected through JS

        $customer = User::where('email', $request->email)->first();

        if (!$customer) {
            $this->validate($request, [
                'firstNames' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|unique:users,email:rfc,dns',
                'contactNo' => 'required|unique:users',
                'password' => 'required|string|confirmed',
            ]);

            $customer = User::create($request->only(
                'firstNames',
                'lastName',
                'email',
                'contactNo',
                'distributorCode',
                'password',
            ));
        }

        if ($customer) {
            $orderReference = $customer->id . rand(10000, 99999);

            $order = Order::create([
                'user_id' => $customer->id,
                'order_reference' => $orderReference,
                'total' => $cartTotal,
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

                if ($customer->email) {
                    $data = [
                        'heading' => 'Thank you for placing your order', 
                        'reference' => $order->order_reference,
                        'order' => $order
                    ];

                    Mail::to($customer->email)->send(new SendOrderNotification($data));
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
            if (!empty($order->shippingAddress)) {
                $shippingMethod = 'courier';
            } else {
                $shippingMethod = 'collect';
            }
        }

        if (\Config::get('app.debug')) {
            $merchant_id = '10004535';
            $merchant_key = 'df13dnlhjdck9';
            $passPhrase = "TicketInTES";
            $notifyUrl = 'https://ishoba.sharedwithexpose.com/api/payfast';
            $returnUrl = 'https://ishoba.sharedwithexpose.com/'; //Mod this to return to the order page
        } else {
            //Enter live details here
            $merchant_id = '19581691';
            $merchant_key = '76p9dmln22lqu';
            $passPhrase = "iSh0baHair0rganic";
            $notifyUrl = 'https://ishoba.co.za/api/payfast';
            $returnUrl = 'https://ishoba.co.za/'; //Mod this to return to the order page
        }

        if (!empty($shippingMethod) && $shippingMethod == 'courier') {
            $cartTotal = $order->total + Order::$shippingFee;
        } else {
            $cartTotal = $order->total;
        }

        if($order->customer->getFormattedPhoneNumber()){
            $userNumber = $order->customer->getFormattedPhoneNumber();
        }else{
            $userNumber =  $order->customer->contactNo;
        }

        $data = [
            'merchant_id' => $merchant_id,
            'merchant_key' => $merchant_key,
            'return_url' => $returnUrl,
            'cancel_url' => $returnUrl,
            'notify_url' => $notifyUrl,
            'name_first' => $order->customer->firstNames,
            'name_last' => $order->customer->lastName,
            'email_address' => $order->customer->email,
            'cell_number' => $userNumber,
            'm_payment_id' => $order->order_reference,
            'amount' => number_format(sprintf('%.2f', $cartTotal), 2, '.', ''),
            'item_name' => "IShoba Hair - ISH-" . $order->order_reference,
            'item_description' => "IShoba Hair products order incl shipping",
            'custom_str1' => number_format(sprintf('%.2f', $cartTotal), 2, '.', ''),
        ];

        $signature = $this->generateSignature($data, $passPhrase);
        $data['signature'] = $signature;
        return view('pages.confirmOrder', ['order' => $order, 'pfData' => $data, 'shippingMethod' => $shippingMethod]);
    }

    public function updateOrderStatus(Order $order, Request $request)
    {
        if ($order) {
            $order->update([
                'status' => $request['status'],
            ]);

            $comment = OrderComments::create([
                'order_id' => $order->id,
                'user_id' => $request['user_id'],
                'comment' => "Order Status chaged to $order->status",
            ]);

            if ($order->customer->email) {
                $data = [
                    'heading' => 'Order Notification', 
                    'reference' => $order->order_reference,
                    'order' => $order,
                    'body' => 'A comment was added to the order '.$comment->comment,
                ];

                Mail::to($order->customer->email)->send(new SendOrderNotification($data));
            }

            return response()->json([
                'error' => null,
                'message' => "Order succesfully update",
                'order' => $order,
            ]);
        } else {
            return response()->json([
                'error' => 'Order not found',
                'message' => "Order succesfully update",
            ]);
        }

    }

    public function saveComment(Order $order, Request $request)
    {
        OrderComments::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'type' => 'comment',
            'comment' => $request['comment'],
        ]);

        return redirect()->back();
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
