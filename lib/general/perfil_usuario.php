<?
    
    $datos['id_usuario']  = $_SESSION['s']['id_usuario'];  
    $datos['tags']        = $_GET['tag'];
    $datos['page']        = $_GET['page'];
    $datos['consulta']    = $_GET['q'];    
    $datos['tab']         = $_GET['tab'];
    
    
    if($_GET['u'] != '')
    {
        $datos['nombre_usuario'] = $_GET['u'];  
    }

    $tmp = $c_sistema->obtenerDatosNombreUsuario($datos);

   
    $vista['P']['nombre']   = 'P&uacute;blico';
    $vista['P']['img']      = 'img/globe-20.png';
    $vista['R']['nombre']   = 'Usuarios Registrados';
    $vista['R']['img']      = 'img/user-group-20.png';
    $vista['S']['nombre']   = 'Seguidores';
    $vista['S']['img']      = 'img/users.png';
    $vista['O']['nombre']   = 'Privado';
    $vista['O']['img']      = 'img/lock.png';

    //print_r($tmp);

    

    $datos['id_usuario'] = $tmp['id_usuario'];  
    $datos['id_usuario_user'] = $tmp['id_usuario'];    

    $vis    = $c_sistema->registrarVisitaPerfil($datos);

    $datos['user'] = $tmp['nombre_usuario'];

    $reg    = $c_sistema->obtenerDatosUsuario2($datos); 
    $result = $c_sistema->listadoContenidoGeneral($datos); 
    $seg    = $c_sistema->validarSeguidor($datos);

    $datos['id_usuario']  = $_SESSION['s']['id_usuario'];  

    


    $pasatiempos   = $c_sistema->obtenerPasatiemposUsuario($reg);

    $vista['P']['nombre']   = 'P&uacute;blico';
    $vista['P']['img']      = 'img/globe-20.png';
    $vista['R']['nombre']   = 'Usuarios Registrados';
    $vista['R']['img']      = 'img/user-group-20.png';
    $vista['S']['nombre']   = 'Seguidores';
    $vista['S']['img']      = 'img/users.png';
    $vista['O']['nombre']   = 'Privado';
    $vista['O']['img']      = 'img/lock.png';

    $vista_default['nombre'] = $vista[$_SESSION['s']['vis_def']]['nombre'];
    $vista_default['img']    = $vista[$_SESSION['s']['vis_def']]['img'];
    $vista_default['valor']  = $_SESSION['s']['vis_def'];

    
    $usuarios = $c_sistema->obtenerSiguiendoNombreUsuarioMini($datos);   


    //print_r($usuarios);
    

    $resultado = $result['datos'];
    $paginacion = $result['paginador'];




    $temp['tipo_comentario'] = '1'; 
    
    

    if($seg['id'] != '0')
    {
        $boton_seguir = '<a id="btn_seguir'.$reg['id_usuario'].'"   class="btn btn-primary btn_dejar_seguir" data-id-usuario="'.$reg['id_usuario'].'">&nbsp;&nbsp;&nbsp;<img src="img/adduser.png" style="width:16px" /><b>Siguiendo</b>&nbsp;&nbsp;&nbsp;</a>';
    }
    else
    {
        $boton_seguir = '<a id="btn_seguir'.$reg['id_usuario'].'"   class="btn btn-default btn_seguir" data-id-usuario="'.$reg['id_usuario'].'" >&nbsp;&nbsp;&nbsp;<img src="img/adduser.png" style="width:16px" /><b>Seguir</b>&nbsp;&nbsp;&nbsp;</a>';   
    }
    
    if($_GET['tab'] != '')
    {
        $destino = "u/".$_GET['u']."/tab/".$_GET['tab'];
    }
    else
    {
        $destino = "u/".$_GET['u'];    
    }
    
    
    $page = $_GET['page'];

    if($page == '1' || $page < '1')
    {
        //$lk_anterior  = '<li class="previous disabled"><a href="#">&lt;&lt; Anterior</a></li>';
        if(count($resultado)>4 )
        {
            $lk_siguiente   = '<li class="next"><a class="f18" href="'.$destino.'/page/2">Siguiente &gt;&gt;</a></li>';
        }
        
    }
   else if(count($resultado)< 5 )
   {
        $lk_anterior    = '<li class="previous "><a class="f18" href="'.$destino.'/page/'.($page - 1 ).'">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next disabled"><a class="f18" href="#">Siguiente &gt;&gt;</a></li>';
    }
    else
    {
        $lk_anterior    = '<li class="previous "><a class="f18" href="'.$destino.'/page/'.($page - 1 ).'">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next"><a class="f18" href="'.$destino.'/page/'.($page + 1 ).'">Siguiente &gt;&gt;</a></li>';
    }

    

?>
<style type="text/css">
body {  
    background-image: url("<?=$reg['fondo_web'];?>");     
    background-attachment: fixed;
    overflow: scroll;
}    
</style>

<script type="text/javascript">
    var pagina          = '<?=$page;?>';
    var categoria       = '<?=$datos["cat"];?>';
    var id_categoria    = '<?=$datos["id_categoria"]?>';
    var img_cat         = '<?=$datos["img_cat"]?>';
    var mejor           = '<?=$datos["mejor"];?>';
    var tags            = '<?=$datos["tags"];?>';
    var consulta        = '<?=$datos["consulta"];?>';
    var like            = '<?=$datos["like"];?>';
    var despl_inf       = "<?=$_SESSION['s']['desp_inf'];?>";
    var movil           = '<?=$movil;?>';
    var avatar          = '<?=$_SESSION["s"]["avatar"];?>';
    var nombre_usuario  = '<?=$_SESSION["s"]["nombre_usuario"];?>';

    var page            = 'perfil';

