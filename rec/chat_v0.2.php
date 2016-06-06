<?
    if($_SESSION['s']['id_usuario'] == '')
    {
        $_SESSION['s']['id_usuario']    = 0;
        $_SESSION['s']['id_last_n']     = 999999999;
        $_SESSION['s']['id_last_c']     = 999999999;
    }
?>
<script src="<?=$url_g;?>js/ion.sound.min.js"></script>

    <script type="text/javascript">
      ion.sound({
        sounds: [
            {name: "water_droplet_3"}          
        ],

        // main config
        path: "sounds/",
        preload: true,
        multiplay: true,
        volume: 0.9
    });
    </script>
    
<script src="<?=$url_g;?>js/jquery.nanoscroller.min.js" ></script>
<link href="<?=$url_g;?>css/nanoscroller.css" rel="stylesheet"> 
<script type="text/javascript">

    var id_usuario_actual   = <?=$_SESSION['s']['id_usuario'];?>;
    var num_notificaciones  = 0 ;
    var num_mensajes        = 0 ;   
    var num_contenido       = 0 ; 
    var id_grupo_act        = 0 ;
    var id_conversacion_act = 0 ;          
    var id_mensaje_temp     = 0 ;
    var id_last_m           = 0 ;
    var id_last_n           = <?=$_SESSION['s']['id_last_n']?> + 0 ;
    var id_last_c           = <?=$_SESSION['s']['id_last_c']?> + 0 ;
    var page_con            = 0 ;
    var id_mensaje_g        = 0 ;
    var chat_activo         = 0 ;
    var num_chat            = 0 ; 

    var id_tmp              = 1 ;

    
      
   function salir()
   {
        if(confirm('Realmente desea salir del sistema?'))
        {
            window.location.href="index.php?op=salir";
        }
   }

      
    setInterval(function(){ cargar_datos_general();},10000);          
            
      

       function cargar_datos_general()
       {
          dataString = 'opcion=load_con_gen&id_last_n=' + id_last_n + '&id_last_m=' + id_last_m + '&id_last_c=' + id_last_c + '&id_mensaje_g=' + id_mensaje_g;

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
                          
                          var mensajes      = r['mensajes'];
                          var notificaciones= r['notificaciones'];                          
                          var mensajes_g    = r['mensajes_g'];
                          
                          
                          if(mensajes.length > 0)
                          {
                            num_mensajes += mensajes.length;
                            $("#lk_n_men").text(num_mensajes);                           
                          }


                          if(notificaciones.length > 0)
                          {
                            // bandera de nuevas notificaciones                             
                            num_notificaciones += notificaciones.length;
                            $("#lk_noti").text(num_notificaciones);                              
                            id_last_n = notificaciones[0].id_notificacion;
                            
                          }
                          
                          // manejo de mensajes 
                          manejar_mensajes(mensajes);
                          
                          // manejo de notificaciones 
                          manejar_notificaciones(notificaciones);
                          
                          // manejo de contenido
                          //manejar_contenido(contenido);

                          /*manejar_mensajes_g(mensajes_g);

                          
                          if(mensajes.length > 0 || notificaciones.length > 0)
                          {
                                var num_noti_titulo = mensajes.length + notificaciones.length;
                                $("#title").text('Mypack - ('+num_noti_titulo+')');
                                beep();
                          }*/
                          
                            

                        
                    },
              timeout:12000,
              type:"POST"
          });
       }


        


       function crear_noti_ms(r)
       {
            var d = '<div id="ms' + r.id_mensaje + '" id="noti-ms" style="display:none">\
                        <div class="notifi-men col-lg-9 col-lg-offset-1" style="padding-left:0px;">\
                            <a href="index.php?sub=men&op=con&usuario=' + r.nombre_usuario + '"><img src="' + r.avatar + '" class="avatar-ms" style="width:32px" /></a>\
                            <a href="index.php?sub=men&op=con&usuario=' + r.nombre_usuario + '"><b>@' + r.nombre_usuario + '</b></a> ' + r.mensaje + '\
                            <a href="index.php?sub=men&op=con&usuario=' + r.nombre_usuario + '">Responder ahora</a>\
                        </div>\
                    </div>';

            $("#noti-ms").append(d);
            $("#ms"+r.id_mensaje).fadeIn();
       }

        function mostrar_ms(id)
        {
            $("#ms_"+id).fadeIn();
        } 

        function borrar_noti_ms(r)
        {
            //console.log("se elimina el div:"+r.id_mensaje);
            $("#ms"+r.id_mensaje).fadeOut();
        }

        function manejar_inbox(inbox)
        {
          if(inbox[0].num > 0)
          {
            $("#lk_inbox").text(inbox[0].num);         
          }
        }

        
        
        function manejar_mensajes(mensajes)
        {
            // se valida que halla mensajes nuevos
            if(mensajes.length > 0)
            {
                // se valida que esten en el dashboard
                if ($('#ms_prin').length)
                {                    
                    $("#lk_n_men").text('');   

                    for(var i=0;i<mensajes.length;i++)
                    {
                        

                        // Seleccion de conversacon activa
                        if(id_conversacion_act == 0)
                        {
                            id_conversacion_act = mensajes[i].id_usuario_envia;  
                            id_grupo_act        = mensajes[i].id_grupo_act;  
                        }

                        // primero valida si ya hay una conversacion con ese usuario. 
                        // si hay una conversacion se escribie ahi , si no crea la ventana de chat
                        // escribe el mensaje 

                        //alert(mensajes[i].nombre_usuario);

                        if($("#dcu_" + mensajes[i].id_usuario_envia).length)
                        {                            
                            var div_con = "#dcu_"+mensajes[i].id_usuario_envia;
                            //$("#idb_" + mensajes[i].id_grupo).html(img_new_ms);
                            crear_mensaje_general(mensajes[i]);

                        }
                        else
                        {
                            var datos = [];

                            datos['id_usuario']     = mensajes[i].id_usuario_envia;
                            datos['avatar']         = mensajes[i].avatar;
                            datos['nombre_usuario'] = mensajes[i].nombre_usuario;
                            datos['id_grupo']       = mensajes[i].id_grupo;
                            datos['chat-ini']       = 'N';

                             $("#dcu_m_" + mensajes[i].id_usuario_envia).show();

                            iniciar_conversacion(datos);

                            

                        }  

                        //console.log('Chat activo: ' + chat_activo);
                        //console.log('Mensaje.grupo : ' + mensajes[i].id_grupo);

                         

                        if(chat_activo != mensajes[i].id_grupo)
                        {

                            var n_m = parseInt($("#lk_k_"+mensajes[i].id_grupo).text());     
                            if(isNaN(n_m))
                            {
                                n_m = 0;
                            }
                            //alert(n_m);
                            n_m = n_m +1;
                            $("#lk_k_"+mensajes[i].id_grupo).text(n_m);
                            var al = '<img src="img/alert.png" />';
                            $("#dm_a"+mensajes[i].id_usuario_envia).empty();
                            $("#dm_a"+mensajes[i].id_usuario_envia).append(al);
                        }
                        
                        //alert( mensajes[i].id_mensaje);
                        id_last_m =  mensajes[i].id_mensaje;
                        

                        //setTimeout(function(){beep();},(i*150)+200);
                   
                    }   

                }
                else
                {
                    for(var i=0;i<mensajes.length;i++)
                    {               
                         id_last_m =  mensajes[i].id_mensaje;
                    }    
                }  

                

            }
        }// fin de manejar mensajes

        function beep()
        {
            ion.sound.play("water_droplet_3");            
        }


        function manejar_notificaciones(notificaciones)
        {
            if(notificaciones.length > 0)
            {   
                if ($('#noti-ms').length)
                {
                    for(var i=0;i<notificaciones.length;i++)
                    {
                         //aparece el mensaje                                
                        var res = notificaciones[i];

                        // muestra la notificacion
                        setTimeout(crear_noti_nt,(i*200)+200,res);

                        //desaparece el mensaje 
                        //setTimeout(borrar_noti_nt,(i*5000)+5000,res);
                    }
                }    
            }
        }

        function crear_noti_nt(n)
        {

            if(n.nombre_usuario == 'undefined')
            {
                n.nombre_usuario = '';
            }
            var div_n = '<div id="nt_' + n.id_notificacion + '" class="well-sm mb not-mini ">\
                          <div style="float:right">' + n.icono + ' </div>\
                                <a href="u/' + n.nombre_usuario + '" class="f12"><img src="' + n.avatar + '" class="avatar-mini"  /></a>\
                                <a href="u/' + n.nombre_usuario + '" class="f12">@' + n.nombre_usuario + '</a>\
                                <span class="f12">' + n.des + '</span>\
                                <span class="f12">' + n.contenido + '</span>\
                                <span class="text-info text-mini text-right"><a href="post/' + n.link_c + '">' + n.fecha_mini + '</a></span> <br>\
                            </div>';
            $("#noti-ms:first").before(div_n);
            //$('#noti-ms').append(div_n);
            $('#nt_'+ n.id_notificacion).fadeIn(1000);
            $("#lk_clean_noti").fadeIn();
        }


        function borrar_noti_nt(n)
        {
             $("#nt_"+n.id_notificacion).fadeOut(1000);
        }




        function manejar_contenido(contenido)
        {
            if(contenido.count > 0)
            {
                $("#lk_cont").text(num_contenido);
            }
        }  

        function manejar_mensajes_g(mensajes_g)
        {
            //alert(mensajes_g.length);
            for(i= 0;i <mensajes_g.length;i++)
            {
                var usuario = '<a href="u/' + mensajes_g[i].nombre_usuario + '" class="text-danger"><b>' + mensajes_g[i].nombre_usuario + '</b></a>';
                var m = '<span style="padding-bottom:15px;">' + usuario +' : ' + mensajes_g[i].mensaje + '</span><br>';                

                $("#mg_prin").append(m);
                $(".nano").nanoScroller();
                $(".nano").nanoScroller({ scroll: 'bottom' });

                id_mensaje_g = mensajes_g[i].id_mensaje_global;
            }
            
        }  

    $(function() {  

        cargar_datos_general();
       

        //CERRAR VENTANA DE CHAT
        $(document).on("click",".clo_chat",function(){

            var idc = $(this).attr('id');
            var id  = idc.substring(4);
 
            $(".ms_min").css('background-color','#0066FF');
            
            $("#msm_"+id).hide();            
        });
        
        
        $(document).on('keypress','#txt_ms',function(e){
               
            if(e.keyCode == 13)
            {
                var men = $("#txt_ms").html();
                men = men.trim();
                if(men != '' || $("#file3").val() != '')
                {   
                    registrar_mensaje_imagen();
                }
                return false;
            }

        });      

        $(document).on('click','.m_m', function() {            
            var id = $(this).attr('id');
            $(".btn_chat").hide();
            $("#"+id+" .btn_chat").fadeIn();
            
        });  

        $(document).on('mouseleave','.m_m',function() {
            var id = $(this).attr('id');
            $(".btn_chat").hide();
        });  


        $(document).on('click','.btn_chat',function(){
            var id_mensaje_div  = $(this).data('id-mj');
            var id_mensaje      = $(this).data('id-mensaje');

            eliminar_mensaje(id_mensaje_div,id_mensaje);

        });


        
        

	    
	});// fin de ready

     function reg_men_mini(mensaje)
     {
          var com          = $("#txt_ms").html();
          var usuario_des  = id_conversacion_act; 
          var grupo        = id_grupo_act;
            
          var id_mensaje_vid = crear_mensaje();

          

          dataString = 'opcion=regmenmini&com=' + com +'&id_user_des=' + usuario_des + '&grupo=' + grupo;

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
                                $("#msj_"+id_mensaje_vid).data('id-mensaje',r.id_mensaje);                                
                            }
                            else
                            {
                                
                            }
                        },
                timeout:3000,
                type:"POST"
            });
     } // fin reg_men_mini

     function registrar_mensaje_imagen()
     {
        var com          = $("#txt_ms").html();
        var usuario_des  = id_conversacion_act; 
        var grupo        = id_grupo_act;

        var archivos = document.getElementById("file3");

        var archivo  = archivos.files;
        
        var data     = new FormData();

        data.append('opcion','regmenmini');
        data.append('com',com);
        data.append('grupo',grupo);
        data.append('id_user_des',usuario_des);
        data.append('file3',archivo[0]);

        $("#load_chat").fadeIn();
        
        

            $.ajax({
              url:'ajax/ajax.php', //Url a donde la enviaremos
              type:'POST',                       //Metodo que usaremos
              contentType:false,                 //Debe estar en false para que pase el objeto sin procesar
              data:data,                         //Le pasamos el objeto que creamos con los archivos
              processData:false,                 //Debe estar en false para que JQuery no procese los datos a enviar
              cache:false                        //Para que el formulario no guarde cache
            }).done(function(data){  

                //alert(data);
                r = jQuery.parseJSON(data);
                //console.log(respuesta);

                if(r.codigo=='000')
                {

                    var id_mensaje_vid = crear_mensaje(r);    
                    $("#msj_"+id_mensaje_vid).data('id-mensaje',r.id_mensaje);    

                    $('#img_chat_del').fadeOut('fast');
                    $('#img_chat').hide('fast');
                    $('#img_chat').attr('src','');
                    $("#file3").val('');
                    $("#txt_ms").html('');

                    $("#load_chat").fadeOut();


                    
                }
                else
                {
                    
                }
         });

    }

    function manejar_mensajes_anteriores(mensajes)
    {
        var id_usuario_envia_temp = 0;

        console.log(mensajes);
         // se valida que halla mensajes nuevos
        if(mensajes.length > 0)
        {
            // se valida que esten en el dashboard
            if ($('#ms_prin').length)
            {                    
                //$("#lk_n_men").text('');   



                for(var i=0;i<mensajes.length;i++)
                {
                   
                    // Seleccion de conversacon activa
                    if(id_conversacion_act == 0)
                    {
                        id_conversacion_act = mensajes[i].id_usuario_envia;    
                    }

                    var img = '';

                    if(mensajes[i].src != '')
                    {
                        img ='<a href="#myModa5" role="button" data-id-div="#txt_ms" class="lk_view_img_chat" data-src="' + mensajes[i].src + '"  data-toggle="modal" style="cursor:pointer;margin-right:10px;" ><img src="' + mensajes[i].src_mini + '" style="width:100%" /></a><br>';
                    }




                    if( mensajes[i].id_usuario_envia != id_usuario_actual)
                    {
                        id_usuario_envia_temp = mensajes[i].id_usuario_envia;
                        // si el usuario que envia es el usuario de la session 
                        // entonces el mensaje debe salir a la derecha
                        var div_ms = '<div id="msjg_' + id_tmp + '"  data-id-mensaje="'+ mensajes[i].id_mensaje+'" class="m_m">\
                                            <div class="aw_l"></div>\
                                            <div  class="ms ms_i ">\
                                                <span id="msj_' + id_tmp + '" class="m_o">\
                                                    <a href="javascript:void(0)" data-id-mj="' + id_tmp + '"  data-id-mensaje="'+ mensajes[i].id_mensaje+'" class="btn_chat" style="float:left;display:none">\
                                                        <img src="img/delete.png" style="margin:5px;" />\
                                                    </a>\
                                                    <b>' +  mensajes[i].nombre_usuario + '</b>:</span> ' + img + ' ' +   mensajes[i].mensaje+'\
                                                <span class="hd_time" title="' + mensajes[i].fecha_e + '">' +  mensajes[i].fecha_mini+'</span>\
                                            </div>\
                                      </div>';
                    }
                    else
                    {
                        var img_visto = '';
                        if( mensajes[i].status_men == 'R')
                        {
                            img_visto = '<span id="icon_visto_' + id_tmp + '" data-id-mensaje="' + mensajes[i].id_mensaje + '" class="lk_view_img_chat chat_' + mensajes[i].id_grupo + '" title="Visto"><img src="img/visto.png" /></span>';
                        }
                        else
                        {
                            img_visto = '<span id="icon_visto_' + id_tmp + '" data-id-mensaje="' + mensajes[i].id_mensaje + '" class="lk_view_img_chat chat_' + mensajes[i].id_grupo + '" title="Enviado"><img src="img/offline.png" /></span>';   
                        }



                        // En caso contrario el mensaje debe salir a la izquierda
                        var div_ms = '<div  id="msjg_' + id_tmp + '" data-id-mensaje="'+ mensajes[i].id_mensaje+'" class="m_m">\
                                            <div class="aw_r"></div>\
                                            <div  class="ms ms_d ">\
                                                <span id="msj_' + id_tmp + '" class="m_y">\
                                                    <a href="javascript:void(0)"  data-id-mj="' + id_tmp + '"  data-id-mensaje="'+ mensajes[i].id_mensaje+'" class="btn_chat" style="float:right;display:none">\
                                                        <img src="img/delete.png" />\
                                                    </a>' + img + ' ' +   mensajes[i].mensaje+'\
                                                <span class="hd_time" title="' + mensajes[i].fecha_e + '">' +  mensajes[i].fecha_mini + ' ' + img_visto + '</span>\
                                            </div>\
                                      </div>';
                    }
                    
                    id_tmp++;

                    $("#body_ms_"+id_conversacion_act).append(div_ms);                            
                    $(".nano").nanoScroller();
                    $("#dcu_" + id_conversacion_act).nanoScroller({ scroll: 'bottom' }); 
                
                   
                }  

                marcar_mensaje_visto(id_usuario_envia_temp); 

            }                 
        }
    }

     function crear_mensaje_general(mensaje)
     {
        //alert("Nuevo mensaje");
        if(mensaje.id_usuario_envia != id_usuario_actual)
        {
            // si el usuario que envia es el usuario de la session 
            // entonces el mensaje debe salir a la derecha
            var div_ms = '<div id="msjg_' + id_tmp + '" data-id-mensaje="'+ mensaje.id_mensaje+'" class="m_m">\
                                <div class="aw_l"></div>\
                                <div  class="ms ms_i ">\
                                    <span id="msj_' + id_tmp + '" class="m_o"><a href="javascript:void(0)"  data-id-mj="' + id_tmp + '"  data-id-mensaje="'+ mensaje.id_mensaje+'" class="btn_chat" style="float:right;display:none"><img src="img/delete.png" style="width:10px;" /></a><b>' + mensaje.nombre_usuario + '</b>:</span> ' + mensaje.mensaje+'\
                                    <span class="hd_time" title="' + mensaje.fecha_e + '" >' + mensaje.fecha_mini+'</span>\
                                </div>\
                          </div>';
            marcar_visto_mensajes_anteriore_conversacion(mensaje.id_grupo);    
        }
        else
        {
            var img_visto = '';
            if(mensaje.status_men == 'R')
            {
                img_visto = '<span id="icon_visto_' + id_tmp + '" data-id-mensaje="' + mensaje.id_mensaje + '" class="lk_view_img_chat chat_' + mensaje.id_grupo + '" title="Visto"><img src="img/visto.png" /></span>';
            }

            // En caso contrario el mensaje debe salir a la izquierda
            var div_ms = '<div  id="msjg_' + id_tmp + '" data-id-mensaje="'+ mensaje.id_mensaje+'" class="m_m">\
                                <div class="aw_r"></div>\
                                <div  class="ms ms_d ">\
                                    <span id="msj_' + id_tmp + '" class="m_y"><a href="javascript:void(0)"  data-id-mj="' + id_tmp + '"  data-id-mensaje="'+ mensaje.id_mensaje+'" class="btn_chat" style="float:right;display:none"><img src="img/delete.png" style="width:10px;" /></a><b>' + mensaje.nombre_usuario + '</b>:</span> ' + mensaje.mensaje+'\
                                    <span class="hd_time" title="' + mensaje.fecha_e + '">' + mensaje.fecha_mini + ' ' + img_visto + '</span>\
                                </div>\
                          </div>';

            
        }   



        id_tmp++;

        $("#body_ms_"+mensaje.id_usuario_envia).append(div_ms);             
        $(".nano").nanoScroller();
        $("#dcu_" + id_conversacion_act).nanoScroller({ scroll: 'bottom' }); 
     }

    function crear_mensaje(data)
    {
        var con = $("#txt_ms").html();

        var fecha   = new Date();
        var hora    = fecha.getHours();
        var minuto  = fecha.getMinutes();
        var segundo = fecha.getSeconds();

        if (hora < 10) {hora = "0" + hora ;}
        if (minuto < 10) {minuto = "0" + minuto ; }
        if (segundo < 10) {segundo = "0" + segundo ;}

        var horita = hora + ":" + minuto  ;

        var img = '';
        if(data.src_mini != '' & data.src_mini != null)
        {
            img ='<a href="#myModa5" role="button" data-id-div="#txt_ms" class="lk_view_img_chat chat_' + data.id_grupo + '" data-src="' + data.src + '"  data-toggle="modal" style="cursor:pointer;margin-right:10px;" ><img src="' + data.src_mini + '" style="width:100%" /></a><br>';
        }

        img_visto = '<span id="icon_visto_' + id_tmp + '" data-id-mensaje="' + data.id_mensaje + '" class="lk_view_img_chat chat_' + data.id_grupo + '" title="Enviado"><img src="img/offline.png" /></span>';

        var div_ms = '<div id="msjg_' + id_tmp + '" data-id-mensaje="0" class="m_m" />\
                            <div class="aw_r"></div>\
                            <div class="ms ms_d">\
                                <span id="msj_' + id_tmp + '" class="m_y">\
                                    <a href="javascript:void(0)"  data-id-mj="' + id_tmp + '"  data-id-mensaje="0" class="btn_chat" style="float:right;display:none">\
                                        <img src="img/delete.png" />\
                                    </a>\
                                    '+img+'\
                                    '+con+'</span>\
                                <span class="hd_time">'+horita+' '+img_visto+' </span>\
                            </div>\
                        </div>';
        var id_tmp_mensaje =  id_tmp;
        id_tmp++;

        $("#body_ms_"+id_conversacion_act).append(div_ms);          
        $("#txt_ms").text(''); 
        $(".nano").nanoScroller();
        $("#dcu_" + id_conversacion_act).nanoScroller({ scroll: 'bottom' }); 
         
        return id_tmp_mensaje;

     }// fin crear_mensaje

     function marcar_visto_mensajes_anteriore_conversacion(id_grupo)
     {
        console.log("marca los mensajes anteriores como vistos");        

        $(".chat_"+id_grupo).attr("title","Visto");
        $(".chat_"+id_grupo).html('<img src="img/visto.png" />');

     }  

     function marcar_mensaje_visto(id)
     {
          $("#msv_"+id).val('S');

          $("#title").text('My Pack, comparte lo que te gusta ;)');

          var dataString = 'opcion=ms_visto_dash&id=' + id;
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
                         
                       if(r.codigo == '000')
                       {
                           $("#msv_"+id).val('S');
                           $("#idb_"+id).html('');
                       }
                       else
                       {
                           $("#msv_"+id).val('N');
                           console.log('Ocurrio un error');
                       }

                     },
             timeout:3000,
             type:"POST"
          });
     }// fin de marcar_mensaje_visto

     function eliminar_mensaje(id_mensaje_vid, id_mensaje)
     {
        //$("#msv_"+id).val('S');

          //$("#title").text('My Pack, comparte lo que te gusta ;)');

          var dataString = 'opcion=delmens&id_mensaje=' + id_mensaje;
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
                         
                       if(r.codigo == '000')
                       {
                            $("#msjg_"+id_mensaje_vid).fadeOut();
                            //$("#msjg_"+id_mensaje_vid).remove();
                           
                       }
                       else
                       {
                           
                       }

                     },
             timeout:3000,
             type:"POST"
          });
     }

    function iniciar_conversacion(datos)
    {           
        // aqui se escoje cual es la conversacion activa      
        //alert("cambio de conversacion");
        console.log(datos);

        id_grupo_act = datos['id_grupo'];  

        if(id_conversacion_act == 0)
        {
            id_conversacion_act = datos['id_usuario'];            
        }

        if(chat_activo == 0)
        {
            //alert("cambiar el chat activo");
            chat_activo = datos['id_grupo'];  
        }       


        // primero valida si ya hay una conversacion con ese usuario. 
        // si hay escribie ahi , si no crea la ventana de chat        
        if($("#dcu_" + datos['id_usuario']).length)
        {   
            var div_con = "#dcu_" + datos['id_usuario'];
            id_conversacion_act = datos['id_usuario'];
            //page_con = $(div_con).data('page');            

        }
        else
        {
        	id_conversacion_act = datos['id_usuario'];    

            // se crea el div de la conversacion            
            

            var div_conversacion = '<div id="dcu_' + datos['id_usuario'] + '" data-id-user="' + datos['id_usuario'] + '" data-page="1" class="dcu nano"  style="display:none" >\
                                        <div class="nano-content"><div id="body_ms_' + datos['id_usuario'] +'"></div></div>\
                                    </div>';
            
            $("#ms_prin").append(div_conversacion);            

            var div_con = "#dcu_"+datos['id_usuario'];   
            var sa = 'S';
            $("#div_user_" + datos['id_usuario']).data('conv-act',sa);
            
            page_con = 1 ;       

        }


        
        $("#ms_prin").show();        
        $("#ms_sandbox").show();   
        $("#chat_prin").show();

        if(chat_activo == datos['id_grupo'])
        {
            $("#dcu_"+id_conversacion_act).show();
        }

        if(datos['chat-ini'] == 'N')
        {
            //chat_activo =  datos['id_grupo'];  
            if(chat_activo == datos['id_grupo'])
            {
                cambio_conversacion(datos);    
            }
            
            cargar_conversacion_anterior(page_con,datos['id_usuario']);
        }
        
        
        //cambio_conversacion(id_conversacion_act);
            
            
        
        
    }
    
    function cambio_conversacion(datos)
    {
        chat_activo = datos['id_grupo']; 
        
        $("#con_head_avatar").attr("src",datos['avatar']);
        $("#con_head_user").attr("href",'u/'+datos['nombre_usuario']);
        $("#con_head_user").text('@'+datos['nombre_usuario']);

	    // muestra el chat principal y la conversacion activa
	    $("#ms_prin").show();	
	    $(".dcu").hide();
	    $("#dcu_"+datos['id_usuario']).show();	

        // elimina img alerta y contador de mensajes
        $("#dm_a"+datos['id_usuario']).empty();	    
        $("#lk_k_"+chat_activo).text('');	    

    }

    function cargar_conversacion_anterior(page,id_usuario)
    {
        dataString = 'opcion=load_con_ant&grupo=' + id_grupo_act + '&page=' + page + '&id_usuario_r=' + id_usuario;

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
                          
                        if(r.length > 0)
                        { 
                           manejar_mensajes_anteriores(r);
                        }
                    },
              timeout:8000,
              type:"POST"
          });
    }

    </script>