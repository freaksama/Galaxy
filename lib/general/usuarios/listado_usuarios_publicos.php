<?
    $datos['filtro']    = $_GET['op2'];
    $datos['consulta']  = $_GET['op3'];

    $usuarios = $c_sistema->obtenerUsuarioSeguir($datos);   


    //print_r($_GET);
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
    <h2>Usuarios para seguir</div>

<br><br>

    <?

        if(count($usuarios)>0)
        {
            $i =  (int)(count($usuarios)/3);
            
            foreach($usuarios as $rec)
            {
                ?>
                <div class="col-lg-4" style="min-height:220px;">
                <?
                if (file_exists("src/avatar/48/".$rec['id_usuario'].".jpg"))
                    {
                        $avatar ='src/avatar/200/'.$rec['id_usuario'].'.jpg?op='.rand();                   
                    }
                else
                {
                   $avatar = 'src/avatar/user.png ';    
                }

                if($rec['id_usuario']==$_SESSION['s']['id_usuario'])
                {
                    $boton_seguir = '<a href="index.php?sub=cue&op=det"  class="btn_seguir btn btn-primary"><img src="img/adduser.png" width="16" /><b>Editar</b></a>';
                    $siguiendo = 'S';
                }
                else if($rec['siguiendo'] > '0')
                {
                    $boton_seguir = '<button type="button"  id="btn_seguir_'.$rec['id_usuario'].'"  class="btn_seguir btn btn-primary"><img src="img/adduser.png" width="16" /><b>Siguiendo</b></button>';
                    $siguiendo = 'S';
                }
                else
                {
                    $boton_seguir = '<button type="button" id="btn_seguir_'.$rec['id_usuario'].'"  class="btn_seguir btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/adduser.png"  width="16" /><b>Seguir</b>&nbsp;&nbsp;&nbsp;</button>';   
                    $siguiendo = 'N';
                }


                ?>  
                    
                        <div class="panel panel-default">
                          <div class="panel-body">
                                <div style="float:right;width:150px">
                                    <?=$boton_seguir;?><br>
                                    <input type="hidden" name="txt_s_<?=$rec['id_usuario'];?>" id="txt_s_<?=$rec['id_usuario'];?>" value="<?=$siguiendo;?>" />
                                </div>


                                <img src="<?=$avatar;?>" style="width:32px;max-height:32px;" />
                                <a href="index.php?u=<?=$rec['nombre_usuario'];?>" class="f16"><b>@<?=$rec['nombre_usuario'];?></b></a>
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
                                    if($rec['nombre_situacion'] != '')
                                    {
                                        ?><img src="img/heart-32.png" width="24" title="situaci&oacute;n sentimental" /> <?=$rec['nombre_situacion'];?><?
                                    }

                                        ?>

                                <hr>
                                
                                
                          </div>
                        </div>
                    </div>                                               
                        
                <?
            }
            ?>
                
            <?
        }
    ?>  

</div>
<br>



