angular.module('App')
	.controller('SidebarCtrl', ['$scope', '$auth', function ($scope, $auth) {
		if(localStorage.admin_token)
	    	$scope.admin = true;
	    else
	    	$scope.admin = false;
	    if ($auth.isAuthenticated()) 
            	$scope.autenticado = true;
			else
				$scope.autenticado = false;
		$scope.$watch(() => localStorage.admin_token, (newVal,oldVal) => {
			if(localStorage.admin_token)
	    		$scope.admin = true;
	    	else
	    		$scope.admin = false;
		});
		$scope.$watch(() => localStorage.satellizer_token, (newVal,oldVal) => {
			if ($auth.isAuthenticated()) 
            	$scope.autenticado = true;
			else
				$scope.autenticado = false;
		});
		$scope.logout = () => {
			localStorage.removeItem('satellizer_token');
			localStorage.removeItem('admin_token');
			localStorage.removeItem('user');
			location.reload();
		}
	}]);