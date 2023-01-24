<?php

namespace App\Http\Controllers;

use Response;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Users;

class AuthinController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function validateLogin(Request $request) {

        try{
            $username = $request->username;
            $password = $request->password;
            $account = Users::where('username',$username)->first();
            if(!$account){
                return Response::json([
                    'error' => true, 
                    'msg' => 'Username of Password invalid'
                ]);
            }
            if( Hash::check($password, $account->password) ){
                Session::put('account_id', $account->id);
                Session::put('username', $account->username);
                Session::put('email', $account->email);
                Session::put('name', $account->name);


                return Response::json([
                    'error' => false, 
                    'msg' => 'Login Success'
                ]);
            }else{
                return Response::json([
                    'error' => true, 
                    'msg' => 'Login Failed'
                ]);
            }
        }catch(\Exception $e){
            return Response::json([
                'error' => true, 
                'msg' => 'Login Failed'
            ]);
        }
    }

    public function validateRegister(Request $request) {
        try{
            $data = new Users;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->password = bcrypt($request->password);
            $data->save();

            return Response::json([
                'error' => false, 
                'msg' => 'Register Success'
            ]);
            
        }catch(\Exception $e){
            return Response::json([
                'error' => true, 
                'msg' => 'Register Failed'
            ]);
        }
    }
}
