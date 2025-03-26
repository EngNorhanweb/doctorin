<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use Redirect;
use Excel;
use App\Imports\DrugsImport;

class DrugController extends Controller{


	public function __construct(){
        $this->middleware('auth');
    }


    //
    public function create(){
    	
        return view('drug.create');

    }

    public function store(Request $request){

    	$validatedData = $request->validate([
        	'trade_name' => 'required',
        	'generic_name' => 'required',
    	]);

    	$drug = Drug::updateOrCreate(
		    ['trade_name' => $request->trade_name, 'generic_name' => $request->generic_name],
		    ['note' => $request->note]
		);

    	return Redirect::route('drug.all')->with('success', __('sentence.Drug added Successfully'));
    }

    public function all(){
    	$drugs = Drug::paginate(get_option('pagination'));

    	return view('drug.all',['drugs' => $drugs]);
    }


    public function edit($id){
        $drug = Drug::find($id);
        return view('drug.edit',['drug' => $drug]);
    }

    public function store_edit(Request $request){
            
        $validatedData = $request->validate([
            'trade_name' => 'required',
            'generic_name' => 'required',
        ]);
        
        $drug = Drug::find($request->drug_id);

        $drug->trade_name = $request->trade_name;
        $drug->generic_name = $request->generic_name;

        $drug->save();

        return Redirect::route('drug.all')->with('success', __('sentence.Drug Edited Successfully'));

    }

    public function destroy($id){

        Drug::destroy($id);
        return Redirect::route('drug.all')->with('success', __('sentence.Drug Deleted Successfully'));

    }

    public function bulk_upload(){

        return view('drug.upload');

    }

    public function bulk_upload_store(Request $request)
    {
        $upload = Excel::import(new DrugsImport, $request->file);
        if($upload){

            return redirect()->route('drug.all')->with('success', __('Drugs Imported Successfully'));

        }else{

            return redirect()->route('drug.all')->with('danger', __('Error uploading File'));

        }
        
    }

}
