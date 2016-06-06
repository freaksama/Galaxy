<?
    session_start();    
    
    include('config/conexion.php');       
    include('lib/clases/classSistema.php');      
    include('lib/controladores/c_sistema.php');  
    
    include('config/config.php');
    include('lib/general/validar_movil.php');  


    $db           = new MySQL();  
    $c_sistema    = new sistema_controlador($db);   

    include('config/seguridad.php');


	$sexos = $c_sistema->obtenerCatSexo();
	
	$usuarios = $c_sistema->obtenerUsuarioSeguir($datos);   

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="ISO-8859-1">
    <title><?=$config['titulo'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="<?=$config['url_sitio'];?>">      
    <link href="<?=$config['url_sitio'];?>css/style_global.css" rel="stylesheet">
    <link href="<?=$config['url_sitio'].$c_sistema->obtenerTemaSistema();?>" rel="stylesheet">    
    <script src="<?=$config['url_sitio'];?>js/jquery-1.11.2.min.js"></script>    
    <link  href="<?=$config['url_sitio'];?>css/nanoscroller.css" rel="stylesheet">    
    <script src="<?=$config['url_sitio'];?>js/jquery.nanoscroller.min.js"></script>    

  </head>

  <body>

<?  include('lib/controladores/c_submenu.php'); ?>

    <div class="container">
    

<script type="text/javascript">
	var num_siguiendo = 0;
	$(function(){
		
		$("#lnk_inicio").click(function(){
			$("#inicio").hide();
			$("#sexo").fadeIn(1500);
		});

		$("#sexo").change(function(){
			$("#lnk_sexo").attr('class','btn btn-primary ');
		});

		$("#lnk_sexo").click(function(){

			if($("#sexoh").val() != '') 
			{  
				var tipo_usuario = '<?=$_SESSION["s"]["id_tipo_usuario"];?>';
				if(tipo_usuario == '1')
				{
					$("#sexo").hide();
					$("#direccion").fadeIn(1500);	
				}
				else
				{
					$("#sexo").hide();
					$("#direccion").hide();
					$("#rfc").fadeIn(1500);	
				}
				
			}
		});


		$("#txtnombre").keyup(function(){
			if($("#txtnombre").val()!='')
			{
				$("#lnk_dir").attr('class','btn btn-primary');	
			}
			else
			{
				$("#lnk_dir").attr('class','btn btn-default');	
			}
		});


		$("#txtnombre").change(function(){
			if($("#txtnombre").val()!='')
			{
				$("#lnk_dir").attr('class','btn btn-primary ');	
			}
			else
			{
				$("#lnk_dir").attr('class','btn btn-default ');	
			}
			
		});

		$("#lnk_dir").click(function(){
			if($("#txtnombre").val()!='')
			{
				$("#direccion").hide();
				$("#rfc").fadeIn(1500);	
			}
			
		});

		$("#txtcedula").keyup(function(){
			if($("#txtnombre").val()!='')
			{
				$("#lnk_rfc").attr('class','btn btn-primary ');
			}
			else
			{
				$("#lnk_rfc").attr('class','btn btn-default ');	
			}
		});

		$("#txtcedula").change(function(){
			if($("#txtnombre").val()!='')
			{
				$("#lnk_rfc").attr('class','btn btn-primary ');
			}
			else
			{
				$("#lnk_rfc").attr('class','btn btn-default ');	
			}
			
		});

		$("#lnk_rfc").click(function(){
			if($("#txtcedula").val()!='')
			{
				$("#rfc").hide();
				$("#reco").fadeIn(1500);
				actualizar_informacion_inicio();
			}
		});

		

		$("#lnk_rfc_o").click(function(){
			$("#rfc").hide();
			$("#reco").fadeIn(1500);
			actualizar_informacion_inicio();
			
		});

		


		$("#lnk_rfc").click(function(){
			actualizar_informacion_inicio();
		});

		
		$(".lk_seg").click(function(){

	        var idc = $(this).attr('id');
	        var id  = idc.substr(3); 

	        /*if(loginredirect())
	        {*/
	            seguir_usuario(id);
	            return false;
	        //}

	    });

		$("#lnk_ter").click(function(){
			$("#reco").hide();
			$("#fin").fadeIn(1500);
			//actualizar_informacion_inicio();
			
		});

		$("#lnk_ter2").click(function(){
			$("#reco").hide();
			$("#fin").fadeIn(1500);
			//actualizar_informacion_inicio();
			
		});

		

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
	    



		

		

		


	});

	function actualizar_informacion_inicio()
	{
		var sexo  		= $("#txtsexo").val(); 
		var bio 		= $("#txtbio").val();
		var ubicacion 	= $("#txtu").val();
		

		var url  		= 'ajax/ajax.php';		
		var dataString 	= "&opcion=regInfoInicio" + 
							"&sexo=" + sexo +
							"&bio=" + bio +
							"&ubi=" + ubicacion ;

        $.ajax({
            url: url,
            data: dataString,
            async:true,
            beforeSend: function(ob){ $("#m_ms1").text("Actualizando...");},
            complete: function (ob,exito){},
            dataType:"html",
            error:function(ob,err,ex){$("#load").hide();$("#lnk_ini").fadeIn();},
            global:true,
            success:function(datos)
                    {
                        //reset();
                        //alertify.success("<b>Exito!</b><br>Actualizacion Exitosa");
                        //$("#load").hide();
                        //$("#lnk_ini").fadeIn();
                    },
            timeout:3000,
            type:"POST"
        });
	}

	 function salir()
        {
            if(confirm('Realmente desea salir?'))
            {
                return true;                
            }
            else
            {
                return false;
            }
        }

        setInterval(function(){window.location.href = 'index.php?op=salir';},1800000);

        /*function reset () 
        {
            alertify.set({
                labels : {
                    ok     : "OK",
                    cancel : "Cancel"
                },
                delay : 5000,
                buttonReverse : false,
                buttonFocus   : "ok"
            });
        }*/

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

<br><br>

<div class="text-center">
	<h2><b>Bienvenido a Red Galaxy!</b></h2>
</div>

<div id="inicio" style="display:none1">
	<div style="text-align:center;width:800px;margin:auto">
		<img src="img/mypack-128.png" style="width:200px;" />
	</div>
	<br>
	<div style="text-align:center;width:800px;margin:auto">

	<p class="lead">Te damos la bienvenida a nuestra peque&ntilde;a red Social. Para iniciar es necesario configurar unos detalles de tu cuenta, te ayudaremos paso a paso</p>


	<a href="javascript:void(0)" id="lnk_inicio" class="btn btn-primary">Continuar</a>
	</div>
</div>

<div id="sexo" style="display:none">

	<div style="text-align:center;width:500px;margin:auto">
		<p class="lead">Seleccione su sexo</p>
		<table border="0" style="text-align:center;width:500px;margin:auto">
			<tr>
				<td><img src="img/pregunta-128.png" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align:center;">
					<select class="form-control" name="txtsexo" id="txtsexo">
						<?	
							?><option value="">Seleccione uno</option><?

							foreach ($sexos as $sx) 
							{
								?><option value="<?=$sx['id_sexo'];?>"><?=$sx['nombre_sexo'];?></option><?
							}
						?>
					</select>
				</td>
			</tr>
		</table>

		<br>
		<br>
		<br>
		<!--a href="javascript:void(0)" id="lnk_sexo_o" class="btn btn-default">Omitir</a-->
		<a href="javascript:void(0)" id="lnk_sexo" class="btn btn-default ">Continuar</a>
		
	</div>

</div>







<div id="rfc" style="display:none">
	<div style="text-align:center;width:600px;margin:auto">

		<p class="lead">Escribe algo acerca de ti</p>

		<div class="col-lg-10">
			<div class="well bs-component">
				<form class="form-horizontal" name="frmregistrarpro" id="frmregistrarpro" accion="" method="POST">	
					<fieldset class="dp">
					    
					    

					     <div class="form-group b_medico" >
					      <label for="txtcedula" class="col-lg-3 control-label">Biografia</label>
					      <div class="col-lg-8">
					        <textarea class="form-control" id="txtbio" name="txtbio" rows="5" maxlength="256" ></textarea>
					      </div>
					    </div>

					    <div class="form-group b_medico" >
					      <label for="txtssa" class="col-lg-3 control-label">Ubicaci&oacute;n.</label>
					      <div class="col-lg-8">
					        <input class="form-control" id="txtu" name="txtu"  value="" type="text">
					      </div>
					    </div>

					    

					    <div class="form-group">				     
					      <div class="col-lg-12">
					       <a href="javascript:void(0)" id="lnk_rfc_o" class="btn btn-default">Omitir</a>
					        <a href="javascript:void(0)" id="lnk_rfc" class="btn btn-primary ">Continuar</a>

					      </div>
					    </div>

					   

					</form>		
				</div>
			</div>
				
		
		</div>
	</div>
</div>

	<div id="reco" style="display:none">
	<div style="text-align:left;width:800px;margin:auto">
		<div style="text-align:center">
			<b><h5>Te recomendamos seguir a 5 usuarios minimo</h5></b>

			<br><br>

				 <a href="javascript:void(0)" id="lnk_ter2" class="btn btn-primary">Continuar</a>
			<br><br>
		</div>
	                
	    <?
        if(count($usuarios)>0)
        {
            ?>
                


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
                    <!--tr>
                        <td style="width:50px"><img src="<?=$avatar;?>" width="48" /></td>
                        <td style="min-width:80%;">
                            
                            
                        </td>
                        <td>
                            
                        </td>
                    </tr-->
                    
                <?
            }
            
        }
    ?>  
	        <div style="text-align:center">
				 <a href="javascript:void(0)" id="lnk_ter" class="btn btn-primary">Continuar</a>
			</div>
	               
	    </div>
	</div>


<div id="fin" style="display:none">
	<div style="text-align:center;width:800px;margin:auto">
		<br><br><br>	
		<p class="lead">
		Su cuenta ser&aacute; configurada en unos segundos, recuerde que puede actualizar su informaci&oacute;n en 
		cualquier momento desde el men&uacute; de configuraci&oacute;n</p>
		<br><br>
		<p class="lead">
			Se ha enviado un correo para confirmar su email, le pedimos por favor revisar su bandeja de entrada. 
			Es posible que el correo de confirmaci&oacute;n llegue a su bandeja de spam. 
		</p>
		
		<a href="index.php?op=dash" id="lnk_ini" class="btn btn-primary btn-lg" >Comenzar!!</a>
	</div>
</div>


      <footer>
        <p>
            <br><br><br>
      
        </p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  </body>
</html>