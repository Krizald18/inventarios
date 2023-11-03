angular.module('App')
	.controller('SidebarCtrl', ['$scope', '$auth', function($scope, $auth) {
		if (localStorage.admin_token)
	    	$scope.admin = true;
	    else
	    	$scope.admin = false;
	    if ($auth.isAuthenticated()) 
            	$scope.autenticado = true;
			else
				$scope.autenticado = false;
		$scope.$watch(() => localStorage.admin_token, (newVal,oldVal) => {
			if (newVal)
	    		$scope.admin = true;
	    	else
	    		$scope.admin = false;
		});
		$scope.$watch(() => localStorage.nombre, (newVal,oldVal) => {
			if (newVal)
	    		$scope.nombre = newVal;
	    	else
	    		$scope.nombre = null;
		});
		$scope.$watch(() => localStorage.satellizer_token, (newVal,oldVal) => {
			if ($auth.isAuthenticated()) 
            	$scope.autenticado = true;
			else
				$scope.autenticado = false;
		});
		$scope.logout = () => {
			localStorage.clear();
			sessionStorage.clear();
			location.reload();
		}
	}]);