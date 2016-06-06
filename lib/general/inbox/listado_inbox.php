<?
	$datos['id_usuario'] = $_SESSION['u']['id_usuario'];
	$resultado  = $c_sistema->listadoInboxUsuario($datos);

	$datos['id_consultorio'] = $_SESSION['u']['id_consultorio'];    
    $datos['status'] = 'A';

	$usuarios = $c_sistema->listadoUsuariosInbox($datos);



	


	

?>
<script type="text/javascript">
     var pagina          = '1';   
    var page            = 'msj';
    var band_blo_pub    = 0 ;
    var id_tmp          = 0 ;
    var id_inbox_max    = 0 ;
    var avatar          = "<?=$_SESSION['s']['avatar'];?>";
    var avatar_inbox    = '<img src="'+avatar+'"  class="w32 fr avatar_chat" />';

</script>

<script type="text/javascript">

	cargar_inbox_usuario();

	setInterval(function(){ 
		cargar_inbox_usuario();
	},10000);              


	$(function(){


		$(".usuario_chat").click(function(){
			var avatar 		= $(this).data("avatar");
			var usuario 	= $(this).data("nombre-usuario");
			var id_usuario_d= $(this).data("id-usuario");

			//console.log("inicia el chat");

			iniciar_conversacion(id_usuario_d,avatar,usuario);
			
		});

		

		

		$("#file3").change(function(){
	        if($("#file3").val()!= '')
	        {
	            mostrarImagen(this);
	        }

    	});

    	$(document).on("click",".lk-del-inbox",function(){
    		if(confirm("Realmente desea eliminar este mensaje?"))
    		{
    			var id_inbox = $(this).data("id-inbox");
    			eliminar_mensaje_inbox(id_inbox);
    		}
    	});	

    	

    	$("#lk_contactos").click(function(){
    		$("#enviar_mensaje").hide();
    		$("#listado_inbox").hide();
    		$("#det_inbox").hide();
    		$("#contactos").fadeIn(); 

    	})

    	$('#btn_enviar_mensaje').click(function(){

	        if(band_blo_pub == 1)
	        {
	            return false;
	        }
	        


	        if($("#txt_des_msj").text() == '' & $("#file3").val() == '')
	        {
	            return false;   
	        }


	        band_blo_pub = 1;

            //alert("Envia mensaje");
	        //$("#im_btnenviar").attr("src","img/load.gif");

	        

	        var archivos 	= document.getElementById("file3");
	        var archivo  	= archivos.files; 
	        var mensaje  	= $("#txt_des_msj").text()
	        var id_usuario_d= $("#txt_usuario_d").val()
	        
	        var data     = new FormData();

	        data.append('opcion','reg_inbox');
	        data.append('mensaje',mensaje);   
	        data.append('usuario_destino',id_usuario_d);   
	        data.append('file3',archivo[0]);

	        

	        $.ajax({
	          url:'ajax/ajax.php',               //Url a donde la enviaremos
	          type:'POST',                       //Metodo que usaremos
	          contentType:false,                 //Debe estar en false para que pase el objeto sin procesar
	          data:data,                         //Le pasamos el objeto que creamos con los archivos
	          processData:false,                 //Debe estar en false para que JQuery no procese los datos a enviar
	          cache:false                        //Para que el formulario no guarde cache
	        }).done(function(data){  

	            //$("#im_btnenviar").attr("src","img/bien.png");
	             band_blo_pub = 0;

	            //alert(data);
	            r = jQuery.parseJSON(data);
	            //console.log(respuesta);

	            if(r.codigo == '000')
	            {
	                //$(".tmp_msj").hide();
	                $("#txt_des_msj").html('');
	                //$("#msj_ok").fadeIn();
                    $("#img").hide();
                    $("#file3").val('');

	                crear_mensaje(mensaje,id_usuario_d,r);

	            }
	            else
	            {
	                
	            }

	        }); 

	        return false;

	    });///

		
		$("#lk_load_inbox").click(function(){
	        pagina++;        
	        cargar_inbox_usuario(pagina);
	    });

	    $("#lk_load_inbox_enviados").click(function(){
	        pagina++;        
	        cargar_inbox_enviados(pagina);
	    });

	    $(document).on("click",".cargar_chat_user",function(){
	    	var id_usuario 	= $(this).data("id-usuario");
	    	var page 		= $(this).data("page");

	    	cargar_conversacion_anterior(id_usuario,page);	    	
	    });

        $(document).on("click",".lk_view_img_chat",function(){
            var src  = $(this).data("src");

            $("#img_det_inbox").attr("src",src);
        });

        


	})// fin jquery

