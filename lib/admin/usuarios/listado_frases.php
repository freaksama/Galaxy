<?

    $frases = $c_sistema->obtenerFrases();
    
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
            if($("#txtfrase").val()!= '')
            {
                var frase  = $("#txtfrase").val();
                registrar_frase(frase);
            }
        });

        $("#btn_m2_acep").click(function(){
            if($("#txtfrase_act").val()!= '')
            {
                var id      = $("#txtid").val();
                var frase   = $("#txtfrase_act").val();
                actualizar_frase(id, frase);
            }
        });

        $(document).on("click",".edit_cat",function(){
            var frase   = $(this).data("frase");           
            var id      = $(this).data("id");              

            $("#txtfrase_act").val(frase);            
            $("#txtid").val(id);
            
        })


        $(document).on("click",".dele_cat",function(){

            if(confirm("Realmente desea eliminar?"))            
            {
                var id  = $(this).data("id");  

                eliminar_frase(id);
            }
            
        })

        

        $(document).on("click","#lk_edit",function(){
            $(".edit_cat").toggle();
            $(".dele_cat").toggle();
        })

    });

    function registrar_frase(frase)
    {
        dataString = 'opcion=reg_frase&frase=' + frase;

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
                            
                            tr='<tr id="tr-' + r.id_frase +'">\
                                <td>\
                                    <a class="edit_cat" href="#myModa2" role="button"  data-toggle="modal" data-id="' + r.id_frase + '" data-frase="' + frase + '" style="display:none"><img src="img/b_edit.png"></a>\
                                    <a class="dele_cat" data-id="' + r.id_frase + '" style="display:none"><img src="img/b_drop.png"></a>\
                                    <span class="text-info">' + frase +  '</span>\
                                </td>\
                            </tr>';

                            $("#tabla").append(tr);
                            $("#txtfrase").val('');
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

    function actualizar_frase(id, frase)
    {
        dataString = 'opcion=act_frase&id=' + id +'&frase=' + frase ;

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
                            
                            tr='<td>\
                                    <a class="edit_cat" href="#myModa2" role="button"  data-toggle="modal" data-id="' + id + '" data-frase="' + frase + '"  style="display:none"><img src="img/b_edit.png"></a>\
                                    <a class="dele_cat"  href="javascript:void(0)" data-id="' + id + '" style="display:none"><img src="img/b_drop.png"></a>\
                                    <span class="text-info">' + frase +  '</span>\
                                </td>';

                            $("#tr-" + id).append(tr);
                            $("#txtfrase_act").val('');
                            

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

    function eliminar_frase(id)
    {
        dataString = 'opcion=del_frase&id=' + id ;

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
        <h2>Listado Frases</h2>
    </div>  

    <br><br>
    <a href="#myModal" role="button"  data-toggle="modal"><img src="img/new.png" /> Nueva Frase</a>
    <a id="lk_edit" href="javascript:void(0)" style="float:right" ><img src="img/config-16.png" />Editar</a>
    <table id="tabla" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Frase</th>                              
            </tr>
        </thead>
        <tbody>
            <?
                if(count($frases)>0)
                {
                    foreach($frases as $rec)
                    {
                        ?>
                            <tr id="tr-<?=$rec['id_frase'];?>">
                                <td>
                                    <a class="edit_cat" href="#myModa2" role="button"  data-toggle="modal" data-id="<?=$rec['id_frase'];?>" data-frase="<?=$rec['frase'];?>"  style="display:none"><img src="img/b_edit.png" /></a> 
                                    <a class="dele_cat"  href="javascript:void(0)" data-id="<?=$rec['id_frase'];?>" style="display:none"><img src="img/b_drop.png" /></a>
                                    <span class="text-info"><?=$rec['frase']?></span>
                                    
                                </td>                                
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
                <h4 class="modal-title">Nueva Frase</h4>
            </div>

            <div class="modal-body">
                <p>
                    
                  <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Frase</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control mb5" id="txtfrase" name="txtfrase"  />
                    </div>
                  </div>

                 <br><br><br><br><br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_m1_acep"  class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div id="myModa2" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar Frase</h4>
            </div>

            <div class="modal-body">
                <p>
                    
                    <div id="div_link" class="form-group" >
                    <label for="inputEmail" class="col-lg-2 control-label">Frase</label>
                    <div class="col-lg-10">
                        <input type="text" class="text_est form-control mb5" id="txtfrase_act" name="txtfrase_act"  />
                    </div>
                  </div>

                 <br><br><br><br><br>

                    
                    
                </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="txtid" id="txtid" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_m2_acep"  class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>