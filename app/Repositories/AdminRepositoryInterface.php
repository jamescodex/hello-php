<?php 


namespace App\Repositories;

interface  AdminRepositoryInterface {

    public function allDepartments();
    public function createDepartment($request);
    public function staffDeactivate($id);
    public function allStaffs();
    public function createStaff($request);
    
}