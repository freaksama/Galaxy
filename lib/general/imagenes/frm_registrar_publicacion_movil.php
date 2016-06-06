<?
	$datos['id_tipo_contenido'] = '2';

    $datos['id_usuario'] = $_SESSION['s']['id_usuario'];

    //$grupos     = $c_sistema->obtenerGruposUsuario($datos); 

    switch ($_GET['op2']) 
    {
    	case 'e': 	$id_tipo_contenido = '6';		break;
    	case 'i': 	$id_tipo_contenido = '2';		break;
    	case 'v': 	$id_tipo_contenido = '3';		break;
    	case 'l': 	$id_tipo_contenido = '1';		break;
    	
    	default:
    		# code...
    		break;
    }
   
	
	
	if(isset($_POST['btnenviar']))
	{	
		$resultado = $c_sistema->registrarContenido($_POST,$_FILES);


		if($resultado['codigo']=='000')		
		{
			
			$titulo = 'Registro Exitoso! ';	
			

			//$c_sistema->generarMensaje($datos);
                        //echo'<script type="text/javascript">window.location.href = "index.php?op=dash";</script>';
		}
		
	}
	//$categorias = $c_sistema->obtenerCategorias();
	
	//print_r($categorias);
	 $fechau     = $c_sistema->obtenerFechaUltPublicacion();
//	 echo $fechau;
	 $temp 	     = strtotime ( '+1 hour' , strtotime ( $fechau['fecha_u'] ) ) ;
	 $fechau['fecha_u']     = date("Y-m-d H:i:s",$temp);;

     $categorias = $c_sistema->obtenerCategorias();
?>
<!--script src="rec/ckeditor/ckeditor.js"></script-->
<!--link rel="stylesheet" href="rec/ckeditor/samples/sample.css"-->
<script type="text/javascript">


 $(document).ready(function(){
    
        $("#btnenviar").click(function(){
        	
        	/*if(!(	$("#rb_ran").is(':checked') 	|| 
			$("#rb_ani").is(':checked') 	|| 
			$("#rb_gam").is(':checked')  	||
			$("#rb_dep").is(':checked')	||
			$("#rb_mus").is(':checked')	||
			$("#rb_mod").is(':checked') 	||
			$("#rb_mov").is(':checked') 	||
			$("#rb_lib").is(':checked')))
		{				
			alert("Debe seleccionar al menos un una categoria ;)");	
			return false;			
		}
			
            if($("#file1").val()=='' )
            {
                alert('Es necesario seleccionar una imagen');
                $("#txtnombre").focus();
                return false;
            }*/

        });
        
        

        //$('#txttags').tagit();
        
    $("#txtnombre").focus();

    $("#btncancelar").click(function(){
        if(confirm("Realmente desea cancelar el registro de imagen?"))
        {
            window.location.href="index.php?op=dash";
        }
    });

    $("#btn_m1_acep").click(function(){
        if($("#txtcodigo").val() != '')
        {
            $('#myModal').modal('hide');
            $("#im_v").html('<img src="img/online.png" />');
            $("#txtcontenido").val('3');
            $("#lk_f").hide();
            $("#lk_l").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();

        }
    });

    $("#btn_m2_acep").click(function(){
        if($("#txtlink").val() != '')
        {
            $('#myModa2').modal('hide');
            $("#im_l").html('<img src="img/online.png" />');
            $("#txtcontenido").val('1');
            $("#lk_f").hide();
            $("#lk_v").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();
        }
    });

    $("#btn_m3_acep").click(function(){
        if($("#txtlinkd").val() != '')
        {
            $('#myModa3').modal('hide');
            $("#im_d").html('<img src="img/online.png" />');
            $("#txtcontenido").val('7');
            $("#lk_f").hide();
            $("#lk_v").hide();
            $("#lk_l").hide();
            $("#txtnombre").show();
        }
    });

    $("#file1").change(function(){
        if($("#file1").val()!= '')
        {
            $("#im_f").html('<img src="img/online.png" />');    
            $("#txtcontenido").val('2');
            $("#lk_v").hide();
            $("#lk_l").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();

            mostrarImagen(this);
        }

    });





    //$( "#txtfechap" ).datepicker();
	//$( "#txtfechap" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	



});// fin de ready 

function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
   $('#img').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
 }
}
 

</script>



