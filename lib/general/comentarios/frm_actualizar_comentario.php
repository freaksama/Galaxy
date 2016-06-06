<?
	
	if($_GET['id'] != '')
	{
	  	$datos['id_comentario'] = $_GET['id'];  
	}

	if($_POST['txtid'] != '')
	{ 
	    $datos['id_comentario'] = $_POST['txtid'];    
	}

	 $rec = $c_sistema->obtenerComentario($datos);

	$destino = "index.php?sub=link&op=det&id=".$rec['id_ref'];

	

	if(isset($_POST['btnenviar']))
	{

		if(	$_POST['txtcom']	!= $rec['comentario'] )			
		{
			$resultado = $c_sistema->actualizarComentario($_POST);
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
	  <form class="form-horizontal" action="index.php?sub=com&op=act" method="POST">
	    <fieldset>
	      <legend>Actualizar Comentario</legend>

	      

	      <div class="form-group">
	        <label for="txtcom" class="col-lg-2 control-label">Comentario</label>
	        <div class="col-lg-10">
	          <textarea class="form-control" id="txtcom" name="txtcom" rows="4" ><?=$rec['comentario'];?></textarea>
	        </div>
	      </div>

	      
	      

	      <div class="form-group text-right">
	        <div class="col-lg-10 col-lg-offset-2">
				<input type="hidden" name="op2" id="op2" value="<?=$_GET['op2'];?>" />
	        	<input type="hidden" name="txtid" id="txtid" value="<?=$rec['id_comentario'];?>" />
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Actualizar</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>