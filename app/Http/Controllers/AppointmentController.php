<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Patient;
use App\Appointment;
use App\Setting;
use Redirect;
use Nexmo;
use Auth;
use App\Notifications\WhatsAppNotification;
use App\Notifications\NewAppointmentByEmailNotification;

class AppointmentController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }

    public function create(){

    	$patients = User::where('role','patient')->get();
	    return view('appointment.create', ['patients' => $patients]);
    }

    public function checkslots($date){
        
    	return $this->getTimeSlot($date);
    }


    public function available_slot($date,$start,$end){
    	$check = Appointment::where('date',$date)->where('time_start', $start)->where('time_end', $end)->where('visited', '!=', '2')->count();
    	if($check == 0){
        	return 'available';
    	}else{
        	return 'unavailable';
    	}
    }


    public function getTimeSlot($date) {
    
    $day = date("l", strtotime($date));
  	$day_from =  strtolower($day.'_from');
  	$day_to =  strtolower($day.'_to');

    $start = Setting::get_option($day_from);
    $end = Setting::get_option($day_to);
    $interval = Setting::get_option('appointment_interval');

    $start = new DateTime($start);
    $end = new DateTime($end);
    $start_time = $start->format('H:i'); // Get time Format in Hour and minutes
    $end_time = $end->format('H:i');

    $i=0;
    $time = [];	
    while(strtotime($start_time) <= strtotime($end_time)){
        $start = $start_time;
        $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($start_time)));
        $start_time = date('H:i',strtotime('+'.$interval.' minutes',strtotime($start_time)));
        $i++;
        if(strtotime($start_time) <= strtotime($end_time)){
            $time[$i]['start'] = $start;
            $time[$i]['end'] = $end;
            $time[$i]['available'] = $this->available_slot($date, $start, $end);
        }
    }

    return $time;
	
	}

	public function store(Request $request){    
        
		$validatedData = $request->validate([
        	'patient' => ['required','exists:users,id'],
            'rdv_time_date' => ['required'],
            'rdv_time_start' => ['required'],
            'rdv_time_end' => ['required'],
            'notifyby_sms' => ['boolean'],
            'notifyby_whatsapp' => ['boolean'],
            'notifyby_email' => ['boolean'],

    	]);

    	$appointment = new Appointment();
		$appointment->user_id = $request->patient;
		$appointment->date = $request->rdv_time_date;
		$appointment->time_start = $request->rdv_time_start;
		$appointment->time_end = $request->rdv_time_end;
        $appointment->visited = 0;
        $appointment->reason = $request->reason;
		$appointment->save();


        if($request->notifyby_sms == 1){

            $user = User::findOrFail($request->patient);
            $phone = $user->Patient->phone;

            Nexmo::message()->send([
                'to'   => $phone,
                'from' => '213794616181',
                'text' => 'You have an appointment on '.$request->rdv_time_date.' at '.$request->rdv_time_start.' at Doctorino'
            ]);
            
        }elseif($request->notifyby_whatsapp == 1){
            $user = Patient::where('user_id', $request->patient)->first();
            $user->notify(new WhatsAppNotification($appointment));
        }

		return Redirect::route('appointment.all')->with('success', __('Appointment Created Successfully'));

	}

    public function store_edit(Request $request){

        $validatedData = $request->validate([
            'rdv_id' => ['required','exists:appointments,id'],
            'rdv_status' => ['required','numeric'],
        ]);

        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->visited = $request->rdv_status;
        $appointment->save();

        return Redirect::back()->with('success', __('Appointment Updated Successfully'));
    }

    public function all(){

        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('user_id', Auth()->id())->orderBy('date','ASC')->paginate(get_option('pagination'));
        }else{
            $appointments = Appointment::orderBy('date','ASC')->paginate(get_option('pagination'));
        }
        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function calendar(){
        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('user_id', Auth()->id())->orderBy('date','ASC')->paginate(get_option('pagination'));
        }else{
            $appointments = Appointment::orderBy('date','ASC')->paginate(get_option('pagination'));
        }
        
        return view('appointment.calendar', ['appointments' => $appointments]);
    }

    public function upcoming(){

        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('user_id', Auth()->id())->where('date', '>', Now())->orderBy('date','ASC')->paginate(get_option('pagination'));
        }else{
            $appointments = Appointment::where('date', '>', Now())->orderBy('date','ASC')->paginate(get_option('pagination'));
        }

        return view('appointment.all', ['appointments' => $appointments]);

    }

    public function pending(){

        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 0)->orderBy('date','ASC')->paginate(get_option('pagination'));
        }else{
            $appointments = Appointment::where('visited', 0)->orderBy('date','ASC')->paginate(get_option('pagination'));
        }
        return view('appointment.all', ['appointments' => $appointments]);

    }

    public function treated(){
        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 1)->orderBy('date','ASC')->paginate(get_option('pagination'));
        }else{
            $appointments = Appointment::where('visited', 1)->orderBy('date','ASC')->paginate(get_option('pagination'));        
        }
    
        return view('appointment.all', ['appointments' => $appointments]);

    }

    public function cancelled(){
        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('user_id', Auth()->id())->where('visited', 2)->orderBy('date','ASC')->paginate(get_option('pagination'));
        }else{
            $appointments = Appointment::where('visited', 2)->orderBy('date','ASC')->paginate(get_option('pagination'));     
        }
        
        return view('appointment.all', ['appointments' => $appointments]);

    }

    public function today(){
        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('user_id', Auth()->id())->where('date', today())->orderBy('date','DESC')->paginate(get_option('pagination'));

        }else{
            $appointments = Appointment::where('date', today())->orderBy('date','DESC')->paginate(get_option('pagination'));
        }
        return view('appointment.all', ['appointments' => $appointments]);

    }


    public function destroy($id){

        Appointment::destroy($id);
        return Redirect::route('appointment.all')->with('success', __('Appointment Deleted Successfully'));

    }

    public function notify_whatsapp($id){

        $appointment = Appointment::findorfail($id);
       
        $appointment->User->Patient->notify(new WhatsAppNotification($appointment));
        return back()->with('success', 'Patient Notified Successfully!');

    }

    public function notify_email($id){

        $appointment = Appointment::findorfail($id);
        $appointment->User->notify(new NewAppointmentByEmailNotification($appointment));
        return back()->with('success', __('Patient Notified Successfully'));

    }

    public function getAppointments($id){
        $userAppointments = Appointment::where('user_id', $id)->get();
        $userAppointments = $userAppointments->map(function ($item) {
            // Utilisez toDateString() pour formater la date au format "YYYY-MM-DD".
            $item->date = $item->date->toDateString();
            return $item;
        });
    
        return response()->json($userAppointments);
    }

}
