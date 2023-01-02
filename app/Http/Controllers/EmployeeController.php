<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
 use Yajra\DataTables\DataTables;

use Exception;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $employees = Employee::paginate(5);
            return view('pages.employee.index',compact('employees'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('employee.index')->with('error', 'Error occured in the employee index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('pages.employee.create');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('employee.index')->with('error', 'Error occured in the employee create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try{
            $data = $request->only(Employee::REQUEST_INPUTS);
            $user = new User();
            $user->email = $data['email'];
            $user->name = $data['employee_name'];
            $user->password = bcrypt('Password1!' . $data['employee_name']);
            $user->save();
            $user->assignRole('Employee');
            $permissions = Permission::whereIn('name',['employee.read','employee.read_write'])->get();
            $user->givePermissionTo($permissions);
            Employee::create($data);
            return redirect()->route('employee.index')->with('success', 'Employee Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('employee.index')->with('error', 'Error occured in the employee store');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        try{
            return view('pages.employee.show',compact('employee'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('employee.index')->with('error', 'Error occured in the employee show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        try{
            return view('pages.employee.edit',compact('employee'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('employee.index')->with('error', 'Error occured in the employee show');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        try{
            $data = $request->only(Employee::REQUEST_INPUTS);
            $user = User::whereEmail($data['email'])->first();
            $user->email = $data['email'];
            $user->name = $data['employee_name'];
            $user->password = $request->password != '' ? bcrypt($request->input('password')) : $user->password;
            $user->save();
            $employee = Employee::findOrFail($id);
            $employee->update($data);
            return redirect()->route('employee.index')->with('success', 'Employee Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('employee.index')->with('error', 'Error occured in the employee update');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return response()->json( 'Employee Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('employee.index')->with('error', 'Error occured in the employee destroy');
        }
    }

    public function create1(){
        return view('pages.employee.create');
    }

     public function getEmployee()
      {
          try{
            $clients = Employee::all();

            return Datatables::of($clients)
                ->editColumn('employee_name', function ($client) {
                    return $client->employee_name;
                })->editColumn('designation', function ($client) {
                return ucfirst(str_replace('_', ' ',$client->designation));
            })->editColumn('date_of_joining', function ($client) {
                return dateFormat($client->date_of_joining);
            })->editColumn('email', function ($client) {
                return $client->email;
            })->editColumn('show', function ($client) {
                return '<a href="' . route('employee.show', $client) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($client) {
                return '<a href="' . route('employee.edit', $client) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($client) {
                return '<div class="form-group" ><button class="btn btn-danger  btn-sm" onclick=deleteEmployee('. $client->id .')  ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete'])
                ->make(true);
        } catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        } 
    }
}