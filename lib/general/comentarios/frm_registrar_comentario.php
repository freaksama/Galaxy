<?
	
	if($_GET['id'] != '')
	{
	  	$datos['id_contenido'] = $_GET['id'];  
	}

	if($_POST['txtid'] != '')
	{ 
	    $datos['id_contenido'] = $_POST['txtid'];    
	}

	//$rec = $c_sistema->obtenerComentario($datos);

	$rec = $c_sistema->obtenerContenidoGeneral($datos);

	$destino = "index.php?sub=link&op=det&id=".$rec['id_ref'];

	

	if(isset($_POST['btnenviar']))
	{

		if(	$_POST['txtcom']	!= '' )			
		{
			$resultado = $c_sistema->registrarComentario($_POST);
			if($resultado['codigo']=='000')		
			{
				$datos['tipo'] 		= 'exito';
				$datos['titulo'] 	= 'Registro Exitoso! ';	
				$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';

				//$c_sistema->generarMensaje($datos);
				if($_POST['op2']=='dash')
				{
					echo'<script type="text/javascript">window.location.href = "dashboard";</script>';
				}
				else
				{
					echo 'error al registrar';
				}
				
			}
			else
			{

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

    	$('#txttags').tagit();
    });
</script>


<br><br>
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
	<div class="well bs-component">
	  <form class="form-horizontal" action="registrar/comentario/post/<?=$_GET['id'];?>" method="POST">
	    <fieldset>
	      <legend>Registrar Nuevo Comentario</legend>

	      

	      <div class="form-group">
	        <label for="txtcom" class="col-lg-2 control-label">Comentario</label>
	        <div class="col-lg-10">
	          <textarea class="form-control" id="txtcom" name="txtcom" rows="4" ><?=$rec['comentario'];?></textarea>
	        </div>
	      </div>

	      
	      

	      <div class="form-group text-right">
	        <div class="col-lg-10 col-lg-offset-2">
				<input type="hidden" name="op2" id="op2" value="<?=$_GET['op2'];?>" />
	        	<input type="hidden" name="txtid" id="txtid" value="<?=$rec['id_contenido'];?>" />
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Registrar</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>