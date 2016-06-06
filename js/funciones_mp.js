    var load_val = 1;
    var band_blo_com = 0 ;
    var band_blo_das = 0 ;
    var band_blo_pub = 0 ;
    var panel_prin   = 1 ;
    var panel_chat   = 1 ;
    var id_com_act   = 0 ;
    var httpR;

    var num_notificaciones  = 0 ;
    var num_mensajes        = 0 ;   
    var num_contenido       = 0 ;            
    var id_tmp              = 1 ;
    var id_inbox_max        = 0 ;

 $(document).ready(function(){

    
    
    if(despl_inf == 'S' & movil != 'true')
    {
        $(window).scroll(function(){
        
            if ($(window).scrollTop() == $(document).height() - $(window).height())
            {
                   if(band_blo_das != 0)
                   {
                       return false;
                   }
                   else
                   {
                       band_blo_das = 1;           
                       pagina++;                       
                       cargar_publicaciones_general();
                   }     
                    
                }   
        });
    }    


    /*$("#lk_nsfw").click(function(){

        if($("#btn_nsfw").val()=='N')
        {
            $("#btn_nsfw").val('S');
            $("#img_nsfw").attr("src","img/adulto-64.png");
        }
        else
        {
            $("#btn_nsfw").val('N');
            $("#img_nsfw").attr("src","img/nsfw.gif");   
        }


    });*/

    $("#lk_invitar_amigo").click(function(){
        if($("#txtinvitacion").val()!= '')
        {
            var correo = $("#txtinvitacion").val();
            enviar_corre_invitacion(correo);
        }
        
    });

    $("#txtinvitacion").keyup(function(){
        if($("#txtinvitacion").val()!= '')
        {
            $("#lk_invitar_amigo").attr('class','btn btn-primary btn-sm');
        }
        else
        {
            $("#lk_invitar_amigo").attr('class','btn btn-default btn-sm');
        }   
    });


    

    $(".btn_visibilidad").click(function(){

        var vista = $(this).data("visibilidad");
        var text = $(this).data("text");
        var img  = $(this).data("img");


        $("#txtvista").val(vista);
        $("#text_vista").text(text);
        $("#img_vista").attr("src",img);
        
    });

    $(".ch_cat").click(function(){
        var categoria   = $(this).data("categoria");
        var img         = $(this).data("img");

        $("#categoria").val(categoria);
        $("#img_cat").attr("src",img);

    });

    if(id_categoria != '')
    {
        $("#categoria").val(id_categoria);
        $("#img_cat").attr(img_cat);    
    }

  
    $(document).on("click",".text_com",function(){        
                
        var idc  = $(this).attr('id');  
        var id   = idc.substring(5);   
        var com = $("#txtc_"+id).html(); 
        $("#txtc_"+id).css('height','100%') ;
        $("#txtc_"+id).css('min-height','30px') ;        
            
        registrar_comentario(id);
    });


    $(document).on("focus",".text-comentario",function(){

        var id = $(this).data("id-contenido");
        $("#div_op_com_"+id).fadeIn();
    });

    



    $(document).on("mouseover",".ash",function(){
        var idc = $(this).attr("id");
        var id  = idc.substring(4);

        $(".dsh").hide();
        $("#dsh_"+id).fadeIn();

    });
  
    $(document).on("click",".del_comm",function(){

        if(confirm('Realmente desea eliminar este comentario?'))
        {
            var id           = $(this).attr('id');
            var id_contenido = $(this).data("id-contenido");
            eliminar_comentario(id,id_contenido);
            return false;
        }
        else
        {
            return false;
        }
    });

    $(document).on("click",".lk_more",function(){
        var idc = $(this).attr('id');
        var id  = idc.substr(6) ;
        
        cargar_comentarios(id);
        return false;
    });

    $(document).on("click",".compartir",function(){
        if(confirm("Desea compartir esta publicacion a sus segidores?"))
        {
            var idc = $(this).attr('id');
            var id  = idc.substr(4) ;
            compartir_contenido(id);
            return false;    
        }
       
    });

    $(document).on("click",".like",function(){       
        var idc = $(this).attr('id'); 
        var id  = idc.substr(4) ;
        registrar_like(id);
        return false;       
    });

    $(document).on("mouseover",".like",function(){
        var idc = $(this).attr('id');
        var id  = idc.substr(4) ;

        if(!$("#imk"+id).hasClass('liked'))
        {
            $("#imk"+id).attr('src',img_like);
        }
        
    });

    $(document).on("mouseout",".like",function(){
        var idc = $(this).attr('id'); 
        var id  = idc.substr(4) ;
        if(!$("#imk"+id).hasClass('liked'))
        {
            $("#imk"+id).attr('src','img/unlike.png');    
        }
        
    });

    $(document).on("click",".report",function(){

        var idc = $(this).attr('id');
        var id  = idc.substr(3);      
        reportar_link(id);
        return false;        
        
    });
    
    $(document).on("click",".lk_eliminar",function(){
         
        if(confirm('Realmente desea eliminar esta publicacion?'))
        {
            var idc = $(this).attr('id'); 
            var id  = idc.substr(4);      
            eliminar_contenido(id);
            return false;    
        }
        
    });
   

    $(document).on("click",".lk_seg",function(){

        var idc = $(this).attr('id');
        var id  = idc.substr(3); 
        
        seguir_usuario(id);
        return false;        

    });


    


    $(document).on('click',".btn_seguir",function(){
        var id = $(this).data('id-usuario');
        seguir_usuario(id);
        return false;
    });

    $(document).on('click',".btn_dejar_seguir",function(){
       var id = $(this).data('id-usuario');
        dejar_seguir_usuario(id);
        return false;
    });

    $("#btn_m1_acep").click(function(){
        if($("#txtcodigo").val() != '' || $("#file2").val()!= '')
        {
            $('#myModal').modal('hide');
            $("#im_v").html('<img src="img/online.png" />');
            $("#txtcontenido").val('3');
            $("#lk_f").hide();
            $("#lk_l").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();

        }
    });

    $("#btn_m2_acep").click(function(){
        if($("#txtlink").val() != '')
        {
            $('#myModa2').modal('hide');
            $("#im_l").html('<img src="img/online.png" />');            
            $("#lk_v").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();

            if($("#txtcontenido").val()!='2')
            {
                $("#txtcontenido").val('1');
            }
        }
    });

    $("#btn_m3_acep").click(function(){
        if($("#txtlinkd").val() != '')
        {
            $('#myModa3').modal('hide');
            $("#im_d").html('<img src="img/online.png" />');
            $("#txtcontenido").val('7');
            $("#lk_f").hide();
            $("#lk_v").hide();
            $("#lk_l").hide();
            $("#txtnombre").show();
        }
    });

    $("#file1").change(function(){
        if($("#file1").val()!= '')
        {
            $("#im_f").html('<img src="img/online.png" />');    
            $("#txtcontenido").val('2');
            $("#lk_v").hide();            
            $("#lk_d").hide();
            $("#txtnombre").show();          
            
            mostrarImagen(this);

            $("#new_img_2").fadeIn();
        }

    });

    $("#file_mp3").change(function(){
        if($("#file_mp3").val()!= '')
        {
            $("#im_m").html('<img src="img/online.png" />');    
            $("#txtcontenido").val('9');
            $("#lk_f").hide()
            $("#lk_v").hide();            
            $("#lk_d").hide();
            $("#lk_l").hide();
            $("#txtnombre").show(); 

            var nombre_file = $("#file_mp3").val();
            var nombre_file = nombre_file.split(/(\\|\/)/g).pop();
            $("#txtnombre").val(nombre_file);
        }

    });

    


    $(".new_img").change(function(){
        var id = $(this).data("id-img");

        var id_input = "#"+$(this).attr("id");

        var id_img   = "#img_new_"+id;

        mostrar_imagen_input(this, id_img);

        $("#lk_new_img_"+id).hide();

        // solo se pueden subir 10 imagenes maximo
        if(id == 10)
        {
            return;
        }

        id++;

        $("#new_img_"+id).fadeIn();
    })

     $("#file2").change(function(){
        if($("#file2").val()!= '')
        {
            $('#myModal').modal('hide');
            $("#im_v").html('<img src="img/online.png" />');
            $("#txtcontenido").val('3');
            $("#lk_f").hide();
            $("#lk_l").hide();
            $("#lk_d").hide();
            $("#txtnombre").show();
        }

    });
    
    $(document).on("click",".mos_co",function(){

        var idc = $(this).attr('id');
        var id  = idc.substr(3); 
        
        $("#idc_"+id).fadeIn();
        return false;
        

    });


    $("#lk_clear_noti").click(function(){
        $(".not-mini").fadeOut();
        $("#lk_noti").text(''); 
        $("#lk_clean_noti").fadeOut();
        $("#im_n_i").fadeIn();

        marcar_notificaciones_vistas();
        
    });

    $("#lk_clear_pub").click(function(){
        $("#d_pub").fadeOut();        
    });

    $('#btnenviar').click(function(){

        if(band_blo_pub == 1)
        {
            return false;
        }

        var text = $("#txtdes_tmp").html();
        $("#txtdes").val(text);        

        if($("#txtcontenido").val() == '6' & ($("#txtdes").val() + ''+ $("#txtnombre").val())== '' )
        {
            return false;   
        }

        if($("#file2").val()!= '')
        {
            $("#frmprincipal").submit();
        }

        band_blo_pub = 1;

        $("#im_btnenviar").attr("src","img/load.gif");        

        var archivos = document.getElementById("file1");
        var archivo  = archivos.files; 

        var archivos2 = document.getElementById("file_img_2");
        var archivo2  = archivos2.files; 

        var archivos3 = document.getElementById("file_img_3");
        var archivo3  = archivos3.files; 

        var archivos4 = document.getElementById("file_img_4");
        var archivo4  = archivos4.files; 

        var archivos5 = document.getElementById("file_img_5");
        var archivo5  = archivos5.files; 

        var archivos6 = document.getElementById("file_img_6");
        var archivo6  = archivos6.files; 

        var archivos7 = document.getElementById("file_img_7");
        var archivo7  = archivos7.files; 

        var archivos8 = document.getElementById("file_img_8");
        var archivo8  = archivos8.files; 

        var archivos9 = document.getElementById("file_img_9");
        var archivo9  = archivos9.files; 

        var archivos10 = document.getElementById("file_img_10");
        var archivo10  = archivos10.files; 

        var archivo11   = document.getElementById("file_mp3");
        var archivo11  = archivo11.files; 
        
        var data     = new FormData();

        data.append('opcion','regcon');
        data.append('txtcontenido',$("#txtcontenido").val());   
        data.append('categoria',$("#categoria").val());           

        data.append('txtnombre',$("#txtnombre").val());
        data.append('txtdes',$("#txtdes").val());
        data.append('txtlink',$("#txtlink").val());
        data.append('txtcodigo',$("#txtcodigo").val());
        data.append('txtvista',$("#txtvista").val());
        data.append('btn_nsfw',$("#btn_nsfw").val());
        data.append('txtfav','N');        

        data.append('file1',archivo[0]);
        data.append('file_new_2',archivo2[0]);
        data.append('file_new_3',archivo3[0]);
        data.append('file_new_4',archivo4[0]);
        data.append('file_new_5',archivo5[0]);
        data.append('file_new_6',archivo6[0]);
        data.append('file_new_7',archivo7[0]);
        data.append('file_new_8',archivo8[0]);
        data.append('file_new_9',archivo9[0]);
        data.append('file_new_10',archivo10[0]);
        data.append('file_mp3',archivo11[0]);

        $.ajax({
          url:'ajax/ajax.php',              //Url a donde la enviaremos
          type:'POST',                       //Metodo que usaremos
          contentType:false,                 //Debe estar en false para que pase el objeto sin procesar
          data:data,                         //Le pasamos el objeto que creamos con los archivos
          processData:false,                 //Debe estar en false para que JQuery no procese los datos a enviar
          cache:false                        //Para que el formulario no guarde cache
        }).done(function(data){  

            $("#im_btnenviar").attr("src","img/bien.png");
            band_blo_pub = 0;

            if(data != '')
            {
                $(".contenido:first").before(data);                

                $("#txtnombre").val('');
                $("#txtdes").val('');
                $("#txtdes_tmp").html('');
                $("#txtlink").val('');
                $("#codigo").val('');
                $("#txtadulto").attr("checked",false);
                $("#file1").val('');


                $("#im_d").html('');
                $("#im_f").html(''); 
                $("#im_v").html('');
                $("#im_m").html('');

                
                $("#txtcontenido").val('6');
                $("#lk_f").show();
                $("#lk_v").show();
                $("#lk_l").show();
                $("#lk_m").show();

                $("#img").attr("src","");
                $("#img").hide();

                $("#img_new_2").attr("src","");
                $("#img_new_2").hide();
                $("#img_new_3").attr("src","");
                $("#img_new_3").hide();
                $("#img_new_4").attr("src","");
                $("#img_new_4").hide();
                $("#img_new_5").attr("src","");
                $("#img_new_5").hide();
                $("#img_new_6").attr("src","");
                $("#img_new_6").hide();
                $("#img_new_7").attr("src","");
                $("#img_new_7").hide();
                $("#img_new_8").attr("src","");
                $("#img_new_8").hide();
                $("#img_new_9").attr("src","");
                $("#img_new_9").hide();
                $("#img_new_10").attr("src","");
                $("#img_new_10").hide();
                $("#img_new_10").attr("src","");
                $("#file_mp3").hide();
                $("#file_mp3").attr("src","");

                $("#btn_nsfw").val('N');
                $("#img_nsfw").attr("src","img/nsfw.gif");

            }            

        }); 

        return false;

    });

   
    $(document).on("click",".btn-memes",function(){
        var idc = $(this).attr("id");        
        var id   = idc.substring(5);   
        id_com_act = id;        
    });  

    $(document).on("click",".img_mm",function(){        
        var src    = $(this).data("src");                
        var img = '<img src="' + src + '" style="max-width:200px;" />';
        $("#txtc_"+id_com_act).append(img);
        $('#myModa3').modal('hide');
    });

    $('#fileimg_meme').change(function(){
        mostrarImagenmm(this);
    });

    //al enviar el formulario
    $('#lk_reg_mm').click(function(){
        
        var archivos = document.getElementById("fileimg_meme");
        var archivo  = archivos.files;        

        var data     = new FormData();
        data.append('opcion','regImgMeme');
        data.append('txtdes',$("#txtdescr").val());
        data.append('file1',archivo[0]);        

        $.ajax({
          url:'ajax/ajax.php', //Url a donde la enviaremos
          type:'POST',                       //Metodo que usaremos
          contentType:false,                 //Debe estar en false para que pase el objeto sin procesar
          data:data,                         //Le pasamos el objeto que creamos con los archivos
          processData:false,                 //Debe estar en false para que JQuery no procese los datos a enviar
          cache:false                        //Para que el formulario no guarde cache
        }).done(function(data){  

            respuesta = jQuery.parseJSON(data);            

            if(respuesta.codigo=='000')
            {
                var img = '<img src="' + respuesta.src + '" style="max-width:100%;" />';
                
                $("#txtc_"+id_com_act).append(img);
                $('#myModa3').modal('hide');
                $("#txtbuscarmm").val('');
                $("#img_reg_mm").hide();
                $("#txtdescr").val('');
            }
      });   

    });

    $(document).on("click",".btn-emojis",function(){        
        $("#tmp_id").val($(this).data('id-div'));
    });


    $(document).on("click",".emoji",function(){

        
        var emoji = $(this).html();
        // se pone el emoji en la div seleccionado
        $($("#tmp_id").val()).append(emoji);

        $("#emoji_m").html('Emoji insertado <img src="img/bien.png" style="width:20px;" />');

        setTimeout(function(){ $("#emoji_m").html(''); }, 2000);
    });

     $("#lk_natu").click(function(){
        if($("#lk_natu").data("load")=='N')
        {
            var bloque   = '2'; // naturaleza
            var detalles = 'emo_natu' ;
            cargar_emojis_ajax(bloque,detalles);
        }
    });

    $("#lk_obje").click(function(){
        if($("#lk_obje").data("load")=='N')
        {
            var bloque   = '3'; // objetos
            var detalles = 'emo_obje' ;
            cargar_emojis_ajax(bloque,detalles);
        }
    });

    $("#lk_simb").click(function(){
        if($("#lk_simb").data("load")=='N')
        {
            var bloque   = '4'; // naturaleza
            var detalles = 'emo_simb' ;
            cargar_emojis_ajax(bloque,detalles);
        }
    });

    $("#lk_espe").click(function(){
        if($("#lk_espe").data("load")=='N')
        {
            var bloque   = '5'; // naturaleza
            var detalles = 'emo_espe' ;
            cargar_emojis_ajax(bloque,detalles);
        }
    });

    $(document).on("click","#lk_mis_mm",function(){
        // carga los memes del usuario 
        var op2 = 'S';
        cargar_memes_propios(op2);
    });


    $("#txtbuscarmm").keyup(function(){
        var cadena = $("#txtbuscarmm").val();

        if(cadena.length > 2 || cadena.length == '')
        {
            var op2 = 'S';
            cargar_memes_propios(op2);
        }
    });


});// fin de ready



    function cargar_emojis_ajax(bloque,detalles)
    {
        dataString = 'opcion=load_emojis&bloque='+ bloque ;

        $.ajax({
            url: "ajax/ajax.php",
            data: dataString,
            async:true,
            beforeSend: function(ob){ $("#"+detalles).html('<img src="img/load.gif" /><br><br><span class="text-info f12">Cargandos emojis</span>');},
            complete: function (ob,exito){},
            dataType:"html",        
            global:true,
            success:function(data)
                    {
                        var r = jQuery.parseJSON(data);
                        
                        if(r.length > 0)
                        {
                            $("#" + detalles).empty();

                            var emojis = '';

                            for(var i= 0;i < r.length;i++)
                            {
                                emojis += r[i].emoji;
                            }

                            $("#" + detalles).append(emojis);

                            if(detalles=='emo_natu')
                            {
                                $("#lk_natu").data("load",'S');
                            }


                        }
                        else
                        {
                            //alert('Ocurrio un error al eliminar');   
                        }
                    },
            timeout:10000,
            type:"POST"
        });
    }

    function registrar_comentario(id)
    {
      var id    = id; 
      var tipo  = '1';
      var come  = $("#txtc_"+id).html();
      
      if(band_blo_com != 0)
      {
          return false;
      }
      else
      {
          band_blo_com = 1;
      }
        $("#idlc_"+id).show();

        dataString = 'opcion=regCom&id=' + id +'&tipo=' + tipo + '&com=' + come ;

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
                        band_blo_com = 0;
                        
                        if(r.codigo=='000')
                        { 
                            $("#idlc_"+id).attr('src','img/bien.png');
                            //img_avatar_actual                            
                            var div_comentario ='<div id="comentario_' + r.id_comentario + '" class="comentario">\
                                                    <div class="imagen-avatar" style="">\
                                                        <a href="/u/' + nombre_usuario + '"><img src="' + avatar + '" class="marco_av" style="width:32px;height:32px;" /></a>\
                                                    </div>\
                                                    <div class="cuerpo-comentario" ><a href="/u/' + nombre_usuario + '">@' + nombre_usuario + '</a><span class="text-muted f12">1 s</span><br>\
                                                    <span >' + come + '</span></div>\
                                                </div><hr class="hr">';                            

                           $("#contenido-comentarios_" + id).append(div_comentario);
                           $("#txtc_"+id).text('');
                          
                           $("#come_"+id).attr('class','text-success');
                           var clicks = parseInt($("#come_"+id).text());
                           clicks = clicks + 1 ;
                           $("#come_"+id).html('<b>' + clicks + '</b> Comentarios');

                           $("#idlc_"+id).hide();
              
                        }
                        else
                        {
                            
                            alert('error');         
                        }
                            
                    },
            timeout:6000,
            type:"POST"
        });
    }
  
  function eliminar_comentario(id,id_contenido)
    {
      var id_comentario = id.substr(8);
        dataString = 'opcion=delCom&id=' + id_comentario +'&id_ref=' + id_contenido ;

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
                          $("#comm_"+r.id).fadeOut();
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

    function cargar_comentarios(id)
    {
      var id    = id; 
      var tipo  = '1';
      //var come  = $("#"+id_text).val();

        dataString = 'opcion=loadCom&id=' + id +'&tipo=' + tipo ;

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
                          $("#contenido-comentarios_" + id).empty();

                          for(var i = 0 ;i<r.length; i++ )
                          {
                              var div_comentario ='<div id="comentario_' + r[i].id_comentario + '" class="comentario">\
                              <div class="imagen-avatar" style="">\
                                <a href="u/'+r[i].nombre_usuario+'"><img src="' + r[i].avatar + '" class="marco_av" style="width:42px;height:42px;" /></a>\
                              </div>\
                              <div class="cuerpo-comentario" ><a href="u/'+r[i].nombre_usuario+'">@'+r[i].nombre_usuario+'</a><span class="text-muted f10" href="#">' + r[i].fecha + '</span><br>\
                              <span>' + r[i].comentario + '</span>\
                              </div>\
                            </div>\
                            <hr class="whiter">';
                            $("#contenido-comentarios_" + id).append(div_comentario);
                          }

                          $("#lk_mc_"+id).hide();
              
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

    function marcar_notificaciones_vistas()
    {
        dataString = 'opcion=marcar_notificacion_vistas&id_last_notifi=' + id_last_n ;

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
                           $("#title").text('My Pack, comparte lo que te gusta ;)');
                        }
                        else
                        {
                            
                        }
                            
                    },
            timeout:3000,
            type:"POST"
        });
    }

    function compartir_contenido(id)
    {
        var id    = id; 
        dataString = 'opcion=com_con&id=' + id ;

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
                            //alert('Contenido compartido');

                            $("#lkco"+id).removeClass();
                            $("#lkco"+id).attr('class','text-success');
                            $("#lkco"+id).attr('id','xxx');
                            var num_rt = parseInt($("#nrt_"+id).text());
                            num_rt = num_rt + 1 ;
                            $("#nrt_"+id).text(num_rt);
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

    function registrar_like(id)
    {
        var id     = id; 
        dataString = 'opcion=reglike&id=' + id ;
        
        var n = parseInt($("#n_l"+id).text());
        
        if(!$("#imk"+id).hasClass('liked'))
        {
            // Si es un like primero hace la animacion 
            n = n + 1 ;
            $("#imk"+id).addClass('liked');
            $("#imk"+id).attr('src',img_like);                            

            $("#imk"+id).animate({
                opacity: 0.75,
                width: "+=5",      
                height: "+=5"
              }, function() {
                $("#imk"+id).css('width','24px');
                $("#imk"+id).css('height','24px');
                $("#imk"+id).css('opacity','10');                                    
            });

            $("#imk"+id).attr('src',img_like);  
        }
        else
        {
            n = n - 1 ;
            $("#imk"+id).removeClass('liked');
            $("#imk"+id).attr('src','img/unlike.png');
        }
        
         $("#n_l"+id).html(n);
        

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
                            // Si se registtro sin problema no hace nada
                        }
                        else
                        {
                             if(!$("#imk"+id).hasClass('liked'))                             
                             {
                                 n = n - 1 ;
                                $("#imk"+id).attr('src','img/unlike.png');
                             }
                             else
                             {
                                n = n + 1 ;
                                $("#imk"+id).attr('src',img_like);
                             }
                                //alert('error');         
                        }
                            
                    },
            timeout:3000,
            type:"POST"
        });
    }

    function reportar_link(id)
    {
      var id    = id; 

        dataString = 'opcion=repLink&id=' + id ;

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
                          $("#tr_lk_"+id).fadeOut();
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

    function seguir_usuario(id)
    {
        var usuario = id;
        dataString = 'opcion=seguir_usuario&id=' + usuario;

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
                            $("#v_user"+id).fadeOut();

                            $("#btn_seguir"+id).attr('class','btn btn-primary btn_dejar_seguir');
                            $("#btn_seguir"+id).html('<img src="img/adduser.png" /><b>Siguiendo');

                            var n = parseInt($("#mseguidores").text());
                            n++;
                            $("#mseguidores").html('<b>'+n+'</b>');

                        }
                        else
                        {
                            alert('Ocurrio un error al registrar'); 
                        }
                    },
            timeout:6000,
            type:"POST"
        });
    }

    function dejar_seguir_usuario(id)
    {
                
        dataString = 'opcion=dejar_seguir_usuario&id=' + id ;

        $.ajax({
            url: "ajax/ajax.php",
            data: dataString,
            async:true,
            beforeSend: function(ob){ },
            complete: function (ob,exito){},
            dataType:"html",        
            global:true,
            success:function(data)
                    {
                        var r = jQuery.parseJSON(data);
                        
                        if(r.codigo =='000')
                        {

                            $("#btn_seguir"+id).attr('class','btn btn-default btn_seguir');
                            $("#btn_seguir"+id).html('<img src="img/adduser.png" /><b>Seguir</b>');
                            var n = parseInt($("#mseguidores").text());
                            n--;
                            $("#mseguidores").html('<b>'+n+'</b>');
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
    
    function enviar_corre_invitacion(correo)
    {
        dataString = 'opcion=enviar_invitacion&correo=' + correo ;

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
                            //alert("Correo enviado");

                            $("#txtinvitacion").val('');
                            $("#txtinvitacion").attr('placeholder','Perfecto, invita a otro amigo ;)');
                            $("#lk_invitar_amigo").attr('class','btn btn-default');



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
    

    function eliminar_contenido(id)
    {
      var id    = id; 

        dataString = 'opcion=delCon&id=' + id ;

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
                          $("#tr_lk_"+id).fadeOut();
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

    function cargar_publicaciones_general()
    {
        if (load_val != 1)
        {
            return false;
        }
        
       
           $("#load_cont").show();

            dataString = 'opcion=load_publicaciones&page=' + pagina + '&cat=' + categoria + '&mejor=' + mejor + '&tags=' + tags + '&consulta=' + consulta +'&op3=' + op3;
    
            $.ajax({
                url: "ajax/ajax.php",
                data: dataString,
                async:true,
                beforeSend: function(ob){ /*$("#msj").html("<img src='img/load_05.gif' align='top' border='0' />");*/},
                complete: function (ob,exito){},
                dataType:"html",    
                error:function(ob,err,ex){band_blo_das = 0; cargar_publicaciones_general();},    
                global:true,
                success:function(data)
                        {
                            var r = jQuery.parseJSON(data);
                            if(r.length > 0)
                            {   
                                $("#load_cont").hide();
                                //alert("aqui deberia funcionar");
                                for(var i = 0; i < r.length; i++)
                                {                                       
                                    var post = crear_contenido(r[i]);
                                    //console.log(post);
                                    $("#contenido-last").append(post);    
                                }
                                
                                
                            }
                            else
                            {
                                $("#d_loag_img").html('<img src="img/mal.png" /> <span class="text-danger">Ocurrio un error al cargar las publicaciones, o no hay mas publicaciones.</span>');
                            }
                            
                            band_blo_das = 0;
                                
                        },
                timeout:9000,
                type:"POST"
            });       
    }

    function crear_contenido(datos)
    {
        var post        = datos['post']
        var come        = datos['come'];
        var cabecera    = '';
        var contenido   = '';
        var comentarios = '';

        //Publicacion general;
        var publicacion = '';

        //INICIO PUBLICACION
        

        publicacion = '<div id="tr_lk_' + post.id_contenido + '"class="panel panel-default contenido">';

        //CABECERA 
        cabecera+=      '<div class="panel-body">';
        cabecera+=           '<div class="f_l w100">';
        cabecera+=               '<a href="u/' + post.nombre_usuario + '">';                         
        cabecera+=                   '<img src="' +post.avatar + '" class="w32"/>'; 
        cabecera+=                   '<b>' + post.nombre_real + '</b> <a href="u/' + post.nombre_usuario + '" class="f12">@' + post.nombre_usuario + '</a>';

        if(post.nombre_usuario_rt != null)
        {
            cabecera+=               '<span class="f12"><img src="img/retw.png" /> </span><a href="u/'+ post.nombre_usuario_rt + '">@' + post.nombre_usuario_rt + '];?></a>';
        }
        cabecera +=                  '<a href="/post/' + post.id_contenido + '"><span class="text-muted f11" >'+post.fecha_mini +'</span></a>';
        cabecera +=              '</a>';

        cabecera +=              '<div class="f_r">';
        cabecera +=                  '<a href="cat/' + post.codigo_categoria + '" title="' + post.nombre_categoria + '">';
        cabecera +=                      '<!--img src="' + post.img + '" class="w20" /-->';
        cabecera +=                  '</a>';
        cabecera +=                  '<span class="text-info"><img src="img/eye-16.png" title="Veces visto" /> <b>' + post.veces_visto + '</b></span>';
        cabecera +=                  '<a id="llk_' + post.id_contenido + '" class="like" href="#" style="text-decoration:none;">                ';

        if(post.id_like != null)
        {
            cabecera+=                   '<img id="imk' + post.id_contenido + '" class="liked w24" src="img/like.png" />'
        }
        else
        {
            cabecera+=                   '<img id="imk' + post.id_contenido + '" src="img/unlike.png" class="w24"  />'
        }

        cabecera +=                  '</a>';
        cabecera +=              '<b><span id="n_l' + post.id_contenido + '" class="text-primary">' + post.likes + '</span></b>';
       

        if(post.id_usuario_session  != '')
        {
            cabecera +=              '<div class="btn-group ">';
            cabecera +=                  '<a aria-expanded="true" href="#" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><img src="img/config-16.png" /></a>';
            cabecera +=                  '<ul class="dropdown-menu">';

            if(post.id_usuario ==  post.id_usuario_session || post.tipo_usuario == '2')
            {
                cabecera +=                  '<li><a id="lkd_' + post.id_contenido + '" href="#" class="lk_eliminar"  title="Dar click para eliminar Contenido">Eliminar publicaci&oacute;n</a></li>';
                cabecera +=                  '<li><a href="edit_post/' + post.id_contenido + '" title="Dar click para editar Contenido">Editar publicaci&oacute;n</a></li>';

                
            }
            cabecera +=                      '<li><a href="https://www.facebook.com/dialog/feed?app_id=794307344013409&redirect_uri=http://mypack.me&link=http://mypack.me&picture=http://mypack.me/' + post.src + '&caption=Blog colaborativo de Humor&description=' + post.nombre + '" target="_blank" title="Compartir es divertido"> Compartir En facebook</a></li>';             
            cabecera +=                      '<li class="divider"></li>';
            cabecera +=                      '<li><a id="rp_' + post.id_contenido + '" href="#" class="text-danger report"  >Reportar publicaci&oacute;n</a></li>';
            cabecera +=                   '</ul>';
            cabecera +=              '</div>';
        }
        cabecera +=          '</div>';// fin f_r
        cabecera +=     '</div>';// fin f_r f_l w100
        //cabecera += '</div>';


    
        if(post.nombre != 'null' || post.nombre != null)
        {
            post.nombre = '<span class=" f16"  style="padding-left:5px;" ><b>' + post.nombre + '</b></span><br>';
        }

        //CONTENIDO
        contenido = '';        
        contenido += post.nombre;
        if(post.id_tipo_contenido == '2')
        {
            contenido += post.img; 
        }
        if(post.id_tipo_contenido == '3')
        {
            contenido += post.video;      
        }
        if(post.id_tipo_contenido == '9')
        {
            contenido += post.mp3;       
        }

        if(post.descripcion  != null || post.descripcion  != 'null' )
        {
            contenido += post.descripcion 
        }

        
        contenido += '<br>';

        if(post.link != '')
        {
            publicacion += '<a href="' + post.link + '" class="link text-success f14 " target="_blank">\
                                <img src="http://www.google.com/s2/favicons?domain=' + post.link + '" class="w32" />\
                                ' + post.link + '\
                            </a><br>';
        }

        if(post.id_usuario_session  == null)
        {
            contenido += '<br><br><a href="https://www.facebook.com/dialog/feed?app_id=794307344013409&redirect_uri=http://mypack.me&link=http://mypack.me&picture=http://mypack.me/' + post.src + '&caption=Blog colaborativo de Humor&description=' + post.nombre + '" target="_blank" title="Compartir es divertido"><img src="img/share-fb.png" style="width:150px;" ></a>';                        
        }

        //COMENTARIOS 
        comentarios = '<div id="comentarios" >';
        

        

        comentarios += '<div id="contenido-comentarios_' + post.id_contenido + '">';

        for(var i=0;i < come.length; i++)
        {
            comentarios += '<div id="comm_' + come[i].id_comentario + '" class="comentario">';
            comentarios +=      '<div class="imagen-avatar">';
            comentarios +=          '<a href="u/' + come[i].nombre_usuario + '"><img src="' + come[i].avatar + '" class="marco_av w48" style="height:42px;" /</a>';
            comentarios +=      '</div>';
            comentarios +=      '<div class="cuerpo-comentario">';

            if(come[i].id_usuario == post.id_usuario_session)
            {
                comentarios += '<div class="f_r">';
                comentarios +=      '<a id="lk_edit_' + come[i].id_comentario + '" href="index.php?sub=com&op=act&id=' + come[i].id_comentario + '&op2=dash" title="Dar click para actualizar el comentario"><img src="img/edit2.png" width="16" /></a>|';
                comentarios +=      '<a id="lk_dele_' + come[i].id_comentario + '" class="del_comm" href="#" title="Dar click para elminar comentario"><img src="img/b_drop.png" width="16" /></a>';
                comentarios += '</div>';
            }

            comentarios += '<a href="u/' + come[i].nombre_usuario + '">@' + come[i].nombre_usuario +'</a>';
            comentarios += '<span class="text-muted f10" href="#" > ' + come[i].fecha_mini + '</span><br>';
            comentarios += come[i].comentario;
            comentarios += '</div>';
            comentarios += '</div>';
            comentarios += '<hr class="whiter">';
        }

        comentarios += '</div>';

        if(post.comentarios > 3)
        {
            comentarios += '<br><div class="text-center"><a id="lk_mc_' + post.id_contenido + '" class="lk_more" href="#">Ver ' + post.comentarios + ' comentarios m&aacute;s</a></div>';
        }

        // CAJA DE COMENTARIOS 
        if(post.id_usuario_session  != null)
        {
            comentarios += '<div id="idc_' + post.id_contenido + '" class="comentario" >';
            comentarios += '    <div class="imagen-avatar" >';
            comentarios += '        <a href="u/' +post.nombre_usuario + '">';
            comentarios += '                <img src="' + post.avatar_session + '" class="marco_av w48" style="height:42px;" />';
            comentarios += '        </a>';
            comentarios += '    </div>';

            comentarios += '    <div class="cuerpo-comentario"> ';            
            comentarios += '        <div contentEditable="true" class="form-control input-sm text-comentario" data-id-contenido="' + post.id_contenido + '" id="txtc_' + post.id_contenido + '" style="margin-left:10px;margin-bottom:5px; width:100%;min-height:30px;;height:100%;line-height: 20px;" placeholder="Escribe un comentario..." ></div>';
            comentarios += '        <div id="div_op_com_' + post.id_contenido + '" class="text-right">';            
            comentarios += '            <a id="lkmm_' + post.id_contenido + '"  href="#myModa3" role="button" class="btn-memes"    data-toggle="modal" style="cursor:pointer; margin-right:10px;" ><img src="img/camera-alt-32.png" style="width:24px;" /></a>';
            comentarios += '            <a id="lkme_' + post.id_contenido + '"  href="#myModa4" role="button" class="btn-emojis"   data-id-div="#txtc_' + post.id_contenido + '"  data-toggle="modal" style="cursor:pointer; margin-right:10px;" ><img src="img/Emoticon.png"  style="width:18px;" /></a>';
            comentarios += '            <a id="btmc_' + post.id_contenido + '" class="text_com btn-sm btn btn-primary" style="cursor:pointer">Enviar comentario</a>';
            comentarios += '        </div>';
            comentarios += '        <div class="text-right">';
            comentarios += '             <img id="idlc_' + post.id_contenido + '" src="img/load.gif"  style="display:none" />';
            comentarios += '         </div>';
            comentarios += '    </div>';
            comentarios += '</div>';
        
        }
        // FIN
        publicacion += cabecera + contenido + comentarios;
        publicacion += ' </div></div>';

        return publicacion;

    }

    
    function reload()
    {
        location.reload();
    }


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

function mostrar_imagen_input(input,img)
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function (e) 
        {
            $(img).attr('src', e.target.result);
            $(img).show();
        }

        reader.readAsDataURL(input.files[0]);
    }  
}

function mostrarImagenmm(input) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img_reg_mm').attr('src', e.target.result);
            $('#img_reg_mm').fadeIn('fast');
        }

        reader.readAsDataURL(input.files[0]);
     }
}




function cambiar_fondo_web(fondo)
{
    dataString = 'opcion=cambiar_fondo_web&fondo=' + fondo ;

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
                        //alert('error');         
                    }
                        
                },
        timeout:3000,
        type:"POST"
    });
}
      
   function salir()
   {
        if(confirm('Realmente desea salir del sistema?'))
        {
            window.location.href="index.php?op=salir";
        }
   }

    if(id_usuario_actual != '0')
    {
        setInterval(function(){ cargar_datos_general();},10000);              
    }

   function cargar_datos_general()
   {
      dataString = 'opcion=load_con_gen&id_last_n=' + id_last_n +  '&id_last_c=' + id_last_c + '&id_inbox_max=' + id_inbox_max;
      $.ajax({
          url: "ajax/ajax.php",
          data: dataString,
          async:true,
          beforeSend: function(ob){ /*$("#msj").html("<img src='img/load_05.gif' align='top' border='0' />");*/},
          complete: function (ob,exito){},
          dataType:"html",        
          global:true,
          success:function(data){            
                    var r = jQuery.parseJSON(data);

                    var notificaciones    = r['notificaciones'];                          
                    var mensajes_inbox    = r['mensajes_inbox'];
                    
                    id_inbox_max = mensajes_inbox.id_inbox_max;  
                    
                    if(mensajes_inbox.num_men > 0)
                    {
                        var tmp = parseInt($("#lk_inbox").text());
                        var num_inbox = parseInt(parseInt(tmp) + parseInt(mensajes_inbox.num_men)) ;

                        $("#lk_inbox").text(num_inbox);
                        $("#lk_inbox").show();
                    }
                    
                    if(notificaciones.length > 0)
                    {
                        num_notificaciones += notificaciones.length;
                        $("#lk_noti").text(num_notificaciones);
                        $("#lk_noti").show();
                        id_last_n = notificaciones[0].id_notificacion;                    
                    }
                      
                    manejar_notificaciones(notificaciones);                    

                    if(mensajes_inbox.num_men > 0 || notificaciones.length > 0)
                    {
                        var num_noti_titulo = parseInt(mensajes_inbox.num_men) + parseInt(notificaciones.length);
                        $("#title").text('Mypack - ('+parseInt(num_noti_titulo)+')');
                        beep();
                    }
                },
          timeout:12000,
          type:"POST"
      });
   }

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
                    var res = notificaciones[i];                        
                    setTimeout(crear_noti_nt,(i*200)+200,res);                        
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
                            <span class="text-info text-right"><a href="post/' + n.link_c + '">' + n.fecha_mini + '</a></span><br><br>\
                            <span class="f12">' + n.contenido + '</span>\
                             <br>\
                        </div>';
        $("#noti-ms:first").before(div_n);
        //$(".contenido:first").before(data);  
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
