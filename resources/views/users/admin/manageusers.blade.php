@extends('layouts.app')
@section('head')

	
   


@endsection
@section('content')
<div class="page-container" ng-controller="UserController" ng-init="getroles();getallusers();">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
		 <div id="loadercontainer" style="display:none" ><div class="loader pull-right"></div></div>
          
				   <div class="clearfix"> </div>
<!--heder end here-->
	<div class="validation-form" ng-if="!newusershow">
    <h4>User Management</h4>
        <button type="button" ng-click="addUser()" class="btn btn-primary searchbutton pull-right">Add User</button>
        <div class="grid"  ui.grid.autoScroll ui-grid-resize-columns ui-grid-auto-resize ui-grid-selection ui-grid-pagination ui-grid="gridOptionsActive" style="min-height:540px;border:none;padding-top: 10px;">
            <div class="watermark" ng-show="!myData.length">No data available</div>
        </div>
    </div>
	<div class="validation-form" ng-if="newusershow">
 	<!---->
  	    
        <form>
         	<div class="vali-form">
         	<div class="col-md-12 form-group2 group-mail" ng-if="!edittrue">
              <label class="control-label">Select</label>
            <select ng-model="newuser.role" >
            	<option value="">Select User Role</option>
            	<option ng-repeat="role in roleslist" value="{$role.id$}">{$role.role_name$}</option>
            	
            </select>
            </div>
            <div class="col-md-6 form-group1">
              <label class="control-label">Firstname</label>
              <input type="text" ng-model="newuser.name" placeholder="Name" >
            </div>
            
            <div class="clearfix"> </div>
            </div>
            
            <div class="col-md-6 form-group1 group-mail" ng-if="!edittrue">
              <label class="control-label">Email</label>
              <input type="email" placeholder="Email" ng-model="newuser.email" >
            </div>
            <div class="col-md-6 form-group1 group-mail" ng-if="edittrue">
              <label class="control-label">Email</label>
              <input type="email" placeholder="Email" ng-model="newuser.email" disabled>
            </div>
            <div class="col-md-6 form-group1 group-mail" ng-if="!edittrue">
              <label class="control-label">Password</label>
              <input type="text" placeholder="Password" ng-model="newuser.password" >
            </div>
             <div class="clearfix"> </div>
             <div class="col-md-6 form-group1 group-mail">
              <label class="control-label">Phone Number</label>
              <input type="number" placeholder="Phone Number"  ng-model="newuser.mobile_no" >
            </div>
            <div class="col-md-6 form-group1 group-mail">
              <label class="control-label">Pincode</label>
              <input type="number" placeholder="Pincode"  ng-model="newuser.pincode" >
            </div>
             <div class="col-md-6 form-group1 group-mail" ng-if="newuser.role == 3">
              <label class="control-label">Pub Name</label>
            	<input type="text" placeholder="Pub Name"  ng-model="newuser.pub_name">
            </div>
            
            <div class="col-md-6 form-group2 group-mail" ng-if="edittrue">
              <label class="control-label">Status</label>
            	<!-- <select ng-model="newuser.role">
            	<option ng-repeat="role in roleslist" value="{$role.name$}">{$role.name$}</option>
            	
            </select> -->
            <select ng-model="newuser.status">
            	<option value="1">Active</option>
            	<option value="3">Deactivate</option>
            </select>
            </div>
             <div class="clearfix"> </div>
           <div class="col-md-12 form-group pad-all1" ng-if="!edittrue">
              <button type="submit" ng-click="adduser()" class="btn btn-primary">Submit</button>
              <button type="reset" ng-click="showlistscrren()" class="btn btn-default">Cancel</button>
            </div>
            <div class="col-md-12 form-group" ng-if="edittrue">
              <button type="submit" ng-click="adduser()" class="btn btn-primary">Update</button>
              <button type="reset" ng-click="showlistscrren()" class="btn btn-default">Cancel</button>
            </div>
          <div class="clearfix"> </div>
        </form>
    
 	<!---->
 </div>
<!-- script-for sticky-nav -->
		
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->


</div>
	<!--//content-inner-->
		<!--/sidebar-menu-->
				@include('users.admin.sidebar')
							</div>

	@endsection
	@section('js')  
							
   <script src="{{ asset('js/angular/admin/user.js') }}"></script>
    



@endsection
