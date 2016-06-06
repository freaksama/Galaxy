<?
	
	$datos['id_usuario'] = $_GET['id'];
	if($datos['id_usuario']=='')
	{
		$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	}
	else
	{
		//$datos['id_usuario'] = Encrypter::desencriptar($datos['id_usuario']);
	}
	$datos['id_usuario_2'] = $datos['id_usuario'];
	$reg    = $c_sistema->obtenerDatosUsuario2($datos);	
	$result = $c_sistema->listadoLinksPublicos($datos);	
	$seg 	= $c_sistema->validarSeguidor($datos);

	

	$resultado = $result['datos'];

	$temp['tipo_comentario'] = '1';	

	$avatar_actual = 'img/icon-user.png';
    if (file_exists("img/avatar/48/".$_SESSION['s']['id_usuario'].".jpg"))
    {
	   $avatar_actual ='img/avatar/48/'.$_SESSION['s']['id_usuario'].'.jpg?op='.rand(); 											  
    }

	$sexo['M'] = 'Masculino';
	$sexo['F'] = 'Femenino';

	$tipo['1'] = 'Medico Administrador';
	$tipo['2'] = 'Medico General';
	$tipo['3'] = 'Medico Especialista';
	$tipo['4'] = 'Asistente';

	$status['A'] = 'Activo';
	$status['I'] = 'Inactivo';

	
	
	

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
		 $(".link").click(function(){
    	var idc = $(this).attr('id');
    	var id  = idc.substr(4) ;
    	//alert(id);
    	registrar_click(id);
    });
	
	
	$(".text_com").keyup(function(e){
		if(e.keyCode == 13)
		{
			var com = $(this).val();    
			var id 	= $(this).attr('id');    

			if(com != '')
			{
				//registrar_comentario(id);
			}
		}
	});
	
	$(".del_comm").click(function(){
    	if(confirm('Realmente desea eliminar su comentario?'))
    	{
    		var id = $(this).attr('id');        		

    		//eliminar_comentario(id);
    		return false;
    	}
    	else
    	{
    		return false;
    	}
    });

	//lk_mcom_

	$(".lk_more").click(function(){
    	var idc = $(this).attr('id'); //lk_mc_1
    	var id  = idc.substr(6) ;
    	//alert(id);
    	cargar_comentarios(id);
    });

    $(".karma_b").click(function(){
    	var idc = $(this).attr('id'); //lk_mc_1
    	var id  = idc.substr(4) ;
    	//alert(id);
    	tipo = 'B'; 
    	//registrar_karma(id,tipo);
    	return false;
    });

    $(".karma_m").click(function(){
    	var idc = $(this).attr('id'); //lk_mc_1
    	var id  = idc.substr(4) ;
    	//alert(id);
    	tipo = 'M'; 
    	//registrar_karma(id,tipo);
    	return false;
    });

    $("#btnenviar").click(function(){
    	if($("#txtstatus").val()=='A')
    	{
    		bloquear_usuario();	
    	}
    	else
    	{
    		desbloquear_usuario();
    	}
    	
    });





});// fin de ready




	function registrar_click(id)
	{
		dataString = 'opcion=registrarClickLink&id=' + id;

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
							//alert('Click registrado');
							$("#cont_"+id).attr('class','text-success');
							var clicks = parseInt($("#cont_"+id).text());
							clicks = clicks + 1 ;
							$("#cont_"+id).html('<b>' + clicks + '</b>');



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

	function bloquear_usuario()
	{
		var id = $("#txtid").val();
		dataString = 'opcion=bloquearUsuario&id=' + id;

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
							$("#btnenviar").attr('class','btn btn-danger btn-lg');
							$("#btnenviar").html('&nbsp;&nbsp;&nbsp;<img src="img/pendiente2.png" /><b>Desbloquear</b>&nbsp;&nbsp;&nbsp;');
							$("#txtstatus").val('B');

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

	function desbloquear_usuario()
	{
		var id = $("#txtid").val();
		dataString = 'opcion=desbloquearUsuario&id=' + id;

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
							$("#btnenviar").attr('class','btn btn-default btn-lg');
							$("#btnenviar").html('&nbsp;&nbsp;&nbsp;<img src="img/pendiente2.png" /><b>Bloquear</b>&nbsp;&nbsp;&nbsp;');
							$("#txtstatus").val('A');
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



    function cargar_comentarios(id)
    {
    	var id 		= id; 
    	var tipo 	= '1';
    	//var come 	= $("#"+id_text).val();

        dataString = 'opcion=loadCom&id=' + id +'&tipo=' + tipo ;

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
                        
                        if(r.length > 0)
                        {	
                        	$("#contenido-comentarios_" + id).empty();

                        	for(var i = 0 ;i<r.length; i++ )
                        	{
                        		var img = '<?=$avatar_actual;?>';
                            	var div_comentario ='<div id="comentario_' + r[i].id_comentario + '" class="comentario">\
										      		<div class="imagen-avatar" style="">\
												        <img src="' + img + '" style="width:32px" />\
										      		</div>\
										      		<div class="cuerpo-comentario" >' + r[i].comentario + '\
										      			<br>\
										      			<a class="text-mute" href="#">' + r[i].fecha + '</a>\
										      		</div>\
										      	</div>';
								$("#contenido-comentarios_" + id).append(div_comentario);
                        	}

                        	$("#lk_mc_"+id).hide();
							
                        }
                        else
                        {
                            alert('error');   			
                        }
                        		
                    },
            timeout:3000,
            type:"POST"
        });
    }

   

