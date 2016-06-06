<?
    $destino = "inicio.php";

    
    

    if(isset($_POST['btnenviar2']))
    {

        if( $_POST['txt_correo']        != '' &
            $_POST['txt_new_pass']      != '' )     
        {
            $resultado = $c_sistema->registrarUsuario($_POST);

            if($resultado['codigo']=='000')   
            {

                $datos['nombre_usuario']  = $resultado['nombre_usuario'];
                $datos['password']        =  $_POST['txt_new_pass'];

                

                $ingreso = $c_sistema->iniciarSession($datos);       

                //print_r($_SESSION);

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
                     $mensaje = $ingreso['mensaje'];
                }

                //$datos['tipo']    = 'exito';
                //$datos['titulo']  = 'Registro Exitoso! '; 
                //$datos['mensaje'] = 'Se ha enviado un correo a los responsable para autorizar su Solicitud';

            

                //echo'<script type="text/javascript">window.location.href = "'.$destino.'";</script>';
            }
            else
            {
                $mensaje['titulo']  = 'Espera un momento!!'; 
                $mensaje['mensaje'] = $resultado['mensaje'];
            }
        }
    }
     
?>

    <script>
      $(function(){

            $("#txnombre_usuario").blur(function(){
                validar_nombre_usuario();                    
            });

            $("#txt_correo").blur(function(){
                validar_correo_usuario();                    
            });


            $("#btnenviar2").click(function(){

                if($("#txt_correo").val()=='')
                {
                  alert('Debe capturar un correo valido');
                  return false; 
                }

                if($("#txt_new_pass").val()=='')
                {
                  alert('Debe capturar un password valido');
                  return false; 
                }
                /*if($("#nombre_valido").val()!='S')
                {
                  alert('Debe capturar un nombre de usuario valido');
                  return false;
                }
                if($("#correo_valido").val()!='S')
                {
                  alert('Debe capturar un correo valido');
                  return false;
                }*/
            });

            $("#lk_reg").click(function(){

              $("#login").hide();

              $("#registro").fadeIn();
            });
          <?
            if($_POST['txnombre_usuario']!='')
            {
              echo 'validar_nombre_usuario();';
            }

            if($_POST['txt_correo']!='')
            {
              echo 'validar_correo_usuario();';
            }
          ?>
          
          //validar_correo_usuario();
       
      });// fin de ready 

      function validar_nombre_usuario()
      {
        var nombre = $("#txnombre_usuario").val();
        dataString = 'opcion=validarNombreUsuario&nombre=' + nombre;

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
                
                if(r.codigo =='000')
                {
                    $("#text_usuario").attr('class','form-group has-success');
                    $("#nombre_valido").val('S');
                    $("#ms_user").text('');
                }
                else
                {
                    $("#text_usuario").attr('class','form-group has-error');
                    $("#nombre_valido").val('N');
                    $("#ms_user").html(r.mensaje);
                }
              },
          timeout:3000,
          type:"POST"
        });
      }

      function validar_correo_usuario()
      {
        var correo = $("#txt_correo").val();
        dataString = 'opcion=validarCorreoUsuario&correo=' + correo;

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
                
                if(r.codigo =='000')
                {
                    $("#text_correo").attr('class','form-group has-success');
                    $("#correo_valido").val('S');
                    $("#ms_correo").text('');
                }
                else
                {
                    $("#text_correo").attr('class','form-group has-error');
                    $("#correo_valido").val('N');
                    $("#ms_correo").text(r.mensaje);
                }
              },
          timeout:3000,
          type:"POST"
        });
      }
  </script>

  <br>

    
<div class="row" id="registro" >
      <div class="col-lg-6 col-lg-offset-3">

    <?
        if($mensaje['titulo']!= '')
        {
            ?>
                <div class="alert alert-dismissible alert-info">
                    <button class="close" data-dismiss="alert" type="button">&times;</button>
                    <strong><?=$mensaje['titulo'];?></strong><br>
                    <?=$mensaje['mensaje'];?><br>
                </div>        
            <?
        }
    ?>
        

        <div class="well bs-component">
          <form class="form-horizontal" action="index.php?op=registro" method="POST">
            <fieldset>
              <legend class="text-center">Registro de usuarios <br></legend>

                

              <div id="text_usuario" class="form-group">
                <label for="txnombre_usuario" class="col-lg-4 control-label">Nombre de Usuario</label>
                <div class="col-lg-6">
                  <span id="ms_user" class="text-danger"></span>
                  <input type="hidden" id="nombre_valido" value="N" />                  
                  <input type="text" class="form-control input-sm" id="txnombre_usuario" name="txnombre_usuario" value="<?=$_POST['txnombre_usuario'];?>"  placeholder="Nombre de Usuario" />
                </div>
              </div>

              <div id="text_correo" class="form-group">
                <label for="txt_correo" class="col-lg-4 control-label">Correo Electr&oacute;nico</label>
                <div class="col-lg-6">
                    <span id="ms_correo" class="text-danger"></span>
                    <input type="hidden" id="correo_valido" value="N" />  
                    <input type="text" class="form-control input-sm" name="txt_correo" id="txt_correo" size="20" value="<?=$_POST['txt_correo'];?>" placeholder="Correo Electr&oacute;nico">   
                </div>
              </div>

              <div class="form-group">
                <label for="txt_new_pass" class="col-lg-4 control-label">Contrase&ntilde;a</label>
                <div class="col-lg-6">
                  <input type="password" class="form-control input-sm" name="txt_new_pass" id="txt_new_pass" size="20" value="<?=$_POST['txt_new_pass'];?>" placeholder="Contrase&ntilde;a">
                </div>
              </div>

              

              <div class="form-group text-center">                              

                <div class="col-lg-8 col-lg-offset-2">
                  <span class="text-muted">
                    <br><br>
                    Te pedimos leas nuestros terminos y condiciones 
                    <a href="fundadores/terminos" > T&eacute;rminos y condiciones</a>
                    <br><br>
                    </span>
                  
                </div>
              </di>

              <div class="form-group text-center">
                <div class="col-lg-12"> 
                  <input type="hidden"  name="txt_id_ref" id="txt_id_ref" value="<?=$_COOKIE['user_ref'];?>" />
                  <input type="hidden"  name="txturl" id="txturl" value="<?=$_GET['url'];?>" />
                  <button type="submit" name="btnenviar2" id="btnenviar2" class="btn btn-primary btn-sm">Aceptar los t&eacute;rminos y crear mi cuenta</button>
                </div>
              </div>

              
              
                

            </fieldset>
          </form>
        </div>        
      </div>
    </div>
