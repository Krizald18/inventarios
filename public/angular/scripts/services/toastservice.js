class ToastService {

	constructor($mdToast){
		this.$mdToast = $mdToast;
		this.pos = 'bottom right';
		this.act = 'OK';
		this.hdl = 3000;
	}
	show(content) {
		if (!content) {
			return false;
		}
		return this.$mdToast.show(
			this.$mdToast.simple()
			.textContent(content)
			.position(this.pos)
			.action(this.act)
			.hideDelay(this.hdl)
		);
	}

	error(content){
		if (!content) {
			return false;
		}
		return this.$mdToast.show(
			this.$mdToast.simple()
			.textContent(content)
			.position(this.pos)
			.action(this.act)
			.hideDelay(this.hdl)
		);
	}
}

angular.module('App')
	.service('ToastService', ToastService);