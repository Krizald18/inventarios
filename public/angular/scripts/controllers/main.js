'use strict';
angular.module('App').controller('MainCtrl', ['$scope', '$auth', 'API', function($scope, $auth, API) {
	$scope.refreshbodyheight = () => {
		var body = document.body,
		    html = document.documentElement;
		body.style.height = 100 + "%";
		setTimeout(() => {
			var height = Math.max( body.scrollHeight, body.offsetHeight, 
		        html.clientHeight, html.scrollHeight, html.offsetHeight );
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
	    "caption": "Inventario - Activo y Bajas " + new Date().getFullYear(),
	    "numberprefix": "",
	    "plotgradientcolor": "",
	    "bgcolor": "FFFFFF",
	    "showalternatehgridcolor": "0",
	    "divlinecolor": "CCCCCC",
	    "showvalues": "1",
	    "showcanvasborder": "0",
	    "canvasborderalpha": "0",
	    "canvasbordercolor": "CCCCCC",
	    "canvasborderthickness": "1",
	    "yaxismaxvalue": "3000",
	    "formatNumberScale": "0",
	    "captionpadding": "30",
	    "linethickness": "3",
	    "yaxisvaluespadding": "15",
	    "legendshadow": "0",
	    "legendborderalpha": "0",
	    "palettecolors": "#f8bd19,#008ee4,#33bdda,#e44a00,#6baa01,#583e78",
	    "showborder": "0"
	};
	$scope.dataset = [
	    	{
		        "seriesname": "Activo",
		        "data" : []
	        },
		    {
		        "seriesname": "Bajas",
		        "data" : []
			}
		];
	$scope.categories = [
	    {
	        "category": [
	            {
	                "label": "Ene"
	            },
	            {
	                "label": "Feb"
	            },
	            {
	                "label": "Mar"
	            },
	            {
	                "label": "Abr"
	            },
	            {
	                "label": "May"
	            },
	            {
	                "label": "Jun"
	            },
	            {
	                "label": "Jul"
	            },
	            {
	                "label": "Ago"
	            },
	            {
	                "label": "Sep"
	            },
	            {
	                "label": "Oct"
	            },
	            {
	                "label": "Nov"
	            },
	            {
	                "label": "Dic"
	            }
	        ]
	    }
	];
	API.all("grafica/bajas").customGET("", null).then(response => {
		$scope.bajas = response.plain().data;
		API.all("grafica/activos").customGET("", null).then(resp => {
			$scope.activos = resp.plain().data;
			$scope.dataset = [
		    	{
			        "seriesname": "Activo",
			        "data" : $scope.activos
		        },
			    {
			        "seriesname": "Bajas",
			        "data" : $scope.bajas
				}
			];
		});
	});
}]);