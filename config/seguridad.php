<?
	if(isset($_GET['op']) & $_GET['op']=='salir')
    {
        $c_sistema->terminarSessionActiva();
        session_destroy();
        setcookie("ts_mypack_pro","",time()-1);
        $_SESSION['s'] = '';
        unset($_SESSION['s']);
        setcookie('ts_mypack_pro', '', time()-1 );
        unset($_COOKIE['ts_mypack_pro']);
        header('location: index.php?op=logout');
        die();
    }

    if($_SESSION['s']['token'] != '')
    {
        setcookie("ts_mypack_pro",$_SESSION['s']['token'],time()+(1*86400));  
    }

    if($_COOKIE['ts_mypack_pro'] != "" & $_SESSION['s']['id_usuario'] == '')
    {
        $tmp['token_session'] = $_COOKIE['ts_mypack_pro'];
        $ingreso = $c_sistema->iniciarSessionToken($tmp);        
    }
    
    $c_sistema->registrarVisita($visita);


    /*$bloqueo_ip = $c_sistema->validarBloqueoIP($visita);
    if($bloqueo_ip['valor'] == 'S')
    {
        echo '<b>Bloqueo de IP</b><br>';
        echo 'Tu IP ha sido bloqueda por motivos de seguridad. Es posible que hallas incumplido con las politicas del sitio<br><br>';
        echo 'Comunicate con el administrador para tener mas informaci&oacute;n<br>';
        echo '<a href="mailto:diego.guerra00@gmail.com">diego.guerra00@gmail.com</a>';
        session_destroy();
        die();
    }*/

    $bloqueo_usuario = $c_sistema->validarBloqueoUsuario($visita);
    if($bloqueo_usuario['valor'] == 'S')
    {
        echo '<b>Bloqueo de Usuario</b><br>';
        echo 'Tu Cuenta ha sido bloqueda por motivos de seguridad. Es posible que hallas incumplido con las politicas del sitio<br><br>';
        echo 'Comunicate con el administrador para tener mas informaci&oacute;n<br>';
        echo '<a href="mailto:diego.guerra00@gmail.com">diego.guerra00@gmail.com</a>';
        session_destroy();
        die();
    }

    $sesion = $c_sistema->validarSessionActiva();
    
?>