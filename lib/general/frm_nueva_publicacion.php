<?
	if($movil)
	{
		?>
			<div class="text-center">
                <a href="registrar/estado" class="btn btn-success mb">Registrar Estado</a><br>
                <a href="registrar/imagen" class="btn btn-primary mb">Registrar Imagen</a><br>
                <a href="registrar/video" class="btn btn-danger mb">Registrar Video</a><br>
                <a href="registrar/link" class="btn btn-info mb">Registrar Link</a><br>
                <a href="u/<?=$_SESSION['s']['nombre_usuario']?>" class="btn btn-default mb">Perfil Usuario</a><br>
            </div>                
            <br>
		<?
		die();
	}
?>

<div id="pp" class="well well-sm"  style="margin-bottom:8px;" >
    <form id="frmprincipal" action="index.php?sub=img&op=reg" enctype="multipart/form-data" method="POST">
        <div class="comentario">
            <div style="padding-left:55px;"></div>

            <div class="imagen-avatar" style="margin:1px 0 0 1px;float: left;">
                <a href="index.php?u=<?=$_SESSION['s']['nombre_usuario'];?>"><img src="<?=$_SESSION['s']['avatar'];?>" width="24"/></a><br>
            </div>

            <div id="op_pub1" class="form-group" style="padding-left:40px;">   
                
                <a id="lk_f" class="btn btn-default btn-sm" style="cursor:pointer">
                    <div class="image-selector">
                        <input class="file-data" type="hidden" name="media_data_empty" value="">
                            <div class="multi-photo-data-container hidden"></div>
                                <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                    <img src="img/foto-32.png" style="width:20px" />  
                                    <span class="visuallyhidden"></span>
                                    <span id="im_f"></span>
                                    <input type="file" name="file1" id="file1" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                </label>
                        <div class="swf-container"></div>
                    </div>
                </a>

                
                <a id="lk_v" href="#myModal" role="button" class="btn btn-default btn-sm"  data-toggle="modal">
                	<img src="img/video-32.png" style="width:20px" /> 
                	<span id="im_v"></span>
                </a>

                <a id="lk_l" href="#myModa2" role="button" class="btn btn-default btn-sm"  data-toggle="modal">
                	<img src="img/links.png" style="width:20px" /> 
                	<span id="im_l"></span>
                </a>  
                    

                <a id="lk_f" class="btn btn-default btn-sm" style="cursor:pointer">
                    <div class="image-selector">
                        <input class="file-data" type="hidden" name="media_data_empty" value="">
                            <div class="multi-photo-data-container hidden"></div>
                                <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                    <img src="img/music-32.png" style="width:20px" />  
                                    <span class="visuallyhidden"></span>
                                    <span id="im_m"></span>
                                    <input type="file" name="file_mp3" id="file_mp3" class="file-input" accept="audio/*" size ="50" title="Solo se permite subir imagenes" />
                                </label>
                        <div class="swf-container"></div>
                    </div>                    
                </a>               

            	<input type="hidden" id="txtvista" name="txtvista" value="<?=$vista_default['valor'];?>" />

	            <div class="btn-group" >
	                <a aria-expanded="false" href="#" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
	                   <span id="text_vista"><!--?=$vista_default['nombre'];?--></span> <img id="img_vista" src="<?=$vista_default['img'];?>"class="w20" />
	                    <span class="caret"></span>
	                </a>
	                <ul class="dropdown-menu">                                    
	                    <li>
	                        <a class="btn_visibilidad" data-visibilidad="P" data-text="" data-img="img/globe-20.png"  href="javascript:void(0)"><img src="img/globe-20.png" class="w20 " > P&uacute;blico</a>
	                    </li> 
	                    <li>
	                        <a class="btn_visibilidad" data-visibilidad="R"  data-text="" data-img="img/user-group-20.png"   href="javascript:void(0)"><img src="img/user-group-20.png" class="w20" > Usuarios registrados</a>
	                    </li> 
	                    <li>
	                        <a class="btn_visibilidad" data-visibilidad="S"  data-text="" data-img="img/users.png"   href="javascript:void(0)"><img src="img/users.png" class="w20" > Seguidores</a>
	                    </li> 
	                    <li>
	                        <a class="btn_visibilidad" data-visibilidad="O"  data-text="" data-img="img/lock.png"   href="javascript:void(0)"><img src="img/lock.png" class="w20" > Privado</a>
	                    </li> 
	                    
	                </ul>
	            </div>

                
                <input type="hidden" name="categoria" id="categoria" value="7" />

                <div class="btn-group" style="float:right">
                    <a aria-expanded="false" href="#" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                        <img id="img_cat" src="img/random-48.png" style="width:20px;" />
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?
                            if(count($categorias)>0)
                            {
                                foreach($categorias as $c)
                                {
                                    ?>
                                        <li>
                                            <a href="javascript:void(0)" data-img="<?=$c['img']?>" data-categoria="<?=$c['id_categoria'];?>" class="ch_cat" >
                                                <img src="<?=$c['img'];?>" style="width:20px;" />
                                                <?=$c['nombre_categoria'];?>
                                            </a>
                                        </li> 
                                    <?
                                }
                            }
                        ?>                                      
                    </ul>
                </div>                                                        
                
            </div>

            <div class="cuerpo-comentario" style="padding-left:40px;">      

                <input  type="text" class="form-control input-sm mb5" style="display:none" id="txtnombre" name="txtnombre" placeholder="Titulo" >

                <textarea class="text_est form-control input-sm mb5  " id="txtdes" name="txtdes"  rows="2" style="display:none"  ></textarea>

                <div contentEditable="true" class="text_est form-control mb5 " id="txtdes_tmp" name="txtdes_tmp" style="margin-bottom:5px; width:100%;min-height:60px;;height:100%;line-height: 20px;" placeholder="Descripcion" ></div>
                
            </div>

            <div id="op_pub" class="form-group" style="padding-left:40px;">

                <img id="img" class="mb" style="width:64px;display:none" />

                <!--Mejora para subir mas de dos imagenes por publicacion-->
                <div id="new_img_2" style="display:none">
                    <a id="lk_new_img_2" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_2" id="file_img_2" data-id-img="2" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_2" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_3" style="display:none">
                    <a id="lk_new_img_3" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_3" id="file_img_3" data-id-img="3" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_3" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_4" style="display:none">
                    <a id="lk_new_img_4" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_4" id="file_img_4" data-id-img="4" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_4" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_5" style="display:none">
                    <a id="lk_new_img_5" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_5" id="file_img_5" data-id-img="5" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_5" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_6" style="display:none">
                    <a id="lk_new_img_6" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_6" id="file_img_6" data-id-img="6" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_6" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_7" style="display:none">
                    <a id="lk_new_img_7" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_7" id="file_img_7" data-id-img="7" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_7" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_8" style="display:none">
                    <a id="lk_new_img_8" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_8" id="file_img_8" data-id-img="8" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_8" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_9" style="display:none">
                    <a id="lk_new_img_9" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_9" id="file_img_9" data-id-img="9" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_9" class="mb" style="width:64px;display:none" />
                </div>

                <div id="new_img_10" style="display:none">
                    <a id="lk_new_img_10" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/foto-32.png" style="width:20px" title="Agregar otra imagen" />  
                                        <span class="visuallyhidden"></span>
                                        <span id="im_f"></span>
                                        <input type="file" name="file_img_10" id="file_img_10" data-id-img="10" class="new_img file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                    </label>
                            <div class="swf-container"></div>
                        </div>
                    </a>    
                    <img id="img_new_10" class="mb" style="width:64px;display:none" />
                </div>
                
                <div style="float:right">                    
                    <input type="hidden" id="btn_nsfw" name="btn_nsfw" value="N" />
                    <a id="lk_nsfw" href="javascript:void(0)" ><img id="img_nsfw" src="img/nsfw.gif" style="width:24px;" /></a>
                    <a href="#myModa4" role="button" class="btn-emojis"   data-id-div="#txtdes_tmp"  data-toggle="modal" style="cursor:pointer;margin-right:10px;" ><img src="img/Emoticon.png" class="w20"/></a>                    
                    <a name="btnenviar" id="btnenviar" class="btn btn-default btn-sm"><img id="im_btnenviar" src="img/bien.png"  style="width:16px" >Publicar</a>
                </div>

                <input type="hidden" id="txtcontenido" name="txtcontenido" value="6" />                
                
            </div>
            <br>
        </div>

        <!-- AGREGAR VIDEO-->
        <div id="myModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Agregar c&oacute;digo del video</h4>
                    </div>

                    <div class="modal-body">
                        <p>
                            <textarea class=" form-control input-sm mb5" id="txtcodigo" name="txtcodigo" style=""  rows="2" placeholder="Url youtube, codigo embed ..." ></textarea>
                            <hr>
                            <div class="text-center">
                                <a id="lk_mm" class="btn btn-default" style="cursor:pointer">
                                    <div class="image-selector">
                                        <input class="file-data" type="hidden" name="media_data_empty" value="">
                                            <div class="multi-photo-data-container hidden"></div>
                                                <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                                    <img src="img/video.png" style="width:32px" />
                                                    <span class="visuallyhidden">Subir Video <img src="img/nuevo2.gif" /></span> 
                                                    <span id="im_f"></span>
                                                    <input type="file" name="file2" id="file2" class="file-input" accept="" size ="50" title="Solo se permite subir Videos" />
                                                </label>
                                        <div class="swf-container"></div>
                                    </div>
                                </a>
                            </div>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_m1_acep"  class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!--AGREGAR URL-->
	    <div id="myModa2" class="modal">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title">Agregar c&oacute;digo Url</h4>
	                </div>

	                <div class="modal-body">
	                    <p>
	                        <input type="text" class=" form-control input-sm mb5" id="txtlink"  name="txtlink" placeholder="http://mypack.me" />
	                        
	                        <br><br>

	                        <span class="text-muted">
	                            Agrega una url de un sitio interesante, o la fuente de la imagen a publicar.
	                        </span>
	                    </p>

	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                    <button type="button" id="btn_m2_acep" class="btn btn-primary">Aceptar</button>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!--AGREGAR IMAGEN COMENTARIOS-->
	    <div id="myModa3" class="modal">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title">Seleccione una imagen</h4>
	                </div>

	                <div class="modal-body">
	                        
	                    <div class="tab-pane active fade in " id="subirmeme">                                            
	                        <form method="POST"  enctype="multipart/form-data">                                    

	                            <div style="text-align:center">
	                                <a id="lk_mm" class="btn btn-default" style="cursor:pointer">
	                                    <div class="image-selector">
	                                        <input class="file-data" type="hidden" name="media_data_empty" value="">
	                                            <div class="multi-photo-data-container hidden"></div>
	                                                <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
	                                                    <img src="img/new.png" style="width:24px" />
	                                                    <span class="visuallyhidden">Subir Imagen</span> 
	                                                    <span id="im_f"></span>
	                                                    <input type="file" name="fileimg_meme" id="fileimg_meme" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
	                                                </label>
	                                        <div class="swf-container"></div>
	                                    </div>
	                                </a>
	                            <br>
	                            
	                                <img id="img_reg_mm" style="max-height:200px;max-width:300px;margin:top:5px;display:none;" />
	                            </div>

	                            <br>
	                            <input type="text" class="form-control " name="txtdescr" id="txtdescr" style="display:none" placeholder="Descripcion del meme..." />
	                            <br>
	                            <div class="fr text-center">
	                                <a id="lk_reg_mm" class="btn btn-primary">Subir Imagen</a>
	                            </div>                                                
	                        </form>
	                    </div>
	                </div>                            
	            </div>
	        </div>
	    </div>

	    <!--EMOJIS-->
	    <div id="myModa4" class="modal">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title">Seleccione una imagen</h4>
	                </div>

	                <div class="modal-body">
	                    
	                    <input type="hidden" id="tmp_id" />
	                    <ul class="nav nav-tabs">
	                      <li class="active"><a aria-expanded="false" href="#personas" data-toggle="tab"><span class="em" style="background:url(img/svg/0.svg);"></span></a></li>
	                      <li class=""><a id="lk_natu" aria-expanded="true" href="#naturaleza" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/189.svg);"></span></a></li>
	                      <li class=""><a id="lk_obje" aria-expanded="true" href="#objetos" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/305.svg);"></span></a></li>
	                      <li class=""><a id="lk_simb" aria-expanded="true" href="#simbolos" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/535.svg);"></span></a></li>
	                      <li class=""><a id="lk_espe" aria-expanded="true" href="#especiales" data-load="N" data-toggle="tab"><span class="em" style="background:url(img/svg/636.svg);"></span></a></li>                                      
	                    </ul>

	                    <div id="myTabContent" class="tab-content">
	                      <div class="tab-pane fade active in" id="personas">
	                        <p>
	                            <br>
	                            <?
	                                for($i = 0;$i <= 188;$i++)
	                                {
	                                    ?><!--a href="javascript:void(0)" class="emoji" style="margin:3px;"><span class="em" style="background:url(img/svg/<?=$i;?>.svg);">&nbsp;</span></a--><?
	                                    ?><a href="javascript:void(0)" class="emoji" style="margin:3px;"><img class="em" src="img/svg/<?=$i;?>.svg" /></a><?
	                                }
	                            ?>
	                            
	                        </p>
	                      </div>

	                      <div class="tab-pane fade " id="naturaleza">
	                        <p id="emo_natu"></p>
	                      </div>

	                      <div class="tab-pane fade " id="objetos">
	                        <p id="emo_obje"></p>
	                      </div>

	                      <div class="tab-pane fade " id="simbolos">
	                        <p id="emo_simb"></p>
	                      </div>

	                      <div class="tab-pane fade " id="especiales">
	                        <p id="emo_espe"></p>
	                      </div>

	                    </div>                                
	                </div>  
	                <div class="modal-footer">
	                    <span id="emoji_m" style="float:left"></span>
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Listo</button>                                    
	                </div>                          
	            </div>
	        </div>
	    </div>


    </form> 

</div><!-- fin formulario publicacion-->