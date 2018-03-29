'use strict';


var app = angular.module('app',['cgNotify','ngGrid','ui.grid','ui.load',
    'ui.jq','ui.grid.autoResize', 'ui.grid.selection', 
    'ui.grid.pagination','ui.grid.resizeColumns']);

app.config(['$interpolateProvider',function($interpolateProvider){
    $interpolateProvider.startSymbol('{$').endSymbol('$}');
    
}]);


// Declare app level module which depends on views, and components
app.controller('AppCtrl', ['$scope','$document','$rootScope',
    function($scope,$document,$rootScope) {

        
    }
]);