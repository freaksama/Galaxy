<?
	
	

	$destino = "index.php?sub=adm&op=cam";
	$datos['id_usuario_p'] = 1;
	$usuarios = $c_sistema->obtenerUsuariosSecundarios($datos);
	
	

	

	if(isset($_POST['btnenviar']))
	{


		$resultado = $c_sistema->obtenerDatosUsuarioID($_POST);
		//print_r($resultado);
		if($resultado['codigo']=='000')		
		{
			$datos['tipo'] 		= 'exito';
			$datos['titulo'] 	= 'Registro Exitoso! ';	
			$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';

			//$c_sistema->generarMensaje($datos);
			if($_POST['op2']=='dash')
			{
				echo'<script type="text/javascript">window.location.href = "index.php?op=dash";</script>';
			}
			else
			{
				echo'<script type="text/javascript">window.location.href = "'.$destino.'";</script>';
			}
			
		}
		else
		{

		}
		
	}
	//print_r($_SESSION);
	

?>
<script>
    $(function(){

    	$('#txttags').tagit();
    });
</script>


<br><br>
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=adm&op=cam" method="POST">
	    <fieldset>
	      <legend>Cambio de Usuario</legend>

	      <div class="form-group">
	        <label for="txtip" class="col-lg-2 control-label">Usuario</label>
	        <div class="col-lg-10">
	          <select name="txtusuario" id="txtusuario" class="form-control input-sm" id="select">
	            <?
	            	if(count($usuarios) > 0)
	            	{
	            		foreach($usuarios as $u)
	            		{
	            			?><option value="<?=$u['id_usuario'];?>" ><?=$u['nombre_usuario'];?></option><?
	            		}
	            	}
	            ?>
	          </select>
	        </div>
	      </div>

	      

	      
	      

	      <div class="form-group text-right">
	        <div class="col-lg-10 col-lg-offset-2">
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Cambiar</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>