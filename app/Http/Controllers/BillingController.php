<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setting;
use App\Billing;
use App\Billing_item;
use Redirect;
use Auth;

class BillingController extends Controller
{

	  public function __construct(){
        $this->middleware('auth');
    }

    public function all(){

      if(Auth::user()->role == 'patient'){
        $invoices = Billing::where('user_id', Auth::id())->orderby('id','DESC')->paginate(get_option('pagination'));
      }else{
        $invoices = Billing::orderby('id','DESC')->paginate(get_option('pagination'));
      }
    	
    	return view('billing.all',['invoices' => $invoices]);
    }

    public function paid(){

      if(Auth::user()->role == 'patient'){
        $invoices = Billing::where('user_id', Auth::id())->where('payment_status','Paid')->orderby('id','DESC')->paginate(get_option('pagination'));
      }else{
        $invoices = Billing::orderby('id','DESC')->where('payment_status','Paid')->paginate(get_option('pagination'));
      }
    	
    	return view('billing.all',['invoices' => $invoices]);
    }

    public function unpaid(){

      if(Auth::user()->role == 'patient'){
        $invoices = Billing::where('user_id', Auth::id())->where('payment_status','Unpaid')->orderby('id','DESC')->paginate(get_option('pagination'));
      }else{
        $invoices = Billing::orderby('id','DESC')->where('payment_status','Unpaid')->paginate(get_option('pagination'));
      }
    	
    	return view('billing.all',['invoices' => $invoices]);
    }

    public function partially_paid(){

      if(Auth::user()->role == 'patient'){
        $invoices = Billing::where('user_id', Auth::id())->where('payment_status','Partially Paid')->orderby('id','DESC')->paginate(get_option('pagination'));
      }else{
        $invoices = Billing::orderby('id','DESC')->where('payment_status','Partially Paid')->paginate(get_option('pagination'));
      }
    	
    	return view('billing.all',['invoices' => $invoices]);
    }

    
    public function create(){

    	$patients = User::where('role','patient')->get();

    	return view('billing.create',['patients' => $patients]);
    }


    public function store(Request $request){

	    	 $validatedData = $request->validate([
	        	'patient_id' => ['required','exists:users,id'],
	        	'payment_mode' => 'required',
	        	'invoice_title.*' => 'required',
	        	'invoice_amount.*' => ['required','numeric'],
	    	]);

        if($request->due_amount == 0){
          $payment_status = 'Paid'; 
        }elseif($request->due_amount != 0 && !empty($request->deposited_amount)){
          $payment_status = 'Partially Paid'; 
        }else{
          $payment_status = 'Unpaid'; 
        } 

            

    	$billing = new Billing;

        $billing->user_id = $request->patient_id;
        $billing->payment_mode = $request->payment_mode;
        $billing->payment_status = $payment_status;
        $billing->reference = 'b'.rand(10000,99999);
        $billing->due_amount = $request->due_amount;
        $billing->deposited_amount = $request->deposited_amount;
        $billing->vat = Setting::get_option('vat');
        $billing->total_without_tax = Collect($request->invoice_amount)->sum();
        $billing->total_with_tax = Collect($request->invoice_amount)->sum()+(Collect($request->invoice_amount)->sum()*Setting::get_option('vat')/100);
        $billing->save();


        if(empty($request->invoice_title)){
          return Redirect::back()->with('danger','Empty Invoice Details!');
        }

  	   	$i = count($request->invoice_title);


  	   	for ($x = 0; $x < $i; $x++) {
		  
		  echo $request->invoice_title[$x];

		  

            $invoice_item = new Billing_item;

            $invoice_item->invoice_title = $request->invoice_title[$x];
            $invoice_item->invoice_amount = $request->invoice_amount[$x];
            $invoice_item->billing_id = $billing->id;

            $invoice_item->save();
        }

		return Redirect::route('billing.all')->with('success', 'Invoice Created Successfully!');;

    }



