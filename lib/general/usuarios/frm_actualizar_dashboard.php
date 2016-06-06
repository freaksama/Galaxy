<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	
	
	$rec   = $c_sistema->obtenerDatosUsuario2($datos);


	

	if(isset($_POST['btnenviar']))
    {   
        if( $rec['tipo_dash'] 	!= $_POST['txttipodash'] 	||
        	$rec['desp_inf'] 	!= $_POST['txtdesinf'] 		||
        	$rec['per_nsfw'] 	!= $_POST['txtpern_nsfw']   ||
        	$rec['visibilidad_default'] != $_POST['txt_vista_default']	)
        {

        	$resultado = $c_sistema->actualizarDatosDashUsuario($_POST);



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


    //print_r($_SESSION);

    

	
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
	  <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta</a>
	  <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos</a>
	  <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Dashboard y publicaciones <span style="float:right;"><img src="img/bullet_blue1.png" /></span> </a>
	  <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" />  Foto de perfil</a>	  
	  <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
	  <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password</a>
	  
	</div>
</div>

<div class="row">
<div class="col-lg-6">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=dash" method="POST">
	    <fieldset>
	      <legend>Configurar Dashboard y Publicaciones</legend>
	      

	      	<div class="form-group">
	        	<label for="txtubicacion" class="col-lg-4 control-label">Vista de Publicaciones</label>
	        	<div class="col-lg-8">
	          		<select name="txttipodash" id="txttipodash" class="form-control input-sm">
	          			<option value="1" <?if($rec['tipo_dash']=='1'){echo 'selected ';}?> >Normal</option>
	          			<option value="2" <?if($rec['tipo_dash']=='2'){echo 'selected ';}?> >Mini</option>
	          			<option value="3" <?if($rec['tipo_dash']=='3'){echo 'selected ';}?> >Micro</option>
	          		</select>	          		
	        	</div>
	      	</div>

	      	<div class="form-group">
	        	<label for="txtubicacion" class="col-lg-4 control-label">Desplazamiento Infinito</label>
	        	<div class="col-lg-8">
	          		<select name="txtdesinf" id="txtdesinf" class="form-control input-sm">
	          			<option value="N" <?if($rec['desp_inf']=='N'){echo 'selected ';}?> >NO</option>
	          			<option value="S" <?if($rec['desp_inf']=='S'){echo 'selected ';}?> >SI</option>	          			
	          		</select>
	        	</div>
	      	</div>

	      	<div class="form-group">
	        	<label for="txtubicacion" class="col-lg-4 control-label">Ver Publicaciones NSFW</label>
	        	<div class="col-lg-8">
	          		<select name="txtpern_nsfw" id="txtpern_nsfw" class="form-control input-sm">
	          			<option value="N" <?if($rec['per_nsfw']=='N'){echo 'selected ';}?> >NO</option>
	          			<option value="S" <?if($rec['per_nsfw']=='S'){echo 'selected ';}?> >SI</option>	          			
	          		</select>
	        	</div>
	      	</div>

	      	<div class="form-group">
	        	<label for="txt_vista_default" class="col-lg-4 control-label">Visibilidad Default</label>
	        	<div class="col-lg-8">
	          		<select name="txt_vista_default" id="txt_vista_default" class="form-control input-sm">
	          			<option value="P" <?if($rec['visibilidad_default']=='P'){echo 'selected ';}?> >P&uacute;blico - Todo mundo puede ver tus publicaciones</option>
	          			<option value="R" <?if($rec['visibilidad_default']=='R'){echo 'selected ';}?> >Usuarios Registrados - Solo los usuarios pueden ver tus publicaciones</option>	          			
	          			<option value="S" <?if($rec['visibilidad_default']=='S'){echo 'selected ';}?> >Tus seguidores Seguidores - Solo tus seguidores pueden ver tus publicaciones</option>	          			
	          			<option value="O" <?if($rec['visibilidad_default']=='O'){echo 'selected ';}?> >Privado -  Solo tu puedes ver tus publicaciones</option>	          			
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