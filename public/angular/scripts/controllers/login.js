'use strict';
angular.module('App').controller('LoginCtrl', ['$scope', '$auth', 'ToastService', 'API', function ($scope, $auth, ToastService, API) {
	if($auth.isAuthenticated())
		window.location = '/';
    $scope.username = '';
    $scope.password = '';

	$scope.login = () => {
		let user = {
			username: $scope.username,
			password: $scope.password
		};

		$auth.login(user)
			.then(response => {
				$auth.setToken(response.data);
				if(response.data.data.user.perfil_id == 1)
					localStorage.setItem('admin_token', response.data.data.user.admin.token);
				localStorage.setItem('user', response.data.data.user.id);

				if(sessionStorage.getItem('prev')) 
				{
					var red = sessionStorage.getItem('prev');
					sessionStorage.removeItem('prev');
					window.location = red;
				}
				else
					window.location = '/';
				ToastService.show('Sesión iniciada');
			}, response => {
				$scope.failedLogin(response);
			}).catch($scope.failedLogin.bind());
	}

	$scope.failedLogin = response => {
		if([401,422].indexOf(response.status) !== -1)
			return ToastService.error(response.data.errors.message[0]);
	}
}]);