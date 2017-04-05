'use strict';
angular.module('App').controller('MainCtrl', ['$scope', '$auth', function($scope, $auth) {
	$scope.refreshbodyheight = () => {
		var body = document.body,
		    html = document.documentElement;
		body.style.height = 100 + "%";
		setTimeout(() => {
			var height = Math.max( body.scrollHeight, body.offsetHeight, 
		        html.clientHeight, html.scrollHeight, html.offsetHeight );
			body.style.height = height + "px";
		}, 500);
		$scope.loading = false;
	}

	$scope.refreshbodyheight();

	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 600);
	
	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 700);

	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 1500);
}]);