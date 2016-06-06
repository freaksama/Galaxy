<?
	if($_GET['token']!= '')
	{
		$datos['token'] = $_GET['token'];
	}
	if($_POST['txttoken']!= '')
	{
		$datos['token'] = $_POST['txttoken'];
	}
	
	
        $rec = $c_sistema->buscarUsuarioToken($datos);
        
        //print_r($rec);


	$destino = "index.php";

	

	if(isset($_POST['btnenviar']))
	{
		
		if(	$_POST['txttoken']!= '' ||
			$_POST['txtnp']	!= '' 	||
			$_POST['txtcp']	!= '' )			
		{
			$resultado = $c_sistema->actualizarPasswordToken($_POST);

			//print_r($resultado);

			if($resultado['codigo']=='000')		
			{
				$mensaje = '<div class="alert alert-dismissable alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Password actualizado correctamente. Inicie sessi&oacute;n  <a href="login">&Aacute;qui</a>
					  </div>
					  ';   

				//$c_sistema->generarMensaje($datos);

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
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
<?=$mensaje;?>
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?op=recpass" method="POST">
	    <fieldset>
	      <legend>Actualizar Password</legend>	      


	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Nuevo Password</label>
	        <div class="col-lg-8">
	          <input type="password" class="form-control" id="txtnp" name="txtnp" value="" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-4 control-label">Confirmar Password</label>
	        <div class="col-lg-8">
	          <input type="password" class="form-control" id="txtcp" name="txtcp" value="" />
	        </div>
	      </div>

	      <div class="form-group text-right">
	        <div class="col-lg-10 col-lg-offset-2">	  
	          <input type="hidden" name="txttoken" id="txttoken" value="<?=$datos['token']?>" />
	          <input type="hidden" name="txtid" id="txtid" value="<?=$rec['id_usuario'];?>" />
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Actualizar</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>