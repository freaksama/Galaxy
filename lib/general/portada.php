<?  
    
    $datos['id_usuario']  = $_SESSION['s']['id_usuario'];  
    $datos['tags']        = $_GET['tag'];
    $datos['page']        = $_GET['page'];
    $datos['consulta']    = $_GET['q'];    
    $datos['cat']         = $_GET['cat'];
    //$datos['rss']         = 'S';
    $datos['all']         = 'N';

    $categorias           = $c_sistema->obtenerCategorias();    

    //$publicidad           = $c_sistema->obtenerPublicidadActiva();
    

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

    if($_GET['op2']=='live')
    {
        $datos['live'] = 'S';
    }
    
    //$datos['multimedia'] = 'N';
    if($_GET['op3']=='super')
    {
        $result  = $c_sistema->listadoContenidoGeneralSuperRandom($datos);    
    }
    else
    {
        $result  = $c_sistema->listadoContenidoGeneral($datos);
    }

    $r_user  = $c_sistema->rankingUsuarios();

    $result_m = $c_sistema->listadoContenidoPopularesMenAnterior($datos);

    //print_r($result_m);

    $frase    = $c_sistema->obtenerFraseRandom();

    //$count_categorias     = $c_sistema->countCategorias();  


    
    //$usuarios_online = $c_sistema->obtenerUsuariosOnline();
    
    $visi = $c_sistema->ObtenerVisitasHoy();

    
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

    $destino = "";    
    
    
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

    if($_GET['op2']=='live')
    {
        $destino = "live";        
    }

    if($_GET['cat'] == '' & $_GET['tag'] == '' & $_GET['q'] == '' & $_GET['op'] != 'mas' & $_GET['op2'] != 'all' &   $_GET['op2'] != 'live')
    {
        $destino = "dashboard";
    }

    if($_GET['op3']=='super')
    {
        $destino = "super_random";        
    }

   
    //$destino = "index.php?op=dashini&q=".$_GET['q']."&cat=".$_GET['cat']."&tag=".$_GET['tag'];

    //print_r($paginacion);
    
     $page = $_GET['page'];

    if($page == '1' || $page < '1')
    {
        //$lk_anterior  = '<li class="previous disabled"><a href="#">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next"><a class="f18" href="'.$destino.'/page/2">Siguiente &gt;&gt;</a></li>';
    }
   else if( count($resultado)< 5 )
   {
        $lk_anterior    = '<li class="previous "><a class="f18" href="'.$destino.'/page/'.($page - 1 ).'">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next disabled"><a class="f18" href="#">Siguiente &gt;&gt;</a></li>';
    }
    else
    {
        $lk_anterior    = '<li class="previous "><a class="f18" href="'.$destino.'/page/'.($page - 1 ).'">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next"><a class="f18" href="'.$destino.'/page/'.($page + 1 ).'">Siguiente &gt;&gt;</a></li>';
    }


    //$last_comentarios = $c_sistema->ultimosComentariosInicio();

    //print_r($last_comentarios);

?>

<br>



<script type="text/javascript">
    var pagina          = '<?=$page;?>';
    var categoria       = '<?=$datos["cat"];?>';
    var id_categoria    = '<?=$datos["id_categoria"]?>';
    var img_cat         = '<?=$datos["img_cat"]?>';
    var mejor           = '<?=$datos["mejor"];?>';
    var tags            = '<?=$datos["tags"];?>';
    var consulta        = '<?=$datos["consulta"];?>';
    var like            = '<?=$datos["like"];?>';    
    var movil           = '<?=$movil;?>';
    var load_val        = 1;    
    var band_blo_das    = 0 ;
    var despl_inf       = "<?=$_SESSION['s']['desp_inf'];?>";
    /*var band_blo_pub = 0 ;
    var panel_prin   = 1 ;
    var panel_chat   = 1 ;
    var id_com_act   = 0 ;
    var httpR;*/

</script>

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

    $(document).on("click",".lk_more",function(){
        var idc = $(this).attr('id');
        var id  = idc.substr(6) ;
        
        cargar_comentarios(id);
        return false;
    });


    

});// fin de ready



    

    function reportar_link(id)
    {
      var id    = id; 

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
    }

    function cargar_comentarios(id)
    {
      var id    = id; 
      var tipo  = '1';
      //var come  = $("#"+id_text).val();

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
                              var div_comentario ='<div id="comentario_' + r[i].id_comentario + '" class="comentario">\
                              <div class="imagen-avatar" style="">\
                                <a href="u/'+r[i].nombre_usuario+'"><img src="' + r[i].avatar + '" class="marco_av" style="width:42px;height:42px;" /></a>\
                              </div>\
                              <div class="cuerpo-comentario" ><a href="u/'+r[i].nombre_usuario+'">@'+r[i].nombre_usuario+'</a><span class="text-muted f10" href="#">' + r[i].fecha + '</span><br>\
                              <span class="f14">' + r[i].comentario + '</span>\
                              </div>\
                            </div>\
                            <hr class="hr">';
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

    

    
 

 
    


</script>

<script type="text/javascript">

 


</script>



<br>
<br>
<br>
<div class="col-lg-2">       
    <a href="http://redmedicaonline.com?src=mypack" target="_BLANK">
        <img src="img/publicidad/1.jpg" style="width:100%" />
    </a>
</p>
</div>
<div class="col-lg-5">       
    
    <?  
        //include 'componentes/general/frm_nueva_publicacion_anonimo.php';
    ?>
       <span><img src="img/alert.png" />Hola te presentamos la nueva opci&oacute;n (Buena suerte)<a href="super_random">Super Random</a></span>                
    
<?
    if(count($resultado)>0)
    {
      foreach($resultado as $rec)
      {
         include("publicacion.php");        
      }
    }
  ?>  

  <div id="fb-root"></div>




     
    
    
<div id="lk_page" class="text-center" >
    <ul class="pager">
        <?=$lk_anterior;?>
        <?=$lk_siguiente;?>
    </ul>
</div>


</div>

    <?
        if($_SESSION['s']['id_usuario']=='')
        {

            ?>
            <div class="col-lg-4">
                <div class="panel panel-default">                
                    <div class="panel-body">
                <h1>Red Galaxy!</h1>
                <p>
                    <b>Version 1.0</b><br>
                    
                    Red Galaxy es un sistema web para que puedas montar tu propia red social con pocos clics.
                    Tambi&eacute;n es un lugar para compartir material de humor <br><br>                 
                    Aqu&iacute; podras ver miles de imagenes graciosas, todos los dias publicamos contenido nuevo.
                    De hecho publicamos a cada rato jjajaja<br><br>
                    Pasate un buen rato y r&iacute;e con nosotros.                     
                    <br><br>
                    Si tienes alguna duda o comentario por favor mandamelo al mi correo <a href="mailto:mypackme@gmail.com">mypackme@gmail.com</a> te aseguro que lo reviso todos los dias y leo todos los correos. 
                    
                    <br><br>
                    Si lo que necesitas es publicidad para tu negocio o pagina web, enviame un correo con el asunto CONTACTO y me comunicare contigo a la brevedad. 
                    
                    
                </p>                
                <br><br>
                <h3>Donaciones</h3>

                Contribuye a este proyecto, has tu donaci&oacute;n para mejorar el servicio. Necesitamos mas servidores y una APP. 
                <div class="text-center" >
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="M49QT23TVGPDN">
                        <input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, la forma mÃ¡s segura y rÃ¡pida de pagar en lÃ­nea.">
                        <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>

                Siguenos en : 
                <a href="https://www.facebook.com/profile.php?id=100009506299027" target="_blank"><img src="img/facebook-32.png" /></a>
                <a href="https://twitter.com/mypackme"  target="_blank" ><img src="img/twitter-32.png"  /></a>
                <a href="list/rss"><img src="img/rss-32.png"  style="width:32px;" /></a>
                 
                <p>
                <br><br>
                N&uacute;mero de Visitas  : <span class="label label-primary" style="font-size:16px;"><?=number_format($visi['visitas']);?></span>
                </p>
                
                <hr class="whiter" />
                <br>
                  <form class="form-horizontal" action="index.php?op=login" method="POST">
                    <fieldset>
                      <h5><b>Ingresa a MyPack ;)</b></h5>
                      
                      <div id="text_usuario" class="form-group">                        
                        <div class="col-lg-12">
                          <span id="ms_user" class="text-danger"></span>
                          <input type="hidden" id="nombre_valido" value="N" />                  
                          <input type="text" class="form-control input-sm" id="txtusuario" name="txtusuario"  placeholder="Nombre de Usuario" />
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-lg-12">
                          <input type="password" class="form-control input-sm" name="txtpassword" id="txtpassword" size="20" value="<?=$_POST['txt_new_pass'];?>" placeholder="Contrase&ntilde;a">
                        </div>
                      </div>

                      <div class="form-group text-right">
                        <div class="col-lg-10 col-lg-offset-1">
                            <a id="lk_l"href="registro"  class="btn btn-sm btn-success"><b> Registrate ;)</b></a>
                            <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-sm btn-primary">Ingresar</button>
                        </div>
                      </div>

                    </fieldset>
                  </form> 


               <h5><b>Ingresa a MyPack con tu cuenta de Facebook</b></h5>
               <div class="text-center">
	               <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" onlogin="checkLoginState();" data-auto-logout-link="false">
                   
        	       </div>
               </div>

                <div id="status">
                </div>

                  <hr class="whiter" />

                  <div class="alert alert-dismissible alert-info">
                    <button class="close" data-dismiss="alert" type="button">&times;</button>
                    Tips : <?=$frase['frase'];?>
                </div>
                 
                   

                  
                  
                  <?
                    //include('componentes/general/login-google.php');
                  ?>

                    <hr class="whiter" />
                    <?
                        if($movil)
                        {
                            ?>
                            	<h5><b>Ingresa a MyPack con tu cuenta de Facebook</b></h5>

                               <div class="text-center">
                	               <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" onlogin="checkLoginState();" data-auto-logout-link="false">                                   
                        	       </div>
                               </div>
                               
                                <a href="categorias"><img src="img/category-32.png" width="32" /> Explorar categor&iacute;as</a> 
                                <br>
                                <br>
                                <a href="tags"><img src="img/tags-32.png" width="32" /> Ver M&aacute;s Tags</a>
                                <br>
                                <br>
                                <a href="all"><img src="img/all-48.png" width="32" /> Todas las Publicaciones</a>
                                <br>
                                <br>
                                <a href="mas_vistos"><img src="img/more-view-64.png" width="32" /> Publicaciones m&aacute;s vistos</a>
                                <br>
                                <br>
                                <a href="list/rss"><img src="img/rss-32.png" width="32" /> Suscribete a un canal</a>


                            <?
                        }
                        else
                        {
                            ?>
                                <h4>Publicaciones Anteriores</h4>
                                <?                                   
                                    if(count($result_m)>0)
                                    {
                                        foreach($result_m as $rec)
                                        {
                                            include("contenido_mini.php");
                                        }
                                    }
                                ?> 

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <th colspan="2" class="text-center">Ranking Usuarios</th>
                                </thead>
                                <tbody>
                                    <?
                                        if(count($r_user) > 0)
                                        {
                                            foreach ($r_user as $ru)
                                            {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <a href="u/<?=$ru['nombre_usuario'];?>">
                                                                <img src="<?=$ru['avatar'];?>" class="w20" />
                                                                @<?=$ru['nombre_usuario'];?>    
                                                            </a>
                                                        </td>
                                                        <td><a href="u/<?=$ru['nombre_usuario'];?>"><?=$ru['publicaciones']?></a></td>
                                                    </tr>
                                                <?
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>

                            <hr class="whiter" />
                            <h3>
                                <a href="tags">Nube de Tags </a>
                            </h5>
                            <?
                                $nube_tags =  $c_sistema->ObtenerNubeTags();

                                shuffle($nube_tags);

                                foreach($nube_tags as $rec)
                                {
                                    if($rec['tags'] != '')
                                    {
                                        $link = 'tags/'.trim($rec['tags']);
                                    }

                                    if($rec['valor'] < 5)
                                    {
                                        $font = '10px';
                                    }
                                    else if($rec['valor'] > 5 & $rec['valor'] < 10)
                                    {
                                        $font = '12px';
                                    }
                                    else if($rec['valor'] > 10 & $rec['valor'] < 30)
                                    {
                                        $font = '16px';
                                    }
                                    else if ($rec['valor'] > 30)
                                    {
                                        $font = '20px';
                                    }

                             
                                    echo '<a href="'.$link.'" style="font-size:'.$font.'" title="'.$rec['valor'].'">#'.trim(ucwords($rec['tags'])).'</a> ';

                                }
                            ?>
                           <br>
                        <?
                    }
                ?>

                <?
                        if(!$movil)
                        {
                            ?>
                                <hr>
                                <div class="text-center">
                                    <h3>Mas Categor&iacute;as </h5>
                                </h3>

                                <div class="text-center" >
                                <?
                                    foreach ($categorias as $c_c) 
                                    {
                                        ?>
                                            <a href="cat/<?=$c_c['codigo_categoria'];?>" style="text-decoration:none;">
                                                <img class="profile-pic animated w64 mb5" src="<?=$c_c['img'];?>" style="height:64px;" title="<?=$c_c['nombre_categoria'];?>" />
                                            </a>                                                                
                                        <?
                                    }
                                ?>
                                </div>
                            <?
                        }
                    ?>
                    <hr>
                   </div>
                </div>
                </div>
                </div>

            <?
    
        }
    ?>
    


<br>
<div class="col-lg-8 col-lg-offset-2">

</div>

