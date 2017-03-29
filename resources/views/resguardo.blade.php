<!DOCTYPE html>
<html>
<head>
	<title>Caracteristicas</title>
	<style type="text/css">
		@page {
		    header: page-header;
		    footer: page-footer;
		}
		body {
			color: #333;
		    font-family: 'roboto', serif;
		    font-size: 80%;
		}
		#date {
			margin-top: -120px;
			text-align: right;
		}
		#logo{
			margin-left: 20px;
		}
		img{
			margin-left: 30px;
		}
		p{
			text-align: center;
		}
		#content {
			margin-left: 50px;
			margin-right: 50px;
		}
		table {
		    border-collapse: collapse;
		    width: 100%;
		}

		td, th {
		    text-align: left;
		    padding: 8px;
		}

		tr:nth-child(even) {
		    background-color: #f0f0f0;
		}
	</style>
	<!--border: 1px solid #eee;-->
</head>
<body>
	<htmlpageheader name="page-header">
		<br><br><br>
	    <div id="logo"><img src="images/gob-logo.jpg" alt="logo" height="112px" width="90px"></div>
	    <div id="date"><img src="images/reg-logo.jpg" alt="logo" height="87px" width="110px"><br>Culiacán, Sinaloa {{$day}} de {{$month}} de {{$year}}<br>Núm. {{$id}}</div>
	    <p>DIRECCIÓN DEL REGISTRO CIVIL<br>PROYECTO DE MODERNIZACIÓN DEL REGISTRO CIVIL</p>
	</htmlpageheader>
	<div id="content">
	<p><br><br><br><br><br><br><br><br><br><br><br><br></p>
		Recibí por parte de la Dirección del Registro Civil: <br><br>
		<table>
		  <tr>
		  	<th>Núm.</th>
		    <th>Número de Inventario</th>
		    <th>Número de Serie</th>
		    <th>Artículo</th>
		  </tr>
		  @forelse ($articulos as $index => $articulo)
		  	  <tr>
			  	<td>{{$index + 1}}</td>
			  	<td>{{((object) $articulo)->numero_inventario}}</td>
			    <td>{{((object) $articulo)->numero_serie}}</td>
			    <td>{{((object) $articulo)->articulo}}</td>
			  </tr>
		  @empty
		    
		  @endforelse
		</table>
	</div>
	<htmlpagefooter name="page-footer">
		<p>_________________________________________________<br>{{$oficial}}<br>{{$oficialia && $num_oficialia != 0? 'OFICIAL '.$num_oficialia.' DE '.$oficialia.',':''}} 

		{{$municipio? $municipio.', '.$estado.'.': ''}}<br><br><br><br></p>
		<!--<p style="color: #555;">Unidad de Servicios Estatales. Blvd. Ducto Pemex y Pedro Infante, S/N, Sección IV del desarrollo urbano tres ríos.<br>Tel. 758-7000 Culiacán, Sinaloa. C.P. 8000</p>-->
	    <br><br>
	</htmlpagefooter>
</body>
</html>