    public function view($id){

      if(Auth::user()->role == 'patient'){

        $billing = Billing::where('id', $id)->where('user_id', Auth::id())->first();
        $billing_items = Billing_item::where('billing_id' ,$id)->get();
        if(!$billing): abort(404); endif;

      }else{

        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id' ,$id)->get();

      }
        
        
        return view('billing.view',['billing' => $billing, 'billing_items' => $billing_items]);
    }

      public function pdf($id){
        
        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id' ,$id)->get();
        
         view()->share(['billing' => $billing, 'billing_items' => $billing_items]);
      $pdf = PDF::loadView('billing.pdf_view', ['billing' => $billing, 'billing_items' => $billing_items]);

      // download PDF file with download method
      return $pdf->download($billing->User->name.'_invoice.pdf');
    }


    public function edit($id){
        
        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id' ,$id)->get();

        return view('billing.edit',['billing' => $billing, 'billing_items' => $billing_items]);

    }

    public function update(Request $request){

        if(empty($request->invoice_title)){
          return Redirect::back()->with('danger','Empty Invoice Details!');
        }

        $billing = Billing::findOrfail($request->billing_id);
        $billing_items = Billing_item::where('billing_id' ,$request->billing_id)->pluck('id')->toArray();




        if($request->has('billing_item_id')){
            $filtered = $request->billing_item_id;
        }else{
            $filtered = [];
        }

        foreach($billing_items as $key => $dz){
            $filtered[] = "$dz";            
        }


        $filtered_unique = array_unique($filtered);


        $deleted_items = array_count_values($filtered);

        foreach($deleted_items as $key => $value)
            if($value < 2){
                $new_array[] = $key;

                Billing_item::destroy($key);

            }


        if(isset($request->invoice_title)):

            $i = count($request->invoice_title);


            for ($x = 0; $x < $i; $x++) {
              

               
               if(isset($request->billing_item_id[$x])){

                  Billing_item::where('id', $request->billing_item_id[$x])
                            ->update(['invoice_title' => $request->invoice_title[$x],
                                      'invoice_amount' => $request->invoice_amount[$x]
                                    ]); 



               }else{


                    $add_item_to_invoice = new Billing_item;

                    $add_item_to_invoice->invoice_title = $request->invoice_title[$x];
                    $add_item_to_invoice->invoice_amount = $request->invoice_amount[$x];
                    $add_item_to_invoice->billing_id = $request->billing_id;

                    $add_item_to_invoice->save();
               }


            }

              if($request->due_amount == 0){
                $payment_status = 'Paid'; 
              }elseif($request->due_amount != 0 && !empty($request->deposited_amount)){
                $payment_status = 'Partially Paid'; 
              }else{
                $payment_status = 'Unpaid'; 
              }
              
              $billing = Billing::find($request->billing_id);

                $billing->user_id = $request->patient_id;
                $billing->payment_mode = $request->payment_mode;
                $billing->payment_status = $payment_status;
                $billing->reference = 'b'.rand(10000,99999);
                $billing->due_amount = $request->due_amount;
                $billing->deposited_amount = $request->deposited_amount;
                $billing->vat = Setting::get_option('vat');
                $billing->total_without_tax = Collect($request->invoice_amount)->sum();
                $billing->total_with_tax = Collect($request->invoice_amount)->sum()+(Collect($request->invoice_amount)->sum()*Setting::get_option('vat')/100);
                $billing->save();

        endif;


        return Redirect::route('billing.all')->with('success', 'Invoice Edited Successfully!');;
        
    }

    public function destroy($id){

        Billing::destroy($id);
        return Redirect::route('billing.all')->with('success', 'Invoice Deleted Successfully!');

    }

    public function pay($ref){
      
      $invoice = Billing::where('reference', $ref)->where('user_id', Auth::id())->where('payment_status','!=', 'Paid')->first();
      
      if(!$invoice){ abort(404); }

      $billing_items = Billing_item::where('billing_id' ,$invoice->id)->get();

      return view('billing.pay',['invoice' => $invoice, 'billing_items' => $billing_items]);

    }
}