<div class="col-lg-12">


	<div id="form" >
		<div class="col-lg-7 col-lg-offset-2" >
		
		<?
			if($titulo!= '')
			{
				?>
					<div class="alert alert-dismissible alert-success">
						<button class="close" data-dismiss="alert" type="button">&times;</button>
						<strong>Exito!</strong>
						<?=$titulo;?>
					</div>
				<?
			}

			//print_r($_GET);
		?>

			<?
				if($_GET['op2']=='')
				{
					?>
						<div class="well">
							<h3>Qu&eacute; deseas publicar?</h3>
							<a href="registrar/estado" class="btn btn-lg btn-success">Estado</a>
							<a href="registrar/imagen" class="btn btn-lg btn-primary">Imagen</a>
							<a href="registrar/video" class="btn btn-lg btn-danger">Video</a>
							<a href="registrar/link" class="btn btn-lg btn-info">Link</a>							
						</div>			
					<?
				}

			?>

			

            <div class="well bs-component" <?if($_GET['op2']==''){ echo 'style="display:none;"';}?>>
              <form id="from" class="form-horizontal" action="index.php?sub=img&op=reg"  enctype="multipart/form-data"  method="POST">
                <fieldset>
                  <legend id="legen">Nuevo Contenido</legend>

                  	<div class="form-group">
	                    <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Titulo</label>
	                    <div class="col-lg-6">
	                        <input  type="text" class="text_est form-control input-sm mb5  "  id="txtnombre" name="txtnombre" placeholder="Titulo" >
	                    </div>
                	</div> 

                	<div class="form-group">
                        <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Descripci&oacute;n</label>
                        <div class="col-lg-10">
                            <textarea class="form-control input-sm ckeditor" id="txtdes" name="txtdes" placeholder="Descripcion" rows="5" ></textarea>
                        </div>
                    </div> 

                    <div class="form-group" <?if($_GET['op2']!='i'){ echo 'style="display:none;"';}?> >
                        <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Imagen</label>
                        <div class="col-lg-6">

                        	<input type="file" name="file1" id="file1" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                            <img id="img" style="width:42px" />            
                        </div>
                    </div> 

                	<div class="form-group" <?if($_GET['op2']!='v'){ echo 'style="display:none;"';}?> >
	                    <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Video</label>
	                    <div class="col-lg-10">
	                        <textarea class="text_est form-control input-sm mb5" id="txtcodigo" name="txtcodigo"  rows="4" placeholder="Url youtube, codigo embed ..." ></textarea>
	                    </div>
                	</div> 


                    <div class="form-group" <?if($_GET['op2']!='v'){ echo 'style="display:none;"';}?> >
                        <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Video</label>
                        <div class="col-lg-10">
                            <div class="text-center">                                
                                <input type="file" name="file2" id="file2" class="file-input" accept="" size ="50" title="Solo se permite subir videos" />
                            </div>
                        </div>
                    </div>

                    
                    

                    <div class="form-group" <?if($_GET['op2']!='l'){ echo 'style="display:none;"';}?>>
	                    <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Links</label>
	                    <div class="col-lg-10">
	                        <input type="text" class="text_est form-control input-sm mb5" id="txtlink" name="txtlink" placeholder="http://mypack.me" />
	                    </div>
                	</div> 

                    
                    
                <div class="form-group">                    
                    <label for="categoria" class="col-lg-2 control-label">Categoria</label>
                    <div class="col-lg-10">
                        <select name="categoria" id="categoria" class="input-sm form-control" style="margin-bottom:8px">                                
                            <?
                                if(count($categorias)>0)
                                {
                                    foreach($categorias as $c)
                                    {
                                        ?>
                                            <option value="<?=$c['id_categoria'];?>" <?if('7'==$c['id_categoria']){echo 'selected ';}?> ><?=$c['nombre_categoria'];?></option> 
                                        <?
                                    }
                                }
                            ?>                          
                        </select>
                        </div>
                  </div>

                <div id="div_fav" class="form-group"  >
                    <label for="txtfav" class="col-lg-2 control-label">Adulto</label>
                    <div class="col-lg-10">
                        <select name="btn_nsfw" id="btn_nsfw"  class="input-sm form-control" style="margin-bottom:8px"  title="Publicaci&oacute;n no apta para ver en la escuela o trabajo"> 
                            <option value="N">NO</option>
                            <option value="S">SI</option>
                        </select>                        
                    </div>
                </div>


                  <div class="form-group text-right">
                    <div class="col-lg-10 col-lg-offset-2">
                      <!--input type="radio" name="categoria" id="rb_ran" value="7" style="display:none" /-->
                      <input type="hidden" id="txtcontenido" name="txtcontenido" value="<?=$id_tipo_contenido;?>" />
                      <input type="hidden" id="txtvista" name="txtvista" value="P" />
                      <input type="hidden" id="txtgrupoactual" value="<?=$datos['id_grupo'];?>" />                    
                      <button type="button" id="btncancelar" class="btn btn-default btn-sm">Cancelar</button>                     
                      <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary btn-sm">Publicar Contenido</button>
                    </div>
                  </div>

                </fieldset>
              </form>
            </div>
        </div>
	</div>	
</div>

	

	