function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
   $('#img').attr('src', e.target.result);
   $("#img").show();
  }
  reader.readAsDataURL(input.files[0]);
 }
}

function marcar_inbox_visto(id_inbox)
{
    

    dataString = 'opcion=marcar_inbox_visto&id_inbox=' + id_inbox ;

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
                        //reload()
                        //$("#tr_pen_"+id_inbox).fadeOut();
                    }
                    else
                    {
                        alert('error');         
                    }
                        
                },
        timeout:10000,
        type:"POST"
    });
}   

function eliminar_mensaje_inbox(id_inbox)
{
    dataString = 'opcion=eliminar_inbox&id_inbox=' + id_inbox ;

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
                        //reload()
                        $("#tr_pen_"+id_inbox).fadeOut();
                    }
                    else
                    {
                        //alert('error');         
                    }
                        
                },
        timeout:10000,
        type:"POST"
    });
}


function crear_mensaje(mensaje,id_usuario,inbox)
{
    id_tmp++;

    var hora = obtener_hora();
    var img = '';
    
    if(inbox.src_mini != '' & inbox.src_mini != null)
    {
        img ='<a href="#detalles_img_inbox" role="button" data-id-div="#txt_ms" class="lk_view_img_chat" data-src="' + inbox.src + '"  data-toggle="modal" style="cursor:pointer;margin-right:10px;" ><img src="' + inbox.src_mini + '" style="width:64px" /></a><br>';
    }
    

    var div_ms = '<div id="msjg_' + id_tmp + '" data-id-mensaje="0" class="m_m" />\
                        <div class="ms ms_d">\
                            <span id="msj_' + id_tmp + '" class="m_y">\
                            '+img+'\
                            '+mensaje+'</span>\
                            <span class="text-muted f9">'+hora+' </span>\
                            '+ avatar_inbox +'\
                        </div>\
                    </div>';
    var id_tmp_mensaje =  id_tmp;

    //alert(div_ms);

    $("#chat_"+id_usuario).append(div_ms);               

    $(".nano").nanoScroller();
    $(".nano").nanoScroller({ scroll: 'bottom' });
    //$("#chat_" + id_usuario).nanoScroller({ scroll: 'bottom' }); 
     
    return id_tmp_mensaje;

 }// fin crear_mensaje

 function crear_mensaje_recibido(inbox)
 {
   var img = '';
    var avatar_usuario_envia = '';
    if(inbox.id_usuario_envia != '' || inbox.id_usuario_envia != null)
    {
        if(inbox.id_usuario_envia == $("#txt_usuario_d").val() ||$("#txt_usuario_d").val() ==  0)
        {
            //iniciar_conversacion(inbox.id_usuario_envia,inbox.avatar_usuario_envia,inbox.nombre); 
            
        }
        else
        {
            iniciar_conversacion_muted(inbox.id_usuario_envia);
        }

        if(inbox.src_mini != '' & inbox.src_mini != null)
        {
            img ='<a href="#detalles_img_inbox" role="button" data-id-div="#txt_ms" class="lk_view_img_chat" data-src="' + inbox.src + '"  data-toggle="modal" style="cursor:pointer;margin-right:10px;" ><img src="' + inbox.src_mini + '" style="width:64px" /></a><br>';
        }

        avatar_usuario_envia = '<img src="' + inbox.avatar_usuario_envia + '" class="w32 avatar_chat" />';

        var div_ms = '<div id="msjg_' + inbox.id_inbox + '" data-id-mensaje="0" class="m_m" />\
                            <div class="ms ms_i">\
                                <span id="msj_' + inbox.id_inbox + '" class="m_y">\
                                ' + avatar_usuario_envia + '\
                                ' + img + '\
                                ' + inbox.mensaje + '</span>\
                                <span class="text-muted f9">' + inbox.fecha_envio_mini + ' </span>\
                            </div>\
                        </div>';        

        $("#chat_" + inbox.id_usuario_envia).append(div_ms);               
        $(".nano").nanoScroller();
        $(".nano").nanoScroller({ scroll: 'bottom' });

        genera_notificacion(inbox);
    }
 }

