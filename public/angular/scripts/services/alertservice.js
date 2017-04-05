class AlertService {

	constructor($mdDialog) {
		this.$mdDialog = $mdDialog;
		this.status = '  ';
  		this.customFullscreen = false;
  		//this.parent = angular.element(document.body);
	}

	show(title, content) {
		if (!content || !title) {
			return false;
		}
		return this.$mdDialog.show(
					    this.$mdDialog.alert()
					        //.parent(this.parent)
					        .clickOutsideToClose(true)
					        .title(title)
					        .textContent(content)
					        .ariaLabel(title)
					        .ok('Aceptar')
					);
	}

	error(content){
		if (!content) {
			return false;
		}
		return this.$mdDialog.show(
					    this.$mdDialog.alert()
					        //.parent(this.parent)
					        .clickOutsideToClose(true)
					        .title('Error')
					        .textContent(content)
					        .ariaLabel('Error')
					        .ok('Aceptar')
					);
	}
}

angular.module('App')
	.service('AlertService', ['$mdDialog', AlertService]);;