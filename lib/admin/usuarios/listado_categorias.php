<?

    $categorias = $c_sistema->obtenerCategorias();
    
?>
<script type="text/javascript">
    $(function(){

        <?
            if($_SESSION['m']['mensaje'] != '')
            {
                echo 'reset();';
                echo $c_sistema->show_mensaje();
                $c_sistema->borrarMensaje();
            }
        ?>

        $("#btn_m1_acep").click(function(){
            if($("#txtnombre").val()!= '')
            {
                var nombre  = $("#txtnombre").val();
                var des     = $("#txtdescripcion").val();
                var img     = $("#txtimg").val();
                var nsfw    = $("#nsfw").val();
                var codigo  = $("#txtcodigo").val();

                registrar_categoria(nombre, des, img, nsfw, codigo);
            }
        });

        $("#btn_m2_acep").click(function(){
            if($("#txtnombre_act").val()!= '')
            {
                var id      = $("#txtid").val();
                var nombre  = $("#txtnombre_act").val();
                var des     = $("#txtdescripcion_act").val();
                var img     = $("#txtimg_act").val();
                var nsfw    = $("#nsfw_act").val();
                var codigo  = $("#txtcodigo_act").val();

                

                actualizar_categoria(id, nombre, des, img, nsfw, codigo);
            }
        });

        $(document).on("click",".edit_cat",function(){
            var nombre  = $(this).data("nombre");
            var des     = $(this).data("descripcion");
            var img     = $(this).data("img");
            var id      = $(this).data("id");  
            var nsfw    = $(this).data("nsfw"); 
            var codigo  = $(this).data("codigo"); 

            $("#txtnombre_act").val(nombre);
            $("#txtdescripcion_act").val(des);
            $("#txtimg_act").val(img);
            $("#txtid").val(id);
            $("#nsfw_act").val(nsfw);
            $("#txtcodigo_act").val(codigo);
        })


        $(document).on("click",".dele_cat",function(){

            if(confirm("Realmente desea eliminar?"))            
            {
                var id  = $(this).data("id");  

                eliminar_categoria(id);
            }
            
        })

        

        $(document).on("click","#lk_edit",function(){
            $(".edit_cat").toggle();
            $(".dele_cat").toggle();
        })

    });

    function registrar_categoria(nombre, descripcion, img, nsfw, codigo)
    {
        dataString = 'opcion=reg_categorian&nombre=' + nombre + '&descripcion=' + descripcion + '&img=' + img + '&nsfw=' + nsfw + '&codigo=' + codigo ;

        $.ajax({
            url: "ajax/ajax.php",
            data: dataString,
            async:true,
            beforeSend: function(ob){ /*$("#msj").html("<img src='img/load_05.gif' align='top' border='0' />");*/},
            complete: function (ob,exito){},
            dataType:"html",        
            global:true,
            success:function(data)
                    {
                        var r = jQuery.parseJSON(data);
                        
                        if(r.codigo=='000')
                        { 

                            $('#myModal').modal('hide');

                            var tr = '';
                            var ns = '';

                            if(nsfw == 'S')
                            {
                                ns= '<span class="text-danger"> +18</span>';
                            }


                            
                            tr='<tr id="tr-' + r.id_categoria +'">\
                                <td>\
                                    <a class="edit_cat" href="#myModa2" role="button"  data-toggle="modal" data-id="' + r.id_categoria + '" data-nombre="' + nombre + '" data-descripcion="' + descripcion + '" data-img="' + img + '"   data-nsfw="' + nsfw + '" data-codigo="' + codigo +'"  style="display:none"><img src="img/b_edit.png"></a>\
                                    <a class="dele_cat" data-id="' + r.id_categoria + '" style="display:none"><img src="img/b_drop.png"></a>\
                                    <span class="text-info">' + nombre + '<b>[' + codigo + ']</b>' + ns +  '</span>\
                                    <span class="text-muted f11">' + descripcion + '</span>\
                                </td>\
                                <td style="text-align:center"><img src="' + img +'" width="32" /></td>\
                            </tr>';

                            $("#tabla").append(tr);
                            

                        }
                        else
                        {
                            alert('error');         
                        }
                            
                    },
            timeout:3000,
            type:"POST"
        });
    }

    function actualizar_categoria(id, nombre, descripcion, img, nsfw, codigo)
    {
        dataString = 'opcion=act_categorian&id=' + id +'&nombre=' + nombre + '&descripcion=' + descripcion + '&img=' + img + '&nsfw=' + nsfw + '&codigo=' + codigo ;

        $.ajax({
            url: "ajax/ajax.php",
            data: dataString,
            async:true,
            beforeSend: function(ob){ /*$("#msj").html("<img src='img/load_05.gif' align='top' border='0' />");*/},
            complete: function (ob,exito){},
            dataType:"html",        
            global:true,
            success:function(data)
                    {
                        var r = jQuery.parseJSON(data);
                        
                        if(r.codigo=='000')
                        { 

                            $('#myModa2').modal('hide');

                            $("#tr-" + id).empty();

                            var tr = '';
                            var ns = '';
                            if(nsfw == 'S')
                            {
                                ns= '<span class="text-danger"> +18</span>';
                            }


                            
                            tr='<td>\
                                    <a class="edit_cat" href="#myModa2" role="button"  data-toggle="modal" data-id="' + id + '" data-nombre="' + nombre + '" data-descripcion="' + descripcion + '" data-img="' + img + '"  data-nsfw="' + nsfw + '"  data-codigo="' + codigo +'"  style="display:none"><img src="img/b_edit.png"></a>\
                                    <a class="dele_cat"  href="javascript:void(0)" data-id="' + id + '" style="display:none"><img src="img/b_drop.png"></a>\
                                    <span class="text-info">' + nombre + '<b>[' + codigo + ']</b>' + ns +  '</span>\
                                    <span class="text-muted f11">' + descripcion + '</span>\
                                </td>\
                                <td style="text-align:center"><img src="' + img +'" width="32" /></td>';

                             $("#tr-" + id).append(tr);
                            

                        }
                        else
                        {
                            alert('error');         
                        }
                            
                    },
            timeout:3000,
            type:"POST"
        });
    }

    function eliminar_categoria(id)
    {
        dataString = 'opcion=del_categorian&id=' + id ;

        $.ajax({
            url: "ajax/ajax.php",
            data: dataString,
            async:true,
            beforeSend: function(ob){ /*$("#msj").html("<img src='img/load_05.gif' align='top' border='0' />");*/},
            complete: function (ob,exito){},
            dataType:"html",        
            global:true,
            success:function(data)
                    {
                        var r = jQuery.parseJSON(data);
                        
                        if(r.codigo=='000')
                        { 
                            $("#tr-" + id).remove();
                        }
                        else
                        {
                            alert('error');         
                        }
                            
                    },
            timeout:3000,
            type:"POST"
        });
    }
