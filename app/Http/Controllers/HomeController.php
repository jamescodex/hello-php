<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    public function admindashboard()
    {
        return view('admin.index');
    }

    public function createdepartment() 
    {
        return view('admin.create');
    }

    public function createstaff() 
    {
        return view('admin.create-staff');
    }

    public function adminstaffs()
    {
        return view('admin.staff');
    }


     /**
     * Show the staff application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    public function staffdashboard()
    {
        return view('staff.index');
    }

    public function departments()
    {
      return view('staff.department');
    }

}
