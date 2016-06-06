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
	  <a href="fundadores/panel/ganancias" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Ganancias   </a>	  
	  <a href="fundadores/panel/preguntas" class="list-group-item"><img src="img/photo-32.png" width="24" /> Preguntas Frecuentes <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>
	  <a href="fundadores/terminos" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> T&eacute;rminos y condiciones</a>  
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<h3>Preguntas frecuentes</h3>
		<hr>

		<b class="f14 text-info">Ya soy cliente fundador, y ahora qu&eacute;?</b><br>
		<span class="text-muted">
			Ahora que ya eres un usuario fundador, es hora de ganar dinero. Invita a tus amigos y comparte tu enlace de referencia 
			en las redes sociales para dar a conocer el sitio. Recuerda que por cada usuario que se registre en mypack llevas comisi&oacute;n. 
		</span>

		<hr>

		<b class="f14 text-info">cuanto voy a ganar?</b><br>
		<span class="text-muted">
			Actualmente la comisi&oacute;n  por usuario registrado es de $ 0.30 Moneda nacional (M&eacute;xico). S&iacute; eres de argentina,
			uruguay, colombia o de cualquier otro pais de america latina al realizar el dep&oacute;sito se hace la conversion de divisas. <br>
			Dependiendo de la eficacia de este servicio, es posible que la comision suba. Aunque tambi&eacute;n es probable que baje. Recuerden que todo es posible.

		</span>

		<hr>

		<b class="f14 text-info">Como se realizan los pagos?</b><br>
		<span class="text-muted">
			Los pagos se realizan por tranferencia bancaria. Para ello es necesario registrar una CLABE bancaria para poder realizar la tranferencia.
			Los pagos solo se realizaran a los usuarios que hallan cumplido los terminos y condiciones del servicio y que cuente con el monto minimo para realizar retiros.
		</span>

		<hr>

		<b class="f14 text-info">Cu&aacute;l es el monto minimo para retirar?</b><br>
		<span class="text-muted">
			El monto minimo para retirar son $ 20.00
		</span>

		<hr>

		<b class="f14 text-info">No tengo tarjeta de d&eacute;bito, como puedo retirar mi dimero?</b><br>
		<span class="text-muted">
			Contar con una tarjeta de debito es muy importante, si no cuentas con una puedes pedirle una prestada a un amigo. 

		</span>

		<br><br><br><br><br><br>


		
	</div>
</div>