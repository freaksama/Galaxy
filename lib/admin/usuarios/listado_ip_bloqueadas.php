<?
	$datos['consulta']	= $_GET['q'];
	$resultado = $c_sistema->listadoIpBloquedas($datos);
	
	//print_r($resultado);
	

	$status['A'] = 'Activo';
	$status['B'] = 'Bloqueado';
	$status['C'] = 'Cancelado';

?>

<script type="text/javascript">


 $(document).ready(function(){
 	
 	$(".editar_pass").click(function(){

    	var avatar = $(this).data("avatar");
    	var id     = $(this).data("id-usuario");
    	var nombre = $(this).data("nombre");

    	$("#frm_img").attr("src",avatar);
    	$("#txt_id").val(id);
    	$("#txt_nombre").val(nombre);

    	$("#t_user").fadeOut();
    	$("#frm").fadeIn();
    	
    });  

    $("#id_can").click(function(){
    	$("#t_user").fadeIn();
    	$("#frm").fadeOut();
    });

    $("#id_btn").click(function(){

    	var id   = $("#txt_id").val();
    	var pass = $("#txt_new_pass").val();
    	actualizar_pass_usuario(id,pass);
    })
    	
});


function actualizar_pass_usuario(id,pass)
{
	dataString = 'opcion=act_pass_ser&id=' + id + '&pass=' + pass;

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
						//reload();
						$("#msm").show();
						$("#ms").text(r.mensaje);
						$("#frm").hide();
					}
					else
					{
						alert('Ocurrio un error al actualizar el password');	
					}
				},
		timeout:3000,
		type:"POST"
	});
}

</script>

<div class="text-center">
	<h2>Listado de IPs Bloquedas</h2>
</div>

<br><br>

<div class="col-lg-8 col-lg-offset-2">

	<div id="msm" style="display:none" class="alert alert-dismissible alert-success">
		<button class="close" data-dismiss="alert" type="button">&times;</button>
		<strong>Exito!</strong>
		<span id="ms"></span>
	</div>
	
	<a href="index.php?sub=adm&op=blip">Registrar Ip Bloqueda</a>
	
	<table id="t_user" class="table table-striped table-bordered table-hover">
		<tr>
			<th width="20px">IP</th>			
			<th width="150px">Motivo</th>		
			<th width="100px">Fecha</th>		
		</tr>
		<?
			
				if(count($resultado)>0)
				{
					$total = 0 ;
					foreach($resultado as $rec)
					{
						$total += (int)$rec['usuarios']*0.3;
						?>
							<tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">																
								<td><a href="index.php?sub=adm&op=seip&ip=<?=$rec['ip']?>"><?=$rec['ip'];?></a></td>
								<td><?=$rec['motivo']?></td>
								<td><?=$rec['fecha']?></td>								

							</tr>
						<?
					}
				}
			
		?>	
			
	</table>
</div>
<br>

