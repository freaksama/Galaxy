<?
	
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	$datos['last']	=	'';
	$links 	= $c_sistema->listadoNotificacionesUsuario($datos);
	
	$datos['id_ult_not'] = $links[0]['id_notificacion'];
	$_SESSION['s']['id_last_n'] = $datos['id_ult_not'];

	$c_sistema->actualizarUltNotificacion($datos);

	//$dash        = $c_sistema->obtenerDatosDashboardUsuario();
	//$user_seguir = $c_sistema->listadoUsuariosParaSeguir();

	//print_r($_SESSION);
	//$reg   = $c_sistema->obtenerDatosUsuario2($datos);
	//print_r($links);



?>

<script type="text/javascript">


 $(document).ready(function(){
 	
 	$(".lk_del").click(function(){
    	if(confirm('Realmente desea eliminar este link??'))
    	{
    		var idc = $(this).attr('id');
    		var id  = idc.substr(4) ;    	
    		eliminar_link(id);
    		return false;
    	}
    	else
    	{
    		return false;
    	}
    	
    });

    $("#txtgrupo").change(function(){
    	$(".grupos").hide();
    	$(".g_"+$(this).val()).fadeIn();
    });

    $(document).on("click",".lk_seg",function(){

        var idc = $(this).attr('id');
        var id  = idc.substr(3); 

        if(loginredirect())
        {
            seguir_usuario(id);
            return false;
        }

    });
    	
});

 function loginredirect()
    {
        if("<?=$_SESSION['s']['id_usuario'];?>" == "")
        {
            window.location.href = "index.php?op=login&redirec=dash";
            return false;
        }

         return true;
    }

 function seguir_usuario(id)
    {
        var usuario = id;
        dataString = 'opcion=seguir_usuario&id=' + usuario;

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
                            $("#v_user"+id).fadeOut();
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


function eliminar_link(id)
{
	dataString = 'opcion=eliminarLink&id=' + id;

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
						//reload();
						$("#tr"+id).hide();
					}
					else
					{
						//alert('Ocurrio un error al registrar');	
					}
				},
		timeout:3000,
		type:"POST"
	});
}

</script>


<div class="text-center">
	<h4>&Uacute;ltimas Notificaciones</h4>
</div>



<div class=" col-lg-8 col-lg-offset-2">
    
<table class="table table-hover">
	
	<?
		if(count($links)>0)
		{
			foreach($links as $rec)
			{
				$link = '';
				if (file_exists("src/avatar/48/".$rec['id_usuario'].".jpg"))
			    {
			    	$avatar ='src/avatar/48/'.$rec['id_usuario'].'.jpg?op='.rand(); 
			      
			   	}
			   	else
			   	{
			    	$avatar = 'img/user.png ';    
			   	}

			    if($rec['id_tipo_contenido']=='1')
				{
					$link  = '<a href="index.php?op=ver&id='.$rec['id_ref'].'">'.$rec['nombre'].'</a>';
				}

				if($rec['id_tipo_contenido']=='2')
				{
					$link  = '<a href="index.php?op=ver&id='.$rec['id_ref'].'" style="text-decoration:none">
							  	<img src="'.str_replace('src/pic/img/','src/pic/640/',$rec['src']).'" class="" style="max-width: 64px;" />
							  </a>';
				}
                if($rec['id_tipo_contenido']=='3')
				{
                    $video      = $c_sistema->parse_youtube_url($rec['codigo'],'hqthumb');
                    
                    

                    if($video=='codigo_embed')
                    {
                        $video      = 'img/mini_video.png';
                        $cod_video  = $rec['codigo'];
                    }
                    else
                    {
                        //$cod_video  = $c_sistema->parse_youtube_url($rec['codigo'],'embed');    
                    }
                    
                    $link = 'tu video <img  src="'.$video.'" width="64" class="mini" /><span class="text-muted">&Prime; '.preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']).'&Prime;</span>';

                        
				}
                
                if($rec['id_tipo_contenido']=='6')
                {
                    $link = ' en tu estado <span class="text-primary">'.$rec['descripcion'].';</span>';
                }


                if($rec['id_usuario']=='' || $rec['id_usuario']=='0')
                {
                	$rec['nombre_usuario'] = 'Anonimo';
                	$lk_user 	= '<span class="text-info">'.$rec['nombre_usuario'].'</span>';
                	$lk_avatar 	=  '<img src="'.$avatar.'" style="width:32px" />';
                }
                else
                {
                	$lk_user 	= '<a href="index.php?u='.$rec['nombre_usuario'].'" style="text-decoration:none;">@'.$rec['nombre_usuario'].'</a>';
                	$lk_avatar 	= '<a href="index.php?u='.$rec['nombre_usuario'].'" style="text-decoration:none;"><img src="'.$avatar.'" style="width:32px" /></a>';
                }

                //print_r($rec);


				?>
					<tr id="tr<?=$rec['id_link'];?>"   >
						<td>

							

							<?
								switch ($rec['id_tipo_notificacion']) 
								{
									case '1':
									?>
										<?=$lk_avatar;?>
										<?=$lk_user;?>
										<span class=""><?=$rec['detalles'];?></span> 									
										tu publicaci&oacute;n 
										<?=$link;?>
										<span class="text-muted"><?=$c_sistema->hace($rec['fecha']);?></span>
									<?	
									break;

									case '2':
									?>
										<?=$lk_avatar;?>
										<?=$lk_user;?>
										<span class=""><?=$rec['detalles'];?></span> 
										<?=$link;?>
										<span class="text-muted"><?=$c_sistema->hace($rec['fecha']);?></span>
										
									<?
									break;
									case '3':
									?>
										<?=$lk_avatar;?>
										<?=$lk_user;?>
										Coment&oacute;
										<span class="text-muted">&Prime;<?=$rec['detalles'];?>&Prime;</span>
										<?=$link;?>
										<span class="text-muted"><?=$c_sistema->hace($rec['fecha']);?></span>
									<?
									break;

									case '9':
									?>
										<?=$lk_avatar;?>
										<?=$lk_user;?>										
										<?=$rec['detalles'];?>
										
										<span class="text-muted"><?=$c_sistema->hace($rec['fecha']);?></span>
									<?
									break;
									
									
								}
							?>
						
						<?/*

							switch($rec['id_tipo_notificacion'])
							{	
							
								case '2':

								?>
									<a href="index.php?sub=cue&op=per&usuario=<?=$rec['nombre_usuario'];?>">
										@<?=$rec['nombre_usuario'];?>
									</a>									
									<span class=""><?=$rec['detalles'];?></span> 
									<?=$link;?>
									<span class="text-muted"><?=$c_sistema->hace($rec['fecha']);?></span>
									
								<?
								break;
								case '3':
								?>
									<a href="index.php?sub=cue&op=per&usuario=<?=$rec['nombre_usuario'];?>">
										@<?=$rec['nombre_usuario'];?>
									</a>
									<span class="text-muted">Coment&oacute;</span>			
									<?=$rec['detalles'];?>
									<?=$link;?>
									<span class="text-muted"><?=$c_sistema->hace($rec['fecha']);?></span>
								<?

								case '9':
								?>
									<a href="index.php?u=<?=$rec['nombre_usuario_seguidor'];?>">
										@<?=$rec['nombre_usuario_seguidor'];?>
									</a>
									<?=$rec['detalles'];?>
									<?=$link;?>
									<span class="text-muted"><?=$c_sistema->hace($rec['fecha']);?></span>
								<?


								break;								
							}*/
						?>
							
						</td>								
					</tr>
				<?
			}
		}
	?>	
</table>
</div>
<br>
