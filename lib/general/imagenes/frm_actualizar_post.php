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
		$resultado = $c_sistema->actualizarDetallesContenido($_POST);


		if($resultado['codigo']=='000')		
		{
			
			$titulo = 'Envio Exitoso! ';	
			

			//$c_sistema->generarMensaje($datos);
            echo'<script type="text/javascript">window.location.href = "dashboard";</script>';
		}
		
	}	 
	 	 
?>
<script type="text/javascript">


 $(document).ready(function(){
    
        $("#btnenviar").click(function(){
        	
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
		<div class="col-lg-6 col-lg-offset-2" >
		
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
                    <h2 class="text-center">Actualizacion de publicaci&oacute;n</h2>

  

                    <div class="well bs-component">
                      <form id="from" class="form-horizontal" action="index.php?sub=adm&op=editpost"  enctype="multipart/form-data"  method="POST">
                        <fieldset>

                            <div class="form-group">
                                <label id="txt_des" for="txtnombre" class="col-lg-2 control-label">Titulo</label>
                                <div class="col-lg-10">
                                    <input  type="text" class="text_est form-control input-sm mb5  "  id="txtnombre" name="txtnombre" value="<?=$rec['nombre'];?>" >
                                </div>
                            </div> 

                            <div class="form-group">
                                <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Descripci&oacute;n</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control input-sm ckeditor" id="txtdes" name="txtdes" rows="4" ><?=$rec['descripcion'];?></textarea>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Tipo</label>
                                <div class="col-lg-10">
                                    
                                

                                <a id="lk_f" class="btn btn-default btn-sm" style="cursor:pointer">
                                    <div class="image-selector">
                                        <input class="file-data" type="hidden" name="media_data_empty" value="">
                                            <div class="multi-photo-data-container hidden"></div>
                                                <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                                    <img src="img/foto-32.png" style="width:20px" />
                                                    <span class="visuallyhidden">Foto</span>
                                                    <span id="im_f"></span>
                                                    <input type="file" name="file1" id="file1" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                                </label>
                                        <div class="swf-container"></div>
                                    </div>
                                </a>
                                

                                
                                <a id="lk_v" href="#myModal" role="button" class="btn btn-default btn-sm"  data-toggle="modal"><img src="img/video-32.png" style="width:20px" > Video<span id="im_v"></span></a>
                                <a id="lk_l"href="#myModa2" role="button" class="btn btn-default btn-sm"  data-toggle="modal"><img src="img/links.png" style="width:20px"> Url<span id="im_l"></span></a>                        
                                <img id="img" style="width:64px" src="<?=$rec['src'];?>" />
                                <div style="float:right">                            
                                </div>
                                
                                
                            
                                <br>

                                <div id="myModal" class="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Agregar c&oacute;digo del video</h4>
                                            </div>

                                            <div class="modal-body">
                                                <p>
                                                    <textarea class="text_est form-control input-sm mb5" id="txtcodigo" name="txtcodigo"  rows="4" ><?=$rec['codigo'];?></textarea>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="button" id="btn_m1_acep"  class="btn btn-primary">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="myModa2" class="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Agregar c&oacute;digo Url</h4>
                                            </div>

                                            <div class="modal-body">
                                                <p>
                                                    <input type="text" class="text_est form-control input-sm mb5" id="txtlink" name="txtlink" placeholder="http://mypack.me" value="<?=$rec['link'];?>" />
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="button" id="btn_m2_acep" class="btn btn-primary">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
			        		<label for="txtfav" class="col-lg-2 control-label">Fecha</label>
			                <div class="col-lg-10">
			                    <input type="text" class="form-control input-sm" name="txtfechap" id="txtfechap" value="<?=$rec['fecha_p'];?>" />
			                </div>
						</div>

                        <div id="div_fav" class="form-group"  >
                            <label for="txtfav" class="col-lg-2 control-label">Adulto</label>
                            <div class="col-lg-10">
                                <input type="checkbox" <?if($rec['adulto']=='S'){echo 'checked';}?> name="txtadulto" id="txtadulto"><span id="lb-nfsw" class="text-danger" title="Publicaci&oacute;n no apta para ver en la escuela o trabajo">NFSW</span>
                            </div>
                        </div>

                        <div id="div_fav" class="form-group"  >
                            <label for="txtfav" class="col-lg-2 control-label">Status</label>
                            <div class="col-lg-10">
                                <select name="txtstatus" id="txtstatus"  class="input-sm form-control" >
                                    <option value="P" <?if($rec['status']=='P'){echo 'selected ';}?> >Pendiente</option>
                                    <option value="A" <?if($rec['status']=='A'){echo 'selected ';}?> >Activo</option>
                                    <option value="C" <?if($rec['status']=='C'){echo 'selected ';}?> >Cancelado</option>
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

	

	