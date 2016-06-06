<?
	
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];	
	$datos['tags']		 = $_GET['tag'];
	$datos['page']		 = $_GET['page'];
	$datos['consulta'] 	 = $_GET['q'];
	$result 	 		 = $c_sistema->listadoLinksPublicosReportados($datos);


	//$resultado = $result['datos'];
	//$paginador = $result['paginador'];

	$resultado = $result['datos'];
	$paginacion = $result['paginador'];

	//print_r($paginacion);


	$temp['tipo_comentario'] = '1';	
	
	$avatar_actual = 'img/icon-user.png';
    if (file_exists("img/avatar/48/".$_SESSION['s']['id_usuario'].".jpg"))
    {
	   $avatar_actual ='img/avatar/48/'.$_SESSION['s']['id_usuario'].'.jpg?op='.rand(); 											  
    }
   
   	$destino = "index.php?op=dash&q=".$_GET['q'];


?>

<script type="text/javascript">


 $(document).ready(function(){
 	
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
				registrar_comentario(id);
			}
		}
	});
	
	$(".del_comm").click(function(){
    	if(confirm('Realmente desea eliminar su comentario?'))
    	{
    		var id = $(this).attr('id');        		

    		eliminar_comentario(id);
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
    	registrar_karma(id,tipo);
    	return false;
    });

    $(".karma_m").click(function(){
    	var idc = $(this).attr('id'); //lk_mc_1
    	var id  = idc.substr(4) ;
    	//alert(id);
    	tipo = 'M'; 
    	registrar_karma(id,tipo);
    	return false;
    });

    $(".report").click(function(){
    	var idc = $(this).attr('id'); //lk_mc_1
    	var id  = idc.substr(3);    	
    	reportar_link(id);
    	return false;
    });

    $(".liberar").click(function(){
    	var idc = $(this).attr('id'); //lk_mc_1
    	var id  = idc.substr(3);   
    	var status_rp = 'L';
    	var status 	  = 'L'; 	
    	actualizar_reporte_link(id,status_rp,status);
    	return false;
    });

    $(".sepultar").click(function(){
    	var idc = $(this).attr('id'); //lk_mc_1
    	var id  = idc.substr(3);    	
    	var status_rp = 'S';
    	var status 	  = 'A'; 	
    	actualizar_reporte_link(id,status_rp,status);
    	return false;
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


	function registrar_comentario(id_text)
    {
    	var id 		= id_text.substring(5); 
    	var tipo 	= '1';
    	var come 	= $("#"+id_text).val();

        dataString = 'opcion=regCom&id=' + id +'&tipo=' + tipo + '&com=' + come ;

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
                        
                        if(r.codigo=='000')
                        {	
                        	//img_avatar_actual
                        	var img = '<?=$avatar_actual;?>';
                            var div_comentario ='<div id="comentario_' + r.id_comentario + '" class="comentario">\
										      		<div class="imagen-avatar" style="">\
												        <img src="' + img + '" style="width:32px" />\
										      		</div>\
										      		<div class="cuerpo-comentario" >' + come + '\
										      			<br>\
										      			<a class="text-mute" href="#">' + r.fecha + '</a>\
										      		</div>\
										      	</div>';

							$("#contenido-comentarios_" + id).append(div_comentario);
							$("#"+id_text).val('');
							
							$("#come_"+id).attr('class','text-success');
							var clicks = parseInt($("#come_"+id).text());
							clicks = clicks + 1 ;
							$("#come_"+id).html('<b>' + clicks + '</b>');
							
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
	
	function eliminar_comentario(id)
    {
    	var id_comentario = id.substr(8);
        dataString = 'opcion=delCom&id=' + id_comentario ;

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
                        
                        if(r.codigo=='000')
                        {	
                        	$("#comm_"+r.id).fadeOut();
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

    function registrar_karma(id,tipo)
    {
    	var id 		= id; 
    	var tipo_l 	= 'l';
    	var tipo_k 	= tipo;    	

        dataString = 'opcion=regKarma&id=' + id +'&tipo=' + tipo_l + '&tipokarma=' + tipo_k ;

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
                        
                        if(r.codigo=='000')
                        {	
                        	if(r.tipo_karma=='B')
                        	{
                        		var n = parseInt($("#k_b"+id).text());
								n = n - 1 ;
								$("#k_b"+id).html(n);
                        	}

                        	if(r.tipo_karma=='M')
                        	{
                        		var n = parseInt($("#k_m"+id).text());
								n = n - 1 ;
								$("#k_m"+id).html(n);
                        	}

                        	if(tipo_k == 'B')
                        	{
                        		var n = parseInt($("#k_b"+id).text());
								n = n + 1 ;
								$("#k_b"+id).html('<b>' + n + '</b>');
                        	}
                        	else
                        	{
                        		var n = parseInt($("#k_m"+id).text());
								n = n + 1 ;
								$("#k_m"+id).html('<b>' + n + '</b>');
                        	}                        		
							
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

    function reportar_link(id)
    {
    	var id 		= id; 

        dataString = 'opcion=repLink&id=' + id ;

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
                        
                        if(r.codigo=='000')
                        {	
                        	$("#tr_lk_"+id).fadeOut();
                        }
                        else
                        {
                            alert('error');   			
                        }
                        		
                    },
            timeout:3000,
            type:"POST"
        });
    }// fin reportar 

    function actualizar_reporte_link(id,status_rp,status)
    {
    	var id 		= id; 

        dataString = 'opcion=actRepLink&id=' + id + '&statusrp=' + status_rp + '&status=' + status ;

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
                        
                        if(r.codigo=='000')
                        {	
                        	if(status_rp == 'L')
                        	{
                        		$("#lb_"+id).html('<b>Liberar <img src="img/bien3.png" /></b>');
                        	}
                        	else
                        	{
                        		$("#sp_"+id).html('<b>Sepultar <img src="img/b_drop.png" /></b>');	
                        	}
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

<div class="text-center">
	<h4>Contenido Reportados</h4>
</div>


<div class="col-lg-8 col-lg-offset-2">


  
  <?
    if(count($resultado)>0)
    {
      foreach($resultado as $rec)
      {

             if (file_exists("src/avatar/48/".$rec['id_usuario'].".jpg"))
             {
                $avatar ='src/avatar/48/'.$rec['id_usuario'].'.jpg?op='.rand();                 
             }
             else
             {
                $avatar = 'img/user.png ';    
             }
          
        
        ?>
          <div id="tr_lk_<?=$rec['id_contenido'];?>" class="well well-sm .contenido" >

            <div style="float:left;padding:5px;">
              <a href="index.php?u=<?=$rec['nombre_usuario'];?>"><img src="<?=$avatar;?>" width="32"/></a><br>


            </div>


               
            
            <div style="float:right;">

                


              
              <!--a href="index.php?op=ver&id=<?=$rec['id_contenido'];?>">Ver detalles</a--> 
              <a id="llk_<?=$rec['id_contenido'];?>" class="like" href="#" style="text-decoration:none;">
                <?
                    if($rec['id_like']!= '')
                    {
                        ?><img id="imk<?=$rec['id_contenido'];?>" class="liked" src="img/like.png" width="24" /><?
                    }
                    else
                    {
                        ?><img id="imk<?=$rec['id_contenido'];?>" src="img/unlike.png" width="24" /><?
                    }
                ?>
                                
                </a>
              <b><span id="n_l<?=$rec['id_contenido'];?>" class="text-primary"><?=$rec['likes'];?></span></b>
              
            </div>




            <div style="padding-left:45px;">
                <div style="padding:5px;">
                    <a href="index.php?u=<?=$rec['nombre_usuario'];?>" style="font-size:12px;">@<?=$rec['nombre_usuario'];?></a>
                    <?
                        if($rec['nombre_usuario_rt']!= '')
                        {
                            ?>Compartido de <a href="index.php?u=<?=$rec['nombre_usuario_rt'];?>">@<?=$rec['nombre_usuario_rt'];?></a><?
                        }
                    ?>

                    Publicado <?=$c_sistema->hace($rec['fecha_p']);?>
                    IP: [<a href="index.php?sub=adm&op=blip&ip=<?=$rec['ip'];?>" title="Dar click para bloquear IP"><?=$rec['ip'];?></a>]
                    Reportes  : <b><span class="text-danger"><?=$rec['reportes'];?></span></b>
                    <a id="lb_<?=$rec['id_contenido'];?>" href="#" class="text-success liberar">Liberar <img src="img/bien3.png" /></a> |
                    <a id="sp_<?=$rec['id_contenido'];?>" href="#" class="text-danger sepultar">Sepultar <img src="img/b_drop.png" /></a><br>
                </div>
              

              <?
                
                if($rec['id_tipo_contenido'] == '1')
                {
                  ?>
                    
                    <img src="http://www.google.com/s2/favicons?domain=<?=$rec['link'];?>" width="32" /> 
                    <a href="index.php?op=ver&id=<?=$rec['id_contenido'];?>" style="font-size:20px;text-decoration:none;" title="Dar click para ver detalles"><b><?=$rec['nombre'];?></b></a>
                                        
                    <?if($rec['adulto']=='S'){echo '<span style="font-size:18px;color:red;" ><b>+18</b></span>';}?>
                    <br>
                    <a id="lind<?=$rec['id_contenido'];?>" href="<?=$rec['link'];?>" class="link" target="_blank">
                    <span class="text-success" style="font-size:12px;"><?=$rec['link'];?></span> </a>
                    <br>                  
                    <?=$rec['descripcion'];?><br><br>
                  <?
                }
                else if($rec['id_tipo_contenido']=='2') # IMAGENES
                {
                  ?>
                    <a href="index.php?op=ver&id=<?=$rec['id_contenido'];?>" >
                      <img src="<?=$rec['src'];?>" class="marco" style="max-width:200px;" alt="<?=$rec['descripcion'];?>" /></a><br>
                    <span class="info"  style="font-size:18px;text-decoration:none;" ><?=$rec['nombre'];?></span>
                    
                    <?=$rec['descripcion'];?>                 
                                        <br>
                  <?
                }
                else if($rec['id_tipo_contenido']=='3')
                {
                        $video      = $c_sistema->parse_youtube_url($rec['codigo'],'hqthumb');

                        if($video=='codigo_embed')
                        {
                            $video      = 'img/mini_video.png';
                            $cod_video  = $rec['codigo'];
                        }
                        else
                        {
                            $cod_video  = $c_sistema->parse_youtube_url($rec['codigo'],'embed');    
                        }

                        ?>

                        <img id="img_<?=$rec['id_contenido'];?>" src="<?=$video;?>" width="480" class="mini" style="cursor:pointer;" />
                        <div id="vid_<?=$rec['id_contenido'];?>" style="display:none" class="video">
                             <?=$cod_video;?>
                        </div>
                        <br>                        
                        <?=preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']);?><br>
                        <?
                }
                else if($rec['id_tipo_contenido'] == '4')
                {
                    ?>
                        <a href="<?=$rec['src'];?>" data-imagelightbox="c">
                            <img src="img/pdf256.png" class="marco" style="max-width: 670px;" /></a><br>
                        <h2 class="info"  style="font-size:18px;text-decoration:none;" ><?=$rec['nombre'];?></h2>

                        <?=$rec['descripcion'];?>                                   
                        <br>
                    <?
                }
                 else if($rec['id_tipo_contenido'] == '6')
                {
                    ?>
                        <div style="padding-left:1px;"><?=$rec['descripcion'];?></div>                        
                    <?
                }




              ?>

              
              <?
                if($rec['tags'] != '')
                {
                  $tags = explode(',', $rec['tags']);
                  $link_tags = '';
                  for($i=0;$i < count($tags);$i++)
                  {
                    $link_tags .= ' <a href="index.php?op=dash&tag='.$tags[$i].'" style="font-size:11px;">#'.$tags[$i].'</a>,';
                  }

                  $link_tags = trim($link_tags,',');

                  echo $link_tags;

                }
              ?>
              <br>
              
                <a><img src="img/chat.png" width="16" /> <span id="come_<?=$rec['id_contenido'];?>" class="text-primary" style="font-size:12px;"><?=$rec['comentarios'];?> Comentarios</span></a>

                &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; 
                <?
                    if($rec['nombre_usuario_rt'] != '' OR $rec['id_usuario']== $_SESSION['s']['id_usuario'])
                    {
                        /*?><a  href="#"><img src="img/rt.png" width="24" /> <span id="come_<?=$rec['id_contenido'];?>" class="text-success" style="font-size:12px;"><?=$rec['rt'];?> Compartido</span></a><?*/
                    }
                    else
                    {
                        ?><a id="lkco<?=$rec['id_contenido'];?>" class="compartir text-primary" href="#" style="font-size:12px;">
                            <img src="img/rt.png" width="24" />
                            <span id="nrt_<?=$rec['id_contenido']?>"><?=$rec['rt'];?></span>
                             Compartir</a><?
                    }
                ?>                
                

              
              <div style="float:right">
                    <?
                        if($rec['id_usuario'] == $_SESSION['s']['id_usuario'])
                        {
                            if($rec['id_tipo_contenido']=='6')
                            {
                                $link_d = 'index.php?sub=est&op=act&id='.$rec['id_contenido'];
                            }
                            ?>
                                <!--a id="lka_<?=$rec['id_contenido'];?>" href="<?=$link_d;?>" class="lk_update" style="font-size:11px;" title="Dar click para actualizar Contenido"><img src="img/edit.png" title="Actualizar" /></a-->
                                <a id="lkd_<?=$rec['id_contenido'];?>" href="#" class="lk_eliminar" style="font-size:11px;" title="Dar click para eliminar Contenido"><img src="img/trash.png" title="Eliminar" /></a>
                                
                            <?
                        } 
                    ?>

                    <?
                        if($_SESSION['s']['id_usuario'] != '' & $_SESSION['s']['id_usuario'] != $rec['id_usuario'])
                        {
                            ?><a id="rp_<?=$rec['id_contenido'];?>" href="#" class="text-danger report" style="font-size:11px;" ><img src="img/pendiente2.png" width="16" title="Reportar" /></a><?
                        }
                    ?>

                            
                </div>
            </div>
            <div>
              <?  
                $temp['id_ref'] = $rec['id_contenido'];
                $com =  $c_sistema->listadoUltComentariosDash($temp);

                $com = array_reverse($com);
                
                $n_com =$c_sistema->ContarComentariosDash($temp);

              ?>
              
              <div id="comentarios" > 
                <?
                  if($n_com['num_comentarios'] >= 3)
                  {
                    ?>
                    <div class="text-center">
                      <a id="lk_mc_<?=$rec['id_contenido'];?>" class="lk_more" href="#">Ver <?=$n_com['num_comentarios'];?> comentarios m&aacute;s</a>
                    </div>  
                    <?
                  }
                ?>
                            
                <div id="contenido-comentarios_<?=$rec['id_contenido'];?>">
                <?
                  if(count($com) > 0)
                  {
                    foreach ($com as $c)
                    {                     
                       if (file_exists("src/avatar/48/".$c['id_usuario'].".jpg"))
                       {
                        $avatar ='src/avatar/48/'.$c['id_usuario'].'.jpg?op='.rand();                   
                       }
                       else
                       {
                        $avatar = 'img/user.png ';    
                       }
                      ?>  
                        <div id="comm_<?=$c['id_comentario'];?>" class="comentario">
                          <div class="imagen-avatar" style="">                            
                            <a href="index.php?u=<?=$c['nombre_usuario'];?>"><img src="<?=$avatar;?>" style="width:24px" /></a>
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
                            <a class="text-mute" href="#" style="font-size:10px;"><?=$c_sistema->hace($c['fecha'],10);?></a>
                          </div>                          
                        </div>
                                                
                      <?
                    }
                  }
                ?>                
                </div>
                
            </div>
          </div>
          </div>
        
        <?
      }
    }
  ?>  







<!--div class="col-lg-10 col-lg-offset-1">
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
					<tr id="tr_lk_<?=$rec['id_link'];?>" >
						<td style="text-align:center">
							<a href="index.php?sub=cue&op=per&perfil=<?=$rec['id_usuario'];?>"><img src="<?=$avatar;?>" width="48"/></a><br>
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
							<?=$rec['descripcion'];?>

							<div style="float:right">
								<a id="lb_<?=$rec['id_link'];?>" href="#" class="text-success liberar">Liberar <img src="img/bien3.png" /></a> |
								<a id="sp_<?=$rec['id_link'];?>" href="#" class="text-danger sepultar">Sepultar <img src="img/b_drop.png" /></a><br>
								<span class="text-danger">Reportes: <b><?=$rec['reportes'];?></b></span>
                                Lista de usuario que reportan el link
                                <ul>
                                <?
                                    $usuarios_r = $c_sistema->obtenerListaUsuarioReporte($rec);

                                    foreach ($usuarios_r as $u) 
                                    {
                                        ?><li><a href="index.php?sub=adm&op=detu&id=<?=$u['id_usuario'];?>"><?=$u['nombre_usuario'];?></a></li><?    
                                    }
                                ?>
                                    
                                </ul>
							</div>

							<br>
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
</div-->
<br>


</div>