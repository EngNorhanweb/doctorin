<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prescription;
use App\Appointment;
use App\Billing;
use App\Billing_item;
use App\Patient;
use App\Notification;
use App;
use Auth;
use App\Notifications\WhatsAppNotification;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        Permission::updateOrcreate(['name' => 'view all notifications']);
        Permission::updateOrcreate(['name' => 'create notification']);
        Permission::updateOrcreate(['name' => 'edit notification']);
        Permission::updateOrcreate(['name' => 'delete notification']);
        Permission::updateOrcreate(['name' => 'edit expense']);
        Permission::updateOrcreate(['name' => 'delete expense']);
//$user = Auth::user();
// $user = Patient::findOrFail(1);
// $user->notify(new WhatsAppNotification($user));

//return $user->Patient;
// $permission = Permission::create(['name' => 'manage waiting room']);

//$user->assignRole('admin');
//$user->syncRoles(['assistant']);

//$role = Role::create(['name' => 'admin']);
//1$role = Role::create(['name' => 'assistant']);

$role = Role::findById(1); $role->givePermissionTo(Permission::all());

//$permission = Permission::create(['name' => 'manage roles']);
// $permission = Permission::create(['name' => 'create expense']);
// $role = Role::findById(1); $role->givePermissionTo(Permission::all());

/*

$permission = Permission::create(['name' => 'view patient']);
$permission = Permission::create(['name' => 'view all patients']);
$permission = Permission::create(['name' => 'delete patient']);

$permission = Permission::create(['name' => 'create health history']);
$permission = Permission::create(['name' => 'delete health history']);

$permission = Permission::create(['name' => 'add medical files']);
$permission = Permission::create(['name' => 'delete medical files']);


$permission = Permission::create(['name' => 'create appointment']);
$permission = Permission::create(['name' => 'view all appointments']);
$permission = Permission::create(['name' => 'delete appointment']);

$permission = Permission::create(['name' => 'create prescription']);
$permission = Permission::create(['name' => 'view prescription']);
$permission = Permission::create(['name' => 'view all prescriptions']);
$permission = Permission::create(['name' => 'edit prescription']);
$permission = Permission::create(['name' => 'delete prescription']);
$permission = Permission::create(['name' => 'print prescription']);


$permission = Permission::create(['name' => 'create drug']);
$permission = Permission::create(['name' => 'edit drug']);
$permission = Permission::create(['name' => 'view drug']);
$permission = Permission::create(['name' => 'view all drugs']);

$permission = Permission::create(['name' => 'create diagnostic test']);
$permission = Permission::create(['name' => 'edit diagnostic test']);
$permission = Permission::create(['name' => 'view all diagnostic tests']);

$permission = Permission::create(['name' => 'create invoice']);
$permission = Permission::create(['name' => 'edit invoice']);
$permission = Permission::create(['name' => 'view invoice']);
$permission = Permission::create(['name' => 'view all invoices']);
$permission = Permission::create(['name' => 'delete invoice']);
        
*/


        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Receptionist')){

            $total_patients = User::where('role','patient')->count();
            $total_patients_today = User::where('role','patient')->wheredate('created_at', Today())->count();
            $total_appointments = Appointment::all()->count();
            $total_appointments_today = Appointment::wheredate('date', Today())->get();
            $total_prescriptions = Prescription::all()->count();
            $total_payments = Billing::all()->count();
            $total_payments = Billing::all()->count();
            $total_payments_month = Billing_item::whereMonth('created_at',date('m'))->sum('invoice_amount');
            $total_payments_month = Billing_item::whereMonth('created_at',date('m'))->sum('invoice_amount');
            $total_payments_year = Billing_item::whereYear('created_at',date('Y'))->sum('invoice_amount');

            return view('home.staff', [
                'total_patients' => $total_patients, 
                'total_prescriptions' => $total_prescriptions, 
                'total_patients_today' => $total_patients_today,
                'total_appointments' => $total_appointments,
                'total_appointments_today' => $total_appointments_today,
                'total_payments' => $total_payments,
                'total_payments_month' => $total_payments_month,
                'total_payments_year' => $total_payments_year
            ]);

        }elseif(Auth::user()->hasRole('Patient')){
            $now = Now();
            $appointments = Appointment::where('user_id', Auth::user()->id)->paginate(get_option('pagination'));
            $notifications = Notification::where('start_date', '<=', $now)->where('end_date', '>=', $now)->Orderby('id','desc')->get();

            return view('home.patient',[
                'appointments' => $appointments, 
                'notifications' => $notifications, 
            ]);

        }else{
            abort(403);
        }
        
    }


    public function lang($locale){

        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
