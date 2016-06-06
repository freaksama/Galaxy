<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];

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
	  <a href="fundadores/panel" class="list-group-item"><img src="img/user-32.png" width="24" /> Invitaciones <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>	  
	  <a href="fundadores/panel/estadisticas" class="list-group-item"><img src="img/31-32.png" width="24" /> Estadisticas</a>
	  <a href="fundadores/panel/usuarios" class="list-group-item"><img src="img/list-32.png" width="24" /> Usuarios invitados</a>
	  <a href="fundadores/panel/ganancias" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Ganancias </a>	  
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
	      <legend>Invitaciones a Mypack</legend>      	   

	      	<div class="text-center">

	      		<a href="http://www.facebook.com/sharer.php?u=<?=urlencode('http://mypack.me/index.php?id_ref='.$datos['id_usuario']);?>&t=My Pack, comparte lo que te gusta ;)" target="_blank">
                    <img src="img/facebook-64.png" style="margin-right:20px;" />
                </a>

                <a href="https://twitter.com/intent/tweet?url=<?=urlencode('http://mypack.me/index.php?id_ref='.$datos['id_usuario']);?>&text=My Pack, comparte lo que te gusta ;)%20"  target="_blank">
                    <img src="img/twitter-64.png" style="margin-right:20px;" />
                </a>

                <a href="javascript:var dir=window.document.URL;var dir2=encodeURIComponent('http://mypack.me/index.php?id_ref=<?=$datos['id_usuario'];?>');var tit=window.document.title;var tit2=encodeURIComponent(tit);bb=window.open('http://www.tumblr.com/share?s=&t='+tit2+'&u='+dir2+'&v=3','','width=600,height=400,left=50,top=50');location.bb;">
                    <img src="img/tumblr-64.png" style="margin-right:20px;" />
                </a>

                <a href="https://plus.google.com/share?url=http://mypack.me/index.php?id_ref=<?=$datos['id_usuario'];?>"  target="_blank">
                    <img src="img/googleplus-64.png" style="margin-right:20px;" />
                </a>                

                <a href="javascript:void(window.open('http://www.reddit.com/submit?url='+encodeURIComponent('http://mypack.me/index.php?id_ref=<?=$datos['id_usuario'];?>')+'&title='+escape(document.title),'','width=900,height=800,left=50,top=50'));void(0)">                        
                    <img src="img/reddit-64.png" style="margin-right:20px;" />
                </a>
            </div>

	      	<hr>

	      	<h4>Invitaci&oacute;n por correo</h4>

	      	<div class="form-group">
	        	<label for="txtcorreo" class="col-lg-2 control-label">Correo</label>
	        	<div class="col-lg-9">
	          		<input type="text" class="form-control  input-sm" id="txtcorreo" name="txtcorreo"/>
	        	</div>
	      	</div>

	      	<div class="form-group text-right">
	        	<div class="col-lg-9 col-lg-offset-2">
	          		<a  href="javascript:void(0)" class="btn btn-default">Cancelar</a>
	          		<a  name="btnenviar" id="btnenviar" class="btn btn-primary">Enviar Correo</a>
	        	</div>
	      	</div>
	      	<hr>

	      	<div class="form-group">
	        <label for="txtbio" class="col-lg-3 control-label">Link Referencia</label>
	        <div class="col-lg-8"  style="padding-top: 11px;">
	          <a href="http://mypack.me/index.php?id_ref=<?=$datos['id_usuario'];?>" >http://mypack.me/index.php?id_ref=<?=$datos['id_usuario'];?></a>
	          <br><br>
	          <span class="text-muted">
	          	Todos los usuarios que ingresen a mypack por medio de este link quedar&aacute;n referenciados a tu cuenta en automaticos.
	          	<br><br>
	          	Puedes usar este link para recomendarnos foros y redes sociales. 
	          </span>
	        </div>
	      </div>


	    </fieldset>
	  </form>
	</div>
</div>
</div>