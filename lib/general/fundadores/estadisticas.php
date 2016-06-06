<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];

	$rec = $c_sistema->estadisticasFundadores($datos);

	if($_SESSION['s']['tipo_usuario']!= '3')
	{
		echo'<script type="text/javascript">window.location.href = "error_404";</script>';  
	}
	
	
	
?>



<script type="text/javascript">	
	
	$(function(){

		
		
	});	//fin de ready	
	
</script>	


<br>
<div class="col-lg-3">
	<div class="list-group">
	  <a href="" class="list-group-item active">Configuraci&oacute;n</a>
	  <a href="fundadores/panel" class="list-group-item"><img src="img/user-32.png" width="24" /> Invitaciones </a>	  
	  <a href="fundadores/panel/estadisticas" class="list-group-item"><img src="img/31-32.png" width="24" /> Estadisticas <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>
	  <a href="fundadores/panel/usuarios" class="list-group-item"><img src="img/list-32.png" width="24" /> Usuarios invitados</a>
	  <a href="fundadores/panel/ganancias" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Ganancias </a>	  
	  <a href="fundadores/panel/preguntas" class="list-group-item"><img src="img/photo-32.png" width="24" /> Preguntas Frecuentes</a>
	  <a href="fundadores/terminos" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> T&eacute;rminos y condiciones</a>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">

		<div class="panel panel-primary">

	      <div class="panel-heading">
	        <h3 class="panel-title">Estad&iacute;sticas Generales</h3>
	      </div>
	      <div class="panel-body">
	        <table class="table">
	        	 <tr>
	                <td>Ganancias</td>
	                <td><span class="text-info"><b><?='$ '.number_format(((int)$rec['usuarios']*0.3),2)?> MX</b></span></td>
	            </tr>           
	            <tr>
	                <td>Invitaciones Enviadas</td>
	                <td><span class="text-info"><?=$rec['invitaciones']?></span></td>
	            </tr>
	            <tr>
	                <td>Usuarios Registrados</td>
	                <td><span class="text-info"><?=$rec['usuarios']?></span></td>
	            </tr>
	            <tr>
	                <td>Visitas al perfil</td>
	                <td><span class="text-info"><?=$rec['visitas_perfil']?></span></td>
	            </tr>
	            <tr>
	                <td>Publicaciones</td>
	                <td><span class="text-info"><?=$rec['num_post']?></span></td>
	            </tr>	                                   
	        </table>
	      </div>
	    </div>  	
	</div>
</div>