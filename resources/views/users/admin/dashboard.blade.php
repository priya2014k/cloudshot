@extends('layouts.app')
@section('head')
@endsection
@section('content')
<div class="page-container" ng-cloak>
    <div class="left-content">
	    <div class="mother-grid-inner">
	        <div id="loadercontainer" style="display:none" ><div class="loader pull-right"></div></div>
		    <div class="clearfix"> </div>
                <div class="col-xs-12 col-sm-6 col-lg-4 col-xl-4" style="padding: 80px">
                                            
                        <div class="card-block">
                             <b class="card-title">Completed Orders</b>
                                <p class="card-text">
                                    - {$count.completed$} -
                                </p>
                        </div>
                   
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-4 col-xl-4" style="padding: 80px">
                    <div class="">                          
                        <div class="card-block">
                             <b class="card-title">Pending Orders</b>
                                <p class="card-text">
                                    - {$count.pending$} -
                                </p>
                        </div>
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-6 col-lg-4 col-xl-4" style="padding: 80px">
                    <div class="">                          
                        <div class="card-block">
                             <b class="card-title">Customer Login</b>
                                <p class="card-text">
                                    - {$count.customer$} -
                                </p>
                        </div>
                    </div>
                </div>       
            <div class="inner-block"></div>
        </div>
    </div>
	<!--//content-inner-->
		<!--/sidebar-menu-->
@include('users.admin.sidebar')
							
</div>

	@endsection
	@section('js')  
			
	
    
    
    



@endsection
