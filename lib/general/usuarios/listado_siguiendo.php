<?
    $datos['nombre_usuario']  = $_GET['usuario'];

    $usuarios = $c_sistema->obtenerSiguiendoNombreUsuario($datos);   

    //print_r($usuarios); 

?>

<script type="text/javascript">


 $(document).ready(function(){

    $(".btn_seguir").click(function(){
        var idc = $(this).attr('id');
        var id  = idc.substr(11);
        //alert(id);

        
        if($("#txt_s_"+id).val() == 'S') 
        {
            dejar_seguir_usuario(id); 
        }
        else
        {
            seguir_usuario(id);
        }        
        
    });

        
});// fin de ready 


    function dejar_seguir_usuario(id)
    {
        var usuario = id;
        dataString  = 'opcion=dejar_seguir_usuario&id=' + usuario;

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
                        
                        if(r.codigo =='000')
                        {
                            $("#btn_seguir_"+id).attr('class','btn btn-default btn-sm');
                            $("#btn_seguir_"+id).html('&nbsp;&nbsp;&nbsp;<img src="img/adduser.png" /><b>Seguir</b>&nbsp;&nbsp;&nbsp;');
                            $("#txt_s_"+id).val('N');
                        }
                        else
                        {
                            alert('Ocurrio un error al registrar'); 
                        }
                    },
            timeout:3000,
            type:"POST"
        });
    }

    function seguir_usuario(id)
    {
        var usuario = id;
        dataString  = 'opcion=seguir_usuario&id=' + usuario;

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
                        
                        if(r.codigo =='000')
                        {
                            $("#btn_seguir_"+id).attr('class','btn btn-primary btn-sm');
                            $("#btn_seguir_"+id).html('&nbsp;&nbsp;&nbsp;<img src="img/adduser.png" /><b>Siguiendo</b>&nbsp;&nbsp;&nbsp;');
                            $("#txt_s_"+id).val('S');
                            
                        }
                        else
                        {
                            alert('Ocurrio un error al registrar'); 
                        }
                    },
            timeout:3000,
            type:"POST"
        });
    }

</script>

<div class="text-center">
    <h2>Usuarios que <a href="index.php?sub=cue&op=per&usuario=<?=$datos['nombre_usuario'];?>">@<?=$datos['nombre_usuario'];?></a> sigue</div>

<br><br>

    <?
        if(count($usuarios)>0)
        {
            ?>
                <div class="col-lg-9 col-lg-offset-1"  >
            <?
            foreach($usuarios as $rec)
            {
               if (file_exists("src/avatar/48/".$rec['id_usuario'].".jpg"))
                    {
                        $avatar ='src/avatar/48/'.$rec['id_usuario'].'.jpg?op='.rand();                   
                    }
                else
                {
                   $avatar = 'src/avatar/user.png ';    
                }

                if($rec['id_usuario_pri'] != '')
                {
                    $boton_seguir = '<button type="button"  id="btn_seguir_'.$rec['id_usuario'].'"  class="btn_seguir btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;<img src="img/adduser.png" width="16" /><b>Siguiendo</b>&nbsp;&nbsp;&nbsp;</button>';
                    $siguiendo = 'S';
                }
                else
                {
                    $boton_seguir = '<button type="button" id="btn_seguir_'.$rec['id_usuario'].'"  class="btn_seguir btn btn-default  btn-sm">&nbsp;&nbsp;&nbsp;<img src="img/adduser.png"  width="16" /><b>Seguir</b>&nbsp;&nbsp;&nbsp;</button>';   
                    $siguiendo = 'N';
                }


                ?>                        
                    <!--tr>
                        <td style="width:50px"><img src="<?=$avatar;?>" width="48" /></td>
                        <td style="min-width:80%;">
                            <a href="index.php?u=<?=$rec['nombre_usuario'];?>"><b>@<?=$rec['nombre_usuario'];?></b></a>
                            <?=$rec['bio'];?>
                        </td>
                        <td>
                            <?=$boton_seguir;?><br>
                            <input type="hidden" name="txt_s_<?=$rec['id_usuario'];?>" id="txt_s_<?=$rec['id_usuario'];?>" value="<?=$siguiendo;?>" />
                        </td>
                    </tr-->
                    <div class="well well-sm" style="margin-bottom:5px;">
                        <div style="float:right;width:150px">
                            <?=$boton_seguir;?><br>
                            <input type="hidden" name="txt_s_<?=$rec['id_usuario'];?>" id="txt_s_<?=$rec['id_usuario'];?>" value="<?=$siguiendo;?>" />
                        </div>


                        <img src="<?=$avatar;?>" style="width:48px;max-height:48px;" />
                        <a href="index.php?u=<?=$rec['nombre_usuario'];?>"><b>@<?=$rec['nombre_usuario'];?></b></a>
                        <br>
                        <?=$rec['bio'];?>
                        <br>
                        <?
                            if($rec['nombre_sexo'] != '')
                            {
                                ?><img src="img/sex.png" /> <?=$rec['nombre_sexo'];?> <?
                            }
                            if($rec['ubicacion'] != '')
                            {
                                ?><img src="img/location.png" /> <?=$rec['ubicacion'];?><?
                            }
                        ?>
                    </div>
                    
                <?
            }
            ?>
		</div>
            <?
        }
    ?>  

</div>
<br>



