<?

    $usuarios = $c_sistema->obtenerUsuariosAdmin($datos);

    $datos = $c_sistema->obtenerDatosGenerales();

    $grafica = $c_sistema->obtenerGrafica7dias();

    $visitas = $c_sistema->obtenerVisitasIP($datos);

    $grafica = array_reverse($grafica);
    
    $categorias  = '';
    $string_data = '';
    for($i=0;$i<count($grafica);$i++)
    {
        $categorias  .= "'".$grafica[$i]['fecha']."',";
        $string_data .= "".$grafica[$i]['num_visitas'].",";
    }

    $categorias = trim($categorias,',');
    $string_data = trim($string_data,',');

    $status['A'] = 'Activo';
    $status['B'] = 'Bloqueado';
    $status['C'] = 'Cancelado';


    //print_r($visitas);

    
?>
<script type="text/javascript">
    $(function(){

        <?
            if($_SESSION['m']['mensaje'] != '')
            {
                echo 'reset();';
                echo $c_sistema->show_mensaje();
                $c_sistema->borrarMensaje();
            }
        ?>

        $("#btnenviar").click(function(){
            window.location.href = "index.php?menu=ma&sub=exp&op=reg2";
        });

         $('#container_c').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Visitas Ultimos 7 dias '
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    <?=$categorias;?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'No. Visitas'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Visitas',
                data: [<?=$string_data;?>]
    
            }]
        });

        


    });
</script>
<script src="rec/gra/js/highcharts.js"></script>
<script src="rec/gra/js/modules/exporting.js"></script>


<div class="col-lg-3" style="float:left;">  
    
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3 class="panel-title">Informaci&oacute;n Generales</h3>
      </div>
      <div class="panel-body">
        <table class="table">           
            <tr>
                <td>Publicaciones</td>
                <td><span class="text-info"><?=$datos['num_con'];?></span></td>
            </tr>
            <tr>
                <td>Comentarios</td>
                <td><span class="text-info"><?=$datos['num_comm'];?></span></td>
            </tr>
            <tr>
                <td>Usuarios</td>
                <td><span class="text-info"><?=$datos['num_user'];?></span></td>
            </tr>
            <tr>
                <td>Usuarios Online</td>
                <td><span class="text-info"><?=$datos['num_online'];?></span></td>
            </tr>
            <tr>
                <td>Publicaciones Pendientes</td>
                <td><span class="text-info"><?=$datos['num_pub_pen'];?></span></td>
            </tr>
            <tr>
                <td>Versi&oacute;n del sistema</td>
                <td><span class="text-info">1.02</span></td>
            </tr>            
        </table>
      </div>
    </div>  

</div>














<div style="float:left;"  class="col-lg-8">

<ul class="nav nav-tabs">
    <li class="active"><a href="#gra" data-toggle="tab" aria-expanded="true"><img src="img/gra24.png" style="width:24px;" /> Visitas</a></li>
    <li class=""><a href="#usuarios" data-toggle="tab" aria-expanded="false"><img src="img/users.png" style="width:24px;"  />Usuarios</a></li>        
    <li class=""><a href="#datos" data-toggle="tab" aria-expanded="false"><img src="img/data-32.png" style="width:24px;"  />Datos</a></li>        
    <li class=""><a href="#page" data-toggle="tab" aria-expanded="false"><img src="img/app.png" style="width:24px;"  />Paginas</a></li>        
</ul>

<div id="myTabContent" class="tab-content">

    <div class="tab-pane fade active in" id="gra">        
        <p>
            <div class="text-center">
                <h4>Graficas de Visitas xD</h4>
            </div>                
            
                <div id="container_c" style="width: 700px; height: 400px;"></div>
        </p>
    </div>


    <div class="tab-pane fade " id="usuarios">
        <p>
            <div class="text-center">
                <h5>Listado de Usuarios</h5>
            </div>  
            <span>Numero de usuarios : <span class="text-info"><b><?=count($usuarios);?></b></span></span>          
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="20px">Detalles</th>           
                        <th width="150px">Nombre Usuario</th>                               
                        <th width="60px">Ubicaci&oacute;n</th>
                        <th width="60px">Sexo</th>
                        <th width="60px">Tema</th>
                        <th width="60px">links</th>
                        <th width="60px">Seguidores</th>
                        <th width="60px">Siguiendo</th>
                        <th width="60px">status</th>
                    </tr>
                </thead>
                <tbody>
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
                                        <td title="">
                                            <a href="index.php?u=<?=$rec['nombre_usuario'];?>">@<?=$rec['nombre_usuario'];?></a>
                                            <br>
                                            <?=$rec['bio'];?>
                                            <br>
                                            <b><?=$rec['correo'];?></b><br>
                                             <?=$c_sistema->hace_mini($rec['fecha_ult']);?>
                                        </td>     
                                        
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
                </tbody>
            </table>
        </p>    
    </div>

    <div class="tab-pane fade " id="datos">
        <p>
            <div class="text-center">
                <h5>Datos del visitas</h5>
            </div>  


            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="500px">IP</th> 
                        <th width="150px">Numero Visitas</th>                                                       
                    </tr>
                </thead>
                <tbody>
                    <?
                        if(count($visitas)>0)
                        {
                            $visitas_total  = 0;
                            foreach($visitas as $v)
                            {
                                $visitas_total += $v['num_vis'];

                                ?>
                                    <tr>
                                        <td>
                                            <a href="index.php?sub=adm&op=blip&ip=<?=$v['ip'];?>" title="Dar click para bloquear IP"><?=$v['ip'].'['.$v['nombre_ip'].']-'.$v['des'];?>1| <a href="http://www.elhacker.net/geolocalizacion.html?host=<?=$v['ip'];?>" target="_blank">Rastrear IP</a>
                                        </td>
                                        <td><?=$v['num_vis'];?></td>                                        
                                    </tr>
                                <?
                            }
                        }
                    ?>
                </tbody>
            </table>
            <span>Numero de Visitas : <span class="text-info"><b><?=$visitas_total;?></b></span></span>          

        </p>

    </div>

    

    

</div>


</div>