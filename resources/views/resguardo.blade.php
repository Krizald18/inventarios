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
		    font-size: 16px;
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
		table {
		    border-collapse: collapse;
		    width: 100%;
		}

		td, th {
			font-size: 0.8em;
			height: 2.35em;
		    text-align: left;
		}
		tr {
			font-size: 0.9em;
		}
		tr:nth-child(even) {
		    background-color: #f0f0f0;
		}
		header {
			font-size: 0.9em;
			height: 10em;
			position: fixed;
			width: 100%;
		}
		.contentx {
			font-size: 0.9em;
			margin-left: 1em;
			margin-right: 1em;
		}
		footer {
			font-size: 0.9em;
		}
		.firma {
			text-align: center;
		}
		.nota{
			height: 3em;
		}
	</style>
	<!--border: 1px solid #eee;-->
</head>
<body>
@forelse ($hojas as $index => $hoja)
	<header name="page-header">
	    <div id="logo"><img src="images/gob-logo.jpg" alt="logo" height="112px" width="90px"></div>
	    <div id="date"><img src="images/reg-logo.jpg" alt="logo" height="87px" width="110px"><br>
	    Culiacán, Sinaloa {{$day}} de {{$month}} de {{$year}}<br>Núm. {{$id}}</div>
	    <p>DIRECCIÓN DEL REGISTRO CIVIL<br>PROYECTO DE MODERNIZACIÓN DEL REGISTRO CIVIL</p>
	</header><br><br><br><br><br><br><br>
	<div class="contentx">
		<div class="nota">
		@if (strlen($nota) > 0)
			<small style="background: black; color: white; word-wrap: break-word;">NOTA: {{$nota}}</small><br>
		@else
			<br>
		@endif
		</div>
		Recibí por parte de la Dirección del Registro Civil: <br>
		<table>
		  <tr>
		  	<th>Núm.</th>
		    <th>Número de Inventario</th>
		    <th>Número de Serie</th>
		    <th>Artículo</th>
		  </tr>
		  @forelse ($hoja as $index2 => $articulo)
		  	  <tr>
			  	<td>{{($index * 21) + ($index2 + 1)}}</td>
			  	<td>{{((object) $articulo)->numero_inventario? ((object) $articulo)->numero_inventario: '9999999999'}}</td>
			    <td>{{((object) $articulo)->numero_serie? ((object) $articulo)->numero_serie: '9999999999'}}</td>
			    <td>{{((object) $articulo)->articulo}}</td>
			  </tr>
		  @empty
		  @endforelse
		  @if (count($hoja) < 21)
			@for ($i = 0; $i < 21 - count($hoja); $i++)
				<tr>
					<td style="height: 2.35em"></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			@endfor
		  @endif
		</table>
	</div>
	<footer name="page-footer">
		<br><br><br>
		<div class="firma">
			_________________________________________________<br>
			{{$oficial}}<br>
			{{$oficialia && $num_oficialia != 0? 'OFICIAL '.$num_oficialia.' DE '.$oficialia.',':''}} {{$municipio? $municipio.', '.$estado.'.': ''}}
		</div>
		{{$index + 1}} de {{count($hojas)}}
		@if ($index < count($hojas) - 1)
			<br>
		@endif
	</footer>
@empty
@endforelse
</body>
</html>