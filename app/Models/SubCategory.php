<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Log;
use Validator;
use DB;
use URL;
class SubCategory extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sub_category';   

    public function createSubCategory($userData)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        
        $subcategory = new SubCategory();
        $subcategory->name             = $userData['name'];
        if(array_key_exists('description', $userData))
        $subcategory->description = $userData['description'];
        $subcategory->created_by           = 1;
        $subcategory->status               = "1";
        $subcategory->count = 0;
        $subcategory->save();
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);
        return $subcategory;
    }
     
}
