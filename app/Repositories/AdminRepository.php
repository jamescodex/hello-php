<?php 


namespace App\Repositories;

use App\User;
use App\Department;
use App\DepartmentStaff;
use Illuminate\Support\Facades\Validator;

class AdminRepository implements AdminRepositoryInterface {


    
    /**
     * Get all departments
     *
     * @return [json] user object
    */

    public function allDepartments()
    {
       $departments = Department::all();
       return response()->json(['data' => $departments], 200);
    }


    /**
     * Get all agents
     *
     * @return [json] user object
    */
    public function allStaffs() {

        $staffs = User::whereHas(
            'roles', function($q){
                $q->where('name', 'staff');
            }
        )->get();

        return response()->json(['data' => $staffs], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createStaff($request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:users'
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $staff = new User;
        $staff->firstname = $request->firstname;
        $staff->lastname = $request->lastname;
        $staff->email = $request->email;
        $staff->password = bcrypt('password');
        $staff->save();

        return response()->json(['data' => $staff], 201);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createDepartment($request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:departments',
            'location' => 'required|string',
            'phone' => 'required|string',
            'staff_id' => 'required|integer'
        ]);



        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        $department = new Department;
        $department->name = $request->name;
        $department->location = $request->location;
        $department->number = $request->phone;
        $department->save();


        /** Connect staff to department */
        $departmentStaff = new DepartmentStaff;
        $departmentStaff->department_id = $department->id;
        $departmentStaff->staff_id = $request->staff_id;
        $departmentStaff->save();


        return response()->json(['data' => $department], 201);
        
    }


    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function staffDeactivate($id)
    {
        $staff = User::findOrFail($id);

        $staff->delete();

        return response()->json(['data' => 'Staff deactivated successfully'], 200);
    }

}