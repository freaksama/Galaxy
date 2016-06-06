<?

    $categorias = $c_sistema->obtenerCategorias();
    
?>



<h2 class="text-center">Listado de RSS Mypack</h2>

<br><br>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">


        <div class="panel panel-default">
            <div class="panel-body">

                <div  class="text-right" style="float:right">
                    <a href="rss">Suscribete <img src="img/rss-32.png" /></a>
                </div>
                <div class="text-left"  style="float:left">
                    <img src="img/start-32.png" width="32"  /> 
                    <b class="f15">Portada</b>
                    <span class="text-muted">El mejor contenido de mypack ;)</span>
                </div>

            </div>
        </div>


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
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div  class="text-right" style="float:right">
                                <a href="cat/rss/<?=$c['codigo_categoria']?>">Suscribete <img src="img/rss-32.png" /></a>
                            </div>
                            <div class="text-left"  style="float:left">
                                <img src="<?=$c['img'];?>" width="32"  /> 
                                <b class="f15"><?=$c['nombre_categoria'].$nsfw;?></b>
                                <span class="text-muted"><?=$c['descripcion'];?></span>
                            </div>

                        </div>
                    </div>

                	
                <?
            }
        }
    ?>
	</div>
 
	    
	

	
</div>

    