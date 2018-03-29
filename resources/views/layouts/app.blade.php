<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="loading loading-primary" ng-app="app" ng-strict-di>
<head>
    <script type="text/javascript">
       var baseurl = "{{ URL::to('/') }}";
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}"> 
    

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <link rel="icon" type="image/ico" href="{{ asset('images/dukan_logo.png') }}"/> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/google-font.css') }}">
     
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icon-font.min.css') }}">
    
    
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/angular/angular-csp.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/angular-bootstrap/ui-bootstrap-csp.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/angular-ui-grid/ui-grid.min.css') }}" />

    
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/angular-notify/dist/angular-notify.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/ng-grid/ng-grid.css') }}">
    
    @yield('head')
</head>
<body id="dashboards-analytics" data-layout="top-navigation-2" data-sidebar="primary" data-navbar="primary" data-controller="dashboards" data-view="analytics" >
    
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular/angular.min.js') }}" /></script>
    <script src="{{ asset('bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js') }}" /></script>
    <script src="{{ asset('bower_components/angular-ui-grid/ui-grid.min.js') }}" /></script>
    <script src="{{ asset('bower_components/angular-notify/dist/angular-notify.min.js') }}" /></script>
    <script src="{{ asset('bower_components/ng-grid/build/ng-grid.js') }}"></script>
    <script src="{{ asset('js/ui-load.js') }}"></script>
    <script src="{{ asset('js/ui-jq.js') }}"></script>
    <script src="{{ asset('js/angular/app.js') }}"></script>
    <script src="{{ asset('js/angular/admin/login.js') }}"></script>
     @yield('content')
   
    
    

    @yield('js')
  
</body>
</html>
