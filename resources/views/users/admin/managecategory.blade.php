@extends('layouts.app')
@section('head')
@endsection
@section('content')
<div class="page-container" ng-controller="CategoryController"  ng-init="getallcategory();getallsubcategory();" ng-cloak>
   <!--/content-inner-->
	<div class="left-content">
	    <div class="mother-grid-inner">
		 	<div id="loadercontainer" style="display:none" ><div class="loader pull-right"></div></div>
	        <div class="clearfix"> </div>
	        	<div class="col-md-12 inbox-mail "  >
					<div class="validation-form" ng-if="!newpershow || !newusershow">

        <form >
         	<div class="vali-form" >
         	
            <div class="col-md-2 form-group1 group-mail" ng-if="!newusershow">
            <!-- <label class="label-color">Name</label>  -->
              <input type="text" placeholder="Search By Name" ng-model="search.name" ng-blur="getcategorybysearch()" >
            </div>

            <div class="col-md-2 form-group2 group-mail" ng-if="!newusershow">
              <!-- <label class="label-color">Status</label> --> 
            <select ng-model="search.status" ng-change="getcategorybysearch()">
              <option value="">Status</option>
            	<option value="1">Active</option>
            	<option value="2">Deactivated</option>
            	
            	
            </select>
            </div>
           
             <div class="col-md-2 form-group margin-top" ng-if="!newusershow">

             	<button type="button" ng-click="getcategorybysearch()" class="btn btn-default searchbutton">Go</button>
				<!-- <button type="reset" ng-click="resetcategory()" class="btn btn-default searchbutton">Reset</button> -->
             	<span  ng-click="resetcategory()" data-toggle="tooltip" data-placement="right" title="refresh" id="refresh" style="cursor: pointer;padding-left: 8px;"><i class="fa fa-refresh" aria-hidden="true" style="padding-top: 45px;"></i></span>
                            
            </div>
             
           
        
 
         	
            <div class="col-md-2 form-group1 group-mail" ng-if="!newpershow">
           <!--  <label class="label-color">Name</label>  -->
              <input type="text" placeholder="Search By Name" ng-model="search1.name" ng-blur="getsubcategorybysearch()" >
            </div>

            <div class="col-md-2 form-group2 group-mail" ng-if="!newpershow">
             <!-- <label class="label-color">Status</label>  -->
            <select ng-model="search1.status" ng-change="getsubcategorybysearch()">
              <option value="">Status</option>
            	<option value="1">Active</option>
            	<option value="2">Deactivated</option>
            	
            	
            </select>
            </div>
           
             <div class="col-md-2 form-group margin-top" ng-if="!newpershow">

             	<button type="button" ng-click="getsubcategorybysearch()" class="btn btn-default searchbutton">Go</button>
				<!-- <button type="reset" ng-click="resetsubcategory()" class="btn btn-default searchbutton">Reset</button> -->
             	<span  ng-click="resetsubcategory()" data-toggle="tooltip" data-placement="right" title="refresh" id="refresh" style="cursor: pointer;padding-left: 8px;"><i class="fa fa-refresh" aria-hidden="true" style="padding-top: 45px;"></i></span>
                            
            </div>
             
            <div class="clearfix"> </div>
            </div>
        </form>
    <!----> 
 </div>
	<div class="col-md-6 w3l-table-info" ng-if="!newusershow">
                    <table id="table">
						<thead>
						    <tr>
    							<th>Category Name</th>
    							<th>Status</th>
    							<th>Actions </th>
    							<th><a  ng-click="addnewcategory()" href="javascript:void(0)"><i class="fa fa-plus i-black" aria-hidden="true"></a></th>
    						</tr>
						</thead>
						<tbody>
						  <tr ng-repeat="category in categorylist track by $index">
							<td>{$category.name$}</td>
							<td ng-if="category.status=='1'">Active</td>
							<td ng-if="category.status=='3'">Deactivated</td>
							<td><i class="fa fa-pencil" ng-click="editcategory(category)" aria-hidden="true"></i></td>

							
							<td></td>

						  </tr>
						  
						</tbody>
					</table>

					<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 pagin vali-form">
						<div class="short_pul pull-right" ng-cloak ng-show="total=='true'">
						{$begin$} - {$end$} of {$totallength$} <a href="javascript:void(0)"><i class="fa fa-fast-backward i-arrow" ng-click="previouspage()" ng-show="previousdisable=='true'"></i></a>  <a href="javascript:void(0)"><i class="fa fa-fast-forward i-arrow" ng-click="nextpage()" ng-show="nextdisable=='true'"></i></a>
						</div>
					</div>
				</div>

	<div class="col-md-6 validation-form mar-top1" ng-if="newusershow">
 	<!---->
  	    
        <form>
         	
            <div class="col-md-6 form-group1" ng-if="edittrue">
              <label class="control-label">Name</label>
              <input type="text" ng-model="newcategory.name" placeholder="Category Name" >
            </div>

             <div class="col-md-12 form-group1" ng-if="!edittrue">
              <label class="control-label">Name</label>
              <input type="text" ng-model="newcategory.name" placeholder="Category Name" >
            </div>

            <div class="col-md-12 form-group1 " ng-if="!edittrue">
              <label class="control-label">Description</label>
              <textarea  ng-model="newcategory.description" placeholder="Description (Optional)" ></textarea>
            </div>

            <div class="col-md-12">
              	<div class="col-md-6">
              		<label class="control-label">Icon</label>
		              <img  src="{{ asset('assets/category/{$newcategory.iconurl$}') }}" alt = "">
		            </div>
		            <div class="col-md-6">
              		<label class="control-label">Image</label>
		              <img width = "100%" height="100%" src="{{ asset('assets/category/{$newcategory.imageurl$}') }}" alt = "">
		            </div>
            </div>
            <div class="col-md-12">
            <div class="col-md-6 form-group1">
              <label class="control-label">Icon</label>
              <input type="file" size="60" class="upload_text hide_file" placeholder="Avatar" accept="image/*" name="newcategory_icon" ngf-select="selectAvatar(newcategory_icon,'icon')" ngf-max-files="3" ng-model="newcategory_icon"/>
            </div>

            <div class="col-md-6 form-group1">
              <label class="control-label">Image</label>
              <input type="file" size="60" class="upload_text hide_file" placeholder="Avatar" accept="image/*" name="newcategory_image" ngf-select="selectAvatar(newcategory_image,'image')" ngf-max-files="3" ng-model="newcategory_image"/>
            </div>
        </div>
           	
            <div class="col-md-6 form-group2 group-mail" ng-if="edittrue">
              <label class="control-label">Status</label>
            	<select ng-model="newcategory.status">
	            	<option value="1">Active</option>
	            	<option value="2">Deactivate</option>
	            </select>
            </div>
             <div class="clearfix"> </div>
           <div class="col-md-12 form-group pad-top1" ng-if="!edittrue">
              <button type="submit" ng-click="updatecategory()" class="btn btn-primary">Submit</button>
              <button type="reset" ng-click="showlistscrren()" class="btn btn-default">Cancel</button>
            </div>
            <div class="col-md-12 form-group pad-all1" ng-if="edittrue">
              <button type="submit" ng-click="updatecategory()" class="btn btn-primary">Update</button>
              <button type="reset" ng-click="showlistscrren()" class="btn btn-default">Cancel</button>
            </div>
          <div class="clearfix"> </div>
        </form>
    
 	<!---->
 </div>


	
	<div class="col-md-6 w3l-table-info" ng-if="!newpershow">
					 
					    <table id="table">
						<thead>
						  <tr>
							<th>Sub Category Name</th>
							<th>Status</th>
							<th>Actions </th>
							<th><i class="fa fa-plus i-black" aria-hidden="true" ng-click="addnewsubcategory()"></th>
						  </tr>
						</thead>
						<tbody>
						<tr ng-repeat="subcategory in subcategorylist track by $index">
						<td>{$subcategory.name$}</td>
						<td ng-if="subcategory.status=='1'">Active</td>
						<td ng-if="subcategory.status=='3'">Deactivated</td>
				
						<td><i class="fa fa-pencil" ng-click="editsubcategory(subcategory)" aria-hidden="true"></i></td>
						</tr>
						  
						</tbody>
					  </table>

					  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 pagin vali-form">
							<div class="short_pul pull-right" ng-cloak ng-show="total1=='true'">
							{$begin1$} - {$end1$} of {$totallength1$} <a href="javascript:void(0)"><i class="fa fa-fast-backward i-arrow" ng-click="previouspage1()" ng-show="previousdisable1=='true'"></i></a>  <a href="javascript:void(0)"><i class="fa fa-fast-forward i-arrow" ng-click="nextpage1()" ng-show="nextdisable1=='true'"></i></a>
							</div>
					</div>
					</div>

	<div class="col-md-6 validation-form" ng-if="newpershow">
 	<!---->
  	    
        <form>
         	
            <div class="col-md-6 form-group1" ng-if="editpertrue">
              <label class="control-label">Name</label>
              <input type="text" ng-model="newsubcategory.name" placeholder="Sub Category Name" >
            </div>

            <div class="col-md-12 form-group1" ng-if="!editpertrue">
              <label class="control-label">Name</label>
              <input type="text" ng-model="newsubcategory.name" placeholder="Sub Category Name" >
            </div>
           	 <div class="col-md-12 form-group1 " ng-if="!editpertrue">
              <label class="control-label">Description</label>
              <textarea  ng-model="newsubcategory.description" placeholder="Description (Optional)" ></textarea>
            </div>
            <div class="col-md-6 form-group2 group-mail" ng-if="editpertrue">
              <label class="control-label">Status</label>
            	<select ng-model="newsubcategory.status">
	            	<option value="1">Active</option>
	            	<option value="2">Deactivate</option>
	            </select>
            </div>
             <div class="clearfix"> </div>
           <div class="col-md-12 form-group pad-top1" ng-if="!editpertrue">
              <button type="submit" ng-click="updatesubcategory()" class="btn btn-primary">Submit</button>
              <button type="reset" ng-click="showlistperscrren()" class="btn btn-default">Cancel</button>
            </div>
            <div class="col-md-12 form-group pad-top1" ng-if="editpertrue">
              <button type="submit" ng-click="updatesubcategory()" class="btn btn-primary">Update</button>
              <button type="reset" ng-click="showlistperscrren()" class="btn btn-default">Cancel</button>
            </div>
          <div class="clearfix"> </div>
        </form>
    
 	<!---->
 </div>

	
</div>





	


		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>

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
