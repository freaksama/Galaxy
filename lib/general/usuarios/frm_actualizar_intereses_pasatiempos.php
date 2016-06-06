<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	
	
	$rec   = $c_sistema->obtenerPasatiemposUsuario($datos);


	

	if(isset($_POST['btnenviar']))
    {   
        if( $rec['peliculas'] 	!= $_POST['txtpeliculas'] 	||
        	$rec['musica'] 		!= $_POST['txtmusica'] 	||
        	$rec['videojuegos'] != $_POST['txtvideojuegos'] 	||
        	$rec['libros'] 		!= $_POST['txtlibros'] 	||
        	$rec['otros'] 		!= $_POST['txtotros'] )
        {

        	$resultado = $c_sistema->actualizarPasatiemposUsuario($_POST);



        	if($resultado['codigo']=='000')       
	        {
	        	unset($_POST);

	        	$rec   = $c_sistema->obtenerPasatiemposUsuario($datos);

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

    


    //print_r($rec);

    

	
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
	  <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta </a>	  
	  <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>
	  <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Inicio y publicaciones </a>
	  <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" /> Foto de perfil</a>	  
	  <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
	  <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password</a>	  
	</div>
</div>

<div class="row">
<div class="col-lg-6">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=inte" method="POST">
	    <fieldset>
	      <legend>Actualizar Intereses y pasatiempos</legend>
			
			<div class="form-group" >
	        	<p  class="col-lg-9">Recuerda separar cada pelicula o videojuego con una coma (,).</p>
	      	</div>	      

	      <div class="form-group">
	        <label for="txtnombrereal" class="col-lg-2 control-label">Peliculas</label>
	        <div class="col-lg-9">
	          <textarea class="form-control  input-sm" id="txtpeliculas" name="txtpeliculas" rows="5" maxlength="2048" ><?=$rec['peliculas'];?></textarea>
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtnombre" class="col-lg-2 control-label">M&uacute;sica</label>
	        <div class="col-lg-9">
	          <textarea class="form-control  input-sm" id="txtmusica" name="txtmusica" rows="5" maxlength="2048" ><?=$rec['musica'];?></textarea>
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtcorreo" class="col-lg-2 control-label">Video Juegos</label>
	        <div class="col-lg-9">
	          <textarea class="form-control  input-sm" id="txtvideojuegos" name="txtvideojuegos" rows="5" maxlength="2048" ><?=$rec['videojuegos'];?></textarea>
	        </div>
	      </div>

	      <div class="form-group">
	        <label for="txtbio" class="col-lg-2 control-label">Libros</label>
	        <div class="col-lg-9">
	          <textarea class="form-control  input-sm" id="txtlibros" name="txtlibros" rows="5" maxlength="2048" ><?=$rec['libros'];?></textarea>
	        </div>
	      </div>
	       

	       <div class="form-group">
	        <label for="txtsexo" class="col-lg-2 control-label">Otros</label>
	        <div class="col-lg-9">
	          <textarea class="form-control  input-sm" id="txtotros" name="txtotros" rows="5" maxlength="2048" ><?=$rec['otros'];?></textarea>
	        </div>
	       </div>

	       

	      	

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