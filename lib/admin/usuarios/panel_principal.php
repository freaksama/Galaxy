<?

    $usuarios = $c_sistema->obtenerUsuariosAdmin($datos);

    $datos = $c_sistema->obtenerDatosGenerales();

    $grafica = $c_sistema->obtenerGrafica7dias();
    
    $r = $c_sistema->obtenerGraficaAnual();
    
//    print_r($grafica2);
    
    $visi = $c_sistema->ObtenerVisitasHoy();

    $visitas = $c_sistema->obtenerVisitasIP($datos);
    
    $usuarios_online = $c_sistema->obtenerUsuariosOnline();

    $datos['fecha'] = date("Y-m-d",time());
    $paginas = $c_sistema->ObtenerVisitasFecha($datos);

    $grafica = array_reverse($grafica);
    
    $categorias  = '';
    $string_data = '';
    for($i=0;$i<count($grafica);$i++)
    {
        $categorias  .= "'".substr($grafica[$i]['fecha'],5,5)."',";
        $string_data .= "".$grafica[$i]['num_visitas'].",";
    }

    $categorias = trim($categorias,',');
    $string_data = trim($string_data,',');

    $status['A'] = 'Activo';
    $status['B'] = 'Bloqueado';
    $status['C'] = 'Cancelado';


    //print_r($visitas);
    
    #creacion de la cadena de informacion
    $string =   $r['enero'].','.
                $r['febrero'].','.
                $r['marzo'].','.
                $r['abril'].','.
                $r['mayo'].','.
                $r['junio'].','.
                $r['julio'].','.
                $r['agosto'].','.
                $r['septiembre'].','.
                $r['octubre'].','.
                $r['noviembre'].','.
                $r['diciembre'];

    $i = 0;
    if($r['enero'] > 0)     { $i++; }
    if($r['febrero'] > 0)   { $i++; }
    if($r['marzo'] > 0)     { $i++; }
    if($r['abril'] > 0)     { $i++; }
    if($r['mayo'] > 0)      { $i++; }
    if($r['junio'] > 0)     { $i++; }
    if($r['julio'] > 0)     { $i++; }
    if($r['agosto'] > 0)    { $i++; }
    if($r['septiembre'] > 0){ $i++; }
    if($r['octubre'] > 0)   { $i++; }
    if($r['noviembre'] > 0) { $i++; }
    if($r['diciembre'] > 0) { $i++; }
    

    
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
        
        
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Cambios de Perfil'
            },
            subtitle: {
                text: 'Origen: mypack.me'
            },
            xAxis: {
                categories: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
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
                data: [<?=$string;?>]
    
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
                <td>Visitas Totales</td>
                <td><span class="text-info"><?=number_format($visi['visitas']);?></span></td>
            </tr>
            <tr>
                <td>Publicaciones Enviadas</td>
                <td><span class="text-info"><a href="index.php?op=dash&op2=send"><b><?=$datos['send_post'];?></span></b></a></td>
            </tr>
            <tr>
                <td>Versi&oacute;n del sistema</td>
                <td><span class="text-info">1.15.1</span></td>
            </tr>                       
        </table>
      </div>
    </div>  

</div>














<div style="float:left;"  class="col-lg-8">

<ul class="nav nav-tabs">
    <li class="active"><a href="#gra" data-toggle="tab" aria-expanded="true"><img src="img/gra24.png" style="width:24px;" /> Visitas</a></li>
    <li class=""><a href="#usuarios" data-toggle="tab" aria-expanded="false"><img src="img/users.png" style="width:24px;"  />Usuarios</a></li>     
    <li class=""><a href="#usuarios-on" data-toggle="tab" aria-expanded="false"><img src="img/user-group-32.png" style="width:24px;"  />Online</a></li>   
    <li class=""><a href="#datos" data-toggle="tab" aria-expanded="false"><img src="img/data-32.png" style="width:24px;"  />Datos</a></li>        
    <li class=""><a href="#pagina" data-toggle="tab" aria-expanded="false"><img src="img/app.png" style="width:24px;"  />Paginas</a></li>        
</ul>

<div id="myTabContent" class="tab-content">

    <div class="tab-pane fade active in" id="gra">        
        <p>
            <div class="text-center">
                <h4>Graficas de Visitas</h4>
            </div>                
            
                <div id="container_c" style="width: 700px; height: 260px;"></div>
                <br>
                <div id="container" style="min-width: 700px; height: 260px; margin: 0 auto"></div>
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
                        <th width="60px">Detalles</th>                        
                        <th width="60px">Tema</th>
                        <th width="60px">links</th>
                        <th width="60px">Seguidores</th>
                        <th width="60px">Siguiendo</th>
                        <th width="10px">Vista</th>
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
                                            <a href="index.php?u=<?=$rec['nombre_usuario'];?>"><img src="<?=$avatar;?>" width="32" /></a>
                                        </td>
                                        <td title="">
                                            <a href="index.php?u=<?=$rec['nombre_usuario'];?>">@<?=$rec['nombre_usuario'];?></a>
                                            <br>
                                            <?=$rec['bio'];?>
                                            <br>
                                            <b><?=$rec['correo'];?></b><br>
                                             <?=$c_sistema->hace_mini($rec['fecha_ult']);?>
                                        </td>     
                                        
                                        <td>U:<?=$rec['ubicacion'];?><br>
                                            S:<?=$rec['nombre_sexo'];?>
                                        </td>
                                        <td></td>
                                        <td><?=$rec['tema'];?></td>
                                        <td><?=$rec['num_post'];?></td>
                                        <td><?=$rec['seguidores'];?></td>
                                        <td><?=$rec['siguiendo'];?></td>                        
                                        <td><?=$rec['visibilidad_default'];?></td>                        
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
    
    <div class="tab-pane fade " id="usuarios-on">
        <p>
            <div class="text-center">
                <h5>Listado de Usuarios</h5>
            </div>  
            <span>Numero de usuarios : <span class="text-info"><b><?=count($usuarios_online);?></b></span></span>          
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="20px">Avatar</th>           
                        <th width="150px">Nombre Usuario</th>                               
                        <th width="60px">Bio</th>
                        <th width="60px">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        if(count($usuarios_online)>0)
                        {
                            foreach($usuarios_online as $rec)
                            {
                               

                                ?>
                                    <tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">
                                        <td style="text-align:center;">
                                            <a href="u/<?=$rec['nombre_usuario'];?>"><img src="<?=$rec['avatar'];?>" width="32" /></a>
                                        </td>
                                        <td title="">
                                            <a href="u/<?=$rec['nombre_usuario'];?>">@<?=$rec['nombre_usuario'];?></a>
                                        </td>     
                                        <td><?=$rec['bio'];?></td>
                                        <td><?=$c_sistema->hace_mini($rec['fecha_ult']);?></td>
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
                                            <a href="index.php?sub=adm&op=blip&ip=<?=$v['ip'];?>" title="Dar click para bloquear IP"><?=$v['ip'].'['.$v['nombre_ip'].']-'.$v['des'];?>1| 
                                            <a href="http://www.elhacker.net/geolocalizacion.html?host=<?=$v['ip'];?>" class="text-danger" target="_blank">Rastrear IP</a>|
                                            <a href="index.php?sub=adm&op=seip&ip=<?=$v['ip'];?>" class="text-success" target="_blank">Paginas Vistas</a>|
                                            
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

    <div class="tab-pane fade " id="pagina">
        <p>
            <div class="text-center">
                <h5>Paginas visitadas</h5>
            </div>  

             Paginas visitadas <span class="text-info">: <b><?=count($paginas);?></b></span>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="150px">Fecha</th> 
                        <th width="500px">Url</th> 
                        <th width="150px">Usuario</th> 
                    </tr>
                </thead>
                <tbody>
                    <?
                        if(count($paginas)>0)
                        {
                            foreach($paginas as $p)
                            {

                                ?>
                                    <tr>
                                        <td><?=$p['fecha'];?></td>
                                        <td>                                            
                                            <a href="<?=$p['page'];?>" class="text-danger" target="_blank"><?=$p['page'];?></a>
                                            <br>
                                            <span style="font-size:10px;" class="text-muted"><?=$p['nav'];?></span>
                                        </td>
                                        <td>
                                            <a  href="u/<?=$p['nombre_usuario']?>">@<?=$p['nombre_usuario'];?></a><br>
                                            <a href="http://www.elhacker.net/geolocalizacion.html?host=<?=$p['ip'];?>" class="text-danger" target="_blank">[<?=$p['ip']?>]</a>
                                        </td>
                                    </tr>
                                <?
                            }
                        }
                    ?>
                </tbody>
            </table>
        </p>

    </div>



    

    

</div>


</div>