<?

    if($_SESSION['s']['id_usuario']!= '' )
    {
        echo '<script>window.location.href="dashboard";</script>';                  
    }


  	if((isset($_POST['btnenviar'])))
  	{
    	if($_POST['txtusuario'] != '' && $_POST['txtpassword'] != '')
	    {
	      	$datos['nombre_usuario']   = $_POST['txtusuario'];
	      	$datos['password']         = $_POST['txtpassword'];

	      	$ingreso = $c_sistema->iniciarSession($datos);       

	      
	      	if($ingreso['codigo'] =='000')
	      	{
	      		if($_POST['txturl']!= '')
                {
                    echo '<script>window.location.href="'.$_POST['txturl'].'";</script>';                  
                }
                else
                {
                    echo '<script>window.location.href="dashboard";</script>';                  
                }
	      	}      
	      	else
	      	{
		        $mensaje = '* '.$ingreso['mensaje'];
	      	}
	    }
  }//
?>

<script>
    $(function(){

        $("#btnenviar").click(function(){
            if($("#txtusuario").val() == '')
            {
              alert('Es necesario capturar su nombre de usuario');
              return false;
            }

            if($("#txtpassword").val() == '')
            {
              alert('Es necesario que capture su password');
              return false;
            }

            return true;
        });
       
    });// fin de ready 

  </script>

<br>
  <div class="row" id="login" >
      <div class="col-lg-6 col-lg-offset-3">
        <div class="well bs-component">
          <form class="form-horizontal" action="index.php?op=login" method="POST">
            <fieldset>
              <div class="text-center">
                <legend>Inicio de Sesi&oacute;n</legend>
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
        <span class="text-info">Aun no tienes cuenta? <a href="registro">Registrate Aqui</a></span>
        <br>
        <span class="text-info">No recuerdas tu contrase&ntilde;a? <a href="index.php?op=recu_pass">Entra Aqui</a></span>

        
      </div>

      </div>