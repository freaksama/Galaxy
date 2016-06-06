<?

	$publicidad = $c_sistema->listadoPublicidadGeneral();
	


?>

<div class="text-center">
	<h2>Publicidad Activa </h2>
</div>

<br><br>
<div class="col-lg-6 col-lg-offset-3">	

	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Origen</h3>
	  </div>
	  <div class="panel-body">
	  	<table class="table table-bordered table-hover table-striped">

	  		<tr>
	  			<th>Publicidad</th>
	  			<th>Cliente</th>
	  			<th>Periodo</th>
	  			<th>Monto</th>
	  			<th>visitas</th>

	  		</tr>
	  		<?
	  			if(count($publicidad)>0)
				{
					foreach ($publicidad as $rec)
					{

						?>
							<tr>
								<td><?=$rec['nombre_publicidad'];?></td>
								<td><?=$rec['cliente'];?></td>
								<td><?=$rec['fecha_inicio'].' - '.$rec['fecha_fin'];?></td>
								<td><?=number_format($rec['monto'],2);?></td>
								<td><span class="text-info"><?=$rec['visitas'];?></span></td>
							</tr>
						<?
					}
				}
	  		?>
	  				
	  	</table>
	  </div>
	</div>

	