<?

      $datos['fecha'] = $_GET['fecha'];
      $datos['ip']    = $_GET['ip'];
      
      if($datos['ip']=='')
      {
      	die();
      }
      
      if($datos['fecha']=='')
      {
      	$datos['fecha'] = date('Y-m-d',time());
      }

    $fechas = $c_sistema->obtenerFechasVisitasIP($datos);

    $visitas = $c_sistema->obtenerPaginasVisitasIP($datos);


    
?>
<script type="text/javascript">
    $(function(){

        

       
        


    });
</script>
<script src="rec/gra/js/highcharts.js"></script>
<script src="rec/gra/js/modules/exporting.js"></script>


<div class="col-lg-3" style="float:left;">  
    
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3 class="panel-title">Visitas Anteriores</h3>
      </div>
      <div class="panel-body">
        <table class="table">           
               <thead>
                    <tr>
                        <th width="100px">Fecha</th> 
                        <th width="100px">Visitas</th> 
                    </tr>
                </thead>  
                <tbody>
                    <?
                        if(count($fechas)>0)
                        {
                            foreach($fechas as $f)
                            {
                                ?>
                                    <tr>
                                        <td><a href="index.php?sub=adm&op=seip&ip=<?=$datos['ip'];?>&fecha=<?=$f['fecha'];?>"><?=$f['fecha']?></a></td>
                                      	<td><b><?=$f['visitas']?></b></td>
                                    </tr>
                                <?
                            }
                        }
                    ?>
                </tbody>                          
        </table>
      </div>
    </div>  

</div>














<div style="float:left;"  class="col-lg-8">



             <b>Fecha : </b><?=$datos['fecha'];?>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="100px">Fecha</th> 
                        <th width="200px">IP</th> 
                        <th width="250px">Usuario</th>                                                       
                    </tr>
                </thead>
                <tbody>
                    <?
                        if(count($visitas)>0)
                        {
                            foreach($visitas as $v)
                            {
                                 
                                ?>
                                    <tr>
                                        <td><?=substr($v['fecha'],10)?></td>
                                        <td><a href="<?=$v['page'];?>"><?=$v['page'];?></a></td>                                        
                                        <td><a href="u/<?=$v['nombre_usaurio'];?>" title="<?=$v['nav'];?>"><?=$v['nombre_usuario'];?></a> <a title="<?=$v['nav'];?>">[Nav]</a></td>                                        
                                    </tr>
                                <?
                            }
                        }
                    ?>
                </tbody>
            </table>
    

</div>


</div>