<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Prescription;
use App\Appointment;
use App\Billing;
use App\Document;
use App\History;

use Hash;
use Redirect;
use Str;
use Auth;
use Illuminate\Validation\Rule;
use App\Notifications\ResetPasswordNotification;

class PatientController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }


    public function all(){

    	$patients = User::where('role', '=' ,'patient')->OrderBy('id','DESC')->paginate(get_option('pagination'));

    	return view('patient.all', ['patients' => $patients]);

    }

    public function create(){
    	return view('patient.create');
    }



    public function store(Request $request){

    	$validatedData = $request->validate([
        	'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'birthday' => ['nullable','before:today'],
            'blood' => ['required',
            			Rule::in(['Unknown', 'A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
        	],
            'gender' => ['required',
            			Rule::in(['Male', 'Female']),
        				],
            'weight' => ['numeric','nullable'],
            'height' => ['numeric','nullable'],
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',

    	]);

    	$newPassword =rand(10000000,99999999); 

    	$user = new User();
		$user->password = Hash::make($newPassword);
		$user->email = $request->email;
		$user->name = $request->name;
		$user->role = 'patient';



		// Envoie de la notification par e-mail
		
		if($request->hasFile('image')){

		 	$file = $request->file('image'); 
            $fileName = Str::random(15).'-'.$file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/';
            $file->move($destinationPath,$fileName);            
        	$user->image = $fileName;

		}else{
			$user->image = "";
		}
			

		$user->save();

		$user->assignRole('Patient');

		//Send password by E-mail to Patient
		//$user->notify(new ResetPasswordNotification($newPassword));


		$patient = new Patient();

		$patient->user_id = $user->id;
		$patient->birthday = $request->birthday;
		$patient->phone = $request->phone;
		$patient->gender = $request->gender;
		$patient->blood = $request->blood;
		$patient->adress = $request->adress;
		$patient->weight = $request->weight;
		$patient->height = $request->height;

		$patient->save();

		return Redirect::route('patient.all')->with('success', __('Patient Created Successfully'));
		
		}

    

	    public function edit($id){

	    	$patient = User::findOrfail($id);
	    	return view('patient.edit',['patient' => $patient]);

	    }

        public function store_edit(Request $request){

    		$validatedData = $request->validate([
	        	'name' => ['required', 'string', 'max:255'],
	            'email' => [
			        'nullable', 'email', 'max:255',
			        Rule::unique('users')->ignore($request->user_id),
				],
				'birthday' => ['nullable','before:today'],
				'blood' => ['nullable',
							Rule::in(['Unknown', 'A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
				],
				'gender' => ['nullable',
							Rule::in(['Male', 'Female']),
							],
				'weight' => ['numeric','nullable'],
				'height' => ['numeric','nullable'],
				'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',
			]);

    	$user = User::find($request->user_id);

		$user->email = $request->email;
		$user->name = $request->name;

		if($request->hasFile('image')) {

			// We Get the image
		 	$file = $request->file('image'); 
		 	// We Add String to Image name 
            $fileName = Str::random(15).'-'.$file->getClientOriginalName();
            // We Tell him the uploads path 
            $destinationPath = public_path().'/uploads/';
            // We move the image to the destination path
            $moved = $file->move($destinationPath,$fileName);
            // Add fileName to database 

            $fullpath = public_path().'/uploads/'.$user->image;

            if($moved && !empty($user->image)){
            	unlink($fullpath);
            }

        	$user->image = $fileName;

		}
			

		$user->update();

		$user->assignRole('Patient');

		$patient = Patient::where('user_id', '=' , $request->user_id)
		         			->update(['birthday' => $request->birthday,
										'phone' => $request->phone,
										'gender' => $request->gender,
										'blood' => $request->blood,
										'adress' => $request->adress,
										'weight' => $request->weight,
										'height' => $request->height]);
		

		return Redirect::back()->with('success', __('Patient Updated Successfully'));

    }


    public function view($id){

    	
		if(Auth::user()->role == 'patient'){
			$patient = User::where('id', Auth()->id())->where('role','patient')->first();
		}else{
			$patient = User::where('id', $id)->where('role','patient')->first();
		}
		if(!$patient){ abort(404); }
        $prescriptions = Prescription::where('user_id' ,$id)->OrderBy('id','Desc')->get();
        $appointments = Appointment::where('user_id' ,$id)->OrderBy('id','Desc')->get();
        $documents = Document::where('user_id' ,$id)->OrderBy('id','Desc')->get();
        $invoices = Billing::where('user_id' ,$id)->OrderBy('id','Desc')->get();
        $historys = History::where('user_id' ,$id)->OrderBy('id','Desc')->get();

    	return view('patient.view', [
    		'patient' => $patient, 
    		'prescriptions' => $prescriptions, 
    		'appointments' => $appointments, 
    		'invoices' => $invoices,
    		'documents' => $documents,
    		'historys' => $historys
    	]);

    }


    public function search(Request $request){
    	
    	$term = $request->term;

    	$patients = User::where('name','LIKE','%' . $term . '%')->OrderBy('id','DESC')->paginate(10);


    	return view('patient.all', ['patients' => $patients]);
    }


    public function destroy($id){

    	$patient = User::destroy($id);

    	return Redirect::back()->with('success', 'Patient Deleted Successfully');
    }

	public function SendPassword($id){

		$user = User::find($id);

    	$newPassword =rand(10000000,99999999); 

		$user->update([
            'password' => Hash::make($newPassword),
        ]);

		// Envoie de la notification par e-mail
		$user->notify(new ResetPasswordNotification($newPassword));
		return back()->with('success', 'Password Sent Successfully');
	}


}
