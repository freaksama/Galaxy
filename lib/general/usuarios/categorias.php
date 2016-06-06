<?

    $categorias = $c_sistema->obtenerCategorias();
    
?>



<h2 class="text-center">Categorias Mypack</h2>

<br><br>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">

	<?
        if(count($categorias)>0)
        {
            foreach($categorias as $c)
            {
                $nsfw = '';
                if($c['nsfw']=='S')
                { 
                    $nsfw = '<span class="text-danger"> +18</span>';
                }

                ?>
                	<a href="cat/<?=$c['codigo_categoria']?>" class="btn btn-default" title=<?=$c['descripcion'];?>""  style="margin:10px;width:100px;">
                		<img src="<?=$c['img'];?>" width="64" /><br><?=$c['nombre_categoria'].$nsfw;?>
                	</a>
                <?
            }
        }
    ?>
	</div>
 
	    
	

	
</div>

    