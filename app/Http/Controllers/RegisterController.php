<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    
    public function register(UserRequest $request )
    {
      
        $request->validated($request->all());  
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname, 
            'email' => $request->email,  
            'password' => Hash::make($request->password),
        ]);

        return response([
            'user' => $user,
            'token' => $user->createToken($user->name)->plainTextToken,
            'message' => 'register successfully'
        ]); 
      
    }   

    
    public function login(LoginRequest $request )
    {
        // dd($request->all());
         $request->validated($request->all());    

        if(!Auth::attempt($request->only('email', 'password')))
        {
            return $this->error('', 'email or password!', 401);
        }
     
        $user = User::where('email',  $request['email'])->first();
        // dd($user);
        return response([
            'user' => $user,
            'token' => $user->createToken($user->name)->plainTextToken,
            'message' => 'Login successfully'
        ]);
      
    } 

    public function updateUser(UserRequest $request, $id )
    {
      
            $user = User::find($id);
            $request['password']=Hash::make($request->password);
            $user ->update($request->all());
      
    }   

    public function logout() 
    {
        Auth::user()->currentAccessToken()->delete();
        return response([
            'message' => 'You have been logout' 
        ]);

    }

}
