<?

    $datos['id_usuario_sec']    = $_GET['id'];
    $datos['id_usuario_prin']   = $_SESSION['s']['id_usuario_prin'];

    

    $tmp = $c_sistema->cambiarUsuarioSubCuentas($datos);

    //print_r($_SESSION);
    
    echo'<script type="text/javascript">window.location.href = "subcuentas";</script>';  
    
?>

<script type="text/javascript">

   

</script>



<div class="text-center">
    <h1>Cuentas del usuario</h1>
</div>



<div class="col-lg-8 col-lg-offset-2">
    <br><br>
    <div class="alert alert-dismissible alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>        
        Desde esta pantalla puedes admistrar todas tus cuentas en mypack.
    </div>
    
    
    

</div>
<br>



