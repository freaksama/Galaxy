<?

	$r1 = $c_sistema->listadoVisitasGeneralSRC();
	$r2 = $c_sistema->listadoVisitasGeneralSeccion();
	$r3 = $c_sistema->listadoVisitasGeneralFecha();
	$r4 = $c_sistema->listadoVisitasGeneralIPs();
	$r5 = $c_sistema->listadoVisitasGeneralPage();


	$tipo['S'] = 'SI';
	$tipo['N'] = 'NO';

?>

<div class="text-center">
	<h2>Listado de Visitas </h2>
</div>

<br><br>
<div class="col-lg-3">	

	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Origen</h3>
	  </div>
	  <div class="panel-body">
	  	<table class="table">
	  		<?
	  			if(count($r1)>0)
				{
					foreach ($r1 as $rec)
					{

						?>
							<tr>
								<td ><?=$rec['src'];?></td>
								<td><span class="text-info"><?=$rec['visitas'];?></span></td>
							</tr>
						<?
					}
				}
	  		?>
	  				
	  	</table>
	  </div>
	</div>

	<br>
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">IPs</h3>
	  </div>
	  <div class="panel-body">
	  	<table class="table">
	  		<?
	  			if(count($r4)>0)
				{
					foreach ($r4 as $rec)
					{

						?>
							<tr>
								<td><a href="index.php?sub=adm&op=blip&ip=<?=$rec['ip'];?>" title="Dar click para bloquear IP"><?=$rec['ip'];?></a></td>
								<td><span class="text-info"><?=$rec['visitas'];?></span></td>
							</tr>
						<?
					}
				}
	  		?>
	  				
	  	</table>
	  </div>
	</div>
</div>

<div class="col-lg-3">	

	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Seccion</h3>
	  </div>
	  <div class="panel-body">
	  	<table class="table">
	  		<?
				if(count($r2)>0)
				{
					foreach ($r2 as $rec)
					{

						?>
							<tr>
								
								<td><?=$rec['seccion'];?></td>
								<td><span class="text-info"><?=$rec['visitas'];?></span></td>											
							</tr>
						<?
					}
				}
			?>
	  				
	  	</table>
	  </div>
	</div>

	
</div>

<div class="col-lg-3">	

	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Fecha</h3>
	  </div>
	  <div class="panel-body">
	  	<table class="table">
	  		<?
				if(count($r3)>0)
				{
					foreach ($r3 as $rec)
					{

						?>
							<tr>
								
								<td><?=$rec['solofecha'];?></td>
								<td><span class="text-info"><?=$rec['visitas'];?></span></td>											
							</tr>
						<?
					}
				}
			?>
	  				
	  	</table>
	  </div>
	</div>
</div>

<br><br><br>

<div class="col-lg-12">	

	<div class="panel panel-primary">
	  	<div class="panel-heading">
			<h3 class="panel-title">URL completa</h3>
		</div>
	  
	  
	  	<table class="table">
	  		<?
				if(count($r5)>0)
				{
					foreach ($r5 as $rec)
					{

						?>
							<tr>
								
								<td><?=$rec['page'];?></td>
								<td><span class="text-info"><?=$rec['visitas'];?></span></td>											
							</tr>
						<?
					}
				}
			?>
	  				
	  	</table>
  	</div>

</div>