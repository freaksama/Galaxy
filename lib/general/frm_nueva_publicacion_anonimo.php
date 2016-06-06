<div id="pp" class="well well-sm"  style="margin-bottom:8px;" >
    <form id="frmprincipal" action="index.php?sub=img&op=reg" enctype="multipart/form-data" method="POST">
        <div class="comentario">

            <div style="padding-left:55px;">
            </div>

            <div class="imagen-avatar" style="margin:1px 0 0 1px;float: left;">
                <a href="index.php?u=<?=$_SESSION['s']['nombre_usuario'];?>"><img src="src/avatar/48/anonimo.jpg" width="24"/></a><br>
            </div>

            <div id="op_pub1" class="form-group" style="padding-left:40px;">   

                
                
                
                <a id="lk_f" class="btn btn-default btn-sm" style="cursor:pointer">
                    <div class="image-selector">
                        <input class="file-data" type="hidden" name="media_data_empty" value="">
                            <div class="multi-photo-data-container hidden"></div>
                                <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                    <img src="img/foto-32.png" style="width:20px" />  <b>Imagen</b>
                                    <span class="visuallyhidden"></span>
                                    <span id="im_f"></span>
                                    <input type="file" name="file1" id="file1" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                </label>
                        <div class="swf-container"></div>
                    </div>
                </a>

                
                <a id="lk_v" href="#myModal" role="button" class="btn btn-default btn-sm"  data-toggle="modal"><img src="img/video-32.png" style="width:20px" /> <span id="im_v"> Video</span></a>
                <a id="lk_l" href="#myModa2" role="button" class="btn btn-default btn-sm"  data-toggle="modal"><img src="img/links.png" style="width:20px" /> <span id="im_l"> Enlace</span></a>

                <!--input type="checkbox" name="txtadulto" id="txtadulto"><span id="lb-nfsw" class="text-danger" title="Publicaci&oacute;n no apta para ver en la escuela o trabajo">NFSW</span-->

            <input type="hidden" id="txtvista" name="txtvista" value="P" />

            

                
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
                <div id="new_img_3" style="display:none">
                    <a id="lk_new_img_2" class="" style="cursor:pointer;">
                        <div class="image-selector">
                            <input class="file-data" type="hidden" name="media_data_empty" value="">
                                <div class="multi-photo-data-container hidden"></div>
                                    <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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
                                        <img src="img/add-red.png" style="width:20px" title="Agregar otra imagen" />  
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

                    <!--button type="submit" name="btnenviar" id="btnenviar" class="btn btn-default btn-sm"><img src="img/bien.png"  style="width:16px;" />Publicar</button-->
                    
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
                            <div class="text-center" style="display:none">
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
                       
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_m1_acep"  class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    
    </form> 

</div><!-- fin formulario publicacion-->