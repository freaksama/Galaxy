<?
    $datos['id_usuario'] = $_SESSION['s']['id_usuario'];    

    if($_GET['id']!= '')
    {
        $datos['id_contenido']  = $_GET['id'];
    }   


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


    if(isset($_POST['btn_enviar_comentario']))
    {
        //print_r($_POST);

        /*require_once "rec/recaptchalib.php";
        $secret = "6LeRchMTAAAAAAgW3fcCbdL0ZM2gMpl4Ad3iAHg9";    
         
        // respuesta vacía
        $response = null;
         
        // comprueba la clave secreta
        $reCaptcha = new ReCaptcha($secret);

        if ($_POST["g-recaptcha-response"]) 
        {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );
        }  

        print_r($response);

        /*if($response != null && $response->success)
        {
            $captchat = true;
        }
        else
        {
            $captchat = false;
        }*/



        if($_POST['txt_comentario']!= '' & $_POST['g-recaptcha-response'] != '')
        {
            $r = $c_sistema->registrarComentarioAnonimo($_POST);

            if($r['codigo']=='000')
            {
                $mensaje = '<div class="alert alert-dismissible alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Perfecto !</strong> Tu comentario se registro de manera exitosa ;)</a>.
                            </div>';
            }
            else
            {
                $mensaje = '<div class="alert alert-dismissible alert-danger">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Chispas !</strong> Ocurri&oacute; un error al registrar tu comentario ;)</a>.
                            </div>';
            }   
        }


    }



    $reg = $c_sistema->obtenerContenidoGeneral($datos);    

    if($_SESSION['s']['id_usuario'] != '')
    {
        $t = $c_sistema->generar_notificacion_post_visto($reg);    
    }

    $post = $c_sistema->obtenerSiguienteContenido($datos);

    $tmp['id_usuario']  = $reg['id_usuario'];
    $tmp['id_contenido']= $reg['id_contenido'];

    $result_m = $c_sistema->listadoUltimosPublicacionesUsuario($tmp);

    //print_r($reg);

    if(count($reg)=='0')
    {
        //echo 'Erro 404';
        echo'<script type="text/javascript">window.location.href = "error_404";</script>';  
    }


    $vc = $c_sistema->registrarVistaPublicacion($reg);

    
    
    $rec['veces_visto'] = $vc['veces_visto'];


    //$src_mini = str_replace('/pic/img/', '/pic/160/', $rec['src']);

    $temp['tipo_comentario'] = '1'; 


    

    



    ///print_r($r);

    
    
   


   


?>
    <meta property="og:title" content="My Pack, comparte lo que te gusta ;)" />
    <meta property="og:description" content="<?= strip_tags($reg['descripcion']);?>" />
    <meta property="og:image" content="<?=$reg['src'];?>" />      
    <meta property="og:url" content="http://mypack.me" />

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
    var id_usuario_actual = '<?=$_SESSION["s"]["id_usuario"];?>';
    var img_like        = 'img/like.png';

    var page            = 'detalles';

</script>
<!--script src="<?=$url_g;?>js/funciones_mp.js" ></script-->



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
<br>



<div class="col-lg-3">
    <a href="http://redmedicaonline.com?src=mypack" target="_BLANK">
        <img src="img/publicidad/4.jpg"  />
    </a>
</div>

<div class="col-lg-5">
<?=$mensaje;?>
<?
    $rec = $reg;
    include("contenido_general.php");
?> 
</div>

<div class="col-lg-3">
    <div class="panel panel-primary">
        
        <div class="panel-body">
            <div class="text-center">
            <ul class="pager">                
                <li class="next f14"><a style="float:none" href="post/<?=$post['id_contenido'];?>/<?=$c_sistema->urls_amigables($post['nombre']);?>">Siguiente Post &gt;&gt;</a></li>
            </ul>
            </div>
            <hr>
            <?
                if($_SESSION['s']['id_usuario'] == '')
                {                    
                    ?>
                        <form class="form-horizontal" action="index.php?op=login" method="POST">
                            <fieldset>
                                <h5><b>Ingresa a MyPack xD</b></h5>
                              
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

                                    <div class="form-group text-center">
                                        <div class="col-lg-10 col-lg-offset-1">
                                            <input type="hidden" name="txturl" id="txturl" value="<?=urldecode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>" />
                                            <a href="registro/url/post/<?=$reg['id_contenido'];?>" class="btn btn-success"  ><b> Registrate ;)</b></span></a>
                                            <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">Ingresar</button>
                                        </div>
                                    </div>

                            </fieldset>
                          </form>
                          <hr>
                          
                          <hr>
                    <?
                }
            ?>



            <h5 class="text-center">&Uacute;ltimos post de <a href="u/<?=$reg['nombre_usuario'];?>">@<?=$reg['nombre_usuario'];?></a></h5>
                <div class="col-lg-12">
                  <?
                       
                        if(count($result_m)>0)
                        {

                            foreach($result_m as $rec)
                            {
                                    include("contenido_mini.php");
                                
                            }
                        }
                    ?> 
                </div>

        </div>
    </div>
</div>


	

   