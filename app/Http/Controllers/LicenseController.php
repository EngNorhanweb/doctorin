<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Redirect;
use App\Setting;

class LicenseController extends Controller
{
    public function __construct(){
         $this->middleware(['auth']);
    }

    public function index(){
        if (file_exists(storage_path(base64_decode('aW5zdGFsbGVk'))) && file_exists(storage_path(base64_decode('YWN0aXZhdGVk')))) {
            //return redirect()->route('home'); 
            return view(base64_decode('bGljZW5zZS5hY3RpdmF0aW9u'));
        }
        update_option('purchase_code', '');
        return view(base64_decode('bGljZW5zZS5hY3RpdmF0aW9u'));
    }

    public function activate(Request $request){
                    

                    $purchaseCode = $request->purchase_code;
                    $itemId = get_option('itemID');
                    $uri = base64_decode('aHR0cHM6Ly9saWNlbnNlLW1hbmFnZXIuZGlnaXQ5NHRlYW0uY29tL2FwaS92YWxpZGF0b3I=');


                    $client = new Client();

                    $response = $client->get($uri, [
                        'query' => [
                            'purchaseCode' => $purchaseCode,
                            'item_id' => $itemId,
                            'domain' => url()->full(),
                        ],
                    ]);

                    $body = $response->getBody();

                    $data = json_decode($body, true);

                    //return $data['message'];

                    if(isset($data) && $data['status'] == 1){
                        
                        activate_install_file($data['purchase_code']);

                        update_option('purchase_code', $data['purchase_code']);

                        update_option('available_version', $data['available_version']);
                        setEnv('available_version', $data['available_version']);
    
                        update_option('supported_until', $data['supported_until']);
                        setEnv('supported_until', $data['supported_until']);
    
                        update_option('supported_status', $data['supported_status']);
                        setEnv('supported_status', $data['supported_status']);
    
                        update_option('last_check', now());
                        setEnv('last_check', now());
    
                        update_option('license_message', $data['message']);

                        return Redirect::route('home')->with('success', $data['message']);

                    }elseif(isset($data['error'])){

                        $errors = $data['message'];
                        return Redirect::back()->withErrors($data['message']);

                    }else{
                        return Redirect::back()->with('danger', $data['message']);
                    }
    }

}
