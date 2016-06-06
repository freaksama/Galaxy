<?
	
	$datos['id_usuario'] = $_GET['usuario'];
	if($datos['id_usuario']=='')
	{
		$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	}
	else
	{
		//$datos['id_usuario'] = Encrypter::desencriptar($datos['id_usuario']);
	}
	$rec   = $c_sistema->obtenerDatosUsuario2($datos);

	
	$nsfw['S'] = 'Hell yeah!';
	$nsfw['N'] = 'Nope';

	$correos['S'] = 'SI';
	$correos['N'] = 'NO';
	
	

	$rec['avatar'] = str_replace('/48/', '/200/', $rec['avatar']);
?>



<script type="text/javascript">	
	
	$(function(){

		<?
			if($_SESSION['m']['mensaje'] != '')
			{
				echo 'reset();';
				echo $c_sistema->show_mensaje();
				$c_sistema->borrarMensaje();
			}
		?>
		
	});	//fin de ready	
	
</script>	
<ul class="nav nav-tabs">
  	<!--li><a href="index.php?menu=ma&sub=pac&op=regm"><img src="img/new.png" width="24" />Registrar</a></li-->
  	<li class="active"><a href="index.php?sub=cue&op=det"><img src="img/info2.png" width="24" />Detalles de la Cuenta</a></li>	
	<li><a href="index.php?sub=cue&op=act"><img src="img/edit2.png" width="24"> Actualizar Usuario</a></li>	
	<li class=""><a href="index.php?sub=cue&op=ava"><img src="img/user.png" width="24" />Actualizar Avatar </a></li>	
	<li class=""><a href="index.php?sub=cue&op=fon"><img src="img/wall.png" width="24" />Fondo Web </a></li>	
	<!--li class=""><a href="index.php?sub=cue&op=soc"><img src="img/facebook-32.png" width="24" />Redes Sociales</a></li-->	
	<li class=""><a href="index.php?sub=cue&op=soc"><img src="img/facebook-32.png" width="24" />Imagen Like</a></li>	
	
</ul>

<br>

<div style="float:left">
   

    <img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;"  src="<?=$rec['avatar'];?>"  border="0" />  
    <br><a href="index.php?sub=cue&op=ava">Actualizar Avatar</a>
    
    <br>
    
</div>


<div style="padding-left:200px">

	<div class="col-lg-8">
		<div class="well bs-component">
	
		<fieldset>
			<legend>Detalles de Usuario</legend>	
			
				
		
			<table width="900" style="cellspacing:10px"  cellpadding="10" class="table table-striped table-hover ">
				
				<tr>
					<td style="text-align:right" width="200"><b>Nombre</b></td>
					<td>
						<?=$rec['nombre'];?>
					</td>
				</tr>				
				<tr>
					<td style="text-align:right" width="200"><b>Nombre de Usuario</b></td>
					<td>
						<?=$rec['nombre_usuario'];?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right" width="200"><b>Correo</b></td>
					<td>
						<?=$rec['correo'];?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right" width="200"><b>Bio</b></td>
					<td>
						<?=$rec['bio'];?>
					</td>
				</tr>			
				<tr>
					<td style="text-align:right"  width="200"><b>Sexo</b></td>
					<td>
						<?=$rec['nombre_sexo'];?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right" width="200"><b>Ubicaci&oacute;n</b></td>
					<td>
						<?=$rec['ubicacion'];?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right" width="200"><b>NSFW</b></td>
					<td>
						<?=$nsfw[$rec['per_nsfw']];?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right" width="200"><b>Envio Correos</b></td>
					<td>
						<?=$correos[$rec['per_enviar_correo']];?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right" width="200"><b>Ubicaci&oacute;n</b></td>
					<td>
						<?=$rec['ubicacion'];?>
					</td>
				</tr>	
				<tr>
					<td style="text-align:right" width="200"><b>Publicaciones</b></td>
					<td>
						<?=$rec['links'];?>
					</td>
				</tr>	
				<tr>
					<td style="text-align:right" width="200"><b>Seguidores</b></td>
					<td>
						<?=$rec['seguidores'];?>
					</td>
				</tr>	
				<tr>
					<td style="text-align:right" width="200"><b>Sigues</b></td>
					<td>
						<?=$rec['sigues'];?>
					</td>
				</tr>	

			</table>
		</fieldset>

		</div>		
	</div>
</div>

