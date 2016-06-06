<?
    
    if(isset($_POST['btnenviar']))
    { 
        
        
        
	    $resultado = $c_sistema->registrarInvitacion($_POST);
	    
	    if($resultado['codigo']=='000')
	    {
	        //$_SESSION['m']['tipo']    = 'exito';    
	        //$_SESSION['m']['titulo']  = 'Operaci&oacute;n Completa';
	        $mensaje = 'Invitaci&oacute;n enviada !';              
	        
	        $mensaje = '<div class="alert alert-dismissable alert-success">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>Bien hecho!</strong> Invitaci&oacute;n enviada ;)
			  </div>';   
	        
	        //echo '<script>window.location.href="index.php?menu=ma&sub=usr&op=pan";</script>';
	    } 
	    else
	    {
	        $mensaje = 'Error '.$resultado['codigo'].' : '.$resultado['mensaje'];   
	    }
                
          
    }   
     unset($_POST);
    //print_r($_SESSION);
    //$estados = $c_sistema->obtener_estados();
    
?>



<script type="text/javascript"> 
    
    $(function(){
        


    


        $("#btnenviar").click(function(){

            if($("#txtcorreo").val()=='')
            {
                alert('Es necesario capturar el correo del invitado');
                return false;
            }

            if($("#txtmensaje").val()=='0')
            {
                alert('Es necesario capturar un mensaje ');
                return false;
            }

            return true;


        });

        $("#btncancelar").click(function(){
            cancelar();
        });


        

    }); //fin de ready  

    


    function cancelar()
    {
        if(confirm('Desea cancelar la invitacion?'))
        {
            location.href = 'index.php?op=dash';
        }   
    }
    
</script>   


    
<div class="text-center">
    <h2>Enviar Invitaci&oacute;n</h2>
</div>
<br>

<div style="padding-left:200px">


<div class="col-lg-8">
<?=$mensaje;?>
    <div class="well bs-component">
        <form class="form-horizontal" name="frm_reg_paciente" id="frm_reg_paciente" accion="index.php?sub=cue&op=inv" method="POST">    
            <fieldset class="dp">

                <div class="form-group">
                  <label for="txtcorreo" class="col-lg-3 control-label">Correo</label>
                  <div class="col-lg-9">                     
                    <input class="form-control" id="txtcorreo" name="txtcorreo" placeholder="Correo del invitado" type="text">
                  </div>
                </div>

                
                
                <!--div class="form-group" >
                  <label for="txtmensaje" class="col-lg-3 control-label">Mensaje</label>
                  <div class="col-lg-9">
                    <textarea class="form-control" name="txtmensaje" id="txtmensaje" rows="6" placeholder="Hola amigo, " ></textarea>
                  </div>
                </div-->
                <div class="form-group" >
                  <label for="txtmensaje" class="col-lg-3 control-label"></label>
                  <div class="col-lg-9">
                    <b>Invita a tus amigos para mas diversi&oacute;n n_n.</b>
                  </div>
                </div>
                
                <br><br>

             </fieldset>

               
            <div class="form-group text-right">
              <div class="col-lg-10 col-lg-offset-2">
                <input type="hidden" name="op_ac" id="op_ac" value="1" />
                <input type="hidden" name="op2" id="op2" value="<?=$_GET['op2'];?>" />
                <button type="button" id="btncancelar" class="btn">Cancelar</button>                
                <button type="submit"  id="btnenviar"  name="btnenviar" class="btn btn-success" style="display:none1">Enviar Invitaci&oacute;n</button>
              </div>
            </div>

        </form>
    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">< ></div>
    </div>
</div>
    
</form> 
</div>