function reload()
{
	location.reload();
}
	
</script>	

<br>

<div style="float:left">
    <?   
       if (file_exists("img/avatar/200/".$reg['id_usuario'].".jpg"))
       {
          $avatarg = "img/avatar/200/".$reg['id_usuario'].".jpg?op=".rand();
          ?>
            <img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;"  src="<?=$avatarg;?>" border="0" />  
          <?
       }
       else
       {
            ?><img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;"  src="img/avatar/200/avatar-default-200.jpg" border="0" />   <?      
       }
      
    ?>
    <h1><b><?=$reg['nombre_usuario'];?></b></h1>
    <br>
    <div style="width:200px">
    	<?=$reg['bio'];?>
    </div>
    <br><br>
    
</div>


<div style="padding-left:200px">

	<div class="col-lg-8">
		

			<div class="col-lg-3">
				<div style="text-align:center">
					Links<br>
					<h2><b><?=$reg['links'];?></b></h2>
				</div>
			</div>

			<div class="col-lg-3">
				<div style="text-align:center">
					Seguidores<br>
					<h2 id="mseguidores"><b><?=$reg['seguidores'];?></b></h2>
				</div>
			</div>

			<div class="col-lg-3">
				<div style="text-align:center">
					Siguiendo<br>
					<h2><b><?=$reg['sigues'];?></b></h2>
				</div>
			</div>
			<div class="col-lg-3">
				<div style="text-align:center">
					<input type="hidden" name="txtid" id="txtid" value="<?=$reg['id_usuario'];?>" /> 
					<input type="hidden" name="txtsiguiendo" id="txtsiguiendo" value="<?=$seg['id'];?>" />					
					<input type="hidden" name="txtstatus" id="txtstatus" value="<?=$reg['status'];?>" /> 
				</div>
				<?
					if($reg['status']=='A')
					{
						?><button type="button"  id="btnenviar"  name="btnenviar" class="btn btn-default btn-lg">&nbsp;&nbsp;&nbsp;<img src="img/pendiente2.png" /> <b>Bloquear</b>&nbsp;&nbsp;&nbsp;</button><?
					}
					else
					{
						?><button type="button"  id="btnenviar"  name="btnenviar" class="btn btn-danger btn-lg">&nbsp;&nbsp;&nbsp;<img src="img/pendiente2.png" /> <b>Desbloquear</b>&nbsp;&nbsp;&nbsp;</button><?
					}
				?>
			</div>


			<table class="table table-striped ">
				
				<?
					if(count($resultado)>0)
					{
						foreach($resultado as $rec)
						{

				           if (file_exists("img/avatar/48/".$rec['id_usuario'].".jpg"))
				           {
				              $avatar ='img/avatar/48/'.$rec['id_usuario'].'.jpg?op='.rand(); 
				              
				           }
				           else
				           {
				              $avatar = 'img/icon-user.png ';    
				           }
			          
			        
							?>
								<tr>
									<td style="text-align:center">
										<a href="index.php?sub=adm&op=detu&id=<?=$rec['id_usuario'];?>"><img src="<?=$avatar;?>" width="48"/></a><br>
										<?
											if($rec['id_usuario'] == $_SESSION['s']['id_usuario'])
											{
												?><br><a href="#" class="lk_update" title="Dar click para actualizar Link" onclick="TINY.box.show({iframe:'ajax/include/frm_actualizar_link_mini.php?id=<?=$rec['id_link'];?>',boxid:'frameless',width:750,height:550,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><img src="img/update.png" /></a>  <?
											}
										?>
										 
									</td>								
									<td>
									<div style="float:right;">
										
										<a id="ikb_<?=$rec['id_link'];?>" class="karma_b" href="#"><img src="img/like.png" /></a>
										<span id="k_b<?=$rec['id_link'];?>" class="text-success"><?=$rec['karma_buena'];?></span>
										
										<a id="ikm_<?=$rec['id_link'];?>" class="karma_m" href="#"><img src="img/unlike.png" /></a>
										<span id="k_m<?=$rec['id_link'];?>" class="text-danger"><?=$rec['karma_mala'];?></span>
									</div>

									<a href="#" style="text-decoration:none;">
											<img src="http://www.google.com/s2/favicons?domain=<?=$rec['link'];?>" width="32" /> 
											<a href="index.php?sub=link&op=det&id=<?=$rec['id_link'];?>" style="font-size:18px;text-decoration:none;" title="Dar click para ver detalles"><b><?=$rec['nombre'];?></b></a>
											 
										</a>
										<?if($rec['adulto']=='S'){echo '<span style="font-size:18px;color:red;" ><b>+18</b></span>';}?>
										<br>
										<a id="lind<?=$rec['id_link'];?>" href="<?=$rec['link'];?>" class="link" target="_blank">
										<span class="text-success"><?=$rec['link'];?></span> </a>
										<br>												
										<?=$rec['descripcion'];?><br>
									<?
										if($rec['tags'] != '')
										{
											$tags = explode(',', $rec['tags']);
											$link_tags = '';
											for($i=0;$i < count($tags);$i++)
											{
												$link_tags .= ' <a href="index.php?op=dash&tag='.$tags[$i].'">'.$tags[$i].'</a>,';
											}

											$link_tags = trim($link_tags,',');

											echo $link_tags;

										}
									?>
									<br>
									<?
										if($rec['existe'] != '')
										{
											?><img src="img/oki.png" title="Ya tienes registrado este link ;)" /><?
										}
										else
										{
											?><a href="#" onclick="TINY.box.show({iframe:'ajax/include/frm_registrar_link_mini.php?grupo=<?=$g['id_grupo'];?>&id=<?=$rec['id_link'];?>',boxid:'frameless',width:750,height:550,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><img src="img/new.png" /></a> <?
										}
									?>		
									&nbsp; &nbsp; &nbsp; 
									&nbsp; &nbsp; &nbsp; 
									&nbsp; &nbsp; &nbsp; 

									<img src="img/chat.png" width="24" /> <span id="come_<?=$rec['id_link'];?>" class="text-primary"><?=$rec['comentarios'];?></span>

									&nbsp; &nbsp; &nbsp; 
									&nbsp; &nbsp; &nbsp; 
									&nbsp; &nbsp; &nbsp; 

									<img src="img/click.png" width="24" /> <span id="cont_<?=$rec['id_link'];?>" class="text-primary"><?=$rec['contador']?></span>
									

									<div>
										<?	
											$temp['id_ref'] = $rec['id_link'];
											
											$com =  $c_sistema->listadoUltComentariosDash($temp);

											$com = array_reverse($com);											
											
											$n_com =$c_sistema->ContarComentariosDash($temp);
										?>
										
										<div id="comentarios" >	
											<?
												if($n_com['num_comentarios'] > 3)
												{
													?>
													<div class="text-center">
														<a id="lk_mc_<?=$rec['id_link'];?>" class="lk_more" href="#">Ver <?=$n_com['num_comentarios'];?> comentarios m&aacute;s</a>
													</div>	
													<?
												}
											?>
																	
											<div id="contenido-comentarios_<?=$rec['id_link'];?>">
											<?
												if(count($com) > 0)
												{
													foreach ($com as $c)
													{											
													   if (file_exists("img/avatar/48/".$c['id_usuario'].".jpg"))
													   {
														  $avatar ='img/avatar/48/'.$c['id_usuario'].'.jpg?op='.rand(); 		              
													   }
													   else
													   {
														  $avatar = 'img/icon-user.png ';    
													   }
														?>	
															<div id="comm_<?=$c['id_comentario'];?>" class="comentario">
																<div class="imagen-avatar" style="">														
																	<img src="<?=$avatar;?>" style="width:32px" />
																</div>
																<div class="cuerpo-comentario" >
																	<?
																		if($c['id_usuario']==$_SESSION['s']['id_usuario'])
																		{
																			?>	
																				<div class="op_comm">
																					<a id="lk_edit_<?=$c['id_comentario'];?>" href="index.php?sub=com&op=act&id=<?=$c['id_comentario'];?>&op2=dash" title="Dar click para actualizar el comentario"><img src="img/edit2.png" width="16" /></a>|
																					<a id="lk_dele_<?=$c['id_comentario'];?>" class="del_comm" href="#" title="Dar click para elminar comentario"><img src="img/b_drop.png" width="16" /></a>
																				</div>
																			<?
																		}
																	?>
																	<?=$c['comentario'];?>
																	<br>
																	<a class="text-mute" href="#"><?=$c_sistema->hace($c['fecha'],10);?></a>
																</div>													
															</div>
														<?
													}
												}
											?>								
											</div>
											<div class="comentario">
												<div class="imagen-avatar" style="">
													
													<img id="img_avatar_actual" src="<?=$avatar_actual;?>" width="32" />
												</div>
												<div class="cuerpo-comentario">										
													<input type="text" class="text_com" id="txtc_<?=$rec['id_link'];?>" size="90" placeholder="Escribe un comentario..." />
												</div>
											</div>
										</div>
									</div>
									
									</td>

								</tr>
							<?
						}
					}
				?>	
			</table>

<br>
	
		
			
				
		
		

		
	</div>
</div>

