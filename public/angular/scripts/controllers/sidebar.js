angular.module('App')
	.controller('SidebarCtrl', function ($scope, $auth) {
		$scope.$watch(() => localStorage.satellizer_token, (newVal,oldVal) => {
				if ($auth.isAuthenticated()) 
	            	$scope.autenticado = true;
				else
					$scope.autenticado = false;
			});
		$scope.logout = () => {
			localStorage.removeItem('satellizer_token');
			location.reload();
		}
	});