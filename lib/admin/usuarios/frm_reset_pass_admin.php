<?
	$datos['consulta']	= $_GET['q'];
	$usuarios = $c_sistema->obtenerUsuariosAdmin($datos);
	
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
	<h2>Listado de Usuarios</h2>
</div>

<br><br>

<div class="col-lg-6 col-lg-offset-2">

	<div id="msm" style="display:none" class="alert alert-dismissible alert-success">
		<button class="close" data-dismiss="alert" type="button">&times;</button>
		<strong>Exito!</strong>
		<span id="ms"></span>
	</div>

	<div id="frm" style="display:none">
		<div class="well bs-component">
              <form id="from" class="form-horizontal" action=""  enctype="multipart/form-data"  method="POST">
				<div class="form-group">
		            <label id="txt_des" for="inputEmail" class="col-lg-3 control-label">ID usuario</label>
		            <div class="col-lg-8">
		                <input  type="text" class="form-control input-sm mb5  "  id="txt_id" name="txt_id"  >
		            </div>
		        </div>

		        <div class="form-group">
		            <label id="txt_des" for="inputEmail" class="col-lg-3 control-label">Nombre usuario</label>
		            <div class="col-lg-8">
		                <input  type="text" class="form-control input-sm mb5  "  id="txt_nombre" name="txt_nombre"  >
		            </div>
		        </div>

		        <div class="form-group">
		            <label id="txt_des" for="inputEmail" class="col-lg-3 control-label">Nuevo Password</label>
		            <div class="col-lg-8">
		                <input  type="text" class="form-control input-sm mb5  "  id="txt_new_pass" name="txt_new_pass"  >
		            </div>
		        </div>

		        <div class="form-group text-center">            
		            <div class="col-lg-12">
		            	<a id="id_can" class="btn btn-default btn-sm">Cancelar</a>
		                <a id="id_btn" class="btn btn-primary btn-sm">Actualizar Password</a>
		            </div>
		        </div>
		      </form>  
	        </div>
	    </div>
		<!--div class="col-lg-2"><img id="frm_img" src="" /></div>
		<div class="col-lg-2"><input type="text" class="form-control input-sm" id="txt_id" /></div>
		<div class="col-lg-4"><input type="text" class="form-control input-sm" id="txt_nombre" /></div>
		<div class="col-lg-2"><input type="text" class="form-control input-sm" id="txt_new_pass" /></div-->
		

	
	<br><br>
	<table id="t_user" class="table table-striped table-bordered table-hover">
		<tr>
			<th width="20px">Detalles</th>
			<th width="20px">Avatar</th>			
			<th width="150px">Nombre Usuario</th>		
			<th width="100px">Correo</th>		
			<th width="60px">Ubicaci&oacute;n</th>		
			<th width="60px">status</th>
			
		</tr>
		<?
			if(count($usuarios)>0)
			{
				foreach($usuarios as $rec)
				{
					?>
						<tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">
							<td>
								<a href="javascript:void(0)" class="editar_pass" data-id-usuario="<?=$rec['id_usuario']?>" data-nombre="<?=$rec['nombre_usuario'];?>" data-avatar="<?=$rec['avatar'];?>">Editar</a>
							</td>
							<td style="text-align:center;">
								<a href="index.php?sub=adm&op=detu&id=<?=$rec['id_usuario'];?>"><img src="<?=$rec['avatar'];?>" width="32" /></a>
							</td>
							<td title="<?=$rec['bio'];?>"><?=$rec['nombre_usuario'];?></td>		
							<td><?=$rec['correo'];?></td>						
							<td><?=$rec['ubicacion'];?></td>						
							<td><?=$status[$rec['status']];?></td>
						</tr>
					<?
				}
			}
		?>	
	</table>
</div>
<br>

