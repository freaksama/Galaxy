<?
  //print_r($_SESSION);

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

        $("#txttema").change(function(){

            var selected = $(this).find('option:selected');
            var tema = selected.data('tema'); 

            //var tema = $(txttema).data('tema');



            $("#tema_global").attr('href',tema);
        });
   
    });// fin del ready
   
</script>




<br><br>
  <div class="col-lg-3">
    <div class="list-group">
      <a href="#" class="list-group-item active">Configuraci&oacute;n</a>
      <a href="index.php?sub=cue&op=act" class="list-group-item"><img src="img/user-32.png" width="24" /> Detalles cuenta</a>
      <a href="index.php?sub=cue&op=inte" class="list-group-item"><img src="img/list-32.png" width="24" /> Intereses y pasatiempos</a>
      <a href="index.php?sub=cue&op=dash" class="list-group-item"><img src="img/dash2-32.png" width="24" /> Dashboard y publicaciones </a>
      <a href="index.php?sub=cue&op=ava" class="list-group-item"><img src="img/avatar-2-32.png" width="24" />  Foto de perfil </a>
      <a href="index.php?sub=cue&op=fon" class="list-group-item"><img src="img/photo-32.png" width="24" /> Fondo Web </a>
      <a href="index.php?sub=cue&op=notif" class="list-group-item"><img src="img/31-32.png" width="24" /> Noficicaciones Correo</a>
      <a href="index.php?sub=cue&op=actp" class="list-group-item"><img src="img/lock-24-32.png" width="24" /> Cambiar Password </a>
      <a href="index.php?sub=cue&op=tem" class="list-group-item"><img src="img/themes-32.png" width="24" /> Cambiar Tema <span style="float:right;"><img src="img/bullet_blue1.png" /></span></a>
    </div>
  </div>

  
  <div class="col-lg-6">
    <div class="well bs-component">
      <form class="form-horizontal" name="frmregistrarpro" id="frmregistrarpro" enctype="multipart/form-data"  accion="index.php?menu=ma&sub=usr&op=tem" method="POST"> 
        <fieldset class="dp">
            <legend>Actualizar Tema</legend>
            <div style="text-align:center">

               <img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;"  src="img/tema64.png" border="0" />   

            </div>
            <br><br>
            <div style="text-align:center">
              <b><span id="msj" ></span></b>
            </div>
            

            <div class="form-group">
              <label for="txtpasswordactual" class="col-lg-3 control-label">Seleccionar Tema</label>
              <div class="col-lg-8">
                <select name="txttema" id="txttema" class="form-control input-sm">
                    <option value="1"  <?if($_SESSION['s']['tema'] == '1'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_cerulean.min.css" >1 - Cerulean </option>
                    <option value="2"  <?if($_SESSION['s']['tema'] == '2'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_cosmo.min.css" >2 - Cosmo </option>
                    <option value="3"  <?if($_SESSION['s']['tema'] == '3'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_cyborg.min.css" >3 - Cyborg </option>
                    <option value="4"  <?if($_SESSION['s']['tema'] == '4'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_darkly.min.css" >4 - Darkly </option>
                    <option value="5"  <?if($_SESSION['s']['tema'] == '5'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_flatly.min.css" >5 - Flatly </option>
                    <option value="6"  <?if($_SESSION['s']['tema'] == '6'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_journal.min.css" >6 - Journal </option>
                    <option value="7"  <?if($_SESSION['s']['tema'] == '7'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_lumen.min.css" >7 - Lumen </option>
                    <option value="8"  <?if($_SESSION['s']['tema'] == '8'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_paper.min.css" >8 - Paper </option>
                    <option value="9"  <?if($_SESSION['s']['tema'] == '9'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_readable.min.css" >9 - Readable </option>
                    <option value="10" <?if($_SESSION['s']['tema'] == '10'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_sandstone.min.css" >10 - Sandstone </option>
                    <option value="11" <?if($_SESSION['s']['tema'] == '11'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_simplex.min.css" >11 - Simplex </option>
                    <option value="12" <?if($_SESSION['s']['tema'] == '12'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_slate.min.css" >12 - Slate </option>
                    <option value="13" <?if($_SESSION['s']['tema'] == '13'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_spacelab.min.css" >13 - Spacelab </option>
                    <option value="14" <?if($_SESSION['s']['tema'] == '14'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_superhero.min.css" >14 - Superhero </option>
                    <option value="15" <?if($_SESSION['s']['tema'] == '15'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_united.min.css" >15 - United </option>
                    <option value="16" <?if($_SESSION['s']['tema'] == '16'){ echo 'selected'; }?> data-tema="css/temas/bootstrap_yeti.min.css" >16 - Yeti </option>                    
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
