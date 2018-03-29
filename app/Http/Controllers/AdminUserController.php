<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
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
    }

    public function getroles(Request $request){
    	$response = (Object)[];
    	$result = Role::get();
    	return  $result;
    	$response->status = "success";
    	$response->data = $result;
        return response()->json($response);
    }

    public function getallusers(){
    	$response = (Object)[];
    	$result = User::get();
    	$response->status = "success";
    	$response->data = $result;
        return response()->json($response);
    }
}