function crear_mensaje_anterior(inbox)
 {
    if(inbox.id_usuario_envia != '' || inbox.id_usuario_envia != null)
    {
        // primero valido si el mensaje lo envio el usuario actual

        var img = '';        

        if(inbox.src_mini != '' & inbox.src_mini != null)
        {
            img ='<a href="#detalles_img_inbox" role="button" data-id-div="#txt_ms" class="lk_view_img_chat" data-src="' + inbox.src + '"  data-toggle="modal" style="cursor:pointer;margin-right:10px;" ><img src="' + inbox.src_mini + '" style="width:64px" /></a><br>';
        }

        avatar_usuario_envia = '<img src="' + inbox.avatar_usuario_envia + '" class="w32 avatar_chat" />';

        var id_chat_actual = $("#txt_usuario_d").val();

        if(inbox.id_usuario_envia == id_chat_actual)
        {
            // si el mensaje no lo envia el usuairo actual, aparece el mensaje a la izquierda
            var div_ms = '<div id="msjg_' + inbox.id_inbox + '" data-id-mensaje="0" class="m_m" />\
                            <div class="ms ms_i">\
                                <span id="msj_' + inbox.id_inbox + '" class="m_y">\
                                ' + avatar_usuario_envia + '\
                                ' + img + '\
                                ' + inbox.mensaje + '</span>\
                                <span class="text-muted f9">' + inbox.fecha_envio_mini + ' </span>\
                            </div>\
                        </div>';
        }
        else
        {
            // en caso de que el mensaje lo envio el usuario actual, aparece en la parte derecha
            var div_ms = '<div id="msjg_' + inbox.id_inbox + '" data-id-mensaje="0" class="m_m" />\
                            <div class="ms ms_d">\
                                <span id="msj_' + inbox.id_inbox + '" class="m_y">\
                                '+ avatar_inbox +'\
                                ' + img + '\
                                ' + inbox.mensaje + '</span>\
                                <span class="text-muted f9">' + inbox.fecha_envio_mini + ' </span>\
                            </div>\
                        </div>';
        }

            
        // Aqui se dibuja el mensaje en el chat
        $("#chat_" + id_chat_actual+":first").append(div_ms);               

        // Se actualiza el id max de la conversacion 
        $("#chat_"+id_chat_actual).data("id-inbox-max",inbox.id_inbox);
        $(".nano").nanoScroller();
        $(".nano").nanoScroller({ scroll: 'bottom' });

        // reubicar el boton para cargar la conversacion anterior
        
        $("#lk_load_chat_" + id_chat_actual).remove();

        genera_notificacion(inbox);

        
    }
 }  

 function genera_notificacion(inbox)
 {
 	//Genera la notificacion
 	//console.log(inbox);
    if(inbox.id_usuario_envia != $("#txt_usuario_d").val() )
    {
    	if($("#not_user_"+inbox.id_usuario_envia).text() == '')
    	{
    		var numero_notificaciones = 0;
    	}
    	else
    	{
    		var numero_notificaciones = parseInt($("#not_user_"+inbox.id_usuario_envia).text());
    	}
    	numero_notificaciones++;
    	$("#not_user_"+inbox.id_usuario_envia).text(numero_notificaciones);
    }    
 }

function obtener_hora()
{	
	var fecha   = new Date();
    var hora    = fecha.getHours();
    var minuto  = fecha.getMinutes();
    var segundo = fecha.getSeconds();

    if (hora < 10) {hora = "0" + hora ;}
    if (minuto < 10) {minuto = "0" + minuto ; }
    if (segundo < 10) {segundo = "0" + segundo ;}

    var horita = hora + ":" + minuto  ;

    return horita;
}


