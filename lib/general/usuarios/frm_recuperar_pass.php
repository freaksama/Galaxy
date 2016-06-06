<?
    
    if(isset($_POST['btnenviar']))
    { 
        
        
        
	    $resultado = $c_sistema->EnviarRecuperacionPass($_POST);
	    
	    if($resultado['codigo']=='000')
	    {
	        //$_SESSION['m']['tipo']    = 'exito';    
	        //$_SESSION['m']['titulo']  = 'Operaci&oacute;n Completa';
	        $mensaje = 'Invitaci&oacute;n enviada !';              
	        
	        $mensaje = '<div class="alert alert-dismissable alert-success">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  En breve recibir&aacute; un correo con instrucciones para recuperar su password ;)
			  </div>
			  
			  <div class="alert alert-dismissable alert-success">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <b>Es posible que el correo llegue a tu bandeja de span @_@</b> 
			  </div>
			  ';   
	        
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
                alert('Es necesario capturar el correo');
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
        if(confirm('Desea cancelar la recuperacion?'))
        {
            location.href = 'index.php';
        }   
    }
    
</script>   


    
<div class="text-center">
    <h2>Recuperaci&oacute;n de contrase&ntilde;a</h2>
</div>
<br>

<div style="padding-left:200px">


<div class="col-lg-8">
<?=$mensaje;?>
    <div class="well bs-component">
        <form class="form-horizontal" name="frm_reg_paciente" id="frm_reg_paciente" accion="index.php?op=recu_pass" method="POST">    
            <fieldset class="dp">

                <div class="form-group">
                  <label for="txtcorreo" class="col-lg-3 control-label">Correo </label>
                  <div class="col-lg-9">                     
                    <input class="form-control" id="txtcorreo" name="txtcorreo"  type="text">
                  </div>
                </div>
                


             </fieldset>

               
            <div class="form-group text-right">
              <div class="col-lg-10 col-lg-offset-2">
                <input type="hidden" name="op_ac" id="op_ac" value="1" />
                <input type="hidden" name="op2" id="op2" value="<?=$_GET['op2'];?>" />
                <button type="button" id="btncancelar" class="btn">Cancelar</button>                
                <button type="submit"  id="btnenviar"  name="btnenviar" class="btn btn-success" style="display:none1">Recuperar</button>
              </div>
            </div>

        </form>
    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;"></div>
    </div>
</div>
    
</form> 
</div>




