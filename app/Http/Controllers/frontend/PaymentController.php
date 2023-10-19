<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Flight;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        if ($request->module_id == 1) {
            $module_id = 1;
            $package_id = $request->package_id;
            $package = Package::where('id', $request->package_id)->first();
            $package_price = $package->package_price;
            $number_of_member = $request->number_of_member;
            $total_price = $package_price * $number_of_member;
        }
        if ($request->module_id == 2) {
            $module_id = 2;
            $package_id = $request->package_id;
            $package = Flight::where('id', $request->package_id)->first();
            $number_of_member = $request->number_of_member;
            if ($package->available_sit < $number_of_member) {
                Toastr::error("Flight does't have sufficient sit");
                return back();
            }
            $package_price = $package->price;
            $total_price = $package_price * $number_of_member;
        }
        if ($request->module_id == 3) {
            $request->validate([
                'booking_date' => "required|date"
            ]);
            $module_id = 3;
            $package_id = $request->package_id;
            $package = Hotel::where('id', $request->package_id)->first();
            $package_price = $package->room_price;
            $number_of_member = $request->booking_date;
            $total_price = $package_price;
        }

        $tran_id = "test" . rand(1111111, 9999999); //unique transection id for every transection
        $currency = "BDT"; //aamarPay support Two type of currency USD & BDT
        $amount = $total_price;   //10 taka is the minimum amount for show card option in aamarPay payment gateway
        //For live Store Id & Signature Key please mail to support@aamarpay.com
        $store_id = "aamarpaytest";
        $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";
        $url = "https://​sandbox​.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "store_id": "' . $store_id . '",
            "tran_id": "' . $tran_id . '",
            "success_url": "' . route('success') . '",
            "fail_url": "' . route('fail') . '",
            "cancel_url": "' . route('cancel') . '",
            "amount": "' . $amount . '",
            "currency": "' . $currency . '",
            "signature_key": "' . $signature_key . '",
            "desc": "Merchant Registration Payment",
            "cus_name": "' . Auth::user()->name . '",
            "cus_email": "' . Auth::user()->email . '",
            "cus_add1": "' . Auth::user()->address . '",
            "cus_phone": "' . Auth::user()->phone . '",
            "number_of_member": "' . $number_of_member . '",
            "opt_a": "' . Auth::user()->id . '",
            "opt_b": "' . $package_id . '",
            "opt_c": "' . $module_id . '",
            "opt_d": "' . $number_of_member . '",
            "type": "json"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);

        $responseObj = json_decode($response);

        if (isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

            $paymentUrl = $responseObj->payment_url;
            // dd($paymentUrl);
            return redirect()->away($paymentUrl);
        } else {
            echo $response;
        }
    }


    public function success(Request $request)
    {

        $request_id = $request->mer_txnid;

        //verify the transection using Search Transection API

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";

        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $user = User::findOrFail($request->opt_a);

        if ($request->opt_c == 1) {
            $package = Package::where('id', $request->opt_b)->first();
            $order = Order::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'name' => $request->cus_name,
                'email' => $request->cus_email,
                'phone' => $request->cus_phone,
                'address' => $user->address,
                'amount' => $request->amount,
                'member' => $request->opt_d.' '. 'Person',
                'booking_package_name' => $package->package_name,
                'booking_package_type' => 'Package',
                'booking_from' => $package->starting_date,
                'payment_status' => 'Paid',
                'booking_status' => 'Pending',
                'currency' => $request->currency,
            ]);
            $order_details = Order::findOrFail($order->id);
            Mail::to($order_details->email)->send(
                new InvoiceMail($order_details)
            );
            Toastr::success('Package booking has been successfully completed');
            return back();
        }

        if ($request->opt_c == 2) {
            $package = Flight::where('id', $request->opt_b)->first();
            $available_sit = $package->available_sit - $request->opt_d;
            $package->update([
                'available_sit' => $available_sit,
            ]);
            $order = Order::create([
                'user_id' => $user->id,
                'flight_id' => $package->id,
                'name' => $request->cus_name,
                'email' => $request->cus_email,
                'phone' => $request->cus_phone,
                'address' => $user->address,
                'amount' => $request->amount,
                'member' => $request->opt_d.' '. 'Person',
                'booking_package_name' => $package->airlines_name,
                'booking_package_type' => 'Flight',
                'booking_from' => $package->flight_date,
                'payment_status' => 'Paid',
                'booking_status' => 'Pending',
                'currency' => $request->currency,
            ]);
            $order_details = Order::findOrFail($order->id);
            Mail::to($order_details->email)->send(
                new InvoiceMail($order_details)
            );
            Toastr::success('Flight booking has been successfully completed');
            return back();
        }
        if ($request->opt_c == 3) {
            $package = Hotel::where('id', $request->opt_b)->first();
            $order = Order::create([
                'user_id' => $user->id,
                'hotel_id' => $package->id,
                'name' => $request->cus_name,
                'email' => $request->cus_email,
                'phone' => $request->cus_phone,
                'address' => $user->address,
                'amount' => $request->amount,
                'member' => $package->room_type,
                'booking_package_name' => $package->hotel_name,
                'booking_package_type' => 'Hotel',
                'booking_from' => $request->opt_d,
                'payment_status' => 'Paid',
                'booking_status' => 'Pending',
                'currency' => $request->currency,
            ]);
            $order_details = Order::findOrFail($order->id);
            Mail::to($order_details->email)->send(
                new InvoiceMail($order_details)
            );
            Toastr::success('Hotel booking has been successfully completed');
            return back();
        }
    }


    public function fail(Request $request)
    {
        return back();
    }


    public function cancel()
    {
        return back();
    }
}