function iniciar_conversacion(id_usuario,avatar,usuario)
{
	console.log("pinta el chat");
	if($("#chat_" + id_usuario).length > 0 )
	{
		
		$("#avatar_chat").attr("src",avatar);
		$("#usuario_chat").text(usuario);
		$("#txt_usuario_d").val(id_usuario);

		$(".div_chat").hide();
		$("#chat_" + id_usuario).show();
		$("#enviar_mensaje").show();

		$("#not_user_"+id_usuario).text('');

		return;
	}
	else
	{
		var div_chat = '<div id="chat_' + id_usuario + '" class="div_chat"  data-id-inbox-max="0"><div class="text-center"><a id="lk_load_chat_' + id_usuario + '"  data-page="2" data-id-usuario="' + id_usuario + '" class="btn btn-default btn-xs cargar_chat_user force_top">cargar mensajes anteriores</a><br><br></div></div>';
		$("#chat_principal").append(div_chat);

		$("#avatar_chat").attr("src",avatar);
		$("#usuario_chat").text(usuario);
		$("#txt_usuario_d").val(id_usuario);

		$(".div_chat").hide();
		$("#chat_" + id_usuario).show();

		$("#not_user_"+id_usuario).text('');

		cargar_conversacion_anterior(id_usuario,1);

        $("#mensaje_inicio").hide();
		$("#caja_mensajes").show();   
		$("#enviar_mensaje").show();

		return;
	}
}

function iniciar_conversacion_muted(id_usuario)
{
	var div_chat = '<div id="chat_' + id_usuario + '" class="div_chat" data-id-inbox-max="0" style="display:none"><div class="text-center"><a  id="lk_load_chat_' + id_usuario + '" data-page="2" data-id-usuario="' + id_usuario + '" class="btn btn-default btn-xs cargar_chat_user force_top" style="display:none">cargar mensajes anteriores</a><br><br></div></div>';
		$("#chat_principal").append(div_chat);
}

function cargar_inbox_usuario()
{
	dataString = "&opcion=load_inbox&id_max=" + id_inbox_max;

    $.ajax({
        url: "ajax/ajax.php",
        data: dataString,
        async:true,
        beforeSend: function(data2){},
        complete: function (ob,exito){},
        dataType:"html",
        error:function(ob,err,ex){console.log("Error en : " + err);},
        global:true,
        success:function(datos)
                {
                   	var r = jQuery.parseJSON(datos);
                   	
                   	if(r.length>0)
                   	{
                   		for(var i = 0; i < r.length ; i++ )
                   		{
                   			crear_mensaje_recibido(r[i]);
                   			id_inbox_max = r[i].id_inbox;
                   		}
                   		
                   	}
                },
        timeout:10000,
        type:"POST"
    });
}

function cargar_conversacion_anterior(id_usuario,page)
{
	dataString = "&opcion=load_chat_user&id_usuario=" + id_usuario + "&page=" + page ;

    $.ajax({
        url: "ajax/ajax.php",
        data: dataString,
        async:true,
        beforeSend: function(data2){},
        complete: function (ob,exito){},
        dataType:"html",
        error:function(ob,err,ex){console.log("Error en : " + err);},
        global:true,
        success:function(datos)
                {
                   	var r = jQuery.parseJSON(datos);
                   	
                   	if(r.length>0)
                   	{
                   		for(var i = 0; i < r.length ; i++ )
                   		{
                   			crear_mensaje_anterior(r[i]);
                   			id_inbox_max = r[i].id_inbox;
                   		}

                        // Marcar la convesacion como leida
                        var id_usuario   = $("#txt_usuario_d").val();
                        var id_inbox_max = $("#chat_"+id_usuario).data("id-inbox-max");
                        marcar_mensajes_vistos_usuario(id_usuario,id_inbox_max)
                   	}
                   	else
                   	{
                   		$("#lk_load_chat_"+id_usuario).hide();
                   	}
                },
        timeout:10000,
        type:"POST"
    });
}

function marcar_mensajes_vistos_usuario(id_usuario, id_inbox)
{
    dataString = "&opcion=marchar_mensaje_visto_usuario&id_usuario=" + id_usuario + "&id_inbox=" + id_inbox ;

    $.ajax({
        url: "ajax/ajax.php",
        data: dataString,
        async:true,
        beforeSend: function(data2){},
        complete: function (ob,exito){},
        dataType:"html",
        error:function(ob,err,ex){alert("Error en : " + err);},
        global:true,
        success:function(datos)
                {
                    var r = jQuery.parseJSON(datos);
                    
                    if(r.length>0)
                    {
                        for(var i = 0; i < r.length ; i++ )
                        {
                            crear_mensaje_anterior(r[i]);
                            id_inbox_max = r[i].id_inbox;
                        }
                        
                    }
                    else
                    {
                        $("#lk_load_chat_"+id_usuario).hide();
                    }
                },
        timeout:10000,
        type:"POST"
    });
}




