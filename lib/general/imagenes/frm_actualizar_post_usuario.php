<?
	//$datos['id_tipo_contenido'] = '2';

    $datos['id_usuario'] = $_SESSION['s']['id_usuario'];
    if($_GET['id']!= '')
    {
        $datos['id_contenido']  = $_GET['id'];
    }   



    $rec = $c_sistema->obtenerContenidoGeneral($datos);

    $categorias = $c_sistema->obtenerCategorias();

    

    //$grupos     = $c_sistema->obtenerGruposUsuario($datos); 
   
	

	
	if(isset($_POST['btnenviar']))
	{	
		$resultado = $c_sistema->actualizarDetallesContenidoUsuario($_POST);


		if($resultado['codigo']=='000')		
		{
			
			$titulo = 'Envio Exitoso! ';	
			

			//$c_sistema->generarMensaje($datos);
            echo'<script type="text/javascript">window.location.href = "dashboard";</script>';
		}
		
	}	 

    if($rec['id_usuario'] != $_SESSION['s']['id_usuario'])
    {
        echo'<script type="text/javascript">window.location.href = "error_404";</script>';  
    }
	 	 
?>
<script type="text/javascript">


 $(document).ready(function(){
    
        $("#btnenviar").click(function(){
        	var text = $("#txtdes_tmp").html();
            $("#txtdes").val(text);
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
            //$("#txtcontenido").val('1');
            //$("#lk_f").hide();
            $("#lk_v").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();

            if($("#txtcontenido").val()!='2')
            {
                $("#txtcontenido").val('1');
            }
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
            //$("#lk_l").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();

            
            
            mostrarImagen(this);
        }

    });

     $("#file2").change(function(){
        if($("#file2").val()!= '')
        {
            $('#myModal').modal('hide');
            $("#im_v").html('<img src="img/online.png" />');
            $("#txtcontenido").val('3');
            $("#lk_f").hide();
            $("#lk_l").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();
            
            //mostrarImagen(this);
        }

    });

    $(".f_new").click(function(){
        var fecha  = $(this).data('time');

        $(".f_new").removeClass("text-success");
        $(this).addClass("text-success");

        $("#txtfechap").val(fecha);

        return false;
    }); 



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
		<div class="col-lg-6 col-lg-offset-3" >
		
		<?
			if($titulo!= '')
			{
				?>
					<div class="alert alert-dismissible alert-success">
						<button class="close" data-dismiss="alert" type="button">&times;</button>
						<h2>Envio exitoso, en unos momentos se publicar&aacute;, ten paciencia ;)</h2>
					</div>
				<?
			}
            else
            {
                ?>
                    <h3 class="text-center">Editar de publicaci&oacute;n Usuario</h3>

  

                    <div class="well bs-component">
                      <form id="from" class="form-horizontal" action="edit_post"  enctype="multipart/form-data"  method="POST">
                        <fieldset>

                            <div class="form-group">
                                <label id="txt_des" for="txtnombre" class="col-lg-2 control-label">Titulo</label>
                                <div class="col-lg-10">
                                    <input  type="text" class=" form-control input-sm mb5  "  id="txtnombre" name="txtnombre" value="<?=$rec['nombre'];?>" >
                                </div>
                            </div> 

                            <div class="form-group">
                                <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Descripci&oacute;n</label>
                                <div class="col-lg-10">                                    

                                    <textarea class="text_est form-control input-sm mb5  " id="txtdes" name="txtdes"  rows="2" style="display:none" value="<?=$rec['descripcion'];?>"  ></textarea>

                                    <div contentEditable="true" class="text_est form-control mb5 " id="txtdes_tmp" name="txtdes_tmp" style="margin-bottom:5px; width:100%;min-height:60px;;height:100%;line-height: 20px;" placeholder="Descripcion" ><?=$rec['descripcion'];?></div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Tipo</label>
                                <div class="col-lg-10">

                                <?
                                    if($rec['id_tipo_contenido']=='2')
                                    {
                                        ?>
                                            <img id="img" style="width:128px" src="<?=$rec['src'];?>" />
                                        <?
                                    }

                                    if($rec['id_tipo_contenido']=='3')
                                    {
                                        ?>
                                            <textarea class="text_est form-control input-sm mb5" id="txtcodigo" name="txtcodigo"  rows="4" ><?=$rec['codigo'];?></textarea>
                                        <?
                                    }

                                    if($rec['id_tipo_contenido']=='1')
                                    {
                                        ?>
                                            <input type="text" class="text_est form-control input-sm mb5" id="txtlink" name="txtlink" placeholder="http://mypack.me" value="<?=$rec['link'];?>" />
                                        <?
                                    }


                                ?>
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
                                                        <option value="<?=$c['id_categoria'];?>" <?if($rec['id_categoria']==$c['id_categoria']){echo 'selected ';}?> ><?=$c['nombre_categoria'];?></option> 
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
                                    <option <?if($rec['adulto']=='N'){echo ' selected ';}?> value="N">NO</option>
                                    <option <?if($rec['adulto']=='S'){echo ' selected ';}?> value="S">SI</option>
                                </select>                        
                            </div>
                        </div>

                          <div class="form-group text-right">
                            <div class="col-lg-10 col-lg-offset-2">                      
                              <input type="hidden" id="txtcontenido" name="txtcontenido" value="<?=$rec['id_tipo_contenido'];?>" />
                              <input type="hidden" id="txtidcontenido" name="txtidcontenido" value="<?=$rec['id_contenido'];?>" />
                              <input type="hidden" id="txtvista" name="txtvista" value="P" />                              
                              <button type="button" id="btncancelar" class="btn btn-default btn-sm">Cancelar</button>                     
                              <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary btn-sm">Actualizar Publicacion</button>
                            </div>
                          </div>

                        </fieldset>
                      </form>
                    </div>

                <?
            }
		?>


            

        </div>
	</div>	
</div>

	

	