</script>
<!--script src="<?=$url_g;?>js/funciones_mp.js" ></script-->




<div class="col-lg-3">
    <?
        include('lib/sidebar/perfil_usuario.php');
    ?>    
</div>





    
    <div class="col-lg-5"  >

        <?  
            include 'lib/general/frm_nueva_publicacion.php';
        ?>   

      
     <?
        if(count($resultado)>0)
        {
          foreach($resultado as $rec)
          {
            include("lib/general/publicacion.php");
          }
        }
      ?>  
      
       <!--div id="contenido-last"></div>

        </div>
        
        <div id="load_cont" class="col-lg-offset-2 col-lg-7 text-center" style="display:none">
            <img src="img/load_08.gif" /> Cargando contenido....
        </div-->

        <div id="lk_page" class="text-center">
            <ul class="pager">
                <?=$lk_anterior;?>
                <?=$lk_siguiente;?>
            </ul>
        </div>    

    </div>
<br> 
   



    <!--AGREGAR URL-->
    <div id="myModa2" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Agregar c&oacute;digo Url</h4>
                </div>

                <div class="modal-body">
                    <p>
                        <input type="text" class=" form-control input-sm mb5" id="txtlink"  name="txtlink" placeholder="http://mypack.me" />
                        
                        <br><br>

                        <span class="text-muted">
                            Agrega una url de un sitio interesante, o la fuente de la imagen a publicar.
                        </span>
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_m2_acep" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

 <div id="myModa3" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Seleccione una imagen</h4>
            </div>

            <div class="modal-body">
                    
                <div class="tab-pane active fade in " id="subirmeme">                                            
                    <form method="POST"  enctype="multipart/form-data">                                    

                        <div style="text-align:center">
                            <a id="lk_mm" class="btn btn-default" style="cursor:pointer">
                                <div class="image-selector">
                                    <input class="file-data" type="hidden" name="media_data_empty" value="">
                                        <div class="multi-photo-data-container hidden"></div>
                                            <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                                <img src="img/new.png" style="width:24px" />
                                                <span class="visuallyhidden">Subir Imagen</span> 
                                                <span id="im_f"></span>
                                                <input type="file" name="fileimg_meme" id="fileimg_meme" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                            </label>
                                    <div class="swf-container"></div>
                                </div>
                            </a>
                        <br>
                        
                            <img id="img_reg_mm" style="max-height:200px;max-width:300px;margin:top:5px;display:none;" />
                        </div>

                        <br>
                        <input type="text" class="form-control " name="txtdescr" id="txtdescr" style="display:none" placeholder="Descripcion del meme..." />
                        <br>
                        <div class="fr text-center">
                            <a id="lk_reg_mm" class="btn btn-primary">Subir Imagen</a>
                        </div>                                                
                    </form>
                </div>
            </div>                            
        </div>
    </div>
</div>

    <div id="myModa4" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Seleccione una imagen</h4>
                </div>

                <div class="modal-body">
                    
                    <input type="hidden" id="tmp_id" />
                    <ul class="nav nav-tabs">
                      <li class="active"><a aria-expanded="false" href="#personas" data-toggle="tab"><span class="em" style="background:url(img/svg/0.svg);"></span></a></li>
                      <li class=""><a id="lk_natu" aria-expanded="true" href="#naturaleza" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/189.svg);"></span></a></li>
                      <li class=""><a id="lk_obje" aria-expanded="true" href="#objetos" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/305.svg);"></span></a></li>
                      <li class=""><a id="lk_simb" aria-expanded="true" href="#simbolos" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/535.svg);"></span></a></li>
                      <li class=""><a id="lk_espe" aria-expanded="true" href="#especiales" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/636.svg);"></span></a></li>                                      
                    </ul>

                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane fade active in" id="personas">
                        <p>
                            <br>
                            <?
                                for($i = 0;$i <= 188;$i++)
                                {
                                    ?><!--a href="javascript:void(0)" class="emoji" style="margin:3px;"><span class="em" style="background:url(img/svg/<?=$i;?>.svg);">&nbsp;</span></a--><?
                                    ?><a href="javascript:void(0)" class="emoji" style="margin:3px;"><img class="em" src="img/svg/<?=$i;?>.svg" /></a><?
                                }
                            ?>
                            
                        </p>
                      </div>

                      <div class="tab-pane fade " id="naturaleza">
                        <p id="emo_natu"></p>
                      </div>

                      <div class="tab-pane fade " id="objetos">
                        <p id="emo_obje"></p>
                      </div>

                      <div class="tab-pane fade " id="simbolos">
                        <p id="emo_simb"></p>
                      </div>

                      <div class="tab-pane fade " id="especiales">
                        <p id="emo_espe"></p>
                      </div>

                    </div>                                
                </div>  
                <div class="modal-footer">
                    <span id="emoji_m" style="float:left"></span>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Listo</button>                                    
                </div>                          
            </div>
        </div>
    </div>


    </div>