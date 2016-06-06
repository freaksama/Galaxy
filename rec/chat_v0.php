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
      /*background-color: #0066FF;*/
      height: 32px;
      margin-bottom: 3px;


    }

    .margen
    {
      /*padding: 5px;*/
      /*border-radius: 4px;*/
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

   

    .arrow-right {
      float: right;
      width: 0; 
      height: 0;
      margin-top: 6px;
      border-top: 7px solid transparent;
      border-bottom: 7px solid transparent;      
      border-left: 7px solid #d9ffb9;
    }

    .arrow-left 
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
        /*margin-left: 10px;*/
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
            marcar_mensaje_viso(id);


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
        
        

	    
	});

    onload=function()
    {
      setInterval(function(){if(window.parar)return;document.getElementById('ms_sandbox').scrollTop=document.getElementById('ms_sandbox').scrollHeight},30);
    }

    </script>
  </head>

  
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


