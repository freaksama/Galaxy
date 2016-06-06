<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	
	
	$rec   = $c_sistema->obtenerDatosUsuario2($datos);



	//print_r($_SESSION);
	

	if(isset($_POST['btnenviar']))
    {   
        if( $rec['nombre_usuario'] 	!= $_POST['txtnombre'] 		||
        	$rec['correo'] 			!= $_POST['txtcorreo'] 		||
        	$rec['bio'] 			!= $_POST['txtbio'] 		||
        	$rec['id_sexo'] 		!= $_POST['txtsexo'] 		||
        	$rec['id_situacion'] 	!= $_POST['txtsituacion'] 	||
        	$rec['ubicacion'] 		!= $_POST['txtubicacion'] 	||        	
        	$rec['nombre']			!= $_POST['txtnombrereal'] 	||
        	$rec['id_situacion']	!= $_POST['txtsituacion'] )
        {

        	$resultado = $c_sistema->actualizarDatosUsuario($_POST);


        	/*if($rec['id_situacion'] != $_POST['txtsituacion'])
        	{
				echo '<script>window.location.href="publica/cambio_situacion";</script>';   

        	}

        	if($rec['id_sexo'] != $_POST['txtsexo'])
        	{
        		echo '<script>window.location.href="publica/cambio_sexo";</script>';   
        	}*/






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

    $sexos 			= $c_sistema->obtenerCatSexo();
    $situaciones  	= $c_sistema->obtenerSituacionesSentimentales();


    //print_r($situaciones);

    

	
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
	  <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>	  
	  <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos</a>
	  <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Inicio y publicaciones </a>
	  <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" /> Foto de perfil</a>	  
	  <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
	  <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password</a>	  	  
	  <a href="index.php?sub=cue&op=tem" class="list-group-item"><img src="img/themes-32.png" width="24" /> Cambiar Tema </a>
	</div>
</div>

<div class="row">
<div class="col-lg-6">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=act" method="POST">
	    <fieldset>
	      <legend>Actualizar Informaci&oacute;n B&aacute;sica</legend>
	      

	      <div class="form-group">
	        <label for="txtnombrereal" class="col-lg-2 control-label">Nombre</label>
	        <div class="col-lg-9">
	          <input type="text" class="form-control input-sm" id="txtnombrereal" name="txtnombrereal" value="<?=$rec['nombre'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtnombre" class="col-lg-2 control-label">Usuario</label>
	        <div class="col-lg-9">
	          <input type="text" class="form-control input-sm" id="txtnombre" name="txtnombre" value="<?=$rec['nombre_usuario'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtcorreo" class="col-lg-2 control-label">Correo</label>
	        <div class="col-lg-9">
	          <input type="text" class="form-control  input-sm" id="txtcorreo" name="txtcorreo"  value="<?=$rec['correo'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtbio" class="col-lg-2 control-label">Biograf&iacute;a</label>
	        <div class="col-lg-9">
	          <textarea class="form-control  input-sm" id="txtbio" name="txtbio" rows="2" maxlength="256" ><?=$rec['bio'];?></textarea>
	        </div>
	      </div>
	       

	       <div class="form-group">
	        <label for="txtsexo" class="col-lg-2 control-label">Sexo</label>
	        <div class="col-lg-9">
	          <select class="form-control  input-sm" id="txtsexo" name="txtsexo" />
	          	<?
	          		if(count($sexos)>0)
	          		{
	          			foreach($sexos as $se)
	          			{
	          				?><option value="<?=$se['id_sexo'];?>" <?if($se['id_sexo']==$rec['id_sexo']){ echo 'selected ';}?>><?=$se['nombre_sexo'];?></option><?
	          			}
	          		}
	          	?>
	          </select>
	        </div>
	       </div>

	       <div class="form-group">
	        <label for="txtsituacion" class="col-lg-2 control-label">Situaci&oacute;n Sentimental</label>
	        <div class="col-lg-9">
	          <select class="form-control  input-sm" id="txtsituacion" name="txtsituacion" />
	          	<?
	          		if(count($situaciones)>0)
	          		{
	          			foreach($situaciones as $si)
	          			{
	          				?><option value="<?=$si['id_situacion'];?>" <?if($si['id_situacion']==$rec['id_situacion']){ echo 'selected ';}?>><?=$si['nombre_situacion'];?></option><?
	          			}
	          		}
	          	?>
	          </select>
	        </div>
	       </div>

	       <div class="form-group">
	        	<label for="txtubicacion" class="col-lg-2 control-label">Ubicaci&oacute;n</label>
	        	<div class="col-lg-9">
	          		<input type="text" class="form-control  input-sm" id="txtubicacion" name="txtubicacion"  value="<?=$rec['ubicacion'];?>" />
	        	</div>
	      	</div>

	      	<!--div class="form-group">
	        	<label for="txtubicacion" class="col-lg-3 control-label">Ver NSFW</label>
	        	<div class="col-lg-9">
	          		<input type="checkbox" name="ck_perm_nfsw" id="ck_perm_nfsw" <?if($rec['per_nsfw']=='S'){echo 'checked ';} ?> >
	        	</div>
	      	</div>

	      	<div class="form-group">
	        	<label for="txtubicacion" class="col-lg-3 control-label">Envio Correos</label>
	        	<div class="col-lg-9">
	          		<input type="checkbox" name="ck_perm_correos" id="ck_perm_correos" <?if($rec['per_enviar_correo']=='S'){echo 'checked ';} ?> >
	        	</div>
	      	</div-->

	      	<!--div class="form-group">
	        	<label for="txtubicacion" class="col-lg-3 control-label">Desplazamiento Infinito</label>
	        	<div class="col-lg-9">
	          		<input type="checkbox" name="ck_desp_inf" id="ck_desp_inf" <?if($rec['desp_inf']=='S'){echo 'checked ';} ?> >
	        	</div>
	      	</div-->


	      	

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