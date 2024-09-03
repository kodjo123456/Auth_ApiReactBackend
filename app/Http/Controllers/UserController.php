<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Responses\ApiResponse;

class UserController extends Controller
{
    public function index()
   {

        return ApiResponse::sendResponse(true, [new UserResource(User::all())], 'Opération effectuée.', 201);
   } 

   public function create(){

   }

   public function store(){
    
   }
   public function show(){
    
   }
   public function edit(){
    
   }
   public function update(){
    
   }
    
}
