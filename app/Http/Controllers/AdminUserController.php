<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Merchant;
use App\Models\Role;
use JWTAuth;
use JWTAuthException;
use Hash;
use Log;
use Config;
use URL;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\QueryException;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
        $this->address = new Address;
        $this->role = new Role;
        $this->merchant = new Merchant;
    }

    public function getroles(Request $request){
    	$response = (Object)[];
    	$result = Role::where('status',1)->get();
    	$response->status = "success";
    	$response->data = $result;
        return response()->json($response);
    }

    public function getallusers(){
    	$response = (Object)[];
    	$result = Merchant::get();
    	$response->status = "success";
    	$response->data = $result;
        return response()->json($response);
    }

    public function adduser(Request $request){
        $user = $request->all();
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $response = (Object)[];
       // $signupValidator = $this->user->signupValidator($request->all());
        /*if ($signupValidator->fails()) {
            $messages = $signupValidator->errors();
            $response->status = "failed";
            $response->message = $messages;
            return response()->json($response);
        }*/
        if($user['role'] == 3){
            $olduser =  Merchant::where('email', $user['email'])->first();
        }else{
            $olduser =  User::where('email', $user['email'])->first();
        }
        
        if(!$olduser){
            $request->status = 1;
            if($user['role'] == 3){
                $merchant = $this->merchant->createMerchant($request);
            }else{
                $user = $this->user->createUserByAdmin($request);
            }
            $response->status = "success";
            $response->message = "User created successfully!";
        }
        else{
            $response->status = "failed";
            $response->message = "Email already exist sign in!";
        }
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);   
        return response()->json($response);
    }
}