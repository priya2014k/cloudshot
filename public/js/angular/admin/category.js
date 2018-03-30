'use strict';

app.controller('CategoryController', ['$scope','$http','notify','uiGridConstants','Upload',
  	function($scope,$http,notify,uiGridConstants,Upload) {

  	$scope.getallcategory = function()
	{
		$scope.newusershow = false;
	    
	    $http({ 
	          method: 'POST', 
	          url: 'api/getallcategory',
	         // data :$scope.search,
	         // headers : { 'Authorization' : 'Bearer '+window.localStorage['token'] }
	         }).then(function(data, status, headers, config){
	            console.log(data);
	            if(data.data.status == 'success')
	            {
	                $scope.categorylist = data.data.data;
	                console.log($scope.categorylist);
	                //$scope.paginationpagescalculationfirst($scope.categorylist,'category');
	                
	                
	            }
	        },function(error){

	    });
	}

	$scope.getallsubcategory = function()
	{
		$scope.newusershow = false;
		$http({ 
	          method: 'POST', 
	          url: 'api/getallsubcategory',
	          //data :$scope.search1,
	          //headers : { 'Authorization' : 'Bearer '+window.localStorage['token'] }
	         }).then(function(data, status, headers, config){
	            console.log(data);
	            if(data.data.status == 'success')
	            {
	                $scope.subcategorylist = data.data.data;
	                //$scope.paginationpagescalculationsecond($scope.subcategorylist,'subcategory')
	                
	            }
	           
	    },function(error){

	    });
	}

	$scope.getcategory = function()
	{
		$scope.newusershow = false;
	    $http({ 
	          method: 'get', 
	          url: 'api/getcategory',
	         }).then(function(data, status, headers, config){
	            console.log(data);
	            if(data.data.status == 'success')
	            {
	                $scope.category_list = data.data;
	            }
	           
	    },function(error){

	    });	}

	$scope.getsubcategory = function()
	{
		$scope.newpershow = false;
		$http({ 
	          method: 'get', 
	          url: 'api/getsubcategory',
	         }).then(function(data, status, headers, config){
	            console.log(data);
	            if(data.status == 'success')
	            {
	                $scope.subcategory_list = data.data.data;
	            }
	    },function(error){

	    });
	}


  	$scope.addnewcategory = function()
	{
	    $scope.newusershow = true;
	    $scope.edittrue = false;
	    $scope.newcategory = {}
	}

	$scope.addnewsubcategory = function()
	{
	    $scope.newpershow = true;
	    $scope.editpertrue = false;
	    $scope.newsubcategory = {};
	}

	$scope.editcategory = function(category)
	{
	    $scope.newusershow = true;
	    $scope.edittrue = true;
	    $scope.newcategory = {}
	    
	    $scope.newcategory.id = category.id
	    $scope.newcategory.name = category.name;
	 
	    $scope.newcategory.status = category.status.toString();
	    $scope.newcategory.iconurl = category.icon_url;
	    $scope.newcategory.imageurl = category.image_url;
	}

	$scope.editsubcategory = function(subcategory)
	{
	    $scope.newpershow = true;
	    $scope.editpertrue = true;
	    $scope.newsubcategory = {};
	    $scope.newsubcategory.id = subcategory.id;
	    $scope.newsubcategory.name = subcategory.name;
	    $scope.newsubcategory.status = subcategory.status.toString();
	}

	$scope.showlistscrren = function()
	{
	  $scope.newusershow = false;
	}

	$scope.showlistperscrren = function()
	{
	   $scope.newpershow = false;
	   $scope.editpertrue = false;
	} 

	$scope.updatecategory = function()
	{

	  
	      if($scope.newcategory.name == undefined || $scope.newcategory.name == null || $scope.newcategory.name  == '')
	    {
	        $scope.notifymessage("Enter Name",'failure');
	        return;
	    }
	   
	    else
	    {
	        if($scope.newcategory.name.length > 30)
	        {
	             $scope.notifymessage(" Name Should Not Be Greater Than 30",'failure');
	              return;
	        }
	    }

	    if($scope.newcategory.description != undefined && $scope.newcategory.description != null && $scope.newcategory.description  != '')
	    {
	      if($scope.newcategory.description.length > 500)
	      {
	          $scope.notifymessage(" Description Should Not Be Greater Than 500",'failure');
	                return;
	      }
	    }
	   
	   $http({ 
	          method: 'POST', 
	          url: 'api/addcategory',
	          data:$scope.newcategory,
	          }).then(function(data, status, headers, config){
	          	console.log(data);
	            if(data.data.status == 'success')
	            {

	                $scope.newcategory = {};
	                $scope.notifymessage(data.data.message,'success')
	                $scope.getallcategory();
	            }
	            else
	            {
	                $scope.notifymessage(data.data.message,'failure')
	            } 
	    
	    },function(error){

	    });
	}


	$scope.updatesubcategory = function()
	{
	    if($scope.newsubcategory.name == undefined || $scope.newsubcategory.name == null || $scope.newsubcategory.name  == '')
	    {
	        $scope.notifymessage("Enter Name",'failure');
	        return;
	    }
	   
	    else
	    {
	        if($scope.newsubcategory.name.length > 20)
	        {
	             $scope.notifymessage(" Name Should Not Be Greater Than 20",'failure');
	              return;
	        }
	    }
	    if($scope.newsubcategory.description != undefined && $scope.newsubcategory.description != null && $scope.newsubcategory.description  != '')
	    {
	      if($scope.newsubcategory.description.length > 500)
	      {
	          $scope.notifymessage(" Description Should Not Be Greater Than 500",'failure');
	                return;
	      }
	    }
	   	$http({ 
	          method: 'POST', 
	          url: 'api/addsubcategory',
	          data:$scope.newsubcategory,
	          //headers : { 'Authorization' : 'Bearer '+window.localStorage['token'] }
	          }).then(function(data, status, headers, config){
	            if(data.data.status == 'Success')
	            {
	                  $scope.newpershow = false;
	                  $scope.newsubcategory = {};
	                  $scope.notifymessage(data.data.message,'success')
	                  $scope.getallsubcategory();

	            }
	            else
	            {
	                 $scope.notifymessage(data.data.message,'failure')
	            } 
	    
	   	},function(error){

	    });
	}

	$scope.selectAvatar = function(file,type)
	{
		var filetype = file.type;

		var flag = 0;
		if(filetype != null)
		{
		    if(filetype == 'image/jpeg' || filetype == 'image/png' || filetype == 'IMAGE/JPEG' || filetype == 'IMAGE/PNG')
		    {
		        flag = 1;
		    }
		    else
		    {
		        flag = 0;
		    }
		}
		else
		{
		    flag = 0;
		}

		if(flag == 0)
		{
		     $scope.notifymessage("Select Image In Jpeg or Png Format",'failure');
		        return;
		}
		var filesize = Math.round(file.size/1024);


		  if($scope.newcategory.name == undefined || $scope.newcategory.name == null ||$scope.newcategory.name == '' )
		  {
		      $scope.notifymessage("Enter Category Name",'failure');
		      return;
		  }
		  var id;

		  if($scope.newcategory.id  == undefined || $scope.newcategory.id  == null || $scope.newcategory.id == '')
		  {
		      id = 0;
		  }
		  else
		  {
		      id = $scope.newcategory.id;
		  }

		 
		  
		  $scope.file = file;
		  Upload.upload({
		    method: 'POST',    
		    url: 'api/categorypic',
		    data : {
		     file: $scope.file,
		     name : $scope.newcategory.name,
		     id : id,
		     type: type
		     
		    },
		    //headers : { 'Authorization' : 'Bearer '+window.localStorage['token'] }
		   })
		   .then(function(success){
			if(type == 'image')
		      {
		          $scope.newcategory.imageurl = success.data.url;
		      }

		      if(type == 'icon')
		      {
		          $scope.newcategory.iconurl = success.data.url;
		      }
		      
		     
		   },function(error){

		   })
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