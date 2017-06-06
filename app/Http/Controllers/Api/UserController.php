<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
class UserController extends Controller
{	

	/**
	Register user with name, email, password

	*/
	public function signup(Request $request) {

	   $credentials['name'] = $request->get('name');
	   $credentials['email'] = $request->get('email');
	   $credentials['password'] = $request->get('password');
	   
	   try {	  
	       $user = User::create($credentials);
	   } catch (Exception $e) {
	       return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
	   }

	   return response()->json(['success'=>true, 'msg' => 'Please signin to use the api']);
	}


	/**
	Signin user with email, and password
	@return token one for session
	*/
	public function signin(Request $request){
		$email = $request->get('email');
	   	$password = $request->get('password');
	   	$user = User::where('email', $email)->where('password', $password)->first();
	   	
	   	if(count($user)){
			$token = JWTAuth::fromUser($user);
			$user->api_token = $token;
			$user->save();
	   		return response()->json(compact('token'));
	   	}else{
	   		return response()->json(['error' => 'User not registered.'], 401);
	   	}
	}

}
