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
    	$merchant = Merchant::get()->toArray();
        $user = User::get()->toArray();
        $result = array_merge($merchant,$user);
    	$response->status = "success";
    	$response->data = $result;
        return response()->json($response);
    }

    public function adduser(Request $request){
        $user = $request->all();
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $response = (Object)[];
       /* if($user['role'] == 3){
            $signupValidator = $this->merchant->adminsignupValidator($request->all());
            if ($signupValidator->fails()) {
                $messages = $signupValidator->errors();
                $response->status = "failed";
                $response->message = $messages;
                return response()->json($response);
            }
        }else{
            $signupValidator = $this->user->adminsignupValidator($request->all());
            if ($signupValidator->fails()) {
                $messages = $signupValidator->errors();
                $response->status = "failed";
                $response->message = $messages;
                return response()->json($response);
            }
        }*/
        if(array_key_exists('id', $user)){
            if($user['role'] == 3){
                $merchant = $this->merchant->createMerchant($request);
                
            }else{
                $user = $this->user->createUserByAdmin($request);
            }
            $response->status = "success";
            $response->message = "User Updated successfully!";
        }else{
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
            
        }
        return response()->json($response);
    }
    
    public function changeuserstatus(Request $request){
        $users = $request->get('user');
        $status = $request->get('status');
        if($status == 'activate')
            $status = 1;
        else if($status == 'terminate')   
            $status = 3; 
         foreach ($users as $user) 
         {      
            if($user['role'] == 3){
                $MR = Merchant::find($user['id']);
                $MR->status = $status;
                $MR->save();
            }else{
                $UR = User::find($user['id']);
                $UR->status = $status;
                $UR->save();
            }
        
         }      
        return response()->json(['status' => 'success','reason' => 'Coachee Status Changed','response' =>200]);
    }
}