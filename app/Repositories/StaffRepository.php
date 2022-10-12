<?php 

namespace App\Repositories;

use App\User;
use App\Department;
use App\DepartmentStaff;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class StaffRepository implements StaffRepositoryInterface {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function all() 
    {

       $departmentStaffs = DepartmentStaff::where('staff_id', Auth::id())->get();
      
       $departments = Department::all();

       $staff_departments = $departmentStaffs->map(function($dStaff) use ($departments) {

        $departments_staff = $departments->filter(function($department) use ($dStaff){
            return  $department->id = $dStaff->department_id;
        });

        $departments_staffs = Arr::flatten($departments_staff)[0];
        $dStaff->name  = $departments_staffs->name;
        $dStaff->location =  $departments_staffs->location;
        $dStaff->phone = $departments_staffs->number;

        return $dStaff;

       });
      

       return response()->json(['data' => $staff_departments], 200);


    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function getUser() 
    {
        return response()->json(['data' => Auth::user()], 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function updateUser($request) 
    {
       $validator = Validator::make($request->all(), [
           'email' => 'string|email',
       ]);


       /** Check for input error */
       if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 400);
       }

       $user = User::where('id', Auth::id())->firstOrFail();

       if ($request->has('firstname')) {
           $user->firstname = $request->firstname;
       }

       if ($request->has('lastname')) {
        $user->lastname = $request->lastname;
      }

      if ($request->has('email')) {
        $user->email = $request->email;
      }

      if ($request->has('new_password') && strlen($request->new_password) > 8) {

        if (Hash::check($request->old_password , $user->password)) {
           $user->password = Hash::make($request->new_password);
        } else {
           return response()->json(['error', "Old Password did'nt match"], 400);
        }

       
      }

      if ($user->isClean()) {
        return response()->json([ 'error' => 'You need to specify a different value to update'], 422);
      }

      $user->save();

      return response()->json(['data' => $user], 200);

    }
    
}