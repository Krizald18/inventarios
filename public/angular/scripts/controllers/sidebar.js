angular.module('App')
	.controller('SidebarCtrl', function ($scope, $auth) {
		$scope.$watch(
			function () { 
				return localStorage.satellizer_token; 
			}, 
			function(newVal,oldVal) {
				if ($auth.isAuthenticated()) 
	            	$scope.autenticado = true;
				else
					$scope.autenticado = false;
			});
		$scope.logout = function(){
			localStorage.removeItem('satellizer_token');
			location.reload();
		}
	});