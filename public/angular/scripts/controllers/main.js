'use strict';
angular.module('App').controller('MainCtrl', function ($scope, $auth) {
	$scope.refreshbodyheight = function(){
		var body = document.body,
		    html = document.documentElement;
		body.style.height = 100 + "%";
		setTimeout(function(){
			var height = Math.max( body.scrollHeight, body.offsetHeight, 
		        html.clientHeight, html.scrollHeight, html.offsetHeight );
			body.style.height = height + "px";
		}, 500);
		$scope.loading = false;
	}

	$scope.refreshbodyheight();

	setTimeout(function(){
		$scope.refreshbodyheight();
	}, 600);
	
	setTimeout(function(){
		$scope.refreshbodyheight();
	}, 700);

	setTimeout(function(){
		$scope.refreshbodyheight();
	}, 1500);
});