</script>



<br>


<div class="col-lg-3">
	<div class="list-group">       
	  <a href="#" class="list-group-item active">Amigos</a>
	  <?
        if(count($usuarios)>0)
        {
            foreach ($usuarios as $rec)
            {
                $rec['avatar'] = 'img/user.png';
                ?>
                <a href="javascript:void(0)" class="list-group-item usuario_chat" data-id-usuario="<?=$rec['id_usuario'];?>" data-nombre-usuario="@<?=$rec['nombre_usuario'].' '.$rec['apellidos'];?>" data-avatar="<?=$rec['avatar'];?>">
                	<img src="<?=$rec['avatar'];?>" class="w32" />
                	<span id="not_user_<?=$rec['id_usuario'];?>" class="badge" ></span> 
                	<span class="text-info">@<?=$rec['nombre_usuario'];?></span>
                    <span><?=$rec['bio'];?></span>  
                    <span class="text-muted">Ult. vez <?=$c_sistema->hace_mini($rec['fecha_ult']);?>
                </a>
                <?
            }
        }
                    
	  ?>	  
	</div>
</div>


<div class="col-lg-6 ">

	

	<div id="caja_mensajes" class="panel panel-default" style="display:none;margin-bottom: 0px;">
		<div class="panel-heading">
			<img  id="avatar_chat" src="" class="w32" />
			<span id="usuario_chat" class="text-info">@Usuarios</span>
			<input type="hidden" id="txt_usuario_d" value="0" />
		</div>
		<div class="panel-body">
			<div id="about" class="nano" style="float:none">
            	<div class="nano-content">
            		<div id="chat_principal">
            			
            		</div>
            	</div>
            </div>

	    </div>
	    
	</div>

    <div id="mensaje_inicio" class="panel panel-default">                
        <div class="panel-body">            
            <div class="text-center">
                <h2>Sistema de Chat Interno </h2>
                <img src="img/messages-128.png" />

                <br><br><br>
                <span class="text-muted">S&iacute; deseas conversar con alguien solo da click sobre el usuario ;)</span>
            </div>
        </div>
    </div>

    


	
	

	<div id="enviar_mensaje" style="display:none" >
		<div class="panel panel-default">
	        <div class="panel-body">
	          <form id="from" class="form-horizontal" action="index.php?sub=img&op=reg"  enctype="multipart/form-data"  method="POST">	            
	                
	            	<div class="form-group">
	                    <div class="col-lg-10 col-lg-offset-1">                    
	                        <div contentEditable="true" class="text_est form-control mb5 " id="txt_des_msj" name="txt_des_msj" style="margin-bottom:5px; width:100%;min-height:60px;;height:100%;line-height: 20px;" ></div>                    
	                    </div>
	                </div> 
	                

	              <div class="form-group text-right">
	                <div class="col-lg-10 col-lg-offset-2">
	                    <input type="hidden" id="txt_usuario_des" value="0" />
	                    <a id="lk_f" class="btn btn-default btn-sm" style="cursor:pointer">
                            <div class="image-selector">
                                <input class="file-data" type="hidden" name="media_data_empty" value="">
                                    <div class="multi-photo-data-container hidden"></div>
                                        <label class="t1-label" style="cursor:pointer;margin-bottom:0px;font-weight:normal;">
                                            <img src="img/foto-32.png" style="width:20px" />
                                            <span class="visuallyhidden">Foto</span>
                                            <span id="im_f"></span>
                                            <input type="file" name="file3" id="file3" class="file-input" accept="image/*" size ="50" title="Solo se permite subir imagenes" />
                                        </label>
                                <div class="swf-container"></div>
                            </div>
                        </a>
	                    <img id="img" style="width:100px" />	                    
	                    <a name="btn_enviar_mensaje" id="btn_enviar_mensaje" class="btn btn-primary">Enviar Mensaje</a>
	                </div>
	              </div>
	            
	          </form>
	        </div>
	    </div>
	</div>

	
</div>




<div id="detalles_img_inbox" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Seleccione una imagen</h4>
            </div>

            <div class="modal-body">
                  <img id="img_det_inbox" style="width:100%" />
            </div>              
        </div>
    </div>
</div>