<?

    $busquedas = $c_sistema->obtenerBusquedas($datos);


    
?>
<script type="text/javascript">
    $(function(){

        

       
        


    });
</script>
<script src="rec/gra/js/highcharts.js"></script>
<script src="rec/gra/js/modules/exporting.js"></script>



<div class="col-lg-6 col-lg-offset-3"  >  

        <h2 class="text-center">Busquedas realizadas</h2>
             
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="300px">Consulta</th> 
                        <th width="100px">Num</th>                         
                    </tr>
                </thead>
                <tbody>
                    <?
                        if(count($busquedas)>0)
                        {
                            foreach($busquedas as $b)
                            {
                                ?>
                                    <tr>
                                        <td><?=$b['consulta'];?></a></td>                                        
                                        <td><?=$b['num_q'];?></td>
                                    </tr>
                                <?
                            }
                        }
                    ?>
                </tbody>
            </table>
    

</div>


</div>