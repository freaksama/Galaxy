<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	
	
	$rec   = $c_sistema->obtenerDatosUsuario2($datos);


	

	if(isset($_POST['btnenviar']))
    {   
        if( $rec['per_enviar_correo'] 	!= $_POST['txtpermcorreo'] )
        {

        	$resultado = $c_sistema->actualizarDatosNotificacionUsuario($_POST);



        	if($resultado['codigo']=='000')       
	        {
	        	unset($_POST);

	        	$rec   = $c_sistema->obtenerDatosUsuario2($datos);

	        	$mensaje = '<div class="alert alert-dismissible alert-success">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Exito!</strong> 
							  La informaci&oacute;n a sido actualizada exitosamente.
							</div>';
	            //echo'<script type="text/javascript">window.location.href = "index.php?sub=cue&op=det";</script>';  
	        }
	        else
	        {
	        	$mensaje = '<span class="text-danger">'.$resultado['mensaje'].'</span>';
	        }
        }
        
               
    }// fin de registrar

    //$sexos = $c_sistema->obtenerCatSexo();


    

    

	
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

<?=$mensaje;?>
<br><br>
<div class="col-lg-3">
	<div class="list-group">
	  <a href="#" class="list-group-item active">Configuraci&oacute;n</a>
	  <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta </span></a>
	  <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos</a>
	  <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Dashboard y publicaciones </a>
	  <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" /> Foto de perfil</a>	  
	  <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Notificaciones Correo <span style="float:right;"><img src="img/bullet_blue1.png" /></a>
	  <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password</a>	  
	</div>
</div>

<div class="row">
<div class="col-lg-6">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=notif" method="POST">
	    <fieldset>
	      <legend>Actualizar Notificaciones Correo</legend>
	      
	      	<div class="form-group">
	        	<label for="txtubicacion" class="col-lg-3 control-label">Envio Correos</label>
	        	<div class="col-lg-9">	          		
	          		<select name="txtpermcorreo" id="txtpermcorreo" class="form-control input-sm">
	          			<option value="S"  <?if($rec['per_enviar_correo']=='S'){echo 'selected ';} ?>>SI</option>
	          			<option value="N"  <?if($rec['per_enviar_correo']=='N'){echo 'selected ';} ?>>NO</option>
	          		</select>
	        	</div>
	      	</div>	      	

	      	<div class="form-group text-right">
	        	<div class="col-lg-10 col-lg-offset-2">
	          		<button class="btn btn-default">Cancelar</button>
	          		<button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Guardar Cambios</button>
	        	</div>
	      	</div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>