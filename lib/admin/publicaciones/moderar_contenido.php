<?  
    
    $datos['id_usuario']  = $_SESSION['s']['id_usuario'];  
    $datos['tags']        = $_GET['tag'];
    $datos['page']        = $_GET['page'];
    $datos['consulta']    = $_GET['q'];    
    $datos['cat']         = $_GET['cat'];
    $datos['rss']         = 'N';
    $datos['all']         = 'S';

    ///$categorias           = $c_sistema->obtenerCategorias();    

    //$publicidad             = $c_sistema->obtenerPublicidadActiva();
    

    if($datos['cat']=='adulto')
    {
        //echo 'window.location.href = "index.php?op=login&op2=2";';
    }
   

    if($datos['id_categoria'] == '' & $datos['consulta'] == '')
    {
        $datos['mejor'] = 'S';    
    }

    if($_GET['op']=='mas')
    {
        $datos['mas_visto'] = 'S';
    }
    
    if($_GET['op2']=='all')
    {
        $datos['all'] = 'S';
    }
    
    $result  = $c_sistema->listadoContenidoGeneral($datos);

    //$r_user  = $c_sistema->rankingUsuarios();

    //$result_m = $c_sistema->listadoContenidoPopularesMenAnterior();

    //$frase    = $c_sistema->obtenerFraseRandom();

    //$count_categorias     = $c_sistema->countCategorias();  


    
    //$usuarios_online = $c_sistema->obtenerUsuariosOnline();
    
    //$visi = $c_sistema->ObtenerVisitasHoy();

    
    $resultado = $result['datos'];
    $paginacion = $result['paginador'];

    $vista['P']['nombre']   = 'P&uacute;blico';
    $vista['P']['img']      = '';
    $vista['R']['nombre']   = 'Usuarios Registrados';
    $vista['R']['img']      = '';
    $vista['S']['nombre']   = 'Seguidores';
    $vista['S']['img']      = 'img/users.png';
    $vista['O']['nombre']   = 'Privado';
    $vista['O']['img']      = 'img/lock.png';
    
   
    
    

    $temp['tipo_comentario'] = '1'; 
  
    /*$avatar_actual = 'img/user.png';
    if (file_exists("src/avatar/48/".$_SESSION['s']['id_usuario'].".jpg"))
    {
        $avatar_actual ='src/avatar/48/'.$_SESSION['s']['id_usuario'].'.jpg?op='.rand();                         
    }*/

    $destino = "index.php?sub=adm&op=mod_nsfw";    
    
    
    if($_GET['q'] != '')
    {
        $destino .= "q/".$_GET['q'];
    }

    if($_GET['cat'] != '')
    {
        $destino .= "cat/".$_GET['cat'];
    }

    if($_GET['tag'] != '')
    {
        $destino .= "tags/".$_GET['tag'];
    }
    
    if($_GET['op2'] != '')
    {
        $destino .= "all";
    }    

    if($_GET['op'] == 'mas')
    {
        $destino .= "mas_vistos";
    }

    if($_GET['cat'] == '' & $_GET['tag'] == '' & $_GET['q'] == '' & $_GET['op'] != 'mas' & $_GET['op2'] != 'all' )
    {
        //$destino = "dashboard";
    }

   
    //$destino = "index.php?op=dashini&q=".$_GET['q']."&cat=".$_GET['cat']."&tag=".$_GET['tag'];

    //print_r($paginacion);
    
     $page = $_GET['page'];

    if($page == '1' || $page < '1')
    {
        //$lk_anterior  = '<li class="previous disabled"><a href="#">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next"><a class="f18" href="'.$destino.'&page=2">Siguiente &gt;&gt;</a></li>';
    }
   else if( count($resultado)< 10 )
   {
        $lk_anterior    = '<li class="previous "><a class="f18" href="'.$destino.'&page='.($page - 1 ).'">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next disabled"><a class="f18" href="#">Siguiente &gt;&gt;</a></li>';
    }
    else
    {
        $lk_anterior    = '<li class="previous "><a class="f18" href="'.$destino.'&page='.($page - 1 ).'">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next"><a class="f18" href="'.$destino.'&page='.($page + 1 ).'">Siguiente &gt;&gt;</a></li>';
    }


    //$last_comentarios = $c_sistema->ultimosComentariosInicio();

    //print_r($last_comentarios);

