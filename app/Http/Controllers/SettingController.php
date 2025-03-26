<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Setting;
use Str;

class SettingController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    // Set Env function
    private function setEnv($name, $value){
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)));
        }
    }

    
    public function doctorino_settings(Request $request){
    	$settings = Setting::all();
        $language = ['fr' => 'French', 'en' => 'English', 'es' => 'Spanish', 'it' => 'Italian', 'de' => 'German', 'bn' => 'Bengali', 'tr' => 'Turkish', 'ru' => 'Russian', 'in' => 'Hindi', 'pt' => 'Portuguese', 'id' => 'Indonesian', 'ar' => 'Arabic'];
    	return view('settings.doctorino_settings', ['settings' => $settings, 'language' => $language]);
    }

    public function doctorino_settings_store(Request $request){

    	 $validatedData = $request->validate([
        	'system_name' => 'required',
        	'title' => 'required',
        	'address' => 'required',
        	'phone' => 'required',
        	'hospital_email' => 'required|email',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|dimensions:max_width=300,max_height=100',
    	]);

	    	Setting::update_option('system_name', $request->system_name);
	    	Setting::update_option('title', $request->title);
	    	Setting::update_option('address', $request->address);
	    	Setting::update_option('phone', $request->phone);
	    	Setting::update_option('hospital_email', $request->hospital_email);
            Setting::update_option('language', $request->language);

        if($request->hasFile('logo')){

            // We Get the image
            $file = $request->file('logo'); 
            // We Add String to Image name 
            $fileName = Str::random(15).'-'.$file->getClientOriginalName();
            // We Tell him the uploads path 
            $destinationPath = public_path().'/uploads/';
            // We move the image to the destination path
            $file->move($destinationPath,$fileName);
            // Add fileName to database 
            
            Setting::update_option('logo', $fileName);
        }

        return Redirect::back()->with('success', __('Settings edited Successfully'));
    }

    public function prescription_settings(Request $request){

    	return view('settings.prescription_settings');
    }

    public function prescription_settings_store(Request $request){

	    	Setting::update_option('header_right', $request->header_right);
	    	Setting::update_option('header_left', $request->header_left);
	    	Setting::update_option('footer_right', $request->footer_right);
	    	Setting::update_option('footer_left', $request->footer_left);

            return Redirect::back()->with('success', __('Settings edited Successfully'));

	}

    public function notifications_settings(){
        return view('settings.notifications_settings');
    }

    public function notifications_settings_store(Request $request){

        Setting::update_option('NEXMO_KEY', $request->NEXMO_KEY);
        Setting::update_option('NEXMO_SECRET', $request->NEXMO_SECRET);
        Setting::update_option('TWILIO_AUTH_SID', $request->TWILIO_AUTH_SID);
        Setting::update_option('TWILIO_AUTH_TOKEN', $request->TWILIO_AUTH_TOKEN);
        Setting::update_option('TWILIO_WHATSAPP_FROM', $request->TWILIO_WHATSAPP_FROM);

            
        $this->setEnv('NEXMO_KEY', $request->NEXMO_KEY);
        $this->setEnv('NEXMO_SECRET', $request->NEXMO_SECRET);            
        $this->setEnv('TWILIO_AUTH_SID', $request->TWILIO_AUTH_SID);
        $this->setEnv('TWILIO_AUTH_TOKEN', $request->TWILIO_AUTH_TOKEN);
        $this->setEnv('TWILIO_WHATSAPP_FROM', $request->TWILIO_WHATSAPP_FROM);

        return Redirect::back()->with('success', __('Settings edited Successfully'));

    }

    public function payment_settings(){

        return view('settings.payment_settings');
    }

    public function payment_settings_store(Request $request){

        Setting::update_option('currency', get_currency_symbol()[$request->currency]['ISO']);
        Setting::update_option('currency_symbol', get_currency_symbol()[$request->currency]['Symbol']);
        Setting::update_option('currency_position', $request->currency_position);
        Setting::update_option('vat', $request->vat);

            //return get_currency_symbol()[$request->currency]['ISO'];

            Setting::update_option('active_stripe', $request->active_stripe);
            Setting::update_option('stripe_mode', $request->stripe_mode);
            Setting::update_option('stripe_secret', $request->stripe_secret);
            Setting::update_option('stripe_key', $request->stripe_key);

            Setting::update_option('active_paypal', $request->active_paypal);
            Setting::update_option('paypal_mode', $request->paypal_mode);
            Setting::update_option('paypal_client_id', $request->paypal_client_id);
            Setting::update_option('paypal_secret', $request->paypal_secret);

            
            $this->setEnv('PAYPAL_MODE', $request->paypal_mode);
            $this->setEnv('PAYPAL_CLIENT_ID', $request->paypal_client_id);
            $this->setEnv('PAYPAL_SECRET', $request->paypal_secret);

            return Redirect::back()->with('success', __('Settings edited Successfully'));
        }

        public function appointment_settings(){

            return view('settings.appointment_settings');
        }

        public function appointment_settings_store(Request $request){

            $validatedData = $request->validate([
               'appointment_interval' => 'required|numeric',   
           ]);

            Setting::update_option('appointment_interval', $request->appointment_interval);

            Setting::update_option('saturday_from', $request->saturday_from);
            Setting::update_option('saturday_to', $request->saturday_to);

            Setting::update_option('sunday_from', $request->sunday_from);
            Setting::update_option('sunday_to', $request->sunday_to);

            Setting::update_option('monday_from', $request->monday_from);
            Setting::update_option('monday_to', $request->monday_to);

            Setting::update_option('tuesday_from', $request->tuesday_from);
            Setting::update_option('tuesday_to', $request->tuesday_to);

            Setting::update_option('wednesday_from', $request->wednesday_from);
            Setting::update_option('wednesday_to', $request->wednesday_to);

            Setting::update_option('thursday_from', $request->thursday_from);
            Setting::update_option('thursday_to', $request->thursday_to);

            Setting::update_option('friday_from', $request->friday_from);
            Setting::update_option('friday_to', $request->friday_to);

            return Redirect::back()->with('success', __('Settings edited Successfully'));

        }

}
