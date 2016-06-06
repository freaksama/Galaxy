<div class="text-center">
<ul class="pagination pagination-centered">
  <?
  	if($paginador['page_act'] == '1' || $paginador['page_act'] == '0')
  	{
  		?><li class="disabled"><a href="#"><<</a></li><?
  	}
  	else
  	{
  		?><li><a href="#"><<</a></li><?
  	}

  	for($i=1;$i <= $paginador['pages'];$i++)
  	{
  		if($i==$paginador['page_act'])
  		{
  			?><li class="active"><a href="<?=$destino.'&page='.$i;?>"><?=$i;?></a></li><?
  		}  	
  		else 
  		{
  			?><li class=""><a href="<?=$destino.'&page='.$i;?>"><?=$i;?></a></li><?
  		}		
  	}
  ?>
  <li><a href="#">>></a></li>
</ul>
</div>