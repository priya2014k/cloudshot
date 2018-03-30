@extends('layouts.app')
@section('head')

	
   


@endsection
@section('content')
<div class="page-container" ng-controller="CategoryController" ng-init="getcategory();getsubcategory()">
   <!--/content-inner-->

<div class="left-content">
	   <div class="mother-grid-inner">
	   <div id="loadercontainer" style="display:none" ><div class="loader pull-right"></div></div>
		   
             
				   <div class="clearfix"> </div>
<!--heder end here-->

<div class="inbox-mail">
	
	
	<div class="validation-form" >
 	<!---->
  	    
        <form>
         	<div class="vali-form">
         	<div class="col-md-12 form-group2 group-mail">
            <div class="col-md-4">
            <label class="control-label">Select Category</label>
              <select ng-model="categorys.category_id" ng-change="getsubcategorybyid()">
  			         <option value="" disabled selected>Tap to select your option</option>
              	<option ng-repeat="category in category_list" value="{$category.id$}">{$category.name$}</option>
              </select> 
            </div>
          </div>
          <div class="col-md-12 form-group2 group-mail">
            <div class="col-md-10">
              <div class="checkbox ">
                <label style="padding: 1em 0 1em 2.5em;" class="col-md-3 compose checkbox_list" ng-repeat="position in subcategory_list" ng-init="categorys.subcategories[$index]=0;">
                  <input type="checkbox" class="styled" name="permission" id="currentposition check7"  ng-model="position.checked">{$ position.name $}
                  <span class="checkbox-decorator"><span class="check"></span></span>
                </label>
              </div>
            </div>
          </div>
           <!--  <input type="checkbox" ng-model="rolepermission.roles[permission.id]" ng-repeat="permission in permissionlist track by $index"> -->
            <div class="col-md-12 form-group pad-top1">
              <button type="submit" ng-click="categorySubcategory()" class="btn btn-primary">Update</button>
              
            </div>
          <div class="clearfix"> </div>
        </form>
    
 	<!---->
 	</div>

<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<!-- <div class="copyrights">
	 <p>© 2016 Pooled . All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
</div> -->	
<!--COPY rights end here-->
</div>
</div>
	<!--//content-inner-->
		<!--/sidebar-menu-->
			@include('users.admin.sidebar')
							
							</div>

	@endsection
	@section('js')  
							
       <script src="{{ asset('js/angular/admin/category.js') }}"></script>



@endsection
