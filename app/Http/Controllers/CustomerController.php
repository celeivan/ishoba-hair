<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function clientCheck(Request $request)
    {
        if ($request->has('email')) {
            $client = Customer::where('emailAddress', $request->email)->first();

            if ($client) {

                return response()->json([
                    'error' => null,
                    'message' => 'Customer was found',
                    'customer' => $client,
                ]);
            } else {
                return response()->json([
                    'error' => 'Not Found',
                    'message' => 'Customer was not found',
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Email',
                'message' => 'Please provide a valid email address',
            ]);
        }

    }
}
