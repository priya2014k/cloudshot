'use strict';

app.controller('loginController', ['$scope','$http','notify',
  	function($scope,$http,notify) {


//forgot password
$scope.buttonname = "Forgot Password";
	$scope.userlogin = function()
{
   
    if($scope.username == undefined || $scope.username == null || $scope.username == '')
    {
        notify({
                message: "Enter Valid Email Id",
                classes:'alert-danger',
                duration: 5000
              });
        return;
    }
    if($scope.password == undefined || $scope.password == null || $scope.password == '')
    {
        notify({
                message: "Enter Password",
                classes:'alert-danger',
                duration: 5000
              });
        return;
    }

    var url = 'api/userlogin?password='+$scope.password+'&email='+$scope.username;

     $http({ 
          method: 'POST', 
          url: url,
          //headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
         }).then(function (success){
      console.log(success)
       if(success.data.response == 'success')
       {
           console.log("hi");  
           window.location.href = 'dashboard';
            /*  if(success.data.usercode == 1){
                window.location.href = 'dashboard';
              }else{
                window.location.href = 'useraccount';
              }
       }
       else
       {
          notify({
                message: success.data.reason,
                classes:'alert-danger',
                duration: 5000
              });*/
       }
      },function (error){

      });
}
}]);