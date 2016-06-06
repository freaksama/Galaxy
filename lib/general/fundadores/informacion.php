<script type="text/javascript">
	$(function(){

		$("#lk_1").click(function(){
			$("#prin").hide();
			$("#cara").fadeIn();
		});

		$("#lk_aceptar").click(function(){
			registrar_usuario_fundador();
		});
	});

	function registrar_usuario_fundador()
	{
        dataString = 'opcion=reg_usu_fun';

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
                        	$("#cara").hide();
                        	$("#t").hide();
                            $("#bienvenido").fadeIn();
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
<?
	
?>
<h1 id="t" class="text-center">Mypack Fundadores</h1>

<div class="col-lg-8 col-lg-offset-2	"  >	
	<div id="prin">
		<br>
		<!--span class="text-info f18">Una excelente manera de ganar dinero mientras haces lo que te gusta ;)</span-->
			
		<h3>
			Mypack fundadores es una estupenda manera de ganar dinero mientras pasas tu tiempo en mypack. 
			<br>
			<br>
			Funciona de una manera muy f&aacute;cil: Solo tienes que invitar a tus amigos a unirse a mypack. Por medio de un correo
			o a partir de una liga que nosotros te proporcionaremos. 
			<br>
			<br>
			S&iacute; quieres conocer los detalles del servicio da clic al bot&oacute;n. 
			<br><br>
			<div class="text-center">
				<a id="lk_1" class="btn btn-primary">Continuar</a>
			</div>
		</h3>		
	</div>

	<div id="cara" style="display:none;">
		<div class="text-center">
			<h3>Caracter&iacute;sticas</h3>
		</div>

		<p>
			Para poder ganar dinero en mypack deben ser usuarios fundadores. Para ello debes leer y aceptar los t&eeacute;rminos y condiciones 
			de este nuevo servicio que ofrece mypack. 
			<br><br>
			Los usuarios fundadores ganaran $ 0.30 por cada usuario registrados. Moneda nacional (M&eacute;xico).
			<br><br>
			Para ello los usuarios de mypack enviar&aacute;n un correo a un amigo y este deben registrarse con la liga del correo. 
			Este punto es importante, porque es la manera saber que usuario se registr&oacute; con tu invitaci&oacute;n.
			<br><br>
		 	El monto minimo para realizar retiros de ingresos es de $ 20.00 por medio de una trasferencia bancaria.		 	
		 	<br><br>
		 	Los usuarios fundadores tendr&aacute;n una pantalla de monitoreo de su cuenta con gr&aacute;ficas y cantidad de dinero ganado. 		 	
		 	<br><br>
		 	Para evitar que los usuarios dupliquen informaci&oacute;n, o registren cuentas basura, habr&aacute; reglas sobre estas invitaciones.
		 	Siendo la m&aacute;s importante que el correo sea v&aacute;lido.  
		 	<br><br>
		 	No se permiten registrar cuentas con correos que solo duran 10 minutos. 
		 	<br><br>
		 	Estas son algunas de las reglas de este nuevo servicio de mypack. 
		 	<br><br>
		 	<b>Por favor te pedimos que leas el contrato de t&eacute;rminos y condiciones
		 	antes continuar leyendo. </b>
		 	<a href="fundadores/terminos">T&eacute;rminos y condiciones </a>
		 	<br><br>
		 	<div class="text-center">
		 		<a id="lk_aceptar" class="btn btn-primary">Acepto los T&eacute;rminos y Continuar </a>
		 	</div>
		</p>
	</div>

	<div id="bienvenido" style="display:none">
		<br><br><br>
		<div class="text-center">
			<h1>Bienvenido a Mypack Fundadores</h1>
			<br><br><br>
			<div class="text-center">
				<a href="fundadores/panel" class="btn btn-primary">Ir al panel principal</a>
			</div>
		</div>
		<br><br><br>

	</div>
</div>