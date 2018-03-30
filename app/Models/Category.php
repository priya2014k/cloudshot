<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Log;
use Validator;
use DB;
use URL;
class Category extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'categories';   

     public function UpdateCategory($userData)
    {
        Log::debug("Enter Function ".__CLASS__." ".__FUNCTION__);
        if($userData->id){
            $category =  Category::where('name',$userData['name'])->first();
        }else{
            $category = new Category();
        }
		$category->name             = $userData['name'];
        if(array_key_exists('description', $userData))
           $category->description = $userData['description'];
       	$category->created_by           = 1;
        $category->status               = "1";
        $category->count = 0;
        $category->save();
        Log::debug("Exit Function ".__CLASS__." ".__FUNCTION__);
        return $category;
    }
}
