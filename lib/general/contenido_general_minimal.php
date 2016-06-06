<div id="tr_lk_<?=$rec['id_contenido'];?>" class="panel panel-default contenido" style="margin-bottom: 3px;" >
    <div class="panel-body" style="">

        <div class="" style="float:left;padding-right: 5px">
            <a href="u/<?=$rec['nombre_usuario'];?>"><img src="<?=$rec['avatar'];?>" width="32"/></a>
        </div>

        <div style="float:right">

            
            <!--img src="<?=$vista[$rec['visibilidad']]['img'];?>" title="<?=$vista[$rec['visibilidad']]['nombre']?>" class="w20" /-->
            <?
                if($rec['adulto'] == 'S')
                {
                    ?>
                        <img id="img_nsfw" style="width:20px;" src="img/adulto-64.png">
                    <?
                }
            ?>            
            <a href="cat/<?=$rec['codigo_categoria'];?>" title="<?=$rec['nombre_categoria'];?>"><img src="<?=$rec['img'];?>" style="width:20px;" /></a> 

            <span class="text-info"><img src="img/eye-16.png" title="Veces visto" /> <b><?=$rec['veces_visto'];?></b></span>             

            <a id="llk_<?=$rec['id_contenido'];?>" class="like" href="#" style="text-decoration:none;">                
            <?
                if($rec['id_like']!= '')
                {
                	$img_like = 'img/like.png';
                	if($_SESSION['s']['img_like']!= '')
                	{
	                	$img_like = $_SESSION['s']['img_like'];                		
                	}

                	
                    ?><img id="imk<?=$rec['id_contenido'];?>" class="liked" src="<?=$img_like;?>" width="24" /><?
                }
                else
                {
                    ?><img id="imk<?=$rec['id_contenido'];?>" src="img/unlike.png" width="24" /><?
                }
            ?>                                
            </a>
            <b><span id="n_l<?=$rec['id_contenido'];?>" class="text-primary"><?=$rec['likes'];?></span></b>             
            
            <?
                if($_SESSION['s']['id_usuario'] != '')
                {
                    ?>
                        <div class="btn-group ">                      
                          <a aria-expanded="true" href="#" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><img src="img/config-16.png" /></a>
                          <ul class="dropdown-menu">  
                                                                                         
                            <?
                                if(($rec['id_usuario'] == $_SESSION['s']['id_usuario']) || ($_SESSSION['s']['id_usuario']=='1'))
                                {

                                    ?>
                                        
                                        <li><a id="lkd_<?=$rec['id_contenido'];?>" href="#" class="lk_eliminar"  title="Dar click para eliminar Contenido">Eliminar publicaci&oacute;n</a></li>
                                        <li><a href="edit_post/<?=$rec['id_contenido'];?>" title="Dar click para editar Contenido">Editar publicaci&oacute;n</a></li>
                                        
                                    <?
                                } 
                            ?>
                            <li><a href="https://www.facebook.com/dialog/feed?app_id=794307344013409&redirect_uri=http://mypack.me&link=http://mypack.me&picture=http://mypack.me/<?=$rec['src'];?>&caption=Blog colaborativo de Humor&description=<?=$rec['nombre'];?>&properties={text:'value1',key2:'value2'}&actions={name:'Genial',link:'http://mypack.me'}" target="_blank" title="Compartir es divertido"><img src="img/share-fb.png" style="width:150px;" >Compartir En facebook</a></li>
                            <?
                                if($_SESSION['s']['tipo_usuario']=='2')
                                {
                                    ?>
                                        <li><a href="index.php?sub=adm&op=editpost&id=<?=$rec['id_contenido'];?>" title="Dar click para editar Contenido">Editar publicaci&oacute;n Admin </a></li>
                                        <li><a href="index.php?sub=adm&op=blip&ip=<?=$rec['ip'];?>" title="Dar click para bloquear IP">Bloquear IP</a></li>
                                    <?
                                }
                            ?>                        
                            <?                        
                                if($_SESSION['s']['id_usuario'] != '' & $_SESSION['s']['id_usuario'] != $rec['id_usuario'])
                                {
                                    ?>
                                        <li class="divider"></li>
                                        <li><a id="rp_<?=$rec['id_contenido'];?>" href="#" class="text-danger report"  >Reportar publicaci&oacute;n</a></li>
                                    <?
                                }
                            ?>                        
                          </ul>
                        </div>
                    <?
                }
                else
                {
                    ?>
                        <!--a rel="nofollow" data-share="http://9gag.com/gag/ab0yQ8p?ref=fb.s" data-evt="Facebook-Share,ListClicked,http://9gag.com/gag/ab0yQ8p" data-track="social,fb.s,,,d,ab0yQ8p,l" class="badge-facebook-share badge-evt badge-track btn-share facebook" href="javascript:void(0);">Facebook</a-->
                        
                        <!--a href="https://www.facebook.com/dialog/feed?app_id=794307344013409&redirect_uri=http://mypack.me" target="_blank"><img src="img/share1-32.png"></a-->

                        
                    <?
                }
            ?>
            
            

        </div>

        <div>            
            <b><?=$rec['nombre_real'];?></b> <a href="u/<?=$rec['nombre_usuario'];?>" class="f12">@<?=$rec['nombre_usuario'];?></a>
            <?
                if($rec['nombre_usuario_rt']!= '')
                {
                    ?><span style="font-size:12px"><img src="img/retw.png" /> </span><a href="u/<?=$rec['nombre_usuario_rt'];?>">@<?=$rec['nombre_usuario_rt'];?></a><?
                }
            ?>
            <br>
            <a href="/post/<?=$rec['id_contenido'];?>"><span class="text-muted" style="font-size:11px"><?=$c_sistema->hace_mini($rec['fecha_p']);?></span></a>
            <br>
                          

                <?
                  
                    if($rec['nombre'] != '')
                    {
                        $rec['nombre'] = $rec['nombre'].'<br>';
                    }
                    
                    $des = $rec['descripcion'];
                    $rec['descripcion'] = $c_sistema->generar_tags($rec['descripcion'].' '.$rec['tags']);
                    
                   
                ?>
                
                
                <!--TITULO-->
		<?
			if($rec['nombre'] != '')
			{
				?><span class="text-info"  style="font-size:16px;text-decoration:none;padding-left:5px;" ><b><?=$rec['nombre'];?></b></span><?
			}
			
		?>

               
                <!--IMAGEN O VIDEO-->
                <?
                if($rec['id_tipo_contenido']=='2') # IMAGENES
                {
                    $m_nsfw = '';

                    //$cadena = "Sin León no hubiera España";
                    $buscar = "mypack";
                    $resultado = strpos($rec['src'], $buscar);
                    
                    $extension = end( explode('.',$rec['src']) );

                    $width_img = 'width:100%;';
                    if($extension=='gif')
                    {
                        $width_img = 'max-width:100%;';
                    }
                    

                    if($resultado !== FALSE & $extension != 'gif')
                    {
                        // con esto se toma la miniatura de 640
                        //echo $rec['src'].'<br>';
                        if($movil)
                        {
                            $rec['src'] = str_replace('/img/','/640/', $rec['src']);    
                        }
                        
                        //echo $rec['src'];

                    }
                  ?>
                   
                   <a href="post/<?=$rec['id_contenido'];?>/<?=$c_sistema->urls_amigables($rec['nombre']);?>" >
                  <?

                    //print_r($rec);

                    if($rec['codigo_categoria']=='nsfw' || $rec['adulto']=='S')
                    {
                        $rec['adulto'] = 'N';
                        $rec['codigo_categoria']='sfw';
                    }

                    if(
                        ($rec['codigo_categoria']=='nsfw' || $rec['adulto']=='S') & 
                        ($_SESSION['s']['per_nsfw']=='N' || $_SESSION['s']['id_usuario']=='') &
                        ($_SESSION['ss']['per_nsfw']!='S'))
                    {
                        if($_SESSION['s']['id_usuario'] == '')
                        {                            
                            $m_nsfw='<a class="perm_ns_reg text-info" href="registro/url/post/'.$rec['id_contenido'].'" style="cursor:pointer" title="seguro quieres ver esto?">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';
                        }
                        else
                        {
                            $m_nsfw='<a class="perm_nsfw" class="text-info" style="cursor:pointer" title="Solo Usuarios registrados pueden ver este contenido">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';    
                        }
                        
                        ?>
                            <img src="img/nsfw.jpg" class="marco nsfw" style="width:100%;" alt="<?=$des;?>" /></a><br>
                            <img src="<?=$rec['src'];?>" class="marco sfw" style="<?=$width_img;?>display:none" alt="" />
                            </a>

                        <?
                    }
                    else
                    {
                      ?><img src="<?=$rec['src'];?>" class="marco" style="<?=$width_img;?>" alt="" /></a><br><?
                    }

                    if($rec['multi_img']=='1')
                    {
                        $imgs = $c_sistema->obtenerImagenesPost($rec);



                        if(count($imgs) > 0)
                        {
                            foreach($imgs as $im)
                            {
                                ?>
                                    <a href="post/<?=$rec['id_contenido'];?>/<?=$c_sistema->urls_amigables($rec['nombre']);?>" >
                                  <?
                                    if(
                                        ($rec['codigo_categoria']=='nsfw' || $rec['adulto']=='S') & 
                                        ($_SESSION['s']['per_nsfw']=='N' || $_SESSION['s']['id_usuario']=='') &
                                        ($_SESSION['ss']['per_nsfw']!='S'))
                                    {
                                        if($_SESSION['s']['id_usuario'] == '')
                                        {                            
                                            $m_nsfw='<a class="perm_ns_reg text-info" href="registro/url/post/'.$rec['id_contenido'].'" style="cursor:pointer" title="seguro quieres ver esto?">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';
                                        }
                                        else
                                        {
                                            $m_nsfw='<a class="perm_nsfw" class="text-info" style="cursor:pointer" title="Solo Usuarios registrados pueden ver este contenido">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';    
                                        }
                                        
                                        ?>
                                            <img src="img/nsfw.jpg" class="marco nsfw" style="width:100%;" alt="<?=$des;?>" /></a><br>
                                            <img src="<?=$im['src'];?>" class="marco sfw" style="<?=$width_img;?>display:none" alt="" />
                                            </a>

                                        <?
                                    }
                                    else
                                    {
                                      ?><img src="<?=$im['src'];?>" class="marco" style="<?=$width_img;?>" alt="" /></a><br><?
                                    }
                                
                            }
                        }
                    }
                 
                }
                else if($rec['id_tipo_contenido']=='3')
                {
                    $m_nsfw = '';
                    $codigo_video_mypack = '';

                    if($rec['tipo_archivo'] == 'mp4' || $rec['tipo_archivo'] == 'webm' || $rec['tipo_archivo'] == '3gp')
                    {
                        $sorce_video = "<source src='".$rec['src']."'  />";

                        $codigo_video_mypack = '
                            <div class="text-center">
                                <video controls style="max-width:100%">
                                   '.$sorce_video.'                                
                                </video>
                            </div>';
                    }
                    else
                    {
                        $video      = $c_sistema->parse_youtube_url($rec['codigo'],'hqthumb');

                        if($video=='codigo_embed')
                        {
                            $video      = 'img/mini_video.png';
                            $cod_video  = $rec['codigo'];
                        }
                        else
                        {
                            $cod_video  = $c_sistema->parse_youtube_url($rec['codigo'],'embed',400);    
                        }

                        $codigo_video_mypack = '
                            <div class="text-center">
                                <div id="vid_'.$rec['id_contenido'].'" class="video" style="max-width:100%">
                                     '.$cod_video.'
                                </div>
                            </div>';
                    }


                    
                    if(($rec['codigo_categoria']=='nsfw' || $rec['adulto']=='S') & 
                        ($_SESSION['s']['per_nsfw']=='N' || $_SESSION['s']['id_usuario']=='') &
                        ($_SESSION['ss']['per_nsfw']!='S'))
                    {
                        if($_SESSION['s']['id_usuario'] == '')
                        {                            
                            $m_nsfw='<a class="perm_ns_reg text-info" href="registro/url/post/'.$rec['id_contenido'].'" style="cursor:pointer" title="seguro quieres ver esto?">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';
                        }
                        else
                        {
                            $m_nsfw='<a class="perm_nsfw" class="text-info" style="cursor:pointer" title="Solo Usuarios registrados pueden ver este contenido">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';    
                        }
                        
                        ?>
                            <img src="img/nsfw.jpg" class="marco nsfw" style="width:100%;" alt="<?=$des;?>" /></a><br>

                            <div class="sfw" style="display:none">
                                <?=$codigo_video_mypack;?>
                            </div>

                        <?
                    }
                    else
                    {
                        echo $codigo_video_mypack;
                    }

                    ?>
                        <br>
                        <div style="float:right">
                             <a href="<?=$rec['src'];?>">Descargar <?=$rec['tipo_archivo'];?>[<span class="text-danger"><?=$rec['tamanio'];?></span>]</a>    
                        </div>

                    <?
                   
                }
                    // DESCRIPCION
                    echo $m_nsfw;
                    $m_nsfw = '';

                    if($rec['id_tipo_contenido']=='6')
                    {
                        echo '<span class="f14">'.preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']).'</span>';                    
                    }
                    else
                    {
                        echo '<span class="f14">'.preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']).'</span>';                    
                    }
                    
                    
              ?>
                
                <!--LINK-->
                
                <br>
                <?
                    if($rec['link'] != '')
                    {
                        ?>
                            
                            <a href="<?=$rec['link'];?>" class="link text-success f11 " target="_blank">
                                <img src="http://www.google.com/s2/favicons?domain=<?=$rec['link'];?>" width="20" /> 
                                <?=$rec['link'];?>
                            </a>
                            <br>
                        <?
                    }
                ?>
                    
                
                
             
              
              
                <!--a><img src="img/chat.png" width="16" > <span id="come_<?=$rec['id_contenido'];?>" class="text-primary" style="font-size:12px;"><?=$rec['comentarios'];?></span></a-->

                
                <!--a><img src="img/response.png" width="16"><span id="idc<?=$rec['id_contenido'];?>" class="mos_co text-primary" style="font-size:12px;cursor:pointer;"> Responder</span></a--> 
                <?
                    if($rec['nombre_usuario_rt'] != '' OR $rec['id_usuario']== $_SESSION['s']['id_usuario'])
                    {
                        /*?><a  href="#"><img src="img/rt.png" width="24" /> <span id="come_<?=$rec['id_contenido'];?>" class="text-success" style="font-size:12px;"><?=$rec['rt'];?> Compartido</span></a><?*/
                    }
                    else
                    {

                        if($_SESSION['s']['id_usuario'] != '')
                        {                        
                            ?>
                                <!--a id="lkco<?=$rec['id_contenido'];?>" class="compartir text-primary" href="#" style="font-size:12px;">
                                    <img src="img/rt.png" width="24" />
                                    <span id="nrt_<?=$rec['id_contenido']?>"><?=$rec['rt'];?></span>
                                    
                                </a-->                                 
                            <?
                        }
                    }
                ?>  

                <div style="float:right">
                    <?
                        if($_SESSION['s']['id_usuario']=='')
                        {
                        ?><a href="https://www.facebook.com/dialog/feed?app_id=794307344013409&redirect_uri=http://mypack.me&link=http://mypack.me&picture=http://mypack.me/<?=$rec['src'];?>&caption=Blog colaborativo de Humor&description=<?=$rec['nombre'];?>&properties={text:'value1',key2:'value2'}&actions={name:'Genial',link:'http://mypack.me'}" target="_blank" title="Compartir es divertido"><img src="img/share-fb.png" style="width:150px;" ></a><?
                        }
                    ?>
                </div>
               

                
                
                
                     
              

            </div>
            
            <div>
              <?  
                if($rec['comentarios'] > 0)
                {
                    $temp['id_ref'] = $rec['id_contenido'];
                    $com =  $c_sistema->listadoUltComentariosDash($temp);
                    $com = array_reverse($com);    
                }
                else
                {
                    $com = array();
                }

              ?>
              
              <div id="comentarios" > 
                <?
                  if($rec['comentarios'] > 3)
                  {
                    ?>
                        <div class="text-center">
                            <a id="lk_mc_<?=$rec['id_contenido'];?>" class="lk_more" href="#">Ver <?=$rec['comentarios']-3;?> comentarios m&aacute;s</a>
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
                      
                      ?>  
                        <div id="comm_<?=$c['id_comentario'];?>" class="comentario" >
                          <div class="imagen-avatar" style="">                            
                            <a href="u/<?=$c['nombre_usuario'];?>">
                                <img src="<?=$c['avatar'];?>" class="marco_av" style="width:42px;height:42px;" />
                            </a>
                          </div>
                          <div class="cuerpo-comentario" >
                            <?
                              if($c['id_usuario']==$_SESSION['s']['id_usuario'] & $c['id_usuario']!= '' )
                              {
                                ?>  
                                  <div class="op_comm">
                                    <a id="lk_edit_<?=$c['id_comentario'];?>" href="index.php?sub=com&op=act&id=<?=$c['id_comentario'];?>&op2=dash" title="Dar click para actualizar el comentario"><img src="img/edit2.png" width="16" /></a>|
                                    <a id="lk_dele_<?=$c['id_comentario'];?>" class="del_comm"  data-id-contenido="<?=$rec['id_contenido'];?>"  href="#" title="Dar click para elminar comentario"><img src="img/b_drop.png" width="16" /></a>
                                  </div>
                                <?
                              }

                              if(($rec['id_usuario']==$_SESSION['s']['id_usuario'] & $c['id_usuario']== '')||($rec['id_usuario']==$_SESSION['s']['id_usuario'] & $c['id_usuario']== '0' ))
                              {
                                ?>  
                                  <div class="op_comm">                            
                                    <a id="lk_dele_<?=$c['id_comentario'];?>" class="del_comm" href="#" title="Dar click para elminar comentario"><img src="img/b_drop.png" width="16" /></a>
                                  </div>
                                <?
                              }
                              

                            ?>

                            <a href="u/<?=$c['nombre_usuario'];?>">@<?=$c['nombre_usuario'];?></a>
                            <span class="text-muted f10" href="#"><?=$c_sistema->hace_mini($c['fecha'],10);?></span>
                            <br>
                            <span class="f14"><?=$c_sistema->generar_tags(trim($c['comentario']),"<br>");?></span>
                            
                            
                            <?
                                 if($_SESSION['s']['tipo_usuario']=='2' & $c['id_usuario']== '')
                                {
                                    ?>ip: [<a href="index.php?sub=adm&op=blip&ip=<?=$c['ip'];?>" title="Dar click para bloquear IP"><?=$c['ip'];?></a>]<?
                                }
                            ?>
                            
                          </div>                          
                        </div>  
                        <hr class="hr">                      
                      <?
                    }
                  }
                ?>                
                </div>
                    <?
                        if($_SESSION['s']['id_usuario'] != ''  )
                        {
                            ?>
                            <div id="idc_<?=$rec['id_contenido'];?>" class="comentario" >

                                <div class="imagen-avatar" style="">                            
                                        <a href="u/<?=$c['nombre_usuario'];?>">
                                            <img src="<?=$_SESSION['s']['avatar'];?>" class="marco_av" style="width:42px;height:42px;" />
                                        </a>
                                    </div>
                                
                                <div class="cuerpo-comentario">  

                                     
                                    

                                    <div contentEditable="true" class="form-control input-sm text-comentario" data-id-contenido="<?=$rec['id_contenido'];?>" id="txtc_<?=$rec['id_contenido'];?>" style="margin-left:10px;margin-bottom:5px; width:100%;min-height:30px;;height:100%;line-height: 20px;" placeholder="Escribe un comentario..." ></div>
                                    
                                    <div id="div_op_com_<?=$rec['id_contenido'];?>" style="display:none">

                                    <a id="btmc_<?=$rec['id_contenido'];?>" class="text_com btn btn-xs btn-primary" style="cursor:pointer; float:right">Enviar</a>

                                    <? 
                                        if(!$movil)
                                        {
                                            ?>  
                                                <a id="lkmm_<?=$rec['id_contenido'];?>"  href="#myModa3" role="button" class="btn-memes"    data-toggle="modal" style="cursor:pointer; float:right;margin-right:10px;" ><img src="img/camera-alt-32.png" style="width:24px;" /></a>
                                                <a id="lkme_<?=$rec['id_contenido'];?>"  href="#myModa4" role="button" class="btn-emojis"   data-id-div="#txtc_<?=$rec['id_contenido'];?>"  data-toggle="modal" style="cursor:pointer; float:right;margin-right:10px;" ><img src="img/Emoticon.png"  style="width:18px;" /></a>
                                            <?
                                        }
                                    ?>
                                    </div>

                                    

                                    <div class="text-right">
                                        <img id="idlc_<?=$rec['id_contenido'];?>" src="img/load.gif"  style="display:none" />
                                        
                                    </div>
                                </div>
                                       


                            </div>
                            <?
                        }
                    ?>
                  </div>
            </div>
        </div>
    </div>
    
    