<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use Redirect;
use Str;

class ExpenseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
    	return view('expense.create');
    }

    public function store(Request $request){

    	$validatedData = $request->validate([
        	'title' => 'required',
        	'amount' => 'required|numeric',
        	'date' => 'required|date',
    	]);

    	$expense = New Expense();
        $expense->title = $request->title;
        $expense->amount = $request->amount;
        $expense->type = $request->type;
        $expense->date = $request->date;
        $expense->reference = 'e'.rand(10000,99999);
        $expense->note = $request->note;

        $expense->save();

    	return Redirect::route('expense.all')->with('success', __('Expense Created Successfully'));
    }

    public function edit($id){
        $expense = Expense::find($id);
        return view('expense.edit',['expense' => $expense]);
    }

    public function all(){
    	$expenses = Expense::paginate(get_option('pagination'));

    	return view('expense.all',['expenses' => $expenses]);
    }

    public function store_edit(Request $request){
            
        $validatedData = $request->validate([
            'title' => 'required',
        	'amount' => 'required|numeric',
        	'type' => 'required',
        	'date' => 'required|date',
        ]);
        
        $expense = Expense::find($request->expense_id);

        $expense->title = $request->title;
        $expense->amount = $request->amount;
        $expense->type = $request->type;
        $expense->date = $request->date;
        $expense->note = $request->note;

        $expense->save();

        return Redirect::route('expense.all')->with('success', __('Expense Edited Successfully'));

    }

    public function destroy($id){

        Expense::destroy($id);
        return Redirect::route('expense.all')->with('success', __('Expense Deleted Successfully'));

    }


}
