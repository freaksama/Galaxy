    <style type="text/css">
      #ms_prin
      {
        background-color: #d6e4ef;
        width: auto;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        width: 260px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
    	    float: right;		    
        border: 1px solid #CCCCCC;
      }

      #ms_sandbox
      {
        min-height: 250px;
        max-height: 250px;        
        overflow-y: scroll;        
      }


    #body_ms
    {
        height: 260px;
    }  

    .ms
    {
    	width:85%;
    	margin-bottom: 5px;    	
    	text-align: left;
    	line-height: 20px;    	
    	font-size: 12px;
    	border-radius: 4px;
    	padding: 2px 5px 2px 5px;
    }

    .ms_d
    {
    	margin-left:13%;
      margin-right:0%;
    	background-color: #d9ffb9;
    	border: 1px solid #aee59d;
      
    }

    .ms_i
    {
    	margin-right:10%;
        margin-left:3%;
    	background-color: #FFFFFF;
    	border: 1px solid #bdd3e6;
    }

    .head_ms
    {
      height: 32px;
      margin-bottom: 3px;
    }

    .suc
    {    	
    	color: #008bec;
    }

    .hd_time
    {
    	font-size: 10px;
    	color: #666666;
    }

    .aw_r {
      float: right;
      width: 0; 
      height: 0;
      margin-top: 6px;
      border-top: 7px solid transparent;
      border-bottom: 7px solid transparent;      
      border-left: 7px solid #d9ffb9;
    }


    .aw_l 
    {
      float: left;
      width: 0; 
      height: 0; 
      margin-top: 6px; 
      border-top: 7px solid transparent;
      border-bottom: 7px solid transparent;       
      border-right:8px solid #FFFFFF;
    }

    #txt_ms
    {
      width:100%;
      border:1px solid #CCC;      
      overflow: hidden;            
      bottom: 0px; 
      height: 30px;
      padding: 3px;
      margin-right: 5px;
      background-color: #FFFFFF;
    }

    .ms_min
    {   
        background-color: #0066FF;
        padding: 3px 10px 3px 10px;        
        min-width: 100px;        
        margin-right: 10px;
        float: right;        
        border-radius: 3px;
        cursor:pointer;
        color: #FFFFFF;
        font-size: 12px;
    }

    #div_ms_min
    {
        position: fixed;  
        bottom: 0px;  
        width:80%;
        z-index: 9999;
        margin-left: 100px;
    }

  </style>
    
  <script type="text/javascript">

    $(function() {  

	    var $sidebar   = $("#ms_prin"), 
	        $window    = $(window),
	        offset     = $sidebar.offset(),
	        topPadding = 60;

	    $window.scroll(function() {
	        if ($window.scrollTop() > offset.top) {
	            $sidebar.stop().animate({
	                marginTop: $window.scrollTop() - offset.top + topPadding
	            });
	        } else {
	            $sidebar.stop().animate({
	                marginTop: 0
	            });
	        }
	    });

        //CAMBIA CONVERSACION DE CHAT
        $(document).on("click",".ms_min",function(){
            var idc = $(this).attr('id');
            var id  = idc.substring(4);

            $(".ms_min").css('background-color','#0066FF');
            $(this).css('background-color','#006600');

            $("#ms_prin").show();

            $(".dcu").hide();
            $("#dcu_"+id).show();

            $(".head_ms").hide();
            $("#ms_head"+id_conversacion_act).show();

            id_conversacion_act = id;
            marcar_mensaje_visto(id);

        });

        //MINIMIZA VENTANA DE CHAT
        $(document).on("click",".min_chat",function(){
        	//alert("minimiza la ventana");
            $(".ms_min").css('background-color','#0066FF');
            $("#ms_prin").hide();
        });

        //CERRAR VENTANA DE CHAT
        $(document).on("click",".clo_chat",function(){

            var idc = $(this).attr('id');
            var id  = idc.substring(4);
 
            $(".ms_min").css('background-color','#0066FF');
            // cierra ventana minimizada
            $("#msm_"+id).hide();
            // cierra ventanaidc chat 
            $("#ms_prin").hide();
        });

        // Marca el mensaje en visto cuando pasen el mouse sobre el mensaje
        $(document).on('mouseover','.dcu',function(){

            var idc = $(this).attr('id');
            var id  = idc.substring(4);            
            
            if($("#msv_"+id).val() == 'N')
            {
                marcar_mensaje_visto(id);
            }

        });// fin 

        //  Envia el mensaje cuando se da enter
        
        $(document).on('keypress','#txt_ms',function(e){
               
            if(e.keyCode == 13)
            {
                var men = $("#txt_ms").text();
                men = men.trim();
                if(men != '')
                {   
                    reg_men_mini(men);      
                }
                return false;
            }

        });
        
        

	    
	});// fin de ready

     onload=function()
     {
          setInterval(function(){if(window.parar)return;document.getElementById('ms_sandbox').scrollTop=document.getElementById('ms_sandbox').scrollHeight},30);
     }


     function reg_men_mini(mensaje)
     {
          var com          = mensaje;
          var usuario_des  = id_conversacion_act;            
            
          crear_mensaje();

          dataString = 'opcion=regmenmini&com=' + com +'&id_user_des=' + usuario_des;

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
                                //alert('Mensaje enviado');
                                
                            }
                            else
                            {
                                //alert('Ocurrio un error al registrar');   
                            }
                        },
                timeout:3000,
                type:"POST"
            });
     } // fin reg_men_mini

     function crear_mensaje()
     {
          var con = $("#txt_ms").text();

          var fecha   = new Date();
          var hora    = fecha.getHours();
          var minuto  = fecha.getMinutes();
          var segundo = fecha.getSeconds();

          if (hora < 10) {hora = "0" + hora ;}
          if (minuto < 10) {minuto = "0" + minuto ; }
          if (segundo < 10) {segundo = "0" + segundo ;}

          var horita = hora + ":" + minuto  ;

          var div_ms = '<div class="aw_r"></div>\
                       <div class="ms ms_d">\
                       '+con+'\
                       <span class="hd_time">'+horita+'</span>\
                     </div>';
          //alert(div_ms);
          $("#body_ms_"+id_conversacion_act).append(div_ms);
          $("#body_ms_"+id_conversacion_act).animate({ scrollTop: $("#body_ms_"+id_conversacion_act).last().attr("scrollHeight") }, 500);
          $("#txt_ms").text('');            
     }// fin crear_mensaje

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

     function iniciar_conversacion(datos)
     {   
        if ($('#ms_prin').length)
        {           
            //var img_new_ms = '<img src="img/notifi.png" style="width:20px;" />';
            // aqui se escoje cual es la conversacion activa
            if(id_conversacion_act == 0)
            {
                id_conversacion_act = datos['id_usuario'];    
            }

            // primero valida si ya hay una conversacion con ese usuario. 
            // si hay escribie ahi , si no crea la ventana de chat
            // escribe el mensaje 

            if($("#dcu_" + datos['id_usuario']).length)
            {
                // id de la conversacion 
                var div_con = "#dcu_" + datos['id_usuario'];
                //$("#idb_" + datos['id_usuario']).html(img_new_ms);
            }
            else
            {

                // se crea el div de la conversacion
                var div_head_ms = '<div id="ms_head'+datos['id_usuario']+'" class="head_ms navbar-inverse" style="display:none;">\
                                    <input id="msv_' + datos['id_usuario'] + '" type="hidden" value="N" />\
                                      <img src="' + datos['avatar'] + '" class="margen" style="height:20px;" />\
                                      <span style="color:#FFF;">\
                                        <b>@' + datos['nombre_usuario'] + '</b>\
                                        <div  style="float:right;padding:4px;">\
                                            <img id="imc_0318" class="min_chat" src="img/minimize_chat.png" style="width:16px;cursor:pointer;" />\
                                            <img id="icc_0318" class="clo_chat" src="img/close_chat.png" style="width:16px;cursor:pointer;" />\
                                        </div>\
                                      </span>\
                                    </div>';

                var div_conversacion = '<div id="dcu_' + datos['id_usuario'] + '" class="dcu"  style="display:none" >\
                                            <div id="body_ms_' + datos['id_usuario'] +'">\
                                            </div>\
                                        </div>';
                $("#ms_header").append(div_head_ms);
                $("#ms_sandbox").append(div_conversacion);
                

                var div_con = "#dcu_"+datos['id_usuario'];
                // se crea el div minimizado oculto.
                var div_minimize = '<div id="msm_'+datos['id_usuario']+'" class="ms_min">\
                                    ' + datos['nombre_usuario'] + '\
                                    <div id="idb_'+datos['id_usuario']+'" style="float:right;;"></div>\
                                </div>';

                $("#div_ms_min").append(div_minimize);

                
            }

            /*var ms_ue = '<div class="aw_l"></div>\
                        <div  class="ms ms_i ">\
                            <span class="suc">' + datos['nombre_usuario'] + ':</span> '+r[i].mensaje+'\
                            <span class="hd_time">'+r[i].fecha+'</span>\
                        </div>';
            $("#msv_" + datos['id_usuario']).val("N");
            $("#body_ms_" + datos['id_usuario']).append(ms_ue);
            */
            //id_last_m =  r[i].id_mensaje;
            $("#ms_prin").show();

                                           

            
            $("#ms_head"+id_conversacion_act).show();
            $("#dcu_"+id_conversacion_act).show();
            

            

            //alert(id_conversacion_act);
            //$("#idlm_"+r[i].id_mensaje).focus();
            $("#body_ms_"+datos['id_usuario']).animate({ scrollTop: $("#body_ms_"+datos['id_usuario']).last().attr("scrollHeight") }, 500);


        }

        
    }

    </script>

  
  <!--
        El div img prin sera el sandbox de las conversaciones
  -->

    <div id="ms_prin" style="display:none">
        <div id="ms_header">

        </div>

        <div id="ms_sandbox"  onmouseover="parar=1" onmouseout="parar=0">

        </div>

        <div id="txt_ms"  contentEditable="true"  style="" >&nbsp;</div>
    </div>

    <div id="div_ms_min">

    </div>


