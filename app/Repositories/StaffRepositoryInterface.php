<?php 

namespace App\Repositories;


interface StaffRepositoryInterface {
    
    public function all();
    public function getUser();
    public function updateUser($request);
}