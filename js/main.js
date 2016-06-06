var img_like        = "img/like.png";
var id_last_n           =  0 ;
var id_last_c           =  0 ;
var id_usuario_actual   =  0 ;

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

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-62645322-1', 'auto');
ga('send', 'pageview');

$(function(){

    $("#txt_query").click(function(e) {                
        if(e.which == 13) 
        {

            var q = $("#txt_query").val();
            if(q != '')
            {
                window.location.href="q/" + q;    
            }
            
        }
        return false;
    });

    $("#frmq").submit(function(){                
        var q = $("#txt_query").val();
        if(q != '')
        {
            window.location.href="q/" + q;    
        }
        return false;
    });

    $("#lk_query").click(function(){
        var q = $("#txt_query").val();
        if(q != '')
        {
            window.location.href="q/" + q;    
        }
    });             
     

    $(".txt").minEmojiSVG();
});
        
            
        
