<?
	
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];


	$destino = "index.php";

	

	if(isset($_POST['btnenviar']))
	{
		print($_POST);

		if(	$_POST['txtpa']	!= '' 	||
			$_POST['txtnp']	!= '' 	||
			$_POST['txtcp']	!= '' )			
		{
			$resultado = $c_sistema->actualizarPassword($_POST);

			//print_r($resultado);

			if($resultado['codigo']=='000')		
			{
				$datos['tipo'] 		= 'exito';
				$datos['titulo'] 	= 'Registro Exitoso! ';	
				$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';

				//$c_sistema->generarMensaje($datos);
				 $mensaje = '<div class="alert alert-dismissible alert-success">
	                <button type="button" class="close" data-dismiss="alert">&times;</button>
	                <strong>Exito!</strong> 
	                La informaci&oacute;n a sido actualizada exitosamente.
	              </div>';

				//echo'<script type="text/javascript">window.location.href = "'.$destino.'";</script>';
			}
			else
			{
				?>
					<div class="text-center">
						<span class="text-danger"><img src="img/pendiente2.png" /><?=$resultado['mensaje'];?></span>
					</div>
				<?
			}
		}
	}
	

?>


<br><br>

  <div class="col-lg-3">
    <div class="list-group">
      <a href="#" class="list-group-item active">Configuraci&oacute;n</a>
      <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta</a>
      <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos</a>
      <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Dashboard y publicaciones </a>
      <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" />  Foto de perfil </a>      
      <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Notificaciones Correo</a>
      <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>
      
    </div>
  </div>


<div class="col-lg-6 ">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=actp" method="POST">
	    <fieldset>
	      <legend>Actualizar Password</legend>
	      

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Password Actual</label>
	        <div class="col-lg-8">
	          <input type="password" class="form-control input-sm" id="txtpa" name="txtpa" value="" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Nuevo Password</label>
	        <div class="col-lg-8">
	          <input type="password" class="form-control input-sm" id="txtnp" name="txtnp" value="" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Confirmar Password</label>
	        <div class="col-lg-8">
	          <input type="password" class="form-control input-sm" id="txtcp" name="txtcp" value="" />
	        </div>
	      </div>

	      

	      <div class="form-group text-right">
	        <div class="col-lg-10 col-lg-offset-2">	        
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Actualizar</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
