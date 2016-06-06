<?
	$datos['consulta']	= $_GET['q'];
	$usuarios = $c_sistema->obtenerUsuariosFundadoresAdmin($datos);
	
	//print_r($usuarios);
	

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
	<h2>Listado de Usuarios Fundadores</h2>
</div>

<br><br>

<div class="col-lg-8 col-lg-offset-2">

	<div id="msm" style="display:none" class="alert alert-dismissible alert-success">
		<button class="close" data-dismiss="alert" type="button">&times;</button>
		<strong>Exito!</strong>
		<span id="ms"></span>
	</div>
	
	
	<table id="t_user" class="table table-striped table-bordered table-hover">
		<tr>
			<th width="20px">Avatar</th>			
			<th width="150px">Detalles</th>		
			<th width="100px">Correo</th>		
			<th width="60px">Invitados</th>		
			<th width="60px">Usuarios</th>
			<th width="60px">Ganancias</th>
			
		</tr>
		<?
			
				if(count($usuarios)>0)
				{
					$total = 0 ;
					foreach($usuarios as $rec)
					{
						$total += (int)$rec['usuarios']*0.3;
						?>
							<tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">								
								<td style="text-align:center;">
									<a href="u/<?=$rec['nombre_usuario']?>">
										<img src="<?=$rec['avatar'];?>" width="32" />
									</a>
								</td>
								<td title="<?=$rec['bio'];?>">
									<a href="u/<?=$rec['nombre_usuario']?>">@<?=$rec['nombre_usuario'];?></a>
									<br>
									<span class="text-muted f11"><?=$rec['bio'];?></span>
								</td>
								<td><?=$rec['correo']?></td>
								<td><?=$rec['invitaciones']?></td>
								<td><?=$rec['usuarios']?></td>
								<td><?='$ '.number_format(((int)$rec['usuarios']*0.3),2);?></td>

							</tr>
						<?
					}
				}
			
		?>	
			<tr>
				<td colspan="5">&nbsp;</td>
				<td colspan="5"><?='$ '.number_format($total,2);?></td>
			</tr>
	</table>
</div>
<br>

