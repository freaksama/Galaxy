<?
	$datos['consulta']	= $_GET['q'];
	$usuarios = $c_sistema->listadoCatSexos();
	
	//print_r($usuarios);
	

	$status['A'] = 'Activo';
	$status['B'] = 'Bloqueado';
	$status['C'] = 'Cancelado';

?>

<script type="text/javascript">


 $(document).ready(function(){
 	
 	
    	
});




</script>
<ul class="nav nav-tabs">
  <li><a href="index.php?sub=sex&op=reg"><img src="img/new.png"  width="20" />  Registrar Genero</a></li>
  <li class="active"><a href="index.php?sub=sex&op=lis"><img src="img/listado.png" width="24" /> Listado Generos</a></li>  
</ul>
<div class="text-center">
	<h2>Listado de Generos</h2>
</div>

<br><br>
<table class="table table-striped table-bordered table-hover">
	<tr>
		<th width="100px">Editar</th>			
		<th width="350px">Nombre </th>		
		<th width="100px">Fecha</th>		
		<th width="60px">status</th>
		
	</tr>
	<?
		if(count($usuarios)>0)
		{
			foreach($usuarios as $rec)
			{
				
				?>
					<tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">
						<td style="text-align:center;">
							<a href="index.php?sub=sex&op=act&id=<?=$rec['id_sexo'];?>">Actualizar</a>
						</td>
						<td title="<?=$rec['bio'];?>"><?=$rec['nombre_sexo'];?></td>								
						<td><?=$rec['fecha'];?></td>						
						<td><?=$status[$rec['status']];?></td>
					</tr>
				<?
			}
		}
	?>	
</table>
</div>
<br>
