<?
if(count($resultado)>0)
{
    $nextpage= $paginacion['page'] +1;
    $prevpage= $paginacion['page'] -1;
    $rango  = 7;
    $limite = 15;
    $inicio = 1;
    $rangomin = $paginacion['page'] - $rango;
    $rangomax = $paginacion['page'] + $rango;
 
    $ultima = $paginacion['lastpage'];
     
    ?><ul  class="pagination pagination-sm"><?php
          
  
	if($paginacion['lastpage'] < $limite)
	{
		//Si el numero de paginas es menor al limite entonces se deben de mostrar todas las paginas
		//Se valida si es la primer pagina para desdehabilitar el boton de previo
		//se hace un for para todas la paginas
		//Se hace valida si es la ultima pagina para deshbailitar el boton de sisguente

		if ($paginacion['page'] == 1)
		{
			?><li class="active"><a>&laquo; Anterior</a></li><?	
		}
		else
		{
			?><li><a href="<?=$destino;?>&page=<?php echo $prevpage;?>">&laquo; Anterior</a></li><?
		}


		for($i = 1; $i<= $paginacion['lastpage']; $i++)
		{	
			if($paginacion['page'] == $i)
			{
				?><li class="active"><a><?php echo $i;?></a></li><?
			}
			else
			{
				?><li><a href="<?=$destino;?>&page=<?php echo $i;?>" ><?php echo $i;?></a></li><?
		    }
		}

		if($paginacion['lastpage'] >$paginacion['page'] )
		{
			?><li class="next"><a href="<?=$destino;?>&page=<?php echo $nextpage;?>" >Siguiente &raquo;</a></li><?
		}
		else
		{
			?><li class="disabled"><a>Siguiente &raquo;</a></li><?
		}

	}
	else if ($paginacion['page'] == 1)
	{
		//Si nos encontrames en la primer pagina, mostramos inactivo boton previo,
	  	//Muestro la pagina 1 como la activa
	  	//hacermos un for de 1 hasta $limite
	  
		?><li><a>&laquo; Anterior</a></li>
		<li class="active"><a>1</a></li><?
	 
		for($i= $paginacion['page']+1; $i<= $limite; $i++)
		{
			?><li><a href="<?=$destino;?>&page=<?php echo $i;?>"><?php echo $i;?></a></li><?
		}

		?><li><a href="<?=$destino;?>&page=<?php echo $i;?>">...</a></li><?
		?><li><a href="<?=$destino;?>&page=<?php echo $ultima;?>"><?php echo $ultima;?></a></li><? 
	           
	           
	  
	    //Si la ultima pagina es menor que la actual, deshabilito el boton de next	  

	    if($paginacion['lastpage'] >$paginacion['page'] )
		{
			?><li class="next"><a href="<?=$destino;?>&page=<?php echo $nextpage;?>" >Siguiente &raquo;</a></li><?
	    }
	    else
		{
			?><li class="next-off">Siguiente &raquo;</li><?
		}

	}
	else if ($paginacion['page'] + $rango >= $paginacion['lastpage'])
	{
		//Si la pagina actual esta dentro del $rango de la ultima pagina entonces
		//Se habilita el boton previos
		//Se pone la pagina 1 como primera, y despues se muestran desde la ultima pagina menos 15
		?><li class="previous"><a href="<?=$destino;?>&page=<?php echo $prevpage;?>">&laquo; Anterior</a></li><?
		?><li><a href="<?=$destino;?>&page=<?php echo $inicio;?>" ><?php echo $inicio;?></a></li><?
		?><li><a href="<?=$destino;?>&page=<?php echo $paginacion['lastpage']-$limite -2;?>">...</a></li><?
		
	    for($i= $paginacion['lastpage']-$limite -1; $i<= $paginacion['lastpage'] ; $i++)
	    {
	        if($paginacion['page'] == $i)
			{
				?><li class="active"><a><?php echo $i;?></a></li><?
	        }
	        else
	        {
				?><li><a href="<?=$destino;?>&page=<?php echo $i;?>" ><?php echo $i;?></a></li><?
	        }
	    }            
	             //Y SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    
	    if($paginacion['lastpage'] >$paginacion['page'] )
	    {   
	    	?><li class="next"><a href="<?=$destino;?>&page=<?php echo $nextpage;?>">Siguiente &raquo;</a></li><?php
	    }
		else
	    {
	        ?><li class="disabled"><a>Siguiente &raquo;</a></li><?
	    }
	}
	else if($paginacion['page'] < $rango + 3 )
	{
		//Si la pagina actual es menor que el rango + 3, entonces se muestran las paginas desde 1
		// hasta el limite, activando los botones de sig y previo
		//poniendo [...] en el penultimo lugar
		?><li class="previous"><a href="<?=$destino;?>&page=<?php echo $prevpage;?>">&laquo; Anterior</a></li><?

	    for($i= 1; $i<= $limite ; $i++)
	    {
	        //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
	        if($paginacion['page'] == $i)
			{
				?><li class="active"><a><?php echo $i;?></a></li><?
	        }
	        else
	        {
				?><li><a href="<?=$destino;?>&page=<?php echo $i;?>" ><?php echo $i;?></a></li><?
	        }
	    }
	    
	    if($limite < $ultima)
	    {
	        ?><li><a href="<?=$destino;?>&page=<?php echo $i;?>" >...</a></li>
	          <li><a href="<?=$destino;?>&page=<?php echo $ultima;?>"><?php echo $ultima;?></a></li><?
	    }
	    
	    //Y SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    
	    if($paginacion['lastpage'] >$paginacion['page'] )
	    {
			?><li class="next"><a href="<?=$destino;?>&page=<?php echo $nextpage;?>">Siguiente &raquo;</a></li><?
	    }
	    else
	    {
	        ?><li class="next-off"><a>Siguiente &raquo;</a></li><?
	    }
	}	
	else if ($paginacion['page'] >= $rango )
	{
		//Si la pagina actual esta despues del rango entonces se activa el boton de previo
		//se pone comoo pagina inicial 1
		//se ponene [...] despues de 1, y se muestran las paginas desde
		// pagina inicial menos $rango y mas rango y se ponene [...] en el peultimo lugar	

	    ?><li class="previous"><a href="<?=$destino;?>&page=<?php echo $prevpage;?>">&laquo; Anterior</a></li>
		<li><a href="<?=$destino;?>&page=<?php echo $inicio;?>" ><?php echo $inicio;?></a></li>
		<li><a href="<?=$destino;?>&page=<?=$paginacion['page']-$rango;?>" >...</a></li><?
		
		for($i= $paginacion['page']- $rango; $i<= $paginacion['page'] +  $rango ; $i++)
		{	
			if($paginacion['page'] == $i)
			{
				?><li class="active"><a><?php echo $i;?></a></li><?
			}
			else
			{
				?><li><a href="<?=$destino;?>&page=<?php echo $i;?>" ><?php echo $i;?></a></li><?
			}
	    }
	            
	    if($limite < $ultima)
	    {
	            ?><li><a href="<?=$destino;?>&page=<?php echo $i;?>" >...</a></li>
	            <li><a href="<?=$destino;?>&page=<?php echo $ultima;?>"><?php echo $ultima;?></a></li><?
	    }
	    
	    //Y SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    
	    if($paginacion['lastpage'] >$paginacion['page'] )
	    {
	       	?><li class="next"><a href="<?=$destino;?>&page=<?php echo $nextpage;?>">Siguiente &raquo;</a></li><?php
	    }
	    else
	    {
	        ?><li class="next-off">Siguiente &raquo;</li><?
	    }
	}

?></ul><?
} ?>