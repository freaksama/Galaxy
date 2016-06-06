<?
    if(isset($_POST['btnenviar']))
    {   
        $resultado = $c_sistema->subirAvatarUsuario($_FILES,$_POST);                       

        if($resultado['codigo']=='000')       
        {
          
          $mensaje = '<div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Exito!</strong> 
                La informaci&oacute;n a sido actualizada exitosamente.
              </div>';

            
        }
        else
        {
            ?>
                <div style="padding-left:400px;">       
                    <table style="border:2px solid #CCCCCC;">
                        <tr>
                            <td class="tdd" width="30px"><span class="negro">Error :</span></td>
                            <td width="300px"><span class="rojo"><?=$resultado['codigo'];?></span></td>
                        </tr>
                        <tr>
                            <td  class="tdd"><span class="negro">Mensaje:</span></td>
                            <td><span class="rojo"><?=$resultado['mensaje'];?></span></td>
                        </tr>
                    </table>
                </div>     
            <?
        }
               
    }// fin de registrar

    $random = rand();

    //print_r($_SESSION);

    //$_SESSION['s']['avatar'] = "src/avatar/200/".$_SESSION['s']['id_usuario'].".jpg";

    ?>
<script type="text/javascript">
    $(function(){

        $("#btncancelar").click(function(){
            //window.location.href="index.php?menu=ma&sub=usr&op=det";
        });

        $("#file1").change(function(){
        if($("#file1").val()!= '')
        {
            mostrarImagen(this);
        }

    });
   
    });// fin del ready


    function mostrarImagen(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $('#avatar_big').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

   
</script>

<?=$mensaje;?>
<br><br>
  
  <div class="col-lg-3">
    <div class="list-group">
      <a href="#" class="list-group-item active">Configuraci&oacute;n</a>
      <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta</a>
      <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos</a>
      <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Dashboard y publicaciones </a>
      <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" />  Foto de perfil <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>      
      <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
      <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password</a>      
    </div>
  </div>

  
  <div class="col-lg-6">
    <div class="well bs-component">
      <form class="form-horizontal" name="frmregistrarpro" id="frmregistrarpro" enctype="multipart/form-data"  accion="index.php?sub=cue&op=ava" method="POST"> 
        <fieldset class="dp">
            <legend>Actualizar Avatar Usuario XD </legend>
            <div style="text-align:center">
               
              <?   
                if (file_exists("src/avatar/200/".$_SESSION['s']['id_usuario'].".jpg"))
                {
                    $avatarg = "src/avatar/200/".$_SESSION['s']['id_usuario'].".jpg?op=".rand();
                    ?>
                        <img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;width:200px;"  src="<?=$avatarg;?>" border="0" />  
                    <?
               }
               else
               {
                    ?><img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;width:200px;"  src="src/avatar/200/avatar-default-200.jpg" border="0" />   <?      
               }
               
              ?>    
            </div>
            <br><br>
            <div style="text-align:center">
              <b><span id="msj" ></span></b>
            </div>
            <br><br>

            <div class="form-group">
              <label for="txtpasswordactual" class="col-lg-4 control-label">Subir Imagen </label>
              <div class="col-lg-8">
                <input type="file" name="file1" id="file1" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2 text-right">
                  <input type="hidden"  name="txtredirect" id="txtredirect" value="<?=$_GET['redirec'];?>" />
                  <button type="button" id="btncancelar"  class="btn">Cancelar</button>               
                  <button type="submit"  id="btnenviar"  name="btnenviar" class="btn btn-primary">Guardar Cambios</button>
              </div>
             </div>

            
          </fieldset>
      </form>   
    </div>
  </div>

<br><br><br><br><br><br><br>
