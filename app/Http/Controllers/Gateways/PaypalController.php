<?php


namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use App\Billing;
use Redirect;
use Auth;
use Session;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = config('paypal');

        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $paypalConfig['client_id'],
            $paypalConfig['secret']
        ));

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function createPayment(Request $request)
    {
        $invoice = Billing::findOrFail($request->invoice_id);
        Session::put('invoice_id', $invoice->id);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($invoice->due_amount); // You should validate and sanitize user input

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription('Payment description');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.execute'))
            ->setCancelUrl(route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);

            // Redirect the user to PayPal for approval
            return redirect($payment->getApprovalLink());
        } catch (\Exception $e) {
            // Handle any exceptions here, e.g., log the error
            return back()->with('error', 'Payment could not be created.');
        }
    }

    public function executePayment(Request $request)
    {
        $invoice_id = Session::get('invoice_id');
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

       // try {

            $payment = Payment::get($paymentId, $this->apiContext);
            $paypalTransactionId = $payment->getId();

            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            // Execute the payment
            $result = $payment->execute($execution, $this->apiContext);

            // Handle the payment result (e.g., update your database)
            // Redirect the user to a success or failure page based on the result
           // return view('payment.status', ['paymentResult' => $result]);
           $invoice = Billing::findOrFail($invoice_id);
   
           $invoice->payment_status = 'Paid';
           $invoice->payment_mode = 'PayPal';
   
           $invoice->deposited_amount = $invoice->total_with_tax;
           $invoice->due_amount = 0;
   
           $invoice->update();

           $transaction = New  \App\Transaction();

           $transaction->transaction_id = $paypalTransactionId;;
           $transaction->user_id = Auth::id();
           $transaction->billing_id = $invoice->id;
           $transaction->amount = $invoice->due_amount;
           $transaction->currency = get_option('currency');
           $transaction->payment_gateway = "PayPal";
           $transaction->status = 'paid';
   
           $transaction->save();
   


           return Redirect::route('billing.all')->with('success', __('Your payment has been successfully processed!'));

       // } catch (\Exception $e) {
            // Handle any exceptions here, e.g., log the error
          //  return view('payment.status', ['paymentResult' => null]);
         //   return Redirect::route('billing.all')->with('danger', __('We regret to inform you that the payment was unsuccessful'));

     //   }
    }

    public function cancelPayment()
    {
        // Handle payment cancellation here, e.g., show a message to the user
        return Redirect::route('billing.all');
    }
}
