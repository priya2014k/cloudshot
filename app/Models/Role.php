<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Log;
use Validator;
use DB;
use URL;
class Role extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'role';   
}
