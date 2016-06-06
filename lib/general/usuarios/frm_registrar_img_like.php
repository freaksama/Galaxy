<?
	session_start();
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	
	
	$rec   = $c_sistema->obtenerDatosUsuario2($datos);


	

	
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

		$(".lk-img-like").click(function(){
			var img = $(this).data('img');
			actualizar_img_like_user(img);
		});
		
	});	//fin de ready	

	function actualizar_img_like_user(img)
    {
        dataString = 'opcion=act_img_like&img=' + img;

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
                            //alert('Like actualizado ');
                            $("#avatar_actual").attr('src',img);
                            
                        }
                        else
                        {
                            alert('Ocurrio un error al registrar');   
                        }
                    },
            timeout:3000,
            type:"POST"
        });
    }
	
</script>	

<?=$mensaje;?>
<br><br>
<div class="col-lg-3">
	<div class="list-group">
	  <a href="#" class="list-group-item active">Configuraci&oacute;n</a>
	  <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta </span></a>	  
	  <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos</a>
	  <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Inicio y publicaciones </a>
	  <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" /> Foto de perfil</a>
	  <a href="index.php?sub=cue&op=fon" class="list-group-item"><img src="img/photo-32.png" width="24" /> Fondo Web</a>
	  <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
	  <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password</a>
	  <a href="index.php?sub=cue&op=tem" class="list-group-item"><img src="img/themes-32.png" width="24" /> Cambiar Tema</a>
	  <a href="index.php?sub=cue&op=like" class="list-group-item"><img src="img/question-128.png" width="24" /> Imagen Like <span style="float:right;"><img src="img/bullet_blue1.png" /></a>
	</div>
</div>

<div class="row">
<div class="col-lg-6">
	<div class="well bs-component">
	  <form class="form-horizontal" action="index.php?sub=cue&op=act" method="POST">
	    <fieldset>
	      <legend>
	      	<div class="text-right"><img  id="avatar_actual" src="<?=$rec['img_like'];?>"  /></div>
	      Nueva Imagen Like </legend>
	      
	      	<a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/like.png" style="text-decoration:none;">
                <img src="src/likes/like.png" style="width:24px;height:24px;margin:5px"  />
            </a> 

	      	<a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/megaman.gif" style="text-decoration:none;">
                <img src="src/likes/megaman.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

             <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/anime.gif" style="text-decoration:none;">
                <img src="src/likes/anime.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/bomba.gif" style="text-decoration:none;">
                <img src="src/likes/bomba.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/brinco.gif" style="text-decoration:none;">
                <img src="src/likes/brinco.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/brinco2.gif" style="text-decoration:none;">
                <img src="src/likes/brinco2.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/d2.gif" style="text-decoration:none;">
                <img src="src/likes/d2.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/deli.gif" style="text-decoration:none;">
                <img src="src/likes/deli.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/facebook.gif" style="text-decoration:none;">
                <img src="src/likes/facebook.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/fantasma.gif" style="text-decoration:none;">
                <img src="src/likes/fantasma.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/fantasma2.gif" style="text-decoration:none;">
                <img src="src/likes/fantasma2.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/foto.gif" style="text-decoration:none;">
                <img src="src/likes/foto.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/jessica.gif" style="text-decoration:none;">
                <img src="src/likes/jessica.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

        

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/loc.gif" style="text-decoration:none;">
                <img src="src/likes/loco.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/maggie.gif" style="text-decoration:none;">
                <img src="src/likes/maggie.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/musica.gif" style="text-decoration:none;">
                <img src="src/likes/musica.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/nino.gif" style="text-decoration:none;">
                <img src="src/likes/nino.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/pacman.gif" style="text-decoration:none;">
                <img src="src/likes/pacman.gif" style="width:24px;height:24px;margin:5px"  />
            </a>


            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/rombo.gif" style="text-decoration:none;">
                <img src="src/likes/rombo.gif" style="width:24px;height:24px;margin:5px"  />
            </a>

            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/shimakaze_dot.gif" style="text-decoration:none;">
                <img src="src/likes/shimakaze_dot.gif" style="width:24px;height:24px;margin:5px"  />
            </a>


            <a href="javascript:void(0)" class="lk-img-like" data-img="src/likes/star2.gif" style="text-decoration:none;">
                <img src="src/likes/star2.gif" style="width:24px;height:24px;margin:5px"  />
            </a>



	      	

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