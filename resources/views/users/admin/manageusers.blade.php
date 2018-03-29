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
 	
        <form>
         	<div class="vali-form row">
         	<div class="col-md-3 form-group2 group-mail">
           <!--  <label class="label-color">Search By Role</label> -->
            <select ng-model="search.role" ng-change="getusersbysearch()">
            	<option value="">Search By Role</option>
            	<option ng-repeat="role in roleslist"  value="{$role.id$}">{$role.name$}</option>
            	
            </select>
            </div>
            <div class="col-md-3 form-group1 group-mail">
            <!--   <label class="label-color">Email</label> -->
              <input type="email" placeholder="Search By Email" ng-model="search.email" ng-blur="getusersbysearch()" >
            </div>
            <div class="col-md-3 form-group1 group-mail">
              <!-- <label class="label-color">Phone Number</label>  -->
              <input type="number" placeholder="Search By Phone Number"  ng-model="search.phoneno" ng-blur="getusersbysearch()" >
            </div>
             <div class="col-md-3 form-group margin-top">

             <button type="button" ng-click="getusersbysearch()" class="btn btn-default searchbutton">Go</button>

             <!-- <button type="reset" ng-click="reset()" class="btn btn-default searchbutton">Reset</button> -->
             <span  ng-click="reset()" data-toggle="tooltip" data-placement="right" title="refresh" id="refresh" style="cursor: pointer;padding: 12px;"><i class="fa fa-refresh" aria-hidden="true" style="padding-top: 45px;"></i></span>
                            
             <button type="button" ng-click="addUser()" class="btn btn-primary searchbutton">Add User</button>
            </div>
             
            <div class="clearfix"> </div>
            </div>
        </form>
    <!----> 
    <div class="grid"  ui.grid.autoScroll ui-grid-resize-columns ui-grid-auto-resize ui-grid-selection ui-grid-pagination ui-grid="gridOptionsActive" style="min-height:540px;border:none;padding-top: 10px;">
        <div class="watermark" ng-show="!myData.length">No data available</div>
    </div>
 
<div class="inbox-mail">
	
	<div ng-if="!newusershow">
	<div class="w3l-table-info">
					 
					    <table id="table">
						<thead>
						  <tr>
							<th>Name</th>
							<th>Role</th>
							<th>Email</th>
							<th>Phone No</th>
							<th>Branch</th>
							<th>Actions</th>
						  </tr>
						</thead>
						<tbody>
						  <tr ng-repeat="user in userlist track by $index">
							<td>{$user.name$} {$user.last_name$} </td>
							<td>{$user.rolename$}</td>
							<td>{$user.email$}</td>
							<td>{$user.mobile_no$}</td>
							<td><span ng-if="user.role=='3'||user.role=='2'">{$user.branch.branch_name$}</span></td>
							<td><i class="fa fa-pencil" ng-click="edituser(user)" aria-hidden="true"></i></td>
						  </tr>
						  
						</tbody>
					  </table>
					</div>

		<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 pagin vali-form">
			<div class="short_pul pull-right" ng-if="!mailread" ng-cloak ng-show="total=='true'">
			{$begin$} - {$end$} of {$totallength$} <a href="javascript:void(0)"><i class="fa fa-fast-backward i-arrow" ng-click="previouspage()" ng-show="previousdisable=='true'"></i></a>  <a href="javascript:void(0)"><i class="fa fa-fast-forward i-arrow" ng-click="nextpage()" ng-show="nextdisable=='true'"></i></a>
			</div>
	</div>
</div>
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
            
            <div class="col-md-6 form-group1 group-mail">
              <label class="control-label">Email</label>
              <input type="email" placeholder="Email" ng-model="newuser.email" >
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
            	<option value="2">Deactivate</option>
            </select>
            </div>
             <div class="clearfix"> </div>
           <div class="col-md-12 form-group pad-all1" ng-if="!edittrue">
              <button type="submit" ng-click="adduser()" class="btn btn-primary">Submit</button>
              <button type="reset" ng-click="showlistscrren()" class="btn btn-default">Cancel</button>
            </div>
            <div class="col-md-12 form-group" ng-if="edittrue">
              <button type="submit" ng-click="updateuser()" class="btn btn-primary">Update</button>
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
