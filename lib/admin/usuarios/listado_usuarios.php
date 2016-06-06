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
    	
});


function eliminar_link(id)
{
	dataString = 'opcion=eliminarLink&id=' + id;

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
						$("#tr"+id).hide();
					}
					else
					{
						//alert('Ocurrio un error al registrar');	
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
<table class="table table-striped table-bordered table-hover">
	<tr>
		<th width="20px">Detalles</th>			
		<th width="150px">Nombre Usuario</th>		
		<th width="100px">Correo</th>		
		<th width="60px">Ubicaci&oacute;n</th>
		<th width="60px">Sexo</th>
		<th width="60px">Tema</th>
		<th width="60px">links</th>
		<th width="60px">Seguidores</th>
		<th width="60px">Siguiendo</th>
		<th width="60px">status</th>
		
	</tr>
	<?
		if(count($usuarios)>0)
		{
			foreach($usuarios as $rec)
			{
				if (file_exists("src/avatar/48/".$rec['id_usuario'].".jpg"))
	            {
	             	$avatar ='src/avatar/48/'.$rec['id_usuario'].'.jpg?op='.rand(); 	              
	           	}
	           	else
	           	{
	           	   $avatar = 'src/avatar/user.png ';    
	           	}

				?>
					<tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">
						<td style="text-align:center;">
							<a href="index.php?sub=adm&op=detu&id=<?=$rec['id_usuario'];?>"><img src="<?=$avatar;?>" width="32" /></a>
						</td>
						<td title="<?=$rec['bio'];?>"><?=$rec['nombre_usuario'];?></td>		
						<td><?=$rec['correo'];?></td>						
						<td><?=$rec['ubicacion'];?></td>
						<td><?=$rec['nombre_sexo'];?></td>
						<td><?=$rec['tema'];?></td>
						<td><?=$rec['links'];?></td>
						<td><?=$rec['seguidores'];?></td>
						<td><?=$rec['siguiendo'];?></td>						
						<td><?=$status[$rec['status']];?></td>
					</tr>
				<?
			}
		}
	?>	
</table>
</div>
<br>

