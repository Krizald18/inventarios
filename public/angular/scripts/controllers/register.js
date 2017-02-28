'use strict';
angular.module('App')
	.controller('RegisterCtrl', function ($scope, ToastService, $auth) {
		if($auth.isAuthenticated())
			window.location = '/';
		$scope.nombre = '';
		$scope.username = '';
		$scope.email = '';
		$scope.password = '';
	
		$scope.register = function() {
			let user = {
				nombre: $scope.nombre,
				username: $scope.username,
				email: $scope.email,
				password: $scope.password
			};

			$auth.signup(user)
				.then((response) => {
					//remove this if you require email verification
					$auth.setToken(response.data);
					ToastService.show('Successfully registered.');
					window.location = '/';
				})
				.catch($scope.failedRegistration.bind(this));
		}



		$scope.failedRegistration = function(response) {
			if (response.status === 422) {
				for (let error in response.data.errors) {
					return ToastService.error(response.data.errors[error][0]);
				}
			}
			ToastService.error(response.statusText);
		}
	});