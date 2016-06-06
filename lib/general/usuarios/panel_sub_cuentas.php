<?  

    ///print_r($_SESSION);

    
    if(isset($_POST['btn_nueva_cuenta']))
    {
        $resultado = $c_sistema->registrarUsuarioSubCuenta($_POST);

        if($resultado['codigo'] == '')
        {
            $mensaje = '<div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>        
                        Registro de sub cuenta exitosa
                    </div>';
        }
        else
        {
            $mensaje = '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>        
                        Error : '.$resultado['mensaje'].'
                    </div>';
        }
    }



    $datos['id_usuario_prin']   = $_SESSION['s']['id_usuario_prin'];

    $datos['id_usuario']        = $_SESSION['s']['id_usuario_prin'];
    $reg    = $c_sistema->obtenerDatosUsuario2($datos); 

    $datos['id_usuario']        = $_SESSION['s']['id_usuario'];
    $cuentas = $c_sistema->obtenerCuentasUsuario($datos);  



    //print_r($_SESSION);

    $img = '';
    if($reg['id_usuario']==$_SESSION['s']['id_usuario'])
    {
        $img =  '<img src="img/online" />';
    }
                    


    
?>

<script type="text/javascript">

    $(document).ready(function(){        
        $("#lk_new_user").click(function(){
            $("#cuentas").hide();
            $("#add_user").hide();
            $("#new_user").fadeIn();
        });

        $("#lk_add_user").click(function(){
            $("#cuentas").hide();
            $("#new_user").hide();
            $("#add_user").fadeIn();
        });
    });// fin de ready 

</script>



<div class="text-center">
    <h1>Cuentas del usuario</h1>
</div>



<div class="col-lg-8 col-lg-offset-2">
    <br><br>
    
    
    <a id="lk_new_user" href="javascript:void(0)"><img src="img/new.png" />Registra nueva cuenta</a>
    <!--a id="lk_add_user" href="javascript:void(0)">Agregar cuenta existente</a--> 

    <table id="cuentas" class="table table-striped table-bordered table-hover">
        <tr>
            <th colspan="5"><div class="text-center">Cuentas</div></th>
        </tr>
        <tr>
            <th>Avatar</th>
            <th>Usuario</th>
            <th>Biografia</th>
            <th>Ult.conexi&oacute;n</th>
        </tr>
        <tr>
           <td style="text-align:center;">
                <a href="u/<?=$reg['nombre_usuario'];?>"><img src="<?=$reg['avatar'];?>" width="32" /></a>
            </td>
            <td title="">
                <a href="u/<?=$reg['nombre_usuario'];?>">@<?=$reg['nombre_usuario'];?><?=$img;?></a>
            </td>     
            <td><b>(PRINCIPAL)</b><?=$reg['bio'];?></td>
            <td><?=$c_sistema->hace_mini($reg['fecha_ult']);?></td>
            <td><a href="cambiar_usuario/<?=$reg['id_usuario'];?>">Cambiar Usuario</a></td>
        </tr>
        <?
            if(count($cuentas) > 0)
            {
                foreach ($cuentas as $c) 
                {
                    $img = '';

                    
                    if($c['id_usuario_sec'] == $_SESSION['s']['id_usuario'])
                    {
                        $img = '<img src="img/online" />';
                    }
                    

                    ?>
                       <tr>
                           <td style="text-align:center;">
                                <a href="u/<?=$c['nombre_usuario'];?>"><img src="<?=$c['avatar'];?>" width="32" /></a>
                            </td>
                            <td title="">
                                <a href="u/<?=$c['nombre_usuario'];?>">@<?=$c['nombre_usuario'];?><?=$img;?></a>
                            </td>     
                            <td><?=$c['bio'];?></td>
                            <td><?=$c_sistema->hace_mini($c['fecha_ult']);?></td>
                            <td><a href="cambiar_usuario/<?=$c['id_usuario_sec'];?>">Cambiar Usuario</a></td>
                        </tr> 
                    <?
                }
            }
        ?>
    </table>

    <div id="new_user" class="col-lg-8 col-lg-offset-2" style="display:none">
        <div class="well bs-component">
          <form class="form-horizontal" action="subcuentas" method="POST">
            <fieldset>
              <legend class="text-center">Nueva cuenta<br></legend>

                

              <div id="text_usuario" class="form-group">
                <label for="txnombre_usuario" class="col-lg-4 control-label">Nombre de Usuario</label>
                <div class="col-lg-6">
                  <span id="ms_user" class="text-danger"></span>
                  <input type="hidden" id="nombre_valido" value="N" />                  
                  <input type="text" class="form-control input-sm" id="txnombre_usuario" name="txnombre_usuario" value="<?=$_POST['txnombre_usuario'];?>"  placeholder="Nombre de Usuario" />
                </div>
              </div>

              

              <div class="form-group">
                <label for="txt_new_pass" class="col-lg-4 control-label">Contrase&ntilde;a</label>
                <div class="col-lg-6">
                  <input type="password" class="form-control input-sm" name="txt_new_pass" id="txt_new_pass" size="20" value="<?=$_POST['txt_new_pass'];?>" placeholder="Contrase&ntilde;a">
                </div>
              </div>

              <div class="form-group">
                <label for="txt_new_pass" class="col-lg-4 control-label"> Confirmar Contrase&ntilde;a</label>
                <div class="col-lg-6">
                  <input type="password" class="form-control input-sm" name="txt_new_pass" id="txt_new_pass" size="20" value="<?=$_POST['txt_new_pass'];?>" placeholder="Confirmar Contrase&ntilde;a">
                </div>
              </div>

              <div class="form-group text-center">
                <div class="col-lg-12"> 
                  <button type="submit" name="btn_nueva_cuenta" id="btn_nueva_cuenta" class="btn btn-primary btn-sm">Crear mi cuenta</button>
                </div>
              </div>

              
              
                

            </fieldset>
          </form>
        </div>        
    </div>

    <div id="add_user" class="col-lg-8 col-lg-offset-2" style="display:none">
        <div class="well bs-component">
          <form class="form-horizontal" action="index.php?op=login" method="POST">
            <fieldset>
              <div class="text-center">
                <legend>Agregar cuenta existente</legend>
              </div>

              

              <div  class="form-group">
                <label for="txtusuario" class="col-lg-4 control-label">Usuario</label>
                <div class="col-lg-8">
                  
                  <input type="text" class="form-control input-sm" id="txtusuario" name="txtusuario"  placeholder="Nombre de Usuario" />
                </div>
              </div>

              <div class="form-group">
                <label for="txtpassword" class="col-lg-4 control-label">Contrase&ntilde;a</label>
                <div class="col-lg-8">
                  <input type="password" class="form-control input-sm" name="txtpassword" id="txtpassword" size="20"  placeholder="Contrase&ntilde;a">
                </div>
              </div>

              <div class="form-group text-center">
                <div class="col-lg-10 col-lg-offset-2">                  
                    <span style="color:#FF0000;"><?=$mensaje;?></span><br>
                    <input type="hidden" name="op2" id="op2" value="<?=$_GET['redirec'];?>" />
                    <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary btn-sm">Ingresar</button>
                </div>
              </div>

            </fieldset>
          </form>
        </div>
    </div>
    

</div>
<br>



