<div id="tr_lk_<?=$rec['id_contenido'];?>" class="panel panel-primary contenido" style="margin-bottom: 3px;" >
    <div class="panel-body" style="">

        <div class="" style="float:left;padding-right: 5px">
            <a href="u/<?=$rec['nombre_usuario'];?>"><img src="<?=$rec['avatar'];?>" width="32"/></a>
        </div>

        <div style="float:right">           
            
            
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

        <div>            
            <b><?=$rec['nombre_real'];?></b> <a href="u/<?=$rec['nombre_usuario'];?>" class="f12">@<?=$rec['nombre_usuario'];?></a>
            <?
                if($rec['nombre_usuario_rt']!= '')
                {
                    ?><span style="font-size:12px"><img src="img/retw.png" /> </span><a href="u/<?=$rec['nombre_usuario_rt'];?>">@<?=$rec['nombre_usuario_rt'];?></a><?
                }
            ?>            
            <a href="/post/<?=$rec['id_contenido'];?>"><span class="text-muted" style="font-size:11px"><?=$c_sistema->hace_mini($rec['fecha_p']);?></span></a>
            <br>
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
                            <img src="<?=$rec['src'];?>" class="marco sfw" style="width:64px;<?=$width_img;?>display:none" alt="" />
                            </a>

                        <?
                    }
                    else
                    {
                      ?><img src="<?=$rec['src'];?>" class="marco" style="<?=$width_img;?>" alt="" /></a><br><?
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
                                <img src="http://www.google.com/s2/favicons?domain=<?=$rec['link'];?>" width="16" /> 
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
               

                
                
                
                     
              

            </div>
            
            
        </div>
    </div>
    
    