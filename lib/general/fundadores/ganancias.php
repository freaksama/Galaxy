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

		$("#btnenviar").click(function(){
			if($("#txtcorreo").val()=='')
			{
				alert("El correo no puede estar vacio");
				return false;
			}

			var correo  = $("#txtcorreo").val();
			var mensaje = '';

			enviar_correo_invitacion_fundador(correo,mensaje);
		});
		
	});	//fin de ready	

	function enviar_correo_invitacion_fundador(correo,mensaje)
	{
        dataString = 'opcion=env_cor_inv_fun' + '&correo=' + correo + '&mensaje=' + mensaje ;

        $.ajax({
            url: "ajax/ajax.php",
            data: dataString,
            async:true,
            beforeSend: function(ob){ /*$("#msj").html("<img src='img/load_05.gif' align='top' border='0' />");*/},
            complete: function (ob,exito){},
            dataType:"html",        
            global:true,
            success:function(data)
                    {
                        var r = jQuery.parseJSON(data);
                        
                        if(r.codigo =='000')
                        {
                        	$("#txtcorreo").val('');
                        	$("#ms").fadeIn();
                        	setInterval(function(){ $("#ms").fadeOut();},2000);       

                        }
                        else
                        {
                            alert('Ocurrio un error');   
                        }
                    },
            timeout:3000,
            type:"POST"
        });
	}
	
</script>	


<br>
<div class="col-lg-3">
	<div class="list-group">
	  <a href="" class="list-group-item active">Configuraci&oacute;n</a>
	  <a href="fundadores/panel" class="list-group-item"><img src="img/user-32.png" width="24" /> Invitaciones </a>	  
	  <a href="fundadores/panel/estadisticas" class="list-group-item"><img src="img/31-32.png" width="24" /> Estadisticas</a>
	  <a href="fundadores/panel/usuarios" class="list-group-item"><img src="img/list-32.png" width="24" /> Usuarios invitados</a>
	  <a href="fundadores/panel/ganancias" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Ganancias  <span style="float:right;"><img src="img/bullet_blue1.png" /></span> </a>	  
	  <a href="fundadores/panel/preguntas" class="list-group-item"><img src="img/photo-32.png" width="24" /> Preguntas Frecuentes</a>
	  <a href="fundadores/terminos" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> T&eacute;rminos y condiciones</a>
	</div>
</div>

<div class="row">
<div class="col-lg-6">

	<div id="ms" class="alert alert-dismissible alert-success" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Exito!</strong> 
        Invitaci&oacute;n enviada exitosamente.
    </div>

	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=act" method="POST">
	    <fieldset>	      
	      	<br><br>
	      	<div class="form-group">	        	
	        	<div class="col-lg-12">
	        		<span class="f28">Ganacias Acumuladas 
	          			<span class="text-success"><b><?='$ '.number_format(((int)$rec['usuarios']*0.3),2)?> MX</b></span>
	          		</span>

	        	</div>
	      	</div>
	      	<br>
	      	<hr>

	      	<div class="form-group">
	        <label for="txtbio" class="col-lg-3 control-label">Cobrar Dinero</label>
	        <div class="col-lg-8"  style="padding-top: 11px;">	          	          
	          <span class="text-muted">
	          	Para cobrar tu dinero es necesario contar con un numero de tarjeta de debito. 
	          	<br><br>
	          	El monto minimo para retirar tu dinero es de $ 20.00 
	          </span>
	        </div>
	      </div>

	      <hr>
	      <br><br>
	      <div class="text-center">
		    <?
		    	if(((int)$rec['usuarios']*0.3)< 20)
		    	{
		    		?>
		    			<a class="btn btn-lg btn-default">Aun no puedes retirar tu dinero</a>
		    		<?
		    	}
		    	else
		    	{
		    		?>
		    			<a class="btn btn-lg btn-primary">Retirar dinero</a>
		    		<?
		    	}
		    ?>
	    	</div>


	    </fieldset>
	  </form>
	</div>
</div>
</div>