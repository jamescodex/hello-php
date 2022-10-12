<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepositoryInterface;

class AdminController extends Controller
{
    /** 
     * @var App\Repositories/StaffRepository
    */
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }



    /**
     * Get all departments
     *
     * @return [json] user object
    */

    public function departments()
    {
        $response = $this->adminRepository->allDepartments();

        return $response;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function createdepartment(Request $request)
    {
        $response = $this->adminRepository->createDepartment($request);

        return $response;
    }


    
    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function staffdeactivate($id) 
    {
        $response = $this->adminRepository->staffDeactivate($id);
        
        return $response;
    }



    /**
     * Get all agents
     *
     * @return [json] user object
    */

    public function staffs()
    {
        $response = $this->adminRepository->allStaffs();

        return $response;
    }



     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    
    public function createstaff(Request $request) 
    {
        $response = $this->adminRepository->createStaff($request);

        return $response;
    }
}
