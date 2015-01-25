<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function getUser()
	{
		$userId = Input::get('user_id');
		$user = User::find($userId);
		if($user == NULL){
			$response=['message' => 'user not found'];
			return Response::json($response, 404);
		}
		else {
			return $user;	
		}
	}
	
	public function login()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$validator = Validator::make(
				array('email' => $email, 'password' => $password),
				array('email'=>'required|email', 'password' => 'required')
			);
		if($validator->fails()){
			return $validator->messages()->toJson();
		}
		else {
			if(Auth::attempt(Input::all(),true)){
				$user = Auth::user();
				return Response::json(["token_key" => $user->remember_token, "data" => $user], 200);
			}
			else {
				return Response::json(["message" => "user not found"], 200);	
			}
		}
	}


	public function checkAuth(){
		if(Auth::check()){
			return "login";
		}
		else {
			return "not login";
		}
	}

	public function logout(){
		Auth::logout();
		return Response::json(["message" => "success logout"], 400);
	}

	public function registerUser(){
		$validator = Validator::make(Input::all(),
				array('name'=>'required','email'=>'required|email', 'password' => 'required')
			);
		if($validator->fails()){
			return $validator->messages()->toJson();
		}
		else {
			$user = New User();
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Response::json(["message" => "success insert user"], 400);
		}
	}
	/**
	condition 
	->to one person
	->to one group
	->broadcast
	**/
	public function sendMessage()
	{
		$validator = Validator::make(Input::all(), 
			array(
				'data_message' => 'required',
				'type' => 'required',
				'user_id_sender' => 'required'
				));
		if($validator->fails()){
			return $validator->messages()->toJson();
		}
		else{
			$list_user = User::where('id', '<>', Input::get('user_id_sender'))->get();
			foreach ($list_user as $user) {
				$messages = new Message();
				$messages->data_message = Input::get('data_message');
				$messages->type = Input::get('type');
				$messages->user_id_sender = Input::get('user_id_sender');
				$messages->user_id_receiver = $user->id;
				$messages->group_id = "";
				$messages->save();
			}
			return Response::json(['messages'=>'success send messages'], 200);
		}
	}

	public function getMessage()
	{
		$validator = Validator::make(Input::all(), 
			array(
				'user_id' => 'required'
				));
		if($validator->fails()){
			return $validator->messages->toJson();
		}
		else {
			$list_messages = Message::with(['user_receiver', 'user_sender'])->where('user_id_receiver', Input::get('user_id'))->get();
			foreach ($list_messages as $messages) {
				$messages->delete();
			}
			return Response::json(['data'=>$list_messages], 200);
		}
	}
}
