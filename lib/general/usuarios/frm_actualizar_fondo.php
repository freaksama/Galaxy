<?
    session_start();
    $datos['id_usuario'] = $_SESSION['s']['id_usuario'];


    $fondo = $c_sistema->obtenerFondoWeb($datos);

    //print_r($fondo);
    if(isset($_POST['btnenviar']))
    {   
        $resultado = $c_sistema->registrarFondoWeb($_POST,$_FILES);                       

        if($resultado['codigo']=='000')       
        {
          
               //echo'<script type="text/javascript">window.location.href = "dashboard";</script>';  
              $mensaje = '<div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Exito!</strong> 
                La informaci&oacute;n a sido actualizada exitosamente.
              </div>';

               $fondo = $c_sistema->obtenerFondoWeb($datos);


          

            
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
?>
<?
    if(!$movil)
    {
        ?>
            <style type="text/css">
            body {  
                background-image: url("<?=$_SESSION['s']['fondo_web'];?>");     
                background-attachment: fixed;
                overflow: scroll;
            }    
            </style>
        <?
    }
?>

<script type="text/javascript">
    var img_tmp =  "<?=$_SESSION['s']['fondo_web'];?>";

    $(function(){

        $("#btncancelar").click(function(){
            window.location.href="index.php?menu=ma&sub=usr&op=det";
        });

         $("#file1").change(function(){
              if($("#file1").val()!= '')
              {
                  mostrarImagen(this);
              }

          });

         $("#txtdel_img").change(function() {  
            if($("#txtdel_img").is(':checked')) 
            {  
                $("#avatar_big").attr("src","img/well-128.png");
            } 
            else 
            {  
                $("#avatar_big").attr("src",img_tmp);
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
                img_tmp = e.target.result;
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
      <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" /> Foto de perfil </a>
      <a href="index.php?sub=cue&op=fon" class="list-group-item"><img src="img/photo-32.png" width="24" /> Fondo Web <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>
      <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
      <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password</a>
      <a href="index.php?sub=cue&op=tem" class="list-group-item"><img src="img/themes-32.png" width="24" /> Cambiar Tema</a>
    </div>
  </div>

  
  <div class="col-lg-6">
    <div class="well bs-component">
      <form class="form-horizontal" name="frmregistrarpro" id="frmregistrarpro" enctype="multipart/form-data"  accion="index.php?sub=cue&op=fon" method="POST"> 
        <fieldset class="dp">
            <legend>Actualizar Fondo Web </legend>

            <div style="text-align:center">
               
              <?   
                if ($fondo['fondo_web'] == '')
                {
                    $fondo['fondo_web'] = 'img/well-128.png';
                }
               
              ?>    

              <img id="avatar_big" style="padding:10px;border:1px solid #CCCCCC;width:300px;"  src="<?=$fondo['fondo_web'];?>" border="0" />
            </div>
            <br><br>
            <div style="text-align:center">
              <b><span id="msj" ></span></b>
            </div>
            <br><br>

            <div class="form-group">
              <label for="txtpasswordactual" class="col-lg-4 control-label">Subir Imagen </label>
              <div class="col-lg-8">
                <!--input type="file" name="file1" id="file1" accept="image/*" size ="50" title="Solo se permite subir imagenes" /-->
                    <a id="lk_f" class="btn btn-default btn-sm" style="cursor:pointer">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        Seleccionar imagen <img src="img/foto-32.png" style="width:24px" />
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file1" id="file1" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>
              </div>
            </div>

            <div class="form-group">
              <label for="txtpasswordactual" class="col-lg-4 control-label"></label>
              <div class="col-lg-8">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="txtdel_img" id="txtdel_img" /> Eliminar Imagen
                    </label>
                </div>
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
