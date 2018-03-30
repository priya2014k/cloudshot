<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SubCategory;
use App\Models\Category;
use JWTAuth;
use JWTAuthException;
use Hash;
use Log;
use Config;
use URL;
use Carbon\Carbon;
use DateTime;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\QueryException;
use File;

class CategoryController extends Controller
{
	public function __construct()
    {
        $this->user = new User;
        $this->category = new Category;
        $this->subcategory = new SubCategory;
    }

    //getallcategory
    public function getallcategory(Request $request){
    	$response = (Object)[];
    	$result = Category::orderBy('updated_at', 'DESC')->get();
    	$response->status = "success";
    	$response->data = $result;
        return response()->json($response);
    }

    public function getallsubcategory(Request $request){
    	$response = (Object)[];
    	$result = SubCategory::orderBy('updated_at', 'DESC')->get();
    	$response->status = "success";
    	$response->data = $result;
        return response()->json($response);
    }

	public function addcategory(Request $request)
    {
        $response = (Object)[];
        $categorydetail =  $request->all();

        $AU=new Category;        
        try
        {
                $flag = 0;
                 if(array_key_exists('id', $categorydetail))
                {
                    if($categorydetail['id'] != null)
                    {
                            //update
                        $oldcategory = Category::where('id',$categorydetail['id'])->first();

                        if(strtoupper($oldcategory->name) == strtoupper($categorydetail['name']))
                        {
                            
                            $flag = 1;
                        }
                        else
                        {
                            $newper = Category::where('name',$categorydetail['name'])->first();

                            if($newper == null)
                            {
                                $oldcategory->name = $categorydetail['name'];
                                $oldcategory->save();

                                $flag = 1;
                                 
                            }
                            else
                            {

                                $flag = 2;
                                $response->status = 'Failure';
                                $response->message = "Category Already Exists"; 
                            }
                        }


                        /*//they changed only status
                        if($flag == 1)
                        {
                            if($categorydetail['status'] == "2")
                            {
                                //role deactivated delete
                                CategorySubCategoryTransaction::where('category_id',$categorydetail['id'])->update(array('status' => '2'));
                                 $oldcategory->status = $categorydetail['status'];
                                  $oldcategory->save();
                                   
                            }
                            else
                            {
                                CategorySubCategoryTransaction::where('category_id',$categorydetail['id'])->update(array('status' => '1'));
                                  $oldcategory->status = $categorydetail['status'];
                                   $oldcategory->save();
                            }


                            $response->status = 'Success';
                            $response->reason = "Category Updated Succesfully"; 
                        }
                        else
                        {

                        }*/
                        
                    }
                }
                else
                {
                   $result = Category::where('name',$categorydetail['name'])->first();
                   if($result == null)
                    {
                        $category = $this->category->UpdateCategory($request);
                        $response->status = 'Success';
                        $response->message = "Category Added Succesfully";  
                    }
                    else
                    {
                        $flag = 0;
                        if($result->icon_url != null)
                        {
                            $flag = 1;
                        }
                        if($result->image_url != null)
                        {
                            $flag = 1;
                        }

                        if($flag == 0)
                        {
                            $response->status = 'Failure';
                            $response->message = "Category Already Exists";  
                        }
                        else
                        {
                            $response->status = 'Success';
                            $response->message = "Category Added Succesfully";  
                        }
                       
                    }
                }
          
        }
        catch(Exception $e)
        {
            $response->status = 'Failure';
            $response->message = "Something Went Wrong,Please try Again";  
        }
        return response()->json($response);
    }

     public function addsubcategory(Request $request)
    {
        $response = (Object)[];
        $subcategorydetail =  $request->all();
             
        try
        {
                $flag = 0;
                 if(array_key_exists('id', $subcategorydetail))
                {
                    if($subcategorydetail['id'] != null)
                    {
                            //update
                        $oldcategory = SubCategory::where('id',$subcategorydetail['id'])->first();

                        if(strtoupper($oldcategory->name) == strtoupper($subcategorydetail['name']))
                        {
                            $flag = 1;
                            
                        }
                        else
                        {
                            $newper = SubCategory::where('name',$subcategorydetail['name'])->first();

                            if($newper == null)
                            {
                                $oldcategory->name = $subcategorydetail['name'];
                                $oldcategory->save();
                                $flag = 1;
                               
                            }
                            else
                            {
                                $flag = 2;
                                $response->status = 'Failure';
                                $response->message = "Sub Category Already Exists"; 
                            }
                        }


                         //they changed only status
                        /*if($flag == 1)
                        {
                            if($subcategorydetail['status'] == "2")
                            {
                                //role deactivated delete
                                CategorySubCategoryTransaction::where('sub_category_id',$subcategorydetail['id'])->update(array('status' => '2'));
                                 $oldcategory->status = $subcategorydetail['status'];
                                  $oldcategory->save();
                                   
                            }
                            else
                            {
                                CategorySubCategoryTransaction::where('sub_category_id',$subcategorydetail['id'])->update(array('status' => '1'));
                                  $oldcategory->status = $subcategorydetail['status'];
                                   $oldcategory->save();
                            }


                            $response->status = 'Success';
                            $response->reason = "Sub CategoryCateogry Updated Succesfully"; 
                        }
                        else
                        {

                        }*/
                    }
                }
                else
                {
                   $result = SubCategory::where('name',$subcategorydetail['name'])->first();
                   if($result == null)
                    {
                    	$subcategory = $this->subcategory->createSubCategory($request);
                        $response->status = 'Success';
                        $response->message = "Sub Category Added Succesfully";  
                    }
                    else
                    {
                        $response->status = 'Failure';
                        $response->message = "Sub Category Already Exists";  
                    }
                }
          
        }
        catch(Exception $e)
        {
            $response->status = 'Failure';
            $response->message = "Something Went Wrong,Please try Again";  
        }
        return response()->json($response);
    }

        //save category pic annd icon
    public function categorypic(Request $request)
    {
        $response = (Object)[];
        $categoryname = $request->all();
        $category = null;
        
        
        if(array_key_exists('id', $categoryname))
        {
                if($categoryname['id'] == '0' || $categoryname['id'] == 0)
                {

                    if($categoryname['name'] != null)
                    {
                        $category = Category::where('name',$categoryname['name'])->first();

                        if($category == null)
                        {
                            $category = new Category;
                            $category->name             = $categoryname['name'];
                            if(array_key_exists('description', $categoryname))
                                $category->description = $categoryname['description'];
                            $category->created_by           = 1;//Auth::id();
                            $category->status               = "1";
                            $category->count = 0;   
                           
                            $category->save();
                        }
                    }
                    
                }
                else
                {
                   
                    $category = Category::where('id',$categoryname['id'])->first();
                }
                
        }
      
        if($request->hasFile('file')){
            $files = $request->file('file');
            
            $path = $request->file('file')->getRealPath();
            
            
            $file_path = '/assets/category/'.$category->id;
            $extension =  $files->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension;
            $destinationPath = public_path().$file_path;
            if($categoryname['id'] == 0){
              File::makeDirectory($destinationPath);
            } 
            
            $image = Image::make($files);
            //return $image;
           /* $width = $image->width();
            $height = $image->height();
             // renaming image
            if(! $files->move($destinationPath, $fileName)) {
                $response->status = Config::get('constants.failure');   
            }*/
            $path = $category->id.'/'.$fileName;
            $response->status = Config::get('constants.success');


            if($categoryname['type'] == 'image')
            {
                  $image->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fileName);
                    $category->image_url = $path;
            } 
            if($categoryname['type'] == 'icon')
            {   
                $image->resize(20, 20)->save($destinationPath.'/'.$fileName);
                $category->icon_url = $path;
            } 
             
            $category->save();
            $response->url = $path;

           return response()->json($response);
        }
        else
        {
            return "filenot found";
        }
    }

}