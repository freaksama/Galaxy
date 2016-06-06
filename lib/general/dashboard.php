<?  
    
    $datos['id_usuario']  = $_SESSION['s']['id_usuario'];  
    $datos['tags']        = $_GET['tag'];
    $datos['page']        = $_GET['page'];
    $datos['consulta']    = $_GET['q'];    
    $datos['cat']         = trim($_GET['cat']);
    $datos['all']         = 'N';

    $datos['widget']      = 'dashboard';

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
    
    $dash     = $c_sistema->obtenerDatosDashboardUsuario();
    
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
    

    if (($_GET['op'] == 'mejor' || $dash['siguiendo']=='0' ) & $datos['consulta'] == '')
    {   
        $c_t = 'P';
        $datos['mejor'] = 'S';        
    }

    if($_GET['op']=='like')
    {
        $datos['like'] = 'S';
    }

   if($_GET['op2']=='send')
    {
        $datos['send'] = 'S';
    }

    if($_GET['op2']=='all')
    {
        $datos['all'] = 'S';
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

    


    
    /*$datos['multimedia'] = 'N';
    
    $result2 = $c_sistema->listadoContenidoGeneral($datos);
    
    $resultado = $result2['datos'];
    $paginacion = $result['paginador'];*/

    //print_r($result);



    
    
    if( $dash['siguiendo'] == 0 )
    {
        $mensaje_global = '<div class="alert alert-dismissible alert-info">
                                <button class="close" data-dismiss="alert" type="button">&times;</button>                                
                                Es necesario que sigas a otros usuarios para mejorar tu experiencia en Red Galaxy. 
                            </div>
                            ';
        //$result  = $c_sistema->listadoContenidoGeneral($datos);   
    }


    $resultado = $result['datos'];
    $paginacion = $result['paginador'];
    
    $resultado2 = $result2['datos'];

    //print_r($_SESSION);

    $temp['tipo_comentario'] = '1'; 

    $avatar_actual = $_SESSION['s']['avatar'].'?op='.rand();                         
   
    $destino = "index.php?op=dash&q=".$_GET['q'];

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

    if($_GET['cat'] == '' & $_GET['tag'] == '' & $_GET['q'] == '' )
    {
        $destino = "dashboard";
    }

    if($_GET['op']=='like')
    {
        $destino = "dashboard/liked";        
    }

    if($_GET['op2']=='ofi')
    {
        $destino = "oficina";        
    }
    if($_GET['op3']=='super')
    {
        $destino = "super_random";        
    }

   
    //$destino = "index.php?op=dashini&q=".$_GET['q']."&cat=".$_GET['cat']."&tag=".$_GET['tag'];

    //print_r($paginacion);
    
    $page = $_GET['page'];

    if($page == '')
    {
        $page = '1';   
    }

    if($page == '1' || $page < '1')
    {
        //$lk_anterior  = '<li class="previous disabled"><a href="#">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next"><a href="'.$destino.'/page/2">Siguiente &gt;&gt;</a></li>';
    }    
    else
    {
        $lk_anterior    = '<li class="previous "><a href="'.$destino.'/page/'.($page - 1 ).'">&lt;&lt; Anterior</a></li>';
        $lk_siguiente   = '<li class="next"><a href="'.$destino.'/page/'.($page + 1 ).'">Siguiente &gt;&gt;</a></li>';
    }



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
    var op2             = '<?=$_GET["op2"];?>';
    var op3             = '<?=$_GET["op3"];?>';
    var live            = '<?=$datos["live"];?>';
    var despl_inf       = "<?=$_SESSION['s']['desp_inf'];?>";
    var movil           = '<?=$movil;?>';
    var avatar          = '<?=$_SESSION["s"]["avatar"];?>';
    var nombre_usuario  = '<?=$_SESSION["s"]["nombre_usuario"];?>';
    var id_usuario_actual = '<?=$_SESSION["s"]["id_usuario"];?>';
    var page            = 'dashboard';
    var img_like        = 'img/like.png';


</script>


    <div class="col-lg-3">
        <?
            include 'lib/sidebar/dashboard.php';
        ?>
    </div>

    <div class="col-lg-5">

        <?=$mensaje_global;?>
        
        <?  
            include 'lib/general/frm_nueva_publicacion.php';
        ?> 
        <span><img src="img/alert.png" />Hola te presentamos la nueva opci&oacute;n (Buena suerte) <a href="super_random">Super Random</a></span>               
        <?
            if($_SESSION['s']['avatar']=='http://mypack.me/img/user.png')
            {
                ?>
                    <div class="alert alert-dismissible alert-info">
                        <button class="close" data-dismiss="alert" type="button">&times;</button>
                        <strong>Hola amigo!</strong><br>
                        Te recomendamos capturar un avatar para que personalices tu cuenta 
                        <a href="index.php?sub=cue&op=ava" class="text-danger">Da clic Aqu&iacute;</a><br>                                
                    </div>            
                <?
            }
        ?>            

        <?
            if(count($resultado)>0)
            {
                foreach($resultado as $rec)
                {
                    include('publicacion.php');    
                }
            }
        ?>  

        <?
            if($_SESSION['s']['desp_inf']=='N' || $movil == true)
            {
                ?>
                    <div id="lk_page" class="text-center">
                        <ul class="pager">
                            <?=$lk_anterior;?>
                            <?=$lk_siguiente;?>
                        </ul>
                    </div>
                <?
            }
        ?>                        
                        
        <div id="contenido-last"></div>
        
        <div id="load_cont" class="col-lg-12 text-center" style="display:none">
            <div class="panel panel-default" style="margin-bottom: 10px;">                
                <div class="panel-body">            
                    <div id="d_loag_img" class="text-center">
                        <img src="img/load.gif" /> Cargando contenido....
                    </div>       
                </div>
            </div>          
        </div>
    </div><!--FIN COL 5-->

    <div class="col-lg-4">
        <?
            include 'lib/general/inbox/listado_inbox_dashboard.php';
        ?>
    
        <div id="lk_clean_noti" class="panel panel-default" style="display:none" >
            <div class="panel-heading">
                <h5 class="panel-title f12">
                    <b>Notificaciones</b>
                    <div  style="float:right">
                        <a id="lk_clear_noti" class="f18" href="javascript:void(0)">&times;</a><br><br>
                    </div>
                </h5>                                
            </div>
            
            <div class="panel-body">
                <div id="noti-ms" class="p-10">
                    <div class="text-center">
                        
                    </div>
                </div>
            </div>
        </div>                         
    </div><!-- FIN COL 4-->
                    
                
                
            




   












    

    



    

    

    
    


    



