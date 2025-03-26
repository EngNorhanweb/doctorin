<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Billing;
use App\Transaction;

use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Charge;

use Stripe\Exception\StripeException;
use Stripe\Exception\CardException;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;

use Illuminate\Support\Str;

use Redirect;
use Auth;


class StripeController extends Controller
{
    
    public function subscribe(Request $request)
    {

        try {

        $invoice = Billing::findOrFail($request->invoice_id);

        Stripe::setApiKey(get_option('stripe_secret'));

        $token = $request->stripeToken;

        $charge = Charge::create([
            'amount' => $invoice->due_amount * 100,
            'currency' => get_option('currency'),
            'description' => __('Invoice reference: ').$invoice->reference,
            'source' => $token,
        ]);


        $transaction = New Transaction();

        $transaction->transaction_id = $charge->id;
        $transaction->user_id = Auth::id();
        $transaction->billing_id = $invoice->id;
        $transaction->amount = $invoice->due_amount;
        $transaction->currency = get_option('currency');
        $transaction->payment_gateway = "Stripe";
        $transaction->status = 'paid';

        $transaction->save();

        $invoice = Billing::findOrFail($request->invoice_id);

        $invoice->payment_status = 'Paid';
        $invoice->payment_mode = 'Stripe';

        $invoice->deposited_amount = $invoice->total_with_tax;
        $invoice->due_amount = 0;

        $invoice->update();

        return redirect::route('billing.all')->with('success', __('Your invoice has been successfully processed !'));

    } catch (CardException $e) {
        // Gérer les erreurs liées à la carte (ex: carte invalide)
        return redirect()->back()->with('danger', $e->getMessage());
    } catch (RateLimitException $e) {
        // Gérer les erreurs liées aux limites de taux de Stripe
        return redirect()->back()->with('danger', $e->getMessage());
    } catch (InvalidRequestException $e) {
        // Gérer les erreurs liées à des demandes invalides
        return redirect()->back()->with('danger', $e->getMessage());
    } catch (AuthenticationException $e) {
        // Gérer les erreurs d'authentification avec Stripe
        return redirect()->back()->with('danger', $e->getMessage());
    } catch (ApiConnectionException $e) {
        // Gérer les erreurs de connexion avec l'API Stripe
        return redirect()->back()->with('danger', $e->getMessage());
    } catch (ApiErrorException $e) {
        // Gérer les erreurs génériques de l'API Stripe
        return redirect()->back()->with('danger', $e->getMessage());
    }

    }
}
