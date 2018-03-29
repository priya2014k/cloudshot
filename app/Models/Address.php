<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Log;
use Validator;
use DB;
use URL;
class Address extends Model
{
    protected $primaryKey = 'id';

    /*create user address*/
    public function createAddress($userData,$saveduserData)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        $address = new Address();
        $address->user_id = $saveduserData->id;
        $address->address1 = $saveduserData->address1;
        $address->country_code = $userData->country_code;
        $address->mobile_no = $userData->mobile_no;
        if(isset($userData->address2)){
            $address->address2 = $userData->address2;
        }
        if(isset($userData->lat)){
            $address->lat = $userData->lat;
        }
        if(isset($userData->long)){
            $address->long = $userData->long;
        }
        if(isset($userData->location)){
            $address->location = $userData->location;
        }
        $address->save();
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);
        return $address;
    }
}
