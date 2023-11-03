'use strict';
angular.module('App')
	.controller('RegisterCtrl', ['$scope', 'ToastService', '$auth', function($scope, ToastService, $auth) {
		if ($auth.isAuthenticated())
			window.location = '/';
		$scope.nombre = '';
		$scope.username = '';
		$scope.email = '';
		$scope.password = '';
		$scope.$watch('nombre', n => {
			if ($scope.nombre)
				$scope.nombre = n.charAt(0).toUpperCase() + n.slice(1);
		})
		$scope.register = () => {
			let user = {
				nombre: $scope.nombre,
				username: $scope.username,
				email: $scope.email,
				password: $scope.password
			};

			$auth.signup(user)
				.then(response => {
					//remove this if you require email verification
					$auth.setToken(response.data);

					if (response.data.data.user.perfil_id == 1)
						localStorage.setItem('admin_token', response.data.data.user.admin.token);
					localStorage.setItem('user', response.data.data.user.id);
					localStorage.setItem('nombre', response.data.data.user.nombre);

					ToastService.show('Registro Exitoso.');
					window.location = '/';
				})
				.catch($scope.failedRegistration.bind(this));
		}

		$scope.failedRegistration = response => {
			if (response.status === 422) {
				for (let error in response.data.errors) {
					return ToastService.error(response.data.errors[error][0]);
				}
			}
			ToastService.error(response.statusText);
		}
	}]);