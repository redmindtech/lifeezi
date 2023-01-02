<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;
use App\Models\Expense;
use Exception;
 use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    
    public function index(Request $request)
    {
        try{
            $expenses = Expense::paginate(5);
            return view('pages.expenses.index',compact('expenses'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('expense.index')->with('error', 'Error occured in the expenses index');
        }
    }
    
    
    public function create()
    {
        try{
            return view('pages.expenses.create');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('expense.index')->with('error', 'Error occured in the expenses create');
        }
    }

    public function store(ExpenseRequest $request)
    {
        try{
            $data = $request->only(Expense::REQUEST_INPUTS);
            Expense::create($data);
            return redirect()->route('expense.index')->with('success', 'Expenses Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('expense.index')->with('error', 'Error occured in the Expenses store');
        } 
    }

   
    public function show(Expense $expense)
    {
        try{
            return view('pages.expenses.show',compact('expense'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('expense.index')->with('error', 'Error occured in the expenses show');
        } 
    }

    public function edit(Expense $expense)
    {
       try{
        
            return view('pages.expenses.edit',compact('expense'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('expense.index')->with('error', 'Error occured in the expenses edit');
        } 
    }


    public function update(ExpenseRequest $request, Expense $expense)
    {
        try{
            $data = $request->only(Expense::REQUEST_INPUTS);
            $expense->update($data);
            return redirect()->route('expense.index')->with('success', 'expenses Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('expense.index')->with('error', 'Error occured in the expenses update');
        } 
    }

    public function destroy($expense)
    {
        try{
            $expense = Expense::findOrFail($expense);
            $expense->delete();
            return response()->json('Expenses Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('expense.index')->with('error', 'Error occured in the expenses destroy');
        } 
    }

    public function getExpenses()
      {
          try{
            $expenses = Expense::all();

            return Datatables::of($expenses)
                ->editColumn('expense_date', function ($client) {
                    return dateFormat($client->expenses_date);
                })->editColumn('amount', function ($client) {
                return ucfirst($client->amount);
            })->editColumn('expense_type', function ($client) {
                return $client->expenses_type;
            })->editColumn('paid_to', function ($client) {
                return ucfirst($client->paid_to);
            })->editColumn('show', function ($client) {
                return '<a href="' . route('expense.show', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($client) {
                return '<a href="' . route('expense.edit', $client) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($client) {
                return '<div class="form-group" ><button class="btn btn-danger btn-sm" onclick=deleteExpenses('. $client->id .') data-id="'. $client->id . '" ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete'])
                ->make(true);
        } catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        } 
    }




}