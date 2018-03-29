<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use JWTAuth;
use JWTAuthException;
use Hash;
use Log;
use Config;
use URL;
use Carbon;
use DateTime;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
        $this->address = new Address;
    }
    
    public function login(Request $request){
        
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $response = (Object)[];
        $user =  User::where('mobile_no', $request->mobile_no)->first();
        if($user){
            $sendOtp = $this->user->sendOtp($user);
            $response->status = "success";
            $response->message = "Otp sent successfully!";
        }
        else{
            $response->status = "failed";
            $response->message = "Mobile Number not found, sign up!";
        }
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);   
        return response()->json($response);
    }

    public function getAuthUser(Request $request){
        return response()->json([
            'response' => 'success',
            
        ]);
    }


    //registration
    public function registration(Request $request)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $response = (Object)[];
        $signupValidator = $this->user->signupValidator($request->all());
        if ($signupValidator->fails()) {
            /*log users for failed to signup*/
            $messages = $signupValidator->errors();
            $response->status = "failed";
            $response->message = $messages;
            return response()->json($response);
        }
        $olduser =  User::where('mobile_no', $request->mobile_no)->orwhere('email',$request->email)->first();
        if(!$olduser){
            $request->status = 2;
            $request->role = 2;
            $user = $this->user->createUser($request);
            $saveaddress = $this->address->createAddress($request,$user);
            $sendOtp = $this->user->sendOtp($user);
            $response->status = "success";
            $response->message = "User created successfully!";
        }
        else{
            $response->status = "failed";
            $response->message = "Mobile Number or Email already exist sign in!";
        }
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);   
        return response()->json($response);
    }

    //resend otp
    public function resendotp(Request $request)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $response = (Object)[];
        $user = $request->all();
        try
        {
            $user =User::where('mobile_no', $request->mobile_no)->first();
            $sendOtp = $this->user->sendOtp($user);
            $response->status = "success";
            $response->message = "Otp re-sent successfully!";
        }
        catch(Exception $e)
       {
            $response->status = "failed";
            $response->message = "Something went wrong!";
       }
       Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__); 
       return response()->json($response);
    }
    //verifyotp
    public function verifyotp(Request $request)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $response = (Object)[];
        $user = $request->all();
        try
        {
            $userdetails =User::where('mobile_no', $request->mobile_no)->first();
            if($userdetails->otp == $user['otp'])
            {
                $userdetails->otp = null;
                $userdetails->status = 1;
                $userdetails->save();
                $response->status = "success";
                $response->message = "User validated successfully!";
            }
            else
            {
                $response->status = "failed";
                $response->message = "Invalid otp";
            }
        }
        catch(Exception $e)
       {
            $response->status = "failed";
            $response->message = "Something went wrong!";
       }
       Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__); 
       return response()->json($response);
    }
}

