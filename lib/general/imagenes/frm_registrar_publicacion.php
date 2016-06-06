<?
	$datos['id_tipo_contenido'] = '2';

    $datos['id_usuario'] = $_SESSION['s']['id_usuario'];

    //$grupos     = $c_sistema->obtenerGruposUsuario($datos); 
	


	if(isset($_POST['btnenviar']) || $_FILES['file2']['name'] != '')
	{	
		$resultado = $c_sistema->registrarContenido($_POST,$_FILES);

    //print_r($resultado);


		if($resultado['codigo']=='000')		
		{
			$datos['tipo'] 		= 'exito';
			$datos['titulo'] 	= 'Registro Exitoso! ';	
			//$datos['mensaje']	= 'Se ha enviado un correo a los responsable para autorizar su Solicitud';

        if($_POST['categoria'] != '7')
        {
            $categorias = $c_sistema->obtenerCategorias();

            foreach ($categorias as $c ) 
            {
                if($c['id_categoria'] == $_POST['categoria'])
                {
                    $url = 'cat/'.$c['codigo_categoria'];                    
                    break;
                }
                
            }
        }
        else
        {
            $url = 'dashboard';
        }   

			//$c_sistema->generarMensaje($datos);
            echo'<script type="text/javascript">window.location.href = "'.$url.'";</script>';
		}
		
	}
	//$categorias = $c_sistema->obtenerCategorias();
	
	//print_r($categorias);
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



<div class="col-lg-7 col-lg-offset-2" >
<br><br><br><br>
<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h3>
    <strong>Ocurrio un error!</strong> <br>
    <?=$resultado['mensaje'];?>
  </h3>
</div>




	<!--div id="form" >
		<div class="col-lg-7 col-lg-offset-2" >
            <div class="well bs-component">
              <form id="from" class="form-horizontal" action="index.php?sub=img&op=reg"  enctype="multipart/form-data"  method="POST">
                <fieldset>
                  <legend id="legen">Registro de Publicaci&oacute;n</legend>

                  	<div class="form-group">
	                    <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Titulo</label>
	                    <div class="col-lg-10">
	                        <input  type="text" class="text_est form-control input-sm mb5  "  id="txtnombre" name="txtnombre" placeholder="Titulo" >
	                    </div>
                	</div> 

                    <div class="form-group">
                        <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Contenido</label>
                        <div class="col-lg-10">
                            
                        

                    	<a id="lk_f" class="btn btn-default btn-sm" style="cursor:pointer">
                            <div class="image-selector">
                                <input class="file-data" type="hidden" name="media_data_empty" value="">
                                    <div class="multi-photo-data-container hidden"></div>
                                        <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                            <img src="img/foto-32.png" style="width:24px" />
                                            <span class="visuallyhidden">Foto</span>
                                            <span id="im_f"></span>
                                            <input type="file" name="file1" id="file1" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                        </label>
                                <div class="swf-container"></div>
                            </div>
                        </a>
                        <img id="img" style="width:200px" />

                        
                        <a id="lk_v" href="#myModal" role="button" class="btn btn-default btn-sm"  data-toggle="modal"><img src="img/video-32.png" style="width:24px" /> Video<span id="im_v"></span></a>
                        <a id="lk_l"href="#myModa2" role="button" class="btn btn-default btn-sm"  data-toggle="modal"><img src="img/links.png" style="width:24px" /> Url<span id="im_l"></span></a>                        
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
	                                        <textarea class="text_est form-control input-sm mb5" id="txtcodigo" name="txtcodigo"  rows="4" placeholder="Url youtube, codigo embed ..." ></textarea>
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
	                                        <input type="text" class="text_est form-control input-sm mb5" id="txtlink" name="txtlink" placeholder="http://mypack.me" />
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
                        <label id="txt_des" for="inputEmail" class="col-lg-2 control-label">Descripci&oacute;n</label>
                        <div class="col-lg-10">
                            <textarea class="form-control input-sm ckeditor" id="txtdes" name="txtdes" rows="5" ></textarea>
                        </div>
                    </div> 
                    
                <!--div class="form-group">
                	
			        <label for="categoria" class="col-lg-2 control-label">Categoria</label>
			
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/random-48.png" title="Random" style="width:44px;" /><br>
				          <input type="radio" name="categoria" id="rb_ran" value="7" />
				        </div>
			
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/anime-48.png" title="Anime"  style="width:44px;" /><br>
				          <input type="radio" name="categoria" id="rb_ani" value="1" />
				        </div>
			
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/game-48.png" title="Gamer"  style="width:44px;" /><br>
				          <input type="radio" name="categoria" id="rb_gam" value="2" />
				        </div>
			
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/deporte-48.png" title="Deportes" style="width:44px;"  /><br>
				          <input type="radio" name="categoria" id="rb_dep" value="3" />
				        </div>
			
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/musica-48.png" title="M&uacute;sica" style="width:44px;"  /><br>
				          <input type="radio" name="categoria" id="rb_mus" value="4" />
				        </div>
			
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/moda-48.png" title="Moda y Fama"  style="width:44px;"  /><br>
				          <input type="radio" name="categoria" id="rb_mod" value="5" />
				        </div>
			
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/cine-48.png" title="Cine"  style="width:44px;"  /><br>
				          <input type="radio" name="categoria" id="rb_mov" value="6" />
				        </div>
				        
				        <div class="col-lg-1 text-center" style="padding:0 0 0 0;margin-right:10px;">
				          <img src="img/libros-48.png" title="Literatura"  style="width:44px;"  /><br>
				          <input type="radio" name="categoria" id="rb_lib" value="8" />
				        </div>

			      </div>

                    <div class="form-group" >
                      <label for="txttags" class="col-lg-2 control-label">Etiquetas</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control input-sm" id="txttags" name="txttags" />
                      </div>
                  </div>
                 

                   <!--div class="form-group">
                    <label for="txtvista" class="col-lg-2 control-label">Visibilidad</label>
                    <div class="col-lg-10">
                        <input type="radio" name="txtvista" value="M">Privado -  Solo podr&aacute; ser vista por ti<br>
                        <input type="radio" name="txtvista" value="P" checked="checked" >Publico -  Sera publicada para ser vista por todos                      
                    </div>
                   </div-->

                   <?                   	
                   	if($_SESSION['s']['tipo_usuario']=='2')
                   	{
                   		?>
                   		<!--div id="div_fav" class="form-group"  >
			        		<label for="txtfav" class="col-lg-2 control-label">Publicaci&oacute;n</label>
			                <div class="col-lg-10">
			                	<input type="text" class="form-control input-sm" name="txtfechap" id="txtfechap" value="<?=date("Y-m-d H:",time()).'00:00';?>" />
			                </div>
						</div-->
                   		<?
                   	}
                   ?>

                   

                  <!--div class="form-group text-right">
                    <div class="col-lg-10 col-lg-offset-2">
                      <input type="radio" name="categoria" id="rb_ran" value="7" style="display:none" />
                      <input type="hidden" id="txtcontenido" name="txtcontenido" value="6" />
                      <input type="hidden" id="txtvista" name="txtvista" value="P" />
                      <input type="hidden" id="txtgrupoactual" value="<?=$datos['id_grupo'];?>" />                    
                      <button type="button" id="btncancelar" class="btn btn-default btn-sm">Cancelar</button>                     
                      <button type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary btn-sm">Publicar Contenido</button>
                    </div>
                  </div>

                </fieldset>
              </form>
            <div>
        </div>
	</div-->	
</div>

	

	