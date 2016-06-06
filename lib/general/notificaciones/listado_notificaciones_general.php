<?
	
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
	$datos['last']	=	'';
	$notificaciones 	= $c_sistema->listadoNotificacionGeneral($datos);

	//print_r($notificaciones);

	
	
	$datos['id_ult_not'] = $notificaciones[0]['id_notificacion'];
	$_SESSION['s']['id_last_n'] = $datos['id_ult_not'];

	$c_sistema->actualizarUltNotificacion($datos);

	//$dash        = $c_sistema->obtenerDatosDashboardUsuario();
	//$user_seguir = $c_sistema->listadoUsuariosParaSeguir();

	//print_r($_SESSION);
	//$reg   = $c_sistema->obtenerDatosUsuario2($datos);
	//print_r($links);

	//print_r($_SESSION);



?>

<script type="text/javascript">


 $(document).ready(function(){
 	
 	$(".lk_del").click(function(){
    	if(confirm('Realmente desea eliminar este link??'))
    	{
    		var idc = $(this).attr('id');
    		var id  = idc.substr(4) ;    	
    		eliminar_link(id);
    		return false;
    	}
    	else
    	{
    		return false;
    	}
    	
    });

    $("#txtgrupo").change(function(){
    	$(".grupos").hide();
    	$(".g_"+$(this).val()).fadeIn();
    });

    $(document).on("click",".lk_seg",function(){

        var idc = $(this).attr('id');
        var id  = idc.substr(3); 

        if(loginredirect())
        {
            seguir_usuario(id);
            return false;
        }

    });
    	
});



</script>


<div class="text-center">
	<h4>&Uacute;ltimas Notificaciones</h4>
</div>



<div class=" col-lg-8 col-lg-offset-2">	
<?
	if(count($notificaciones)>0)
	{
		foreach($notificaciones as $rec)
		{
			$img_new = '';
        	if($rec['id_notificacion'] > $_SESSION['s']['id_last_n'] )
        	{
        		$img_new = '<img src="img/new-32.png" />';
        	}
		       if($rec['nombre_usuario'] != '')      
		       {
		       		$nombre_usuario = '@'.$rec['nombre_usuario'];
		       }

			?>
				<div class="panel panel-default">
				  	<div class="panel-body">
						<div style="float:right"><?=$rec['icono'];?> <?=$img_new;?></div>
			            <img src="<?=$rec['avatar']?>" class="avatar-mini"  />
			            <a href="/u/<?=$rec['nombre_usuario']?>"><?=$nombre_usuario;?></a>
			            <?=$c_sistema->generar_tags($rec['des']);?>
			            <?=$c_sistema->generar_tags($rec['contenido']);?>
			            <a href="post/<?=$rec['link_c'];?>"><span class="text-info text-mini text-right"><?=$rec['fecha_mini'];?></span></a> <br> 
		        	</div>
		        </div>
			<?
		}
	}
?>	
</div>
<br>
