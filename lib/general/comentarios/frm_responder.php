<?
	if($_GET['id'] != '')
	{
	  	$datos['id_pregunta'] = $_GET['id'];  
	}

	if($_POST['txtid'] != '')
	{ 
	    $datos['id_pregunta'] = $_POST['txtid'];    
	}

	$rec = $c_sistema->obtenerPregunta($datos);
	$destino = "index.php?sub=pre&op=lis";
	
	if(isset($_POST['btnenviar']))
	{

		if(	$_POST['txtrespuesta']	!= $rec['respuesta'] )			
		{
			$resultado = $c_sistema->actualizarRespuesta($_POST);

			if($resultado['codigo']=='000')		
			{
				$datos['tipo'] 		= 'exito';
				$datos['titulo'] 	= 'Registro Exitoso! ';	
				$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';
				
				echo'<script type="text/javascript">window.location.href = "'.$destino.'";</script>';
			}			
		}
		else
		{
			echo'<script type="text/javascript">window.location.href = "'.$destino.'";</script>';
		}
	}
	

?>
<script>
    $(function(){

    	
    });
</script>


<br><br>
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=pre&op=rep" method="POST">
	    <fieldset>
	      <legend>Responder</legend>

	      <div class="form-group">
	        <label for="txtcom" class="col-lg-2 control-label"><a><?=$rec['nombre_usuario_r'];?></a></label>
	        <div class="col-lg-10">
	          <b><?=$rec['pregunta'];?></b>
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtrespuesta" class="col-lg-2 control-label">Tu respuesta</label>
	        <div class="col-lg-10">
	          <textarea class="form-control" id="txtrespuesta" name="txtrespuesta" rows="4" ><?=$rec['respuesta'];?></textarea>
	        </div>
	      </div>

	      <div class="form-group text-right">
	        <div class="col-lg-10 col-lg-offset-2">				
	        	<input type="hidden" name="txtid" id="txtid" value="<?=$rec['id_pregunta'];?>" />
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Responder</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>

