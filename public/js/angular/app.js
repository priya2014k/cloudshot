'use strict';


var app = angular.module('app',['cgNotify',]);

app.config(['$interpolateProvider',function($interpolateProvider){
    $interpolateProvider.startSymbol('{$').endSymbol('$}');
    
}]);


// Declare app level module which depends on views, and components
app.controller('AppCtrl', ['$scope','$document','$rootScope',
    function($scope,$document,$rootScope) {

        
    }
]);