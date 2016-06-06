<?
	
	$destino = "index.php?sub=sex&op=lis";

	

	if(isset($_POST['btnenviar']))
	{

		if(	$_POST['txtnombre']	!= '' )			
		{
			$resultado = $c_sistema->registrarSexo($_POST);
			if($resultado['codigo']=='000')		
			{
				/*
				$datos['tipo'] 		= 'exito';
				$datos['titulo'] 	= 'Registro Exitoso! ';	
				$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';
				*/

				//$c_sistema->generarMensaje($datos);

				echo'<script type="text/javascript">window.location.href = "'.$destino.'";</script>';
			}
			else
			{

			}
		}
	}

	

?>
<script>
    $(function(){

    	$('#txttags').tagit();
    });
</script>

<ul class="nav nav-tabs">
  <li class="active"><a href="index.php?sub=sex&op=reg"><img src="img/new.png"  width="20" />  Registrar Genero</a></li>
  <li><a href="index.php?sub=sex&op=lis"><img src="img/listado.png" width="24" /> Listado Generos</a></li>  
</ul>

<br><br>
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=sex&op=reg" method="POST">
	    <fieldset>
	      <legend>Registro de Genero</legend>

	      <div class="form-group">
	        <label for="inputEmail" class="col-lg-2 control-label">Nombre</label>
	        <div class="col-lg-10">
	          <input type="text" class="form-control input-sm"id="txtnombre" name="txtnombre" />
	        </div>
	      </div>
	      
	      <div class="form-group">
	        <div class="col-lg-12 text-right">
	          <button class="btn btn-default">Cancelar</button>
	          <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Registrar Genero</button>
	        </div>
	      </div>

	    </fieldset>
	  </form>
	</div>
</div>
</div>