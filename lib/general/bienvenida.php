<?
	$datos['id_usuario'] = $_SESSION['s']['id_usuario'];

	$grupos  = $c_sistema->obtenerGruposUsuario($datos);
	//$links 	 = $c_sistema->obtenerLinkUsuario($datos);
?>

<!-- Jumbotron -->
<h1 class="text-center">Pagina de Inicio</h1>


<ul class="nav nav-tabs" style="margin-bottom: 15px;">
	<?
		$class = ' class="active" ';
		foreach($grupos as $g)
		{

			?><li <?=$class;?> ><a href="#<?=$g['id_grupo']?>" data-toggle="tab"><?=$g['nombre'];?> <span class="badge"><?=$g['num_link'];?></span></a></li><?
			$class ='';
		}
	?>  	
</ul>
<div id="myTabContent" class="tab-content">


	<?	
		$active = 'active';
		foreach($grupos as $g)
		{
			?>
				<div class="tab-pane <?=$active.' '.$class;?> " id="<?=$g['id_grupo'];?>">				
			<?
			$active = '';	
				foreach($links as $l)
				{
					if($l['id_grupo']==$g['id_grupo'])
					{
						?>
							<img src="http://www.google.com/s2/favicons?domain=<?=$l['link'];?>" width="24" /> 
							<a href="<?=$l['link'];?>" target="_blank" title="<?=$l['descripcion'];?>"><?=$l['nombre'];?></a>
							<br>
							<br>
						<?	
					}
					
				}
			?>
				</div>			
			<?
		}
	?>

	
	
</div>
