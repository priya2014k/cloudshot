<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];

    public function signupValidator($signupData)
    {
        return Validator::make($signupData, [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'country_code' => 'required', 		
            'mobile_no' => 'required',
            'address1' => 'required',
            ]);
    }

    /*create user*/
    public function createUser($userData)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $user = new User();
        if(isset($userData->email)){
            $user->email = $userData->email;
        }
        $user->name = $userData->name;
        $user->gender = $userData->gender;
        $user->dob	 = $userData->dob	;
        $user->country_code = $userData->country_code;
        $user->mobile_no = $userData->mobile_no;
        $user->role = $userData->role;
        $user->status = $userData->status;
        // $user->password = Hash::make($userData->password);
        $user->save();
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);
        return $user;
    }

    // send otp
    public function sendOtp($userData)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        //$otp = mt_rand(100000, 999999);
        $otp = 123456;
        $userData->otp = $otp;
        $userData->save();
        // if(isset($userData->email)){
        //     $user->email = $userData->email;
        // }
        // $user->name = $userData->name;
        // $user->gender = $userData->gender;
        // $user->dob	 = $userData->dob	;
        // $user->country_code = $userData->country_code;
        // $user->mobile_no = $userData->mobile_no;
        // $user->role = $userData->role;
        // $user->status = $userData->status;
        // // $user->password = Hash::make($userData->password);
        // $user->save();
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);
        return $userData;
    }
}
