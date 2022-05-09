<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderComments;
use App\Models\Payments;
use Illuminate\Http\Request;

class PayFastController extends Controller
{
    public function webhook(Request $request)
    {
        // [2022-05-04 20:05:06] local.INFO: array (
        //     'm_payment_id' => '558468',
        //     'pf_payment_id' => '1425285',
        //     'payment_status' => 'COMPLETE',
        //     'item_name' => 'IShoba Hair - ISH-558468',
        //     'item_description' => 'IShoba Hair products order incl shipping',
        //     'amount_gross' => '130.00',
        //     'amount_fee' => '-2.99',
        //     'amount_net' => '127.01',
        //     'custom_str1' => '',
        //     'custom_str2' => '',
        //     'custom_str3' => '',
        //     'custom_str4' => '',
        //     'custom_str5' => '',
        //     'custom_int1' => '',
        //     'custom_int2' => '',
        //     'custom_int3' => '',
        //     'custom_int4' => '',
        //     'custom_int5' => '',
        //     'name_first' => 'Njabulo Ivan',
        //     'name_last' => 'Cele',
        //     'email_address' => 'developer@ncitsolutions.co.za',
        //     'merchant_id' => '10004535',
        //     'signature' => '08dd389e74775808286f8613a90f75e6',
        //   )

        //Repond to payfast and then process data intenally
        header('HTTP/1.0 200 OK');
        flush();

        if (\Config::get('app.debug')) {
            $pfHost = 'sandbox.payfast.co.za';
            $pfPassphrase = 'TicketInTES';
        } else {
            $pfHost = 'www.payfast.co.za';
            $pfPassphrase = 'iSh0baHair0rganic';
        }

        $pfData = $_POST;

        // Strip any slashes in data
        foreach ($pfData as $key => $val) {
            $pfData[$key] = stripslashes($val);
        }

        // Convert posted variables to a string
        $pfParamString = '';
        foreach ($pfData as $key => $val) {
            if ($key !== 'signature') {
                $pfParamString .= $key . '=' . urlencode($val) . '&';
            } else {
                break;
            }
        }

        $pfParamString = substr($pfParamString, 0, -1);

        $order = Order::where('order_reference', $request['m_payment_id'])->first();

        if ($order->total == $pfData['custom_str1']) {
            $cartTotal = $order->total;
        } else {
            $cartTotal = $pfData['custom_str1'];
        }

        $check1 = $this->pfValidSignature($pfData, $pfParamString, $pfPassphrase);
        $check2 = $this->pfValidIP();
        $check3 = $this->pfValidPaymentData($cartTotal, $pfData);
        $check4 = $this->pfValidServerConfirmation($pfParamString, $pfHost);

        if ($check1 && $check2 && $check3 && $check4) {
            if ($order && $pfData['payment_status'] == 'COMPLETE') {
                $order->update([
                    'status' => 'payment received',
                ]);

                Payments::create([
                    'order_id' => $order->id,
                    'amount_paid' => $pfData['amount_gross'],
                    'reference' => $pfData['pf_payment_id'],
                    'paymentMethod' => 'PayFast - Online',
                    'approved' => true,
                    'approved_by' => 0, //Zero is system
                ]);

                OrderComments::create([
                    'order_id' => $order->id,
                    'user_id' => 0,
                    'comment' => "Payment received from PayFast, and order status changed to Payment Received",
                ]);
            }else{
                OrderComments::create([
                    'order_id' => $order->id,
                    'user_id' => 0,
                    'comment' => "Payment ".$pfData['pf_payment_id']." not confirmed from PayFast, received status ".$pfData['payment_status'],
                ]);
            }
        }else{
            info('One of the checks failed');
            info($check1." check 2".$check2." check 3".$check3." check 4".$check4);
        }
    }

    private function pfValidSignature($pfData, $pfParamString, $pfPassphrase = null)
    {
        // Calculate security signature
        if ($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString . '&passphrase=' . urlencode($pfPassphrase);
        }

        $signature = md5($tempParamString);
        return ($pfData['signature'] === $signature);
    }

    private function pfValidIP()
    {
        // Variable initialization
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
        );

        $validIps = [];

        foreach ($validHosts as $pfHostname) {
            $ips = gethostbynamel($pfHostname);

            if ($ips !== false) {
                $validIps = array_merge($validIps, $ips);
            }

        }

        // Remove duplicates
        $validIps = array_unique($validIps);
        $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
        if (in_array($referrerIp, $validIps, true)) {
            return true;
        }
        return false;
    }

    private function pfValidPaymentData($cartTotal, $pfData)
    {
        return !(abs((float) $cartTotal - (float) $pfData['amount_gross']) > 0.01);
    }

    private function pfValidServerConfirmation($pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null)
    {
        // Use cURL (if available)
        if (in_array('curl', get_loaded_extensions(), true)) {
            // Variable initialization
            $url = 'https://' . $pfHost . '/eng/query/validate';

            // Create default cURL object
            $ch = curl_init();

            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt($ch, CURLOPT_USERAGENT, null); // Set user agent
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return output as string rather than outputting it
            curl_setopt($ch, CURLOPT_HEADER, false); // Don't include header in output
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

            // Standard settings
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $pfParamString);
            if (!empty($pfProxy)) {
                curl_setopt($ch, CURLOPT_PROXY, $pfProxy);
            }

            // Execute cURL
            $response = curl_exec($ch);
            curl_close($ch);
            if ($response === 'VALID') {
                return true;
            }
        }
        return false;
    }
}
