<?
	
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];

	$redes = $c_sistema->obtenerRedesSociales($datos);


	$destino = "index.php";

	

	if(isset($_POST['btnenviar']))
	{
		

		if(	$_POST['txtfacebook']	!= $redes['facebook'] 	||
			$_POST['txttwitter']	!= $redes['twitter'] 	||
			$_POST['txttumblr']		!= $redes['tumblr'] 	||
			$_POST['txtinstagram']	!= $redes['instagram'] 	||
			$_POST['txtpinterest']	!= $redes['pinterest'] 	||
			$_POST['txtgoogle']		!= $redes['google'] 	||	
			$_POST['txtyoutube']	!= $redes['youtube']  	||
			$_POST['txtdeviantart']	!= $redes['deviantart'] ||
			$_POST['txtreedit']		!= $redes['reedit'] 	||	
			$_POST['txtblogger']	!= $redes['blogger'] 	)			
		{
			$resultado = $c_sistema->actualizarRedesSociales($_POST);

			

			if($resultado['codigo']=='000')		
			{
				$datos['tipo'] 		= 'exito';
				$datos['titulo'] 	= 'Registro Exitoso! ';	
				$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';

				//$c_sistema->generarMensaje($datos);

				echo'<script type="text/javascript">window.location.href = "index.php?sub=cue&op=det";</script>';
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
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=soc" method="POST">
	    <fieldset>
	      <legend>Mis Otras Redes Sociales</legend>
	      

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Facebook</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtfacebook" name="txtfacebook" value="<?=$redes['facebook'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Twitter</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txttwitter" name="txttwitter" value="<?=$redes['twitter'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Tumblr</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txttumblr" name="txttumblr" value="<?=$redes['tumblr'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Instagram</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtinstagram" name="txtinstagram" value="<?=$redes['instagram'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Pinterest</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtpinterest" name="txtpinterest" value="<?=$redes['pinterest'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Google</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtgoogle" name="txtgoogle" value="<?=$redes['google'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Youtube</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtyoutube" name="txtyoutube" value="<?=$redes['youtube'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Deviantart</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtdeviantart" name="txtdeviantart" value="<?=$redes['deviantart'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Reedit</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtreedit" name="txtreedit" value="<?=$redes['reedit'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Blogger</label>
	        <div class="col-lg-8">
	          <input type="text" class="form-control input-sm" id="txtblogger" name="txtblogger" value="<?=$redes['blogger'];?>" />
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
</div>