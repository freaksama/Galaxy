<?
    if(!$movil)
    {
        
        $user_seguir     = $c_sistema->listadoUsuariosParaSeguir();            
        $usuarios_online = $c_sistema->obtenerUsuariosOnline();
        $categorias      = $c_sistema->obtenerCategorias();
        $dash            = $c_sistema->obtenerDatosDashboardUsuario();
        $usuario         = $c_sistema->obtenerPerfilUSuario(); 

        //print_r($usuario);
    }


?>

<div class="panel panel-default">                
    <div class="panel-body">

        <a href="u/<?=$_SESSION['s']['nombre_usuario'];?>" class=" f14" >
            <img id="avatar_p" class="profile-pic animated" src="<?=$_SESSION['s']['avatar'];?>" />
        </a>

        <br><br>
        <b class="f14"><?=$usuario['nombre'];?></b> 
            <a href="u/<?=$_SESSION['s']['nombre_usuario'];?>" >
                @<?=$_SESSION['s']['nombre_usuario'];?>
        </a>
        

        <p><?=$usuario['bio'];?></p>
        <b>Sexo :</b> <?=$usuario['nombre_sexo'];?>  <img src="img/sex.png" /> <br>
        <b>Ubicaci&oacute;n : </b> <?=$usuario['ubicacion'];?> <img src="img/location.png" />  <br><br>
        <b>Situaci&oacute;n Sentimental :</b> <?=$usuario['nombre_situacion'];?> <br><br>
                
                    


       
        <br>
            <a href="index.php?sub=cue&op=act"><img src="img/config-16.png" /> Configurar perfil</a><br>                        
        <br>
        <br>        
        <a href="index.php?sub=cue&op=sig&usuario=<?=$_SESSION['s']['nombre_usuario'];?>" class="f14">Siguiendo <span style="float:right" class=""></span></a><br />
        <a href="index.php?sub=cue&op=seg&usuario=<?=$_SESSION['s']['nombre_usuario'];?>" class="f14">Seguidores <span style="float:right" class=""></span></a><br />
        <a href="dashboard/liked" class="f14">Me gusta  <span style="float:right" class=""></span></a><br />
        <br>
        <hr class="whiter" />         
        <h4 class="text-center">Visita Tambi&eacute;n </h4>

        
        
        <a href="all" ><img src="img/all-48.png"  style="width:32px;margin:8px" />Todo con Todo</a><br>
        <a href="live"><img src="img/tv-32.png" style="width:32px;margin:8px" width="24" />  Live  </a><br>
        <a href="list/rss"><img src="img/rss-32.png" style="width:32px;margin:8px" width="24"  />RSS</a><br>
        <a href="comentarios"><img src="img/chat2.png" style="width:32px;margin:8px" width="24" />Comentarios</a><br>
        <a href="tags" ><img src="img/tags-32.png" style="width:32px;margin:8px"  width="24" />Hashtags</a>
                        
        <input type="text" id="txtinvitacion" name="txtinvitacion" class="form-control input-sm mb" placeholder="Email de amigo" />

        <div style="float:right">
            <a id="lk_invitar_amigo" href="javascript:void(0)" class="btn btn-default btn-sm">Invitar Amigo  ;)</a>
        </div>
        <br>
        
        <hr class="whiter" />

        <input type="checkbox" name="ck_perm_nfsw" id="ck_perm_nfsw" <?if($_SESSION['s']['per_nsfw']=='S'){echo 'checked ';} ?> >
        <span id="lb-nfsw" class="text-danger" title="Publicaci&oacute;n no apta para ver en la escuela o trabajo">Ver NFSW</span-->
        
        
        <hr class="whiter" />

        <div style="text-align:center">
            <b>Usuarios a seguir</b>
        </div>
        
        <?
            if(count($user_seguir) > 0)
            {
                
                foreach($user_seguir as $user)
                {
                    ?>
                        <div id="v_user<?=$user['id_usuario'];?>" style="padding-bottom:5px;">
                            <div style="float:right">
                                <a  id="btn_seguir_<?=$user['id_usuario'];?>"  data-id-usuario="<?=$user['id_usuario'];?>" class="btn_seguir btn btn-default btn-sm" style="padding: 4px 6px;">
                                    <img src="img/adduser.png"  width="16" />
                                    Seguir
                                </a>
                            </div>

                            <div style="float:left;">
                                <a href="u/<?=$user['nombre_usuario'];?>" title="<?=$user['bio'];?>">
                                    <img src="<?=$user['avatar'];?>" style="width:22px;" />
                                </a>
                            </div>
                            <a href="u/<?=$user['nombre_usuario'];?>" title="<?=$user['bio'];?>" style="padding:1px;" class="f12">
                                @<?=$user['nombre_usuario'];?>  
                            </a>
                            <span class="text-muted f11"><?=$user['bio'];?></span>                            
                        </div>

                        <br><br>


                    <?
                }

            }
        ?>
        
        <h4 class="text-center"><a href="index.php?op=usuarios">Mas usuarios a seguir</a></h4>

        <hr class="whiter" />
           

        
        



         <h4 class="text-center">Usuarios Online ;) </h4>    
            <?
            if(count($usuarios_online)>0)
            {
                foreach($usuarios_online as $rec)
                {
                   

                    ?>
                            <div style="float:left;">
                                <a href="u/<?=$rec['nombre_usuario'];?>" title="<?=$rec['bio'];?>">
                                    <img src="<?=$rec['avatar'];?>" class="w32"  />
                                </a>
                            </div>
                            <a href="u/<?=$rec['nombre_usuario'];?>" title="<?=$rec['bio'];?>" style="padding:1px;" class="f12">
                                @<?=$rec['nombre_usuario'];?>  
                            </a>
                            <img src="img/online.png" />
                            <span class="text-muted f11"><?=$rec['bio'];?></span>
                            <br>
                        <hr class="whiter" />

                        <!--tr id="tr<?=$rec['id_link'];?>" class="g_<?=$rec['id_grupo'];?> grupos">
                            <td style="text-align:center;">
                                <a href="u/<?=$rec['nombre_usuario'];?>"><img src="<?=$rec['avatar'];?>" width="32" /></a>
                            </td>
                            <td title="">
                                <a href="u/<?=$rec['nombre_usuario'];?>">@<?=$rec['nombre_usuario'];?></a>
                            </td>     
                            <td><?=$rec['bio'];?></td>
                            <td><?=$c_sistema->hace_mini($rec['fecha_ult']);?></td>
                        </tr-->
                    <?
                }
            }
        ?>



         
            <div class="text-center">
                <h3>Mas Categor&iacute;as </h3>
            </div>


            <div class="text-center" >
            <?
                foreach ($categorias as $c_c) 
                {
                    ?>
                        <a href="cat/<?=$c_c['codigo_categoria'];?>" style="text-decoration:none;">
                            <img class="profile-pic animated w48 mb5" src="<?=$c_c['img'];?>" style="height:48px;" title="<?=$c_c['nombre_categoria'];?>" />
                        </a>                                                                
                    <?
                }
            ?>
            </div>
            <hr class="whiter" />
            

        

    </div>
</div>