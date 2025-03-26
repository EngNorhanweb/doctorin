<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;

use Mollie;

class MollieController extends Controller {

    //
    public function createPayment() {

        $plan = Plan::find($request->plan_id);

        $payment = Mollie::api()->payments()->create([
            "amount" => [
                "currency" => "USD",
                "value" => $plan->price,
            ],
            "description" => $plan->description,
            "redirectUrl" => route("payment.status"),
            "webhookUrl" => route("payment.webhook"),
        ]);

        return redirect($payment->getCheckoutUrl());
    }

    public function paymentStatus(){

        $payment = Mollie::api()->payments()->get(request()->input('id'));

        if ($payment->isPaid()) {
            
            $user = User::find(Auth::id());
            $user->used_credit = 0;
            if($plan->periodicity == "monthly"){
                $user->will_expire = Carbon::now()->addMonths(1);
            }else{
                $user->will_expire = Carbon::now()->addMonths(12);
            }
            $user->plan_id = $plan->id;

            $user->update();
        } else {
            // Paiement échoué
        }
    }

    public function paymentWebhook(Request $request) {

        $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid()) {
            // Paiement réussi
        } else {
            // Paiement échoué
        }
    }

}
