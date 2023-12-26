<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Stripe\PaymentIntent;
class PaymentController extends Controller
{
    public function call(Request $request) {

        \Stripe\Stripe::setApiKey('sk_test_51MIbdBEVvRtoq49JnGdiE5XdEyveVbxKdHK1Ad0IGqSZX1VoavQY0alBPuN0HqEeOLiQhobcUlfHLGwsR8oWSmSs00gg1qekkN');
        $amount = 300 * 100;
        $currency = "usd";

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            'confirmation_method' => 'manual',
            'confirm' => true
          ]);
          if ($paymentIntent->status === 'succeeded') {
            // Payment was successful, update the database and send a receipt
            return view('payment_success');
          } else {
            // Payment failed, display an error message
            return view('payment_error');
          }
          return 'df';

        \Stripe\Stripe::setApiKey('sk_test_51MIbdBEVvRtoq49JnGdiE5XdEyveVbxKdHK1Ad0IGqSZX1VoavQY0alBPuN0HqEeOLiQhobcUlfHLGwsR8oWSmSs00gg1qekkN');
        $customer = \Stripe\Customer::create(array(
          'name' => 'test',
          'description' => 'test description',
          'email' => 'email@gmail.com',
          'source' => $request->input('stripeToken'),
           "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

      ));
      return $customer;
        try {
            \Stripe\Charge::create ( array (
                    "amount" => 300 * 100,
                    "currency" => "usd",
                    "customer" =>  $customer["id"],
                    "description" => "Test payment."
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            return view ( 'cardForm' );
        } catch ( \Stripe\Error\Card $e ) {
            Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'cardForm' );
        }
    }
    public function call2(Request $request) {

        \Stripe\Stripe::setApiKey('sk_test_51MIbdBEVvRtoq49JnGdiE5XdEyveVbxKdHK1Ad0IGqSZX1VoavQY0alBPuN0HqEeOLiQhobcUlfHLGwsR8oWSmSs00gg1qekkN');
        $amount = 300 * 100;
        $currency = "usd";

        $paymentIntent = PaymentIntent::create([
            'amount' => 1099, 'currency' => 'usd', 'payment_method_types' => ['card']
          ]);
          return $paymentIntent;
        //   ['amount' => 1099, 'currency' => 'usd', 'payment_method_types' => ['card']]
          if ($paymentIntent->status === 'succeeded') {
            // Payment was successful, update the database and send a receipt
            return view('payment_success');
          } else {
            // Payment failed, display an error message
            return view('payment_error');
          }
          return $request;

        \Stripe\Stripe::setApiKey('sk_test_51MIbdBEVvRtoq49JnGdiE5XdEyveVbxKdHK1Ad0IGqSZX1VoavQY0alBPuN0HqEeOLiQhobcUlfHLGwsR8oWSmSs00gg1qekkN');
        $customer = \Stripe\Customer::create(array(
          'name' => 'test',
          'description' => 'test description',
          'email' => 'email@gmail.com',
          'source' => $request->input('stripeToken'),
           "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

        ));
        //   return $customer;
        try {
            \Stripe\Charge::create ( array (
                    "amount" => 300 * 100,
                    "currency" => "usd",
                    "customer" =>  $customer["id"],
                    "description" => "Test payment."
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            return view ( 'cardForm' );
        } catch ( \Stripe\Error\Card $e ) {
            Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'cardForm' );
        }
    }
}
