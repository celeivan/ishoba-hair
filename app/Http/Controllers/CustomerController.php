<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function auth()
    {
        return view('pages.customer.auth');
    }

    public function authCustomer(Request $request)
    {
        $this->validate($request, [
            'emailAddress' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('customer')->attempt(['emailAddress' => $request->emailAddress, 'password' => $request->password])) {
            return redirect()->route('secure.customer.customerProfile');
        } else {
            dd("Auth Failed");
        }
    }

    public function profile()
    {
        //check if user is auth and their password isn't the default one, if it is default force them to change it
        //If not default password then display customer dashboard with orders and option to update profile
        $user = Auth::guard('customer')->user();
        return view('pages.customer.dash', ['user' => $user]);
    }
}
