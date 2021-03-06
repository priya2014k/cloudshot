<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Log;
use Validator;
use DB;
use URL;
class Merchant extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'merchant'; 
    
    public function adminsignupValidator($signupData)
    {
        return Validator::make($signupData, [
            'name' => 'required',
            'email' => 'required',
            'pub_name' => 'pub_name',
            'role' => 'role',
            'pincode' => 'pincode',       
            'mobile_no' => 'required',
            'password'  =>'password',
            ]);
    }
    //*create merchant*/
    public function createMerchant($userData)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        if($userData->id){
            $user =  Merchant::where('email', $userData['email'])->first();
        }else{
            $user = new Merchant();
        }
        
        
        if(isset($userData->email)){
            $user->email = $userData->email;
        }
        $user->name = $userData->name;
        $user->pub_name = $userData->pub_name;
        $user->pincode   = $userData->pincode;
        $user->mobile_no = $userData->mobile_no;
        $user->role = $userData->role;
        $user->status = $userData->status;
        $user->password = $userData->password;
        $user->save();
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);
        return $user;
    }
}
