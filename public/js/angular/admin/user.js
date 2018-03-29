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
        conole.log($scope.myData);
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
          {
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
          },
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
                       $scope.editCoachee($scope.selectedRows[0].id);                       
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
                      $scope.changeCoacheeStatus($scope.selectedRows,'activate')
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
                       $scope.changeCoacheeStatus($scope.selectedRows,'terminate');                     
                },
              order:214,
          },
          {
            title: 'Remove',
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
                    swal({
                          title: "Are you sure?",
                          text: "You will not be able to recover this coachee!",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Yes, delete it!",
                          closeOnConfirm: false
                        },
                        function(){                          
                          $scope.changeCoacheeStatus($scope.selectedRows,'remove');
                        });
                },
            order:215,
          },
          {
            title: 'Export Excel',
            action: function($event){
                    $scope.selectedRows = $scope.gridApi.selection.getSelectedRows();
                    if($scope.selectedRows.length == 0)
                        {
                          notify({
                            message: 'Please Select Atleast One Row',
                            classes: 'alert-danger',
                            duration: 2000
                          });
                          return;
                        }
                    $scope.exportExcel($scope.selectedRows);
                },
            order:216,
          }
        ],
        primaryKey:'uid',
        fastWatch: true,
        columnDefs: [//{ field: "entity_name",enableFiltering: true,displayName:"Name",cellToolTip:'Some Text',width:200,visible:true,cellToolTip:true},
                    //{ field: "name",enableFiltering: true,displayName:"Name",width:200,cellTemplate:'<div class="ngCellText" ng-class="col.colIndex()">{$ row.entity.first_name+" "+row.entity.last_name$}</div>'},
                    { field: "name",enableFiltering: true,displayName:"First Name",width:200,},
                    { field: "email",enableFiltering: true,displayName:"Email",width:200,},
                    { field: "mobile_no",enableFiltering: true,displayName:"Phone",width:200},
                    { field: "mail_id",enableFiltering: true,displayName:"Email",width:300,cellToolTip:true,visible:false},
                    { field: "status",enableFiltering: true,displayName:"Status",width:200,cellTemplate:'<div class="ngCellText" ng-class="col.colIndex()"><span ng-if="row.entity.status==1">Active</span><span ng-if="row.entity.status==0">Deactive</span></div>'},
                    { field: "gender",enableFiltering: true,displayName:"Gender",width:200,visible:false,cellTemplate:'<div class="ngCellText" ng-class="col.colIndex()"><span ng-if="row.entity.gender==1">Male</span><span ng-if="row.entity.gender==2">Female</span><span ng-if="row.entity.gender==3">Other</span></div>'},
                    { field: "location",enableFiltering: true,displayName:"Location",width:300,cellToolTip:true,visible:false},
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
            if(data.status == 'Success')
            {

            }
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

	$scope.adduser = function()
  	{

	    if($scope.newuser.role == undefined || $scope.newuser.role == null || $scope.newuser.role  == '')
	    {
	        $scope.notifymessage("Select Role",'failure');
	        return;
	    }
	    if($scope.newuser.first_name == undefined || $scope.newuser.first_name == null || $scope.newuser.first_name  == '')
	    {
	        $scope.notifymessage("Enter First Name",'failure');
	        return;
	    }
	    else
	    {
	        if($scope.newuser.first_name.length > 20)
	        {
	             $scope.notifymessage("First Name Should Not Be Greater Than 20",'failure');
	              return;
	        }
	    }
	    if($scope.newuser.last_name == undefined || $scope.newuser.last_name == null || $scope.newuser.last_name  == '')
	    {
	        $scope.notifymessage("Enter Last Name",'failure');
	        return;
	    }
	    else
	    {
	        if($scope.newuser.last_name.length > 20)
	          {
	               $scope.notifymessage("Last Name Should Not Be Greater Than 20",'failure');
	                return;
	          }
	    }
	    if($scope.newuser.email == undefined || $scope.newuser.email == null || $scope.newuser.email  == '')
	    {
	        $scope.notifymessage("Enter Valid Email",'failure');
	        return;
	    }
	    
	    if($scope.newuser.phoneno == undefined || $scope.newuser.phoneno == null || $scope.newuser.phoneno  == '')
	    {
	        $scope.notifymessage("Enter Mobile Number",'failure');
	        return;
	    }
	    else
	    {
	        if($scope.newuser.phoneno.toString().length != 10)
	        {
	           $scope.notifymessage("Mobile Number Should Be 10 Digits",'failure');
	            return;
	        }
	    }
	   

	      $http({ 
	          method: 'POST', 
	          url: 'api/adduser',
	          data:$scope.newuser,
	          }).success(function(data, status, headers, config){
	            console.log(data);
	            $("#loadercontainer").hide();
	            if(data.status == 'Success')
	            {

	                  $scope.newuser = {};
	                  $scope.notifymessage(data.reason,'success')
	                  $scope.getallusers();
	            }
	            else
	            {
	                 $scope.notifymessage(data.reason,'failure')
	            } 
	    
	    });
	 }

}]);