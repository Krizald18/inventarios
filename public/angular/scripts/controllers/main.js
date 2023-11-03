'use strict';
angular.module('App').controller(
'MainCtrl', ['$scope', '$auth', 'API',
function($scope, $auth, API) {
	$scope.refreshbodyheight = () => {
		var body = document.body,
				html = document.documentElement;
		body.style.height = 100 + "%";
		setTimeout(() => {
			var height = Math.max(
				body.scrollHeight, body.offsetHeight, html.clientHeight,
				html.scrollHeight, html.offsetHeight
			);
			body.style.height = height + "px";
		}, 500);
		$scope.loading = false;
	}

	$scope.refreshbodyheight();

	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 600);

	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 700);

	setTimeout(() => {
		$scope.refreshbodyheight();
	}, 1500);

	$scope.attrs = {
		"caption":
			"Inventario - Agregados y actualizados en " + new Date().getFullYear(),
		"captionfontsize": "16",
		// "basefontsize": "13",
		"outCnvBaseFontSize": "12",
		// "palette": "5",
		"numberprefix": "",
		"plotgradientcolor": "",
		// "bgcolor": "FFFFFF",
		"showalternatehgridcolor": "0",
		// "divlinecolor":	"CCCCCC",
		"showvalues": "1",
		"showcanvasborder": "0",
		"canvasborderalpha": "0",
		// "canvasbordercolor": "CCCCCC",
		"canvasborderthickness": "1",
		"yaxisname": "Artículos",
		"yaxisnamefontsize": "14",
		"yaxismaxvalue": "300",
		"formatNumberScale": "0",
		"captionpadding": "30",
		"linethickness": "3",
		// "yaxisvaluespadding": "15",
		"legendshadow": "0",
		"legendborderalpha": "0",
		// "palettecolors": "#f8bd19,#008ee4,#33bdda,#e44a00,#6baa01,#583e78",
		"paletteColors": "#44bb44, #dd2222",
		"showborder": "0"
	};

	$scope.dataset = [
		{"seriesname": "Activo",				"data": []},
		{"seriesname": "Actualizados",	"data": []}
	];

	$scope.categories = [
		{
			"category": [
				{"label": "Ene"}, {"label": "Feb"}, {"label": "Mar"}, {"label": "Abr"},
				{"label": "May"}, {"label": "Jun"}, {"label": "Jul"}, {"label": "Ago"},
				{"label": "Sep"}, {"label": "Oct"}, {"label": "Nov"}, {"label": "Dic"}
			]
		}
	];

	API.all("grafica/actualizados").customGET("", null).then(response => {
		$scope.actualizados = response.plain();
		// console.log($scope.actualizados);
		API.all("grafica/activos").customGET("", null).then(resp => {
			$scope.activos = resp.plain().data;
			$scope.dataset = [
				{"seriesname": "Agregados",			"data": $scope.activos},
				{"seriesname": "Actualizados",	"data": $scope.actualizados}
			];
		});
	});
}]);