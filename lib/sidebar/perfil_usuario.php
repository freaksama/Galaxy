<?
?>
<div class="panel panel-default">
    <div class="panel-heading"><a href="u/<?=$reg['nombre_usuario'];?>" style="text-decoration:none"><h4><b>@<?=$reg['nombre_usuario'];?></b></h4></a></div>
        <div class="panel-body">

        <div >
        <?   
           if (file_exists("src/avatar/200/".$reg['id_usuario'].".jpg"))
           {
              $avatarg = "src/avatar/200/".$reg['id_usuario'].".jpg?op=".rand();
              ?>
                <img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;"  src="<?=$avatarg;?>" border="0" />  
              <?
           }
           else
           {
                ?><img id="avatar_big" title="Avatar del usuario" style="padding:10px;border:1px solid #CCCCCC;"  src="src/avatar/200/avatar-default-200.jpg" border="0" />   <?      
           }
          
        ?>
        
        </div>
        <br>
        
        <?=$reg['bio'];?>
        
        <br><br>
        <b>Sexo :</b> <?=$reg['nombre_sexo'];?>  <img src="img/sex.png" /> <br><br>

        <b>Ubicaci&oacute;n : </b> <?=$reg['ubicacion'];?> <img src="img/location.png" />  <br><br>

        <b>Visitas a tu perfil</b> : <?=$reg['visitas_perfil'];?><br /><br />

        <div class="panel panel-default">
            <div class="panel-heading text-center"><b>Situaci&oacute;n Sentimental </b></div>
            <div class="panel-body text-center">
                <br> <p class="lead"><?=$reg['nombre_situacion'];?> <img src="img/heart-32.png" width="32" /></p>
            </div>
        </div>

        <?
            //print_r($_SESSION);
            if($_SESSION['s']['id_usuario']!='')
            {
                ?>
                    
                        <div style="text-align:center">
                            <input type="hidden" name="txtid" id="txtid" value="<?=$reg['id_usuario'];?>" /> 
                            <input type="hidden" name="txtsiguiendo" id="txtsiguiendo" value="<?=$seg['id'];?>" />
                            <?
                                if($reg['id_usuario']!=$_SESSION['s']['id_usuario'])
                                {
                                    echo $boton_seguir;
                                }
                            ?>                    
                        </div>
                    
                <?
            }
        ?>    

        <br><br>
        
        <br><br>
        <?
            if($_SESSION['s']['id_usuario']==$reg['id_usuario'])
            {
                ?><a href="index.php?sub=cue&op=act" class="btn btn-default"><img src="img/config-16.png" /> Configurar Cuenta</a><br><?
            }
        ?>

        <div>
            <span style="font-size:20px;">Publicaciones<b class="text-info"> <?=$reg['links'];?></b></span>
        </div>

        <div>
            <span style="font-size:20px;">Seguidores        
                <b id="mseguidores">
                    <?
                         if($_SESSION['s']['id_usuario']!='')
                         {
                            ?><a href="index.php?sub=cue&op=seg&usuario=<?=$reg['nombre_usuario'];?>"><?=$reg['seguidores'];?></a><?
                         }
                         else
                        {
                            ?><?=$reg['seguidores'];?><?
                        }
                    ?>
                    
                </b>
            </span>
        </div>

        <div>
            <span style="font-size:20px;">Siguiendo        
                <b>
                    <?
                         if($_SESSION['s']['id_usuario']!='')
                         {
                            ?><a href="index.php?sub=cue&op=sig&usuario=<?=$reg['nombre_usuario'];?>"><?=$reg['sigues'];?></a><?
                         }
                         else
                        {
                            ?><?=$reg['seguidores'];?><?
                        }
                    ?>
                    
                </b>
            </span>
        </div>

            <?
                foreach ($usuarios as $u_s) 
                {
                    ?>
                        <a href="u/<?=$u_s['nombre_usuario'];?>" style="text-decoration:none;">
                            <img src="<?=$u_s['avatar'];?>" class="marco_av" style="width:32px;height:32px;margin:5px" title="@<?=$u_s['nombre_usuario'];?>" />
                        </a>                                                                
                    <?
                }
            ?>
        <hr>


    

    <br><br><br>

    
    <hr>
    <?
        if($_SESSION['s']['id_usuario'] == $reg['id_usuario'])
        {
            ?><a href="index.php?sub=cue&op=inte"><img src="img/config-16.png" /> Actualizar Intereses</a><?
        }
    ?>

    <h4>Peliculas</h4>   
    <?
        $array_peliculas = split(',', $pasatiempos['peliculas']);

        for ($i = 0 ; $i < count($array_peliculas) ; $i++) 
        { 
            $peliculas .= ' <a href="explorar/peliculas/'.urlencode(trim($array_peliculas[$i])).'">'.$array_peliculas[$i].'</a>,';
        }

        $peliculas = substr($peliculas, 0, -1);

        echo $peliculas;
    ?>
    <hr>
    <h4>M&uacute;sica</h4>   
    <?
        $array_musica = split(',', $pasatiempos['musica']);

        for ($i = 0 ; $i < count($array_musica) ; $i++) 
        { 
            $musica .= ' <a href="explorar/musica/'.urlencode(trim($array_musica[$i])).'">'.$array_musica[$i].'</a>,';
        }

        $musica = substr($musica, 0, -1);

        echo $musica;
    ?>
    <hr>
    <h4>Videojuegos</h4>   
    <?
        $array_juegos = split(',', $pasatiempos['videojuegos']);

        for ($i = 0 ; $i < count($array_juegos) ; $i++) 
        { 
            $juegos .= ' <a href="explorar/juegos/'.urlencode(trim($array_juegos[$i])).'">'.$array_juegos[$i].'</a>,';
        }

        $juegos = substr($juegos, 0, -1);

        echo $juegos;
    ?>
    <hr>
    <h4>Libros</h4>   
    <?
        $array_libros = split(',', $pasatiempos['libros']);

        for ($i = 0 ; $i < count($array_libros) ; $i++) 
        { 
            $libros .= ' <a href="explorar/libros/'.urlencode(trim($array_libros[$i])).'">'.$array_libros[$i].'</a>,';
        }

        $libros = substr($libros, 0, -1);

        echo $libros;
    ?>
    <hr>
    <h4>Otros Intereses</h4>   
    <?
        $array_otro = split(',', $pasatiempos['otros']);

        for ($i = 0 ; $i < count($array_otro) ; $i++) 
        { 
            $otro .= ' <a href="explorar/otros/'.urlencode(trim($array_otro[$i])).'">'.$array_otro[$i].'</a>,';
        }

        $otro = substr($otro, 0, -1);

        echo $otro;
    ?>


    </div>
</div>