'use strict';
angular.module('App').controller('LoginCtrl', function ($scope, $auth, ToastService) {
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
				if(sessionStorage.getItem('prev')) 
				{
					var red = sessionStorage.getItem('prev');
					sessionStorage.removeItem('prev');
					window.location = red;
				}
				else
					window.location = '/';
				ToastService.show('Sesión iniciada');
			})
			.catch($scope.failedLogin.bind());
	}

	$scope.failedLogin = response => {
		if (response.status === 422) {
			for (let error in response.data.errors) {
				return ToastService.error(response.data.errors[error][0]);
			}
		}
		ToastService.error(response.statusText);
	}
});