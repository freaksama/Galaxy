<?
  //print_r($_SESSION);

    $cursores = $c_sistema->obtenerCursores();

    print_r($cursores);

    if(isset($_POST['btnenviar']))
    {   
        $resultado = $c_sistema->actualizarTemaUsuario($_POST);                       

        if($resultado['codigo']=='000')       
        {
          
              $_SESSION['s']['tema'] = $resultado['tema'];
              echo'<script type="text/javascript">window.location.href = "index.php?sub=cue&op=tem";</script>';  
            
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
?>
<script type="text/javascript">
    $(function(){

        $("#txtcursor").change(function(){

            var selected = $(this).find('option:selected');
            var codigo = selected.data('codigo'); 

            alert(codigo);

            $('body').css('cursor','url(http://www.creatupropiaweb.com/cursor_azul.cur)');

        });
   
    });// fin del ready
   
</script>




<br><br>
  <div class="col-lg-3">
    <div class="list-group">
      <a href="#" class="list-group-item active">Configuraci&oacute;n</a>
      <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta</a>
      <a href="index.php?sub=cue&op=curs" class="list-group-item"><img src="img/baru-01-32.png" width="24" /> Tipo Cursor <span style="float:right;"><img src="img/bullet_blue1.png" /></span> </a>
      <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Inicio y publicaciones </a>
      <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" />  Foto de perfil </a>
      <a href="index.php?sub=cue&op=fon" class="list-group-item"><img src="img/photo-32.png" width="24" /> Fondo Web </a>
      <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
      <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password </a>
      <a href="index.php?sub=cue&op=tem" class="list-group-item"><img src="img/themes-32.png" width="24" /> Cambiar Tema </a>
    </div>
  </div>

  
  <div class="col-lg-6">
    <div class="well bs-component">
      <form class="form-horizontal" name="frmregistrarpro" id="frmregistrarpro" enctype="multipart/form-data"  accion="index.php?menu=ma&sub=usr&op=tem" method="POST"> 
        <fieldset class="dp">
            <legend>Actualizar Tipo Cursor</legend>
            <div style="text-align:center">

               <img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;"  src="img/tema64.png" border="0" />   

            </div>
            <br><br>
            <div style="text-align:center">
              <b><span id="msj" ></span></b>
            </div>
            

            <div class="form-group">
              <label for="txtpasswordactual" class="col-lg-3 control-label">Seleccionar Cursor</label>
              <div class="col-lg-8">
                <select name="txtcursor" id="txtcursor" class="form-control input-sm">
                    <?
                        if(count($cursores)>0)
                        {
                            foreach ($cursores as $c) 
                            {
                                ?><option data-codigo="<?=$c['codigo'];?>" value="<?=$c['id_cursor'];?>"><?=$c['nombre']?></option><?
                            }
                        }
                    ?>
                </select>
              </div>
            </div>
            <br>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2 text-right">                                              
                  <button type="submit"  id="btnenviar"  name="btnenviar" class="btn btn-primary">Actualizar Tema</button>
              </div>
             </div>

            
          </fieldset>
      </form>   
    </div>
  </div>

<br><br><br><br><br><br><br>
