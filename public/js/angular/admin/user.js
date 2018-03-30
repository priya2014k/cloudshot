'use strict';

app.controller('UserController', ['$scope','$http','notify','uiGridConstants',
  	function($scope,$http,notify,uiGridConstants) {
  	$scope.totalServerItems = 0;
    $scope.pagingOptions = {
        pageSizes: ["10", "50", "100"],
        pageSize: "10",
        currentPage: 1
    };    
    $scope.myData = [];
    $scope.setPagingData = function(page){
        /*var pagedData = data.slice((page - 1) * pageSize, page * pageSize);*/
        $scope.myData = page.data;
        console.log($scope.myData);
        $scope.totalServerItems = page.total;
        if (!$scope.$$phase) {
            $scope.$apply();
        }
    };
    
    $scope.resetGrid = function()
    {
      $scope.gridApi.grid.clearAllFilters();
      $scope.gridApi.core.clearAllFilters();
      $scope.gridApi.selection.clearSelectedRows();
    }

    $scope.gridOptionsActive = {
        data: 'myData',
        enablePaging: true,
        showGridFooter: true,        
        headerRowHeight: 36,
        enableRowSelection: true,
        paginationPageSizes: $scope.pagingOptions,
        paginationPageSize: $scope.pagingOptions.pageSize,        
        enableGridMenu: true,
        multiSelect: true,
        enableHorizontalScrollbar: 1,
        enableVerticalScrollbar: 1,
        enableFiltering: true,
        rowHeight: 40,
        totalServerItems: 'totalServerItems',
        onRegisterApi: function(gridApi)
                      {
                        console.log(gridApi)
                        $scope.gridApi = gridApi;
                        $scope.gridApi.core.on.sortChanged( $scope, function( grid, sort ) {
                          $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
                        });
                      },
        gridMenuCustomItems: [
          /*{
            title: 'View',
            action: function(){                       
                       $scope.selectedRows = $scope.gridApi.selection.getSelectedRows();
                       if($scope.selectedRows.length == 0)
                        {
                          notify({
                            message: 'Please Select Any Row',
                            classes: 'alert-danger',
                            duration: 2000
                          });
                          return;
                        }
                        if($scope.selectedRows.length > 1)
                        {
                          notify({
                            message: 'Please Select One Row',
                            classes: 'alert-danger',
                            duration: 2000
                          });
                          return;
                        }                       
                       $scope.viewCoachee($scope.selectedRows[0].id);                       
                },
              order:211,
          },*/
          {
            title: 'Edit',
            action: function(){                       
                       $scope.selectedRows = $scope.gridApi.selection.getSelectedRows();
                       if($scope.selectedRows.length == 0)
                        {
                          notify({
                            message: 'Please Select Any Row',
                            classes: 'alert-danger',
                            duration: 2000
                          });
                          return;
                        }
                        if($scope.selectedRows.length > 1)
                        {
                          notify({
                            message: 'Please Select One Row',
                            classes: 'alert-danger',
                            duration: 2000
                          });
                          return;
                        }                       
                       $scope.edituser($scope.selectedRows[0]);                       
                },
              order:212,
          },
          {
            title: 'Activate',
            action: function(){
                      $scope.selectedRows = $scope.gridApi.selection.getSelectedRows();
                      if($scope.selectedRows.length == 0)
                        {
                          notify({
                            message: 'Please Select Any Row',
                            classes: 'alert-danger',
                            duration: 2000
                          });
                          return;
                        }
                      $scope.changeuserstatus($scope.selectedRows,'activate')
                },
            order:213,
          },
          
          {
            title: 'Deactivate',
            action: function($event){              
                       $scope.selectedRows = $scope.gridApi.selection.getSelectedRows();
                       if($scope.selectedRows.length == 0)
                        {
                          notify({
                            message: 'Please Select Any Row',
                            classes: 'alert-danger',
                            duration: 2000
                          });
                          return;
                        }
                       $scope.changeuserstatus($scope.selectedRows,'terminate');                     
                },
              order:214,
          }
          
        ],
        primaryKey:'uid',
        fastWatch: true,
        columnDefs: [{ field: "name",enableFiltering: true,displayName:"Name",width:200,},
                    { field: "email",enableFiltering: true,displayName:"Email",width:200,},
                    { field: "mobile_no",enableFiltering: true,displayName:"Phone",width:200},
                    { field: "status",enableFiltering: true,displayName:"Status",width:150,cellTemplate:'<div class="ngCellText" ng-class="col.colIndex()"><span ng-if="row.entity.status==1">Active</span><span ng-if="row.entity.status==3">Deactive</span></div>'},
                    { field: "role",enableFiltering: true,displayName:"Role",width:150,cellTemplate:'<div class="ngCellText" ng-class="col.colIndex()"><span ng-if="row.entity.role==1">Admin</span><span ng-if="row.entity.role==2">Customer</span><span ng-if="row.entity.role==3">Merchant</span></div>'},
                    { field: "pub_name",enableFiltering: true,displayName:"Pub name",width:150,cellToolTip:true,},
                    ]
    };

        
    $scope.gridOptionsInvited = {
        data: 'myData',
        enablePaging: true,
        showFooter: true,
        rowHeight: 36,
        headerRowHeight: 36,
        enableRowSelection: false,
        totalServerItems: 'totalServerItems',
        pagingOptions: $scope.pagingOptions,
        primaryKey:'uid',
       columnDefs: [{ field: "email",displayName:"Email",width:"100%"},
          ]
    };    
    $scope.$watch('pagingOptions', function (newVal, oldVal) {
        if (newVal !== oldVal && (newVal.currentPage !== oldVal.currentPage||newVal.pageSize !== oldVal.pageSize)) {
          $scope.getallusers();
        }
    }, true);

  	$scope.getroles = function(){
  		 $http({ 
          method: 'get', 
          url: 'api/getroles',
         }).then(function(data){
            console.log(data);
            
            $scope.roleslist = data.data.data;
           console.log($scope.roleslist);
        },function (error){

      });
  	}

  	$scope.getallusers = function(){
  		 $http({ 
          method: 'get', 
          url: 'api/getallusers',
         }).then(function(data){
            console.log(data);
            
            	$scope.userlist = data.data.data;
            	$scope.setPagingData(data.data);
            	console.log($scope.userlist);
          
        },function (error){

      });
  	}

  	$scope.addUser = function()
	{
	    $scope.newuser = {};
	    $scope.newusershow = true;
	    $scope.edittrue = false;
	}

	$scope.edituser = function(userdata)
    {
    	$scope.newusershow = true;
    	$scope.edittrue = true;
    	$scope.newuser={};
    	console.log(userdata);
    	$scope.newuser.id = userdata.id;
	    $scope.newuser.email = userdata.email;
	    $scope.newuser.mobile_no = parseInt(userdata.mobile_no);
	    $scope.newuser.role = userdata.role;
	    $scope.newuser.status = userdata.status.toString();
	    $scope.newuser.name = userdata.name;
	    $scope.newuser.pub_name = userdata.pub_name;
	    if(userdata.pincode)
	    $scope.newuser.pincode = userdata.pincode;
    }

	$scope.adduser = function()
  	{
	   
	    console.log($scope.newuser);
	      $http({ 
	          method: 'POST', 
	          url: 'api/adduser',
	          data:$scope.newuser,
	          }).then(function(data){
	            console.log(data);
	            $("#loadercontainer").hide();
	            if(data.data.status == 'success')
	            {
                    $scope.newusershow = false;
	                  $scope.newuser = {};
	                  $scope.notifymessage(data.data.message,'success');

	                  $scope.getallusers();
	            }
	            else
	            {
	                 $scope.notifymessage(data.data.message,'failure')
	            } 
	    
	    },function (error){

      });
	 }

	 $scope.changeuserstatus = function(row,status)
    {      
      $http({
        method: 'POST',
        url: 'api/changeuserstatus',
        data: {
          'user' : row,
          'status' : status,
        }
      }).then(function(success){
        if(success.data.status == 'success')
        {
          
          notify({
            message: success.data.reason,
            classes: 'alert-success',
            duration: 2000
          });
          $scope.getallusers();
        }
      },function(error){

      });
    }

    $scope.showlistscrren = function()
	{
	  $scope.newusershow = false;
	}

	 $scope.notifymessage = function(message,type)
	{
   notify.closeAll();
    if(type == 'success')
    {
        notify({
                  message: message,
                  classes:'alert-success',
                  duration: 5000,
                 
                });
    }
    else if(type == 'failure')
    {
       notify({
                  message: message,
                  classes:'alert-danger',
                  duration: 5000,
                  startTop:200
                });
    }
}

}]);