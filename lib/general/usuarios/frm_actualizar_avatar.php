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

        $(".lk-img-like").click(function(){
            var img = $(this).data('img');
            actualizar_avatar_predeterminado_usuario(img);
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

    function actualizar_avatar_predeterminado_usuario(img)
    {
        dataString = 'opcion=act_img_ava&img=' + img;

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
                            $("#ms").html('<div class="alert alert-dismissible alert-success">\
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>\
                                              Felicidades ahora este es tu avatar <img src="'+img+'" width="128" />\
                                            </div>');
                            $("#avatar_big").attr("src",img);
                            window.location.href="index.php?sub=cue&op=ava#";
                        }
                        else
                        {
                            //alert('Ocurrio un error al registrar');   
                        }
                    },
            timeout:10000,
            type:"POST"

        });
    }// fin funtcion 

   
</script>

<?=$mensaje;?>
<div id="ms">
    
</div>
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

  <div class="col-lg-7">

        <ul class="nav nav-tabs"> 
            <li class="active"><a href="#subir" data-toggle="tab"><img src="img/upload-48.png" width="32" />Subir Avatar</a></li>
            <li><a href="#precargados" data-toggle="tab"><img src="img/category-32.png" width="32" />Avatars Precargados</a></li>  
        </ul>



        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="subir">
                <div class=" bs-component">
                    <br>
                    <form class="form-horizontal" name="frmregistrarpro" id="frmregistrarpro" enctype="multipart/form-data"  accion="index.php?sub=cue&op=ava" method="POST"> 
                        <fieldset class="dp">
                            <legend>Actualizar Avatar Usuario </legend>
                            <div style="text-align:center">
                               
                              <?   
                                if (file_exists($_SESSION['s']['avatar']))
                                {
                                    $avatarg = $_SESSION['s']['avatar']."?op=".rand();
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



            <div class="tab-pane fade" id="precargados">



                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre1.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre1.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre2.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre2.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre3.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre3.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre4.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre4.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre5.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre5.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre6.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre6.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre7.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre7.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre8.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre8.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre9.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre9.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre10.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre10.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre11.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre11.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre12.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre12.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre13.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre13.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre14.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre14.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre15.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre15.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre16.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre16.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre17.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre17.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre18.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre18.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre19.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre19.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre20.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre20.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre21.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre21.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre22.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre22.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre23.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre23.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre24.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre24.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre25.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre25.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre26.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre26.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre27.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre27.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>

                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre28.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre28.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre29.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre29.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre30.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre30.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre31.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre31.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre32.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre32.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre33.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre33.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre34.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre34.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre35.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre35.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre36.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre36.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre37.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre37.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre38.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre38.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre39.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre39.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre40.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre40.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>
                <a href="javascript:void(0)" class="lk-img-like" data-img="src/avatar/200/pre41.jpg" style="text-decoration:none;">
                    <img src="src/avatar/200/pre41.jpg" style="width:128px;height:128px;margin:5px;border:1px solid #CCC"  />
                </a>





            </div>  



        </div>

  
  <div class="col-lg-6">
    <div class="well bs-component">
      
    </div>
  </div>

<br><br><br><br><br><br><br>
