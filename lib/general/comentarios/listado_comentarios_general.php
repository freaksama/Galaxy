<?
	
	if($_GET['op2']!='gen')
	{
		$datos['id_usuario'] = $_SESSION['s']['id_usuario'];	
		$a= ' class="active"';
	}
	else
	{
		$b=' class="active"';
	}
	
	$comentarios 	= $c_sistema->listadoComentariosGeneral($datos);

	//print_r($notificaciones);

	
	
	//$datos['id_ult_not'] = $notificaciones[0]['id_notificacion'];
	//$_SESSION['s']['id_last_n'] = $datos['id_ult_not'];

	//$c_sistema->actualizarUltNotificacion($datos);

	//$dash        = $c_sistema->obtenerDatosDashboardUsuario();
	//$user_seguir = $c_sistema->listadoUsuariosParaSeguir();

	//print_r($_SESSION);
	//$reg   = $c_sistema->obtenerDatosUsuario2($datos);
	//print_r($links);

	//print_r($_SESSION);



?>

<script type="text/javascript">


 $(document).ready(function(){
 	
 	
    	
});



</script>


<div class="text-center">
	<h4>&Uacute;ltimos Comentarios</h4>
</div>

<ul class="nav nav-tabs">
  <li <?=$a;?> ><a href="comentarios"><img src="img/mensajes.png"  width="24" />  Mis Comentarios</a></li>    
  <li <?=$b;?>><a href="comentarios/general"><img src="img/users.png" width="24" /> Todos los comentarios</a></li>
</ul>
<br>

<div class=" col-lg-8 col-lg-offset-2">	
<?
	if(count($comentarios)>0)
	{
		foreach($comentarios as $rec)
		{
			if($rec['nombre_usuario']!='')
			{
				$nombre_usuario = '@'.$rec['nombre_usuario'];
			}

			?>
				<div class="panel panel-default">
				  	<div class="panel-body">				    	
			            <a href="u/<?=$rec['nombre_usuario']?>"><img src="<?=$rec['avatar']?>" class="avatar-mini"  /></a>
			            <a href="u/<?=$rec['nombre_usuario']?>"><?=$nombre_usuario;?></a>
			            <?=$c_sistema->generar_tags($rec['comentario']);?>	
			            <span class="text-muted text-mini text-right"><?=$c_sistema->hace($rec['fecha']);?></span>
			            <a href="post/<?=$rec['id_contenido'];?>/<?=$c_sistema->urls_amigables($rec['nombre']);?>" >Ir a publicaci&oacute;n</a>
			            
			            	
				  	</div>
				</div>

				
					
		        
			<?
		}
	}
?>	
</div>
<br>
