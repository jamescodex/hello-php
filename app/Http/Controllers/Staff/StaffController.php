<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\StaffRepositoryInterface;

class StaffController extends Controller
{
    /** 
     * @var App\Repositories/StaffRepository
    */
    private $staffRepository;

    public function __construct(StaffRepositoryInterface $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function departments() 
    {
        $response = $this->staffRepository->all();
        
        return $response;
    }


     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function getuser() 
    {
        $response = $this->staffRepository->getUser();
        
        return $response;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function updateuser(Request $request) 
    {
        $response = $this->staffRepository->updateUser($request);
        
        return $response;
    }


}