?>


<script type="text/javascript">
    var pagina          = '<?=$page;?>';
    var categoria       = '<?=$datos["cat"];?>';
    var id_categoria    = '<?=$datos["id_categoria"]?>';
    var img_cat         = '<?=$datos["img_cat"]?>';
    var mejor           = '<?=$datos["mejor"];?>';
    var tags            = '<?=$datos["tags"];?>';
    var consulta        = '<?=$datos["consulta"];?>';
    var like            = '<?=$datos["like"];?>';
    var mas_visto       = '<?=$datos["mas_visto"];?>';
    var all             = '<?=$datos["all"];?>';
    var despl_inf       = "<?=$_SESSION['s']['desp_inf'];?>";
    var movil           = '<?=$movil;?>';
    var avatar          = '<?=$_SESSION["s"]["avatar"];?>';
    var nombre_usuario  = '<?=$_SESSION["s"]["nombre_usuario"];?>';

    var page            = 'moderar';

</script>
<script src="<?=$url_g;?>js/funciones_mp.js" ></script>

<script type="text/javascript">
 $(document).ready(function(){   

    //cargardatos();

    $(document).on("mouseover",".like",function(){
        var idc = $(this).attr('id'); //lk_mc_1
        var id  = idc.substr(4) ;

        if(!$("#imk"+id).hasClass('liked'))
        {
            $("#imk"+id).attr('src','img/like.png');
        }        
    });

    $(document).on("mouseout",".like",function(){
        var idc = $(this).attr('id'); //lk_mc_1
        var id  = idc.substr(4) ;
        if(!$("#imk"+id).hasClass('liked'))
        {
            $("#imk"+id).attr('src','img/unlike.png');    
        }        
    });

    $(document).on("click",".report",function(){        
        var idc = $(this).attr('id'); //lk_mc_1
        var id  = idc.substr(3);      
        reportar_link(id);
        return false;
    });  

     $("#lk_clear_pub").click(function(){
        $("#d_pub").fadeOut();        
    });

     $(".lk_nsfw_a").click(function(){
        var adulto    = 'S';
        var contenido = $(this).data("id-contenido");
        marcar_contenido_adulto(contenido, adulto); 
     });

     $(".lk_nsfw_d").click(function(){
        var adulto    = 'N';
        var contenido = $(this).data("id-contenido");
        marcar_contenido_adulto(contenido, adulto); 
     });


    

});// fin de ready



    

    function marcar_contenido_adulto(id_contenido,adulto)
    {
        dataString = 'opcion=mar_con_adu&contenido=' + id_contenido + '&adulto=' + adulto ;

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
                            if(adulto=='N')
                            {
                                $("#img_nsfw_"+id_contenido).attr("src","img/nsfw.gif");
                            }
                            else
                            {
                                $("#img_nsfw_"+id_contenido).attr("src","img/adulto-64.png");
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

    

    
 

 
    


</script>
<br>
<div class="text-center">
    <h4>Moderar Contenido</h4>
</div>

<div class="col-lg-5 col-lg-offset-3">
    
<?
    if(count($resultado)>0)
    {
        foreach($resultado as $rec)
        {
            ?>
                <div id="tr_lk_<?=$rec['id_contenido'];?>" class="panel panel-default contenido" style="margin-bottom: 3px;" >
    <div class="panel-body" style="">

        <div class="" style="float:left;padding-right: 5px">
            <a href="u/<?=$rec['nombre_usuario'];?>"><img src="<?=$rec['avatar'];?>" width="32"/></a>
        </div>

        <div style="float:right">

            <?
                if( $rec['adulto']=='S')
                {
                    ?>
                        <a class="lk_nsfw_d" data-id-contenido="<?=$rec['id_contenido'];?>" href="javascript:void(0)" >
                            <img id="img_nsfw_<?=$rec['id_contenido'];?>" src="img/adulto-64.png" style="width:24px;" />
                        </a>
                    <?
                }
                else
                {
                    ?>  
                        <a class="lk_nsfw_a" data-id-contenido="<?=$rec['id_contenido'];?>" href="javascript:void(0)" >
                            <img id="img_nsfw_<?=$rec['id_contenido'];?>" src="img/nsfw.gif" style="width:24px;" />
                        </a><?
                }
            ?>

            

            <?
                if($rec['id_tipo_contenido']=='2' & $_SESSION['s']['id_usuario']!='')
                {
                    ?><a href="#myModa7" role="button" class="btn_add_con_tab" data-src="<?=$rec['src']?>" data-id-contenido="<?=$rec['id_contenido'];?>" data-toggle="modal"  ><img src="img/add-red.png" /></a><?
                }
            ?>
            
            <!--img src="<?=$vista[$rec['visibilidad']]['img'];?>" title="<?=$vista[$rec['visibilidad']]['nombre']?>" class="w20" /-->
            
            <a href="cat/<?=$rec['codigo_categoria'];?>" title="<?=$rec['nombre_categoria'];?>"><img src="<?=$rec['img'];?>" style="width:20px;" /></a> 
            <span class="text-info"><img src="img/eye-16.png" title="Veces visto" /> <b><?=$rec['veces_visto'];?></b></span>             
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
                <li><a href="#mod_c<?=$rec['id_contenido'];?>" data-toggle="modal">Compartir</a></li>
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
        </div>

        <div>            
            <b><?=$rec['nombre_real'];?></b> <a href="u/<?=$rec['nombre_usuario'];?>" class="f12">@<?=$rec['nombre_usuario'];?></a>
            <?
                if($rec['nombre_usuario_rt']!= '')
                {
                    ?><span style="font-size:12px">compartido de </span><a href="u/<?=$rec['nombre_usuario_rt'];?>">@<?=$rec['nombre_usuario_rt'];?></a><?
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
                            //$m_nsfw='<a class="perm_ns text-info" href="index.php?op=permiso-nsfw&url='.urldecode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'" style="cursor:pointer" title="seguro quieres ver esto?">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';
                            $m_nsfw='<a class="perm_ns_reg text-info" href="registro/url/post/'.$rec['id_contenido'].'" style="cursor:pointer" title="seguro quieres ver esto?">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';

                            
                        }
                        else
                        {
                            $m_nsfw='<a class="perm_nsfw" class="text-info" style="cursor:pointer" title="Solo Usuarios registrados pueden ver este contenido">Permitir ver contenido NSFW</a><span class="text-danger"></span><br>';    
                        }
                        
                        ?>
                            <img src="img/nsfw.jpg" class="marco nsfw" style="width:64px;" alt="<?=$des;?>" /></a><br>
                            <img src="<?=$rec['src'];?>" class="marco sfw" style="width:64px;display:none" alt="" />
                            </a>

                        <?
                    }
                    else
                    {
                      ?><img src="<?=$rec['src'];?>" class="marco" style="width:64px;" alt="" /></a><br><?
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
                            <span class="info"  style="font-size:20px;text-decoration:none;" ><?=$rec['nombre'];?></span>
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
                            $cod_video  = $c_sistema->parse_youtube_url($rec['codigo'],'embed',100);    
                        }

                        ?>
                            <div id="vid_<?=$rec['id_contenido'];?>" class="video" style="max-width:100%">
                                 <?=$cod_video;?>
                            </div> 

                        <?
                    }
                   
                }
                    // DESCRIPCION
                    echo $m_nsfw;
                    
                    echo '<span class="f15">'.preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']).'</span>';     

                    $m_nsfw = '';
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
            
            <div>
              
            </div>
        </div>
    </div>
    
    
            <?
        }
    }
?>  
    
    
<div id="lk_page" class="text-center" >
    <ul class="pager">
        <?=$lk_anterior;?>
        <?=$lk_siguiente;?>
    </ul>
</div>


</div>

   