</script>




<div class="col-lg-8 col-lg-offset-2">

    <div class="text-center">
        <h2>Paginas visitadas</h2>
    </div>  

    <br><br>
    <a href="#myModal" role="button"  data-toggle="modal"><img src="img/new.png" /> Nueva Categoria</a>
    <a id="lk_edit" href="javascript:void(0)" style="float:right" ><img src="img/config-16.png" />Editar</a>
    <table id="tabla" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th width="350px">Categoria</th>              
                <th width="50px">Imagen</th> 
            </tr>
        </thead>
        <tbody>
            <?
                if(count($categorias)>0)
                {
                    foreach($categorias as $cat)
                    {
                        $nsfw = '';
                        if($cat['nsfw']=='S')
                        { 
                            $nsfw = '<span class="text-danger"> +18</span>';
                        }

                        ?>
                            <tr id="tr-<?=$cat['id_categoria'];?>">
                                <td>
                                    <a class="edit_cat" href="#myModa2" role="button"  data-toggle="modal" data-id="<?=$cat['id_categoria'];?>" data-nombre="<?=$cat['nombre_categoria'];?>" data-descripcion="<?=$cat['descripcion'];?>" data-img="<?=$cat['img'];?>"  data-nsfw="<?=$cat['nsfw'];?>" data-codigo="<?=$cat['codigo_categoria'];?>" style="display:none"><img src="img/b_edit.png" /></a> 
                                    <a class="dele_cat"  href="javascript:void(0)" data-id="<?=$cat['id_categoria'];?>" style="display:none"><img src="img/b_drop.png" /></a>
                                    <span class="text-info"><?=$cat['nombre_categoria'].'<b>['.$cat['codigo_categoria'].']</b>'.$nsfw;?></span>
                                    <span class="text-muted f11"><?=$cat['descripcion'];?></span>
                                </td>
                                <td style="text-align:center"><img src="<?=$cat['img'];?>" width="32" /></td>
                            </tr>
                        <?
                    }
                }
            ?>
        </tbody>
    </table>


</div>


<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nueva Categoria</h4>
            </div>

            <div class="modal-body">
                <p>
                    
                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Nombre</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control mb5" id="txtnombre" name="txtnombre" placeholder="Nombre" />
                    </div>
                  </div>

                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Descripcion</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control  mb5" id="txtdescripcion" name="txtdescripcion" placeholder="Descripcion" />
                    </div>
                  </div>

                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Codigo</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control  mb5" id="txtcodigo" name="txtcodigo" placeholder="Codigo" />
                    </div>
                  </div>

                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Imagen</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control mb5" id="txtimg" name="txtimg" placeholder="Imagen" />
                    </div>
                  </div>

                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">nsfw</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="nsfw">
                            <option value="N">NO</option>
                            <option value="S">SI</option>
                        </select>
                    </div>
                  </div>
                   <br><br><br><br><br><br><br><br><br><br>
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
                <h4 class="modal-title">Actualizar Categoria</h4>
            </div>

            <div class="modal-body">
                <p>
                    
                    <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Nombre</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control mb5" id="txtnombre_act" name="txtnombre_act" placeholder="Nombre" />
                    </div>
                  </div>

                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Descripcion</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control  mb5" id="txtdescripcion_act" name="txtdescripcion_act" placeholder="Descripcion" />
                    </div>
                  </div>

                   <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Codigo</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control  mb5" id="txtcodigo_act" name="txtcodigo_act" placeholder="Codigo" />
                    </div>
                  </div>

                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Imagen</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control mb5" id="txtimg_act" name="txtimg_act" placeholder="Imagen" />
                    </div>
                  </div>

                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">nsfw</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="nsfw_act">
                            <option value="N">NO</option>
                            <option value="S">SI</option>
                        </select>
                    </div>
                  </div>
                   <br><br><br><br><br><br><br><br><br><br>

                    
                    
                </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="txtid" id="txtid" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_m2_acep"  class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>