<?
    


    


     if(isset($_POST['btnenviar']))
    { 
        
        if($_POST['txtnombre']   != "" &
           $_POST['txtcorreo']   != "" &
           $_POST['txtmensaje']  != ""  
           )
        {   
            /*if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['ch'])) != $_SESSION['captcha'])
            {               
                $ch = '<span id="msch" style="color:red;font-size:16px;" ><b>*captcha invalido</b></span>';
            }
            else
            {*/

                //$resultado = $c_sistema->enviar_correo_contacto($_POST);    
                $headers  = "From: " . strip_tags("diego.guerra00@mypack.com") . "\r\n";
        		//$headers .= "Reply-To: ". strip_tags($datos['to']) . "\r\n";
        		$headers .= "MIME-Version: 1.0\r\n";
        		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        		
        		$mensaje = $_POST['txtmensaje'].' ::IP:'.$_SERVER['REMOTE_ADDR'];

        		mail("diego.guerra00@gmail.com", "Mensaje desde MYPACK", $mensaje, $headers);	

                echo '<h1>'.$mensaje.'</h1>';

                $mensaje = "Mensaje Enviado!!"; 

            //}
            
        }
        else
        {
            echo  '* Faltan Datos';
        }       
    }   

?>


<!--link href="<?=$rm;?>/sistema/css/redmond/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="<?=$rm;?>/sistema/js/jquery-1.10.2.js"></script>
    <!--script src="sistema/js/jquery-ui-1.10.4.custom.js"></script-->
    <!--script src="<?=$rm;?>/sistema/js/alertify.min.js"></script-->
        
    <body>



<script type="text/javascript"> 
    
    $(function(){

        $("#btnenviar").click(function(){

            
            if($("#txtmensaje").val()=='')
            {
                alert('Creo que olvidaste escribir tu mensaje -_-');
                $("#txtmensaje").focus();
                return false;
            }

            if($("#txtcorreo").val()=='')
            {
                alert('Es necesario capturar  un correo');
                $("#txtcorreo").focus();
                return false;
            }
           


        });

         $("#txtcorreo").blur(function(){
            //validar_correo();
        });

         <?
            if($mensaje != '')
            {
                echo ' setInterval(function(){ window.location.href="http://mypack.me";},1000);';
            }
         ?>




    }); //fin de ready 


    
</script>


    <div style="text-align:center;">
	   <h3>Contacto</h3>
    </div>

    <br><br>

    <div class="col-lg-6 col-lg-offset-3">
    <?
        if($mensaje == '')
        {
            ?>
                <p>Es muy importante que captures tu correo para poder comunicarme contigo ;)</p>
                <form name="frmcontacto" id="frmcontacto" method="POST">
                    <table  class="table table-bordered table-hover table-striped" >   
                        <tr>
                            <td style="text-align: right;">Nombre: </td>
                            <td><input type="text" size="40" id="txtnombre" name="txtnombre" value="<?=$_POST['txtnombre'];?>"  class="form-control  input-sm" /> </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Correo: </td>
                            <td>
                                <input type="text" size="40" id="txtcorreo" name="txtcorreo" value="<?=$_POST['txtcorreo'];?>"  class="form-control  input-sm"/> 
                               
                                <span id="msc"></span>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align: right;">Mensaje: </td>
                            <td><textarea name="txtmensaje" id="txtmensaje"  class="form-control  input-sm"   cols="50" rows="5"><?=$_POST['txtmensaje'];?></textarea> </td>
                        </tr>
                        <!--tr>
                            <td style="text-align: right;">Captchap: </td>
                            <td>
                                <img src="rec/captcha/captcha.php" id="captcha" /><br/>
                                    <a href="#" onclick="
                                        document.getElementById('captcha').src='rec/captcha/captcha.php?'+Math.random();
                                        document.getElementById('captcha-form').focus();"
                                    id="change-image">Cambiar texto.</a>
                            </td>
                        </tr-->

                        <!--tr>
                            <td style="text-align: right;">Escribe el texto: </td>
                            <td>
                                <input class="form-control  input-sm" size="50"  id="ch" name="ch" placeholder="" type="text"> 
                                <br>
                                <?=$ch;?>
                            </td>
                        </tr-->
                        <tr>
                            <td style="text-align:center" colspan="2">
                                <input type="hidden" name="cv" id="cv" value="<?=$_POST['cv'];?>" />
                                <input type="submit" id="btnenviar" name="btnenviar" class="btn btn-primary" value="Enviar Mensaje" />
                            </td>
                        </tr>
                    </table>
                </form>

                


            <?
        }
        else
        {
            echo '<div class="text-center"><h2>'.$mensaje.'</h2><br><br><br>';
        }
    ?>

    
  

</div>
            



        
