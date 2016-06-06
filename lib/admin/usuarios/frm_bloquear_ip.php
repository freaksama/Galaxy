<?
	
	

	$destino = "index.php?sub=adm&op=visi";

	

	if(isset($_POST['btnenviar']))
	{

		if(	$_POST['txtip']	!= '' )			
		{
			$resultado = $c_sistema->bloquearIP($_POST);
			if($resultado['codigo']=='000')		
			{
				$datos['tipo'] 		= 'exito';
				$datos['titulo'] 	= 'Registro Exitoso! ';	
				$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';

				//$c_sistema->generarMensaje($datos);
				if($_POST['op2']=='dash')
				{
					echo'<script type="text/javascript">window.location.href = "index.php?sub=adm&op=ipbloc";</script>';
				}
				else
				{
					echo'<script type="text/javascript">window.location.href = "index.php?sub=adm&op=ipbloc";</script>';
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
	  <form class="form-horizontal" action="index.php?sub=adm&op=blip" method="POST">
	    <fieldset>
	      <legend>Bloquear IP</legend>

	      <div class="form-group">
	        <label for="txtip" class="col-lg-2 control-label">IP</label>
	        <div class="col-lg-10">
	          <input type="text" class="form-control" id="txtip" name="txtip" value="<?=$_GET['ip'];?>" />
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtcom" class="col-lg-2 control-label">Motivo</label>
	        <div class="col-lg-10">
	          <textarea class="form-control" id="txtcom" name="txtcom" rows="4" ></textarea>
	        </div>
	      </div>

	      
	      

	      <div class="form-group text-right">
	        <div class="col-lg-10 col-lg-offset-2">
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Bloquear</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>