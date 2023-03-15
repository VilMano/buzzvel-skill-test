<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QrCodeGenerator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function getUser(string $name){
        //for this small example I decided to just look for the username
        //having the username as a unique input 
        $user = User::where('name', '=', $name)->first();     
        if($user != null){
            return view('profile', ['user' => $user]);
        }   
    }
    
    public function create(Request $request){
        //store form inputs in session
        $request->flash();

        //check if user already exists
        $requestedUser = User::where('name', '=', $request->name)->first();

        //create new user
        //if user doesn't exist, create new
        //if user exists, use $user as $requestedUser 
        $user = new User;

        $errorsInput = $this->validateInputs($request->name, $request->linkedin, $request->github);
        if($errorsInput != ""){
            return view('welcome', ['errorsI' => $errorsInput]);
        }
        
        if($requestedUser == null){
            $user->name = $request->name;
            $user->linkedin_url = $request->linkedin;
            $user->github_url = $request->github;
            $user->save();
        }else{
            $user = $requestedUser;
        }

        //if qrcode png does not exist, create a new one and store it
        if(!Storage::exists(public_path().'/codes/'.$user->name.'-qrcode.png')){
            $qr = new QrCodeGenerator();
            $qr->url = env('APP_URL').':8000/users/'.$user->name;
            $qr->label = $user->name;
            $qr->size = 300;
            $qr->dir = 'codes/'.$user->name.'-qrcode.png';
            $qr->create();
        }

        return view('welcome', ['path' => $qr->dir]);
    }

    public function validateInputs(string $name = null, string $linkedin = null, string $github = null){
        $errors = "";

        if($name == null || $name == ""){
            $errors .= "Name cannot be empty. \\n ";
        }
        
        if($linkedin == null || $linkedin == ""){
            $errors .= "Linkedin URL cannot be empty. \\n ";
        }
        
        if($github == null || $github == ""){
            $errors .= "Github URL cannot be empty. \\n ";
        }
        
        return $errors;
    }
}
