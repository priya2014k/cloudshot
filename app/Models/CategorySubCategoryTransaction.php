<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Log;
use Validator;
use DB;
use URL;
class CategorySubCategoryTransaction extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'category_sub_category_transaction';   
}
