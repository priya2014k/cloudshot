@extends('layouts.app')
@section('head')




@endsection
@section('content')
<!-- pages/sign-in -->
 <div id="loadercontainer" style="display:none" ><div class="loader pull-right"></div></div>
    <div class="form-container" ng-controller="loginController">
        <div class="main-wthree">
			<div class="container">
			<div class="sin-w3-agile">
				<h2>CloudShot</h2>
				<form>
					<div class="username">
						<span class="username">Username:</span>
						<input type="text" name="name" class="name" ng-model="username" placeholder="Enter your registered E-mail" >
						<div class="clearfix"></div>
					</div>
					<div class="password-agileits">
						<span class="username">Password:</span>
						<input type="password" name="password" class="password" ng-model="password" placeholder="Enter your password" >
						<div class="clearfix"></div>
					</div>
					<meta name="csrf-token" content="{{ csrf_token() }}">
					<div class="rem-for-agile">
						<a href="#" ng-click="forgotpassword()">{$buttonname$}</a><br>
					</div>
					<div class="login-w3">
							<input type="submit" class="login" ng-click="login();userlogin();" value="Sign In">
					</div>
					<div class="clearfix"></div>
				</form>
						
			</div>
			</div>
			</div>
    </div>



@endsection

