<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];

	$datos['consulta']	= $_GET['q'];
	$usuarios = $c_sistema->obtenerUsuariosReferenciaFundadores($datos);

	if($_SESSION['s']['tipo_usuario']!= '3')
	{
		echo'<script type="text/javascript">window.location.href = "error_404";</script>';  
	}
	
	//print_r($usuarios);
	

	$status['A'] = 'Activo';
	$status['B'] = 'Bloqueado';
	$status['C'] = 'Cancelado';
	
	
	
?>



<script type="text/javascript">	
	
	$(function(){

		
		
	});	//fin de ready	
	
</script>	


<br>
<div class="col-lg-3">
	<div class="list-group">
	  <a href="" class="list-group-item active">Configuraci&oacute;n</a>
	  <a href="fundadores/panel" class="list-group-item"><img src="img/user-32.png" width="24" /> Invitaciones </a>	  
	  <a href="fundadores/panel/estadisticas" class="list-group-item"><img src="img/31-32.png" width="24" /> Estadisticas </span></a>
	  <a href="fundadores/panel/usuarios" class="list-group-item"><img src="img/list-32.png" width="24" /> Usuarios invitados <span style="float:right;"><img src="img/bullet_blue1.png" /></a>
	  <a href="fundadores/panel/ganancias" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Ganancias </a>	  
	  <a href="fundadores/panel/preguntas" class="list-group-item"><img src="img/photo-32.png" width="24" /> Preguntas Frecuentes</a>
	  <a href="fundadores/terminos" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> T&eacute;rminos y condiciones</a>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<table id="t_user" class="table table-striped table-bordered table-hover">
			<tr>
				<th width="20px">Avatar</th>			
				<th width="150px">Detalles</th>										
			</tr>
			<?
				if(count($usuarios)>0)
				{
					foreach($usuarios as $rec)
					{
						?>
							<tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">								
								<td style="text-align:center;">
									<a href="u/<?=$rec['nombre_usuario']?>">
										<img src="<?=$rec['avatar'];?>" width="32" />
									</a>
								</td>
								<td title="<?=$rec['bio'];?>">
									<a href="u/<?=$rec['nombre_usuario']?>">@<?=$rec['nombre_usuario'];?></a>
									<br>
									<span class="text-muted f11"><?=$rec['bio'];?></span>
								</td>
							</tr>
						<?
					}
				}
			?>	
		</table>			
	</div>
</div>