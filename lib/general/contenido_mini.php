
    <div id="tr_lk_<?=$rec['id_contenido'];?>" class="panel panel-default contenido" >
       

        <div class="panel-body" style="padding: 3px;">
            <div style="padding-top:1px;">
                          

              <?
              
                if($rec['nombre'] != '')
                {
                    $rec['nombre'] = $rec['nombre'].'<br>';
                }
                
                $des = $rec['descripcion'];
                $rec['descripcion'] = $c_sistema->generar_tags($rec['descripcion'].' '.$rec['tags']);
                
               
                ?>
                
                
                <!--TITULO-->

                <!--b><span class="text-info"  style="text-decoration:none;" ><?=$rec['nombre'];?></span></b-->
               
                <!--IMAGEN O VIDEO-->
                <?
                if($rec['id_tipo_contenido']=='2') # IMAGENES
                {
                    $m_nsfw = '';

                    //$cadena = "Sin León no hubiera España";
                    $buscar = "mypack";
                    $resultado = strpos($rec['src'], $buscar);
                    
                    $extension = end( explode('.',$rec['src']) );

                    $width_img = 'width:100%;max-width:100%;';
                    if($extension=='gif')
                    {
                        $width_img = 'max-width:100%;';
                    }
                    

                    if($resultado !== FALSE & $extension != 'gif')
                    {
                        // con esto se toma la miniatura de 640
                        //echo $rec['src'].'<br>';
                        //$rec['src'] = str_replace('/img/','/640/', $rec['src']);
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
                            <img src="<?=$rec['src'];?>" class="marco sfw" style="<?=$width_img;?>display:none" alt="" />
                            </a>

                        <?
                    }
                    else
                    {
                      ?><img src="<?=$rec['src'];?>" class="marco" style="<?=$width_img;?>" alt="" /></a><?
                    }
                 
                }
                else if($rec['id_tipo_contenido']=='3')
                {
                    if($rec['tipo_archivo'] == 'mp4' || $rec['tipo_archivo'] == 'webm')
                    {
                        if($rec['tipo_archivo'] == 'mp4')
                        {
                            $sorce_video = "<source src='".$rec['src']."' type='video/mp4' />";
                        }

                        if($rec['tipo_archivo'] == 'webm')
                        {
                            $sorce_video = "<source src='".$rec['src']."' type='video/webm' />";
                        }

                        ?>
                            
                            <video controls loop width="100%">                          
                              <?=$sorce_video;?>
                               No se puede visualizar video. Descargar <a href="<?=$rec['src']?>">Aqui</a>.
                            </video>
                        <?
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
                            $cod_video  = $c_sistema->parse_youtube_url($rec['codigo'],'embed',160);    
                        }

                        ?>
                            <div id="vid_<?=$rec['id_contenido'];?>" class="video" style="max-width:100%">
                                 <?=$cod_video;?>
                            </div> 

                        <?
                    }
                   
                }
                    // DESCRIPCION
                    //echo $m_nsfw;
                    //echo preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']);

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
            </div>
        </div>
    </div>


                     
            
           




            
        
        
