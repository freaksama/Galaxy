<?
    /**
    * redgalaxy
    * version 1.0 Build 1
    * © Diego Guerra, 2016
    *
    * Project page:    http://redgalaxy.org
    * GitHub page:     https://github.com/freaksama/redgalaxy/
    *
    * Released under MIT licence:
    * http://redgalaxy.org/licencia
    */

    session_start();    
    date_default_timezone_set('America/Chihuahua'); 
    ini_set('default_charset','iso-8859-1');
    ini_set('mbstring.internal_encoding', 'iso-8859-1');
    ini_set('mbstring.http_output', 'iso-8859-1');
    ini_set('mbstring.encoding_translation', 'On');
    ini_set('mbstring.func_overload', '6');
    
    include('config/conexion.php');       
    include('lib/clases/classSistema.php');      
    include('lib/controladores/c_sistema.php');  
    
    include('config/config.php');
    include('lib/general/validar_movil.php');  


    $db           = new MySQL();  
    $c_sistema    = new sistema_controlador($db);   

    include('config/seguridad.php');



?>
<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" >
        <meta charset="ISO-8859-1">
        <title><?=$config['titulo'];?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <base href="<?=$config['url_sitio'];?>">      
        <link href="<?=$config['url_sitio'];?>css/style_global.css" rel="stylesheet">
        <link href="<?=$config['url_sitio'].$c_sistema->obtenerTemaSistema();?>" rel="stylesheet">    
        <script src="<?=$config['url_sitio'];?>js/jquery-1.11.2.min.js"></script>    
        <link  href="<?=$config['url_sitio'];?>css/nanoscroller.css" rel="stylesheet">    
        <script src="<?=$config['url_sitio'];?>js/jquery.nanoscroller.min.js"></script>    
    </head>
    <body>
        <?
            include('lib/controladores/c_submenu.php');
        ?>
        <div class="container">
            <br><br><br>    
            <?
                include('lib/controladores/c_componentes.php');            
            ?>
        </div> 
    
        
        <script src="<?=$config['url_sitio'];?>js/ion.sound.min.js"></script>
        <script src="<?=$config['url_sitio'];?>js/main.js"></script> 
        <script src="<?=$config['url_sitio'];?>js/bootstrap.min.js"></script>        
        <script src="<?=$config['url_sitio'];?>js/scroll.min.js"></script> 
        <script src="<?=$config['url_sitio'];?>js/funciones_mp.js" ></script>                
        <link  href="<?=$config['url_sitio'];?>css/jMinEmoji-SVG.css" rel="stylesheet">
        <script src="<?=$config['url_sitio'];?>js/jMinEmoji-SVG.js"></script>    
    </body>
</html>
