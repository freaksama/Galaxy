<?php
	session_start();
	//header("Content-Type: text/html;charset=ISO-8859-1");
	include('../config/conexion.php');       
	include('../lib/clases/classSistema.php');  	
	include('../lib/controladores/c_sistema.php');
	date_default_timezone_set('America/Chihuahua'); 

	ini_set('default_charset','iso-8859-1');
	ini_set('mbstring.internal_encoding', 'iso-8859-1');
	ini_set('mbstring.http_output', 'iso-8859-1');
	ini_set('mbstring.encoding_translation', 'On');
	ini_set('mbstring.func_overload', '6');
	  
	  $db           = new MySQL();  
	  $c_sistema    = new sistema_controlador($db);
		
	if($_POST['opcion']=='load_con_gen')	
	{
		$resultado = $c_sistema->cargarContenidoNotificacionsMensajes($_POST);
		
		$notificaciones 	= $resultado['notificaciones'];		
		$mensajes_inbox 	= $resultado['mensajes_inbox'];
		
		$resultado['notificaciones'] 	= $notificaciones;
		$resultado['mensajes'] 			= $mensajes;
		$resultado['mensajes_inbox'] 	= $mensajes_inbox;
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='load_con_ant')
	{
		$resultado = $c_sistema->cargarConversacionAnterior($_POST);

		if(count($resultado) > 0)
		{
			$data = array();
			foreach($resultado as $m)
			{
				$m['mensaje'] = utf8_encode($m['mensaje']);
				$m['src_mini']= str_replace('src/men/img', 'src/men/256', $m['src']);
				$data[] = $m;
			}

			$resultado = $data;
		}

		echo json_encode($resultado);
	}

	if($_POST['opcion'] == 'load_chat_user')
	{
		$resultado = $c_sistema->cargarConversacionAnteriorUsuario($_POST);
		$data = array();
		array_reverse($resultado);
		foreach($resultado as $rec)
		{	

			$rec['fecha_envio_mini'] = $c_sistema->hace($rec['fecha_envio']);

			$rec['src_mini'] = '';
			if($rec['src'] != '')
			{
				$rec['src_mini'] = str_replace('/img/', '/64/', $rec['src']);
			}
                        $rec['mensaje'] = utf8_encode($rec['mensaje']);  
			$data[] = $rec;
                        
		}
		echo json_encode($data);

	}

	if($_POST['opcion'] == 'marchar_mensaje_visto_usuario')
	{
		$resultado = $c_sistema->marcarVistoInbox($_POST);
		echo json_encode($resultado);	
	}



	if($_POST['opcion']=='per_nsfw')
	{
		//$datos['per_nsfw']  = 'S';
		$resultado = $c_sistema->permitirNSFW($_POST);				
		echo json_encode($resultado);
	}

	if($_POST['opcion'] == 'ignorarPregunta')
        {
               $resultado = $c_sistema->ignorarPregunta($_POST);
               echo json_encode($resultado);
         }

	if($_POST['opcion']=='regPreg')
	{
		$resultado = $c_sistema->registrarRespuesta($_POST);				
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='load_link')
	{
		$resultado = $c_sistema->cargarLinkGrupo($_POST);
		if(count($resultado)>0)
		{
			
			foreach($resultado as $rec)				
			{
				$rec['nombre'] = utf8_encode($rec['nombre']);
				$rec['descripcion'] = utf8_encode($rec['descripcion']);
				$data[] = $rec;
			}
			$resultado = $data;
			
		}

		echo json_encode($resultado);
	}

	

	if($_POST['opcion']=='new_grupo')
	{
		$resultado = $c_sistema->registrarGrupoAjax($_POST);
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='act_grupo')
	{
		$resultado = $c_sistema->actualizarGrupoAjax($_POST);
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='del_grupo')
	{
		$resultado = $c_sistema->eliminarGrupoAjax($_POST);
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='new_link')
	{
		$resultado = $c_sistema->registrarLinkAjax($_POST);
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='act_link')
	{
		$resultado = $c_sistema->actualizarLinkAjax($_POST);
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='del_link')
	{
		$resultado = $c_sistema->eliminarLinkAjax($_POST);
		echo json_encode($resultado);
	}

	

	

	

	if($_POST['opcion']=='registrarClickLink')
	{
		$resultado = $c_sistema->registrarClickLink($_POST);
		echo json_encode($resultado);
	}

	if($_POST['opcion']=='eliminarLink')
	{
		$resultado = $c_sistema->eliminarLinkAjax($_POST);
		echo json_encode($resultado);			
	}

	if($_POST['opcion']=='regLinks')
	{
		//header("Content-type: text/html; charset=iso-8859-1"); 
		$resultado = $c_sistema->registrarContenidoAjax($_POST);
		echo json_encode($resultado);			
	}

	if($_POST['opcion']=='ActLinks')
	{
		$resultado = $c_sistema->ActualizarLinkAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='regInfoInicio')
	{
		$resultado = $c_sistema->actualizarInfoInicio($_POST);
		echo json_encode($resultado);	
	}

	

	// BLOQUE DE COMENTARIOS 
	if($_POST['opcion']=='regCom')
	{
		$resultado = $c_sistema->registrarComentarioAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='delCom')
	{
		$resultado = $c_sistema->eliminarComentarioAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='load_amigos_chat')
	{
		$datos['id_usuario']  = $_SESSION['s']['id_usuario'];  
		$resultado = $c_sistema->obtenerAmigosConver($datos);
		echo json_encode($resultado);	
	}	

	// Registro de mensajes por ajax
	if($_POST['opcion']=='regmens')
	{
		$resultado = $c_sistema->registrarMensajeAjax($_POST);
		echo json_encode($resultado);	
	}

	// Eliminacion de mensaje por ajax
	if($_POST['opcion']=='delmens')
	{
		$resultado = $c_sistema->eliminarMensajeAjax($_POST);
		echo json_encode($resultado);	
	}


	



	// Registro de mensajes por ajax
	if($_POST['opcion']=='loadCom')
	{
		$resultado = $c_sistema->cargarComentariosAjax($_POST);
		if(count($resultado) > 0)
		{
			$data;
			foreach ($resultado as $rec) 
			{
				$rec['comentario'] = utf8_encode($rec['comentario']);
				$rec['fecha'] = $c_sistema->hace_mini($rec['fecha']);
				$data[] = $rec;
			}
			$resultado = $data;
		}
		echo json_encode($resultado);	
	}

	

	// Registro de mensajes por ajax
	if($_POST['opcion']=='cargmens')
	{
		
		$data = array();
		$resultado = $c_sistema->cargarMensajesConversacionAjax($_POST);
		if(count($resultado)>0)
		{
			
			foreach($resultado as $rec)				
			{
				$rec['mensaje'] = utf8_encode($rec['mensaje']);
			}
			$data[] = $rec;
		}
		echo json_encode($data);	
	}

	if($_POST['opcion']=='marcarleidosmens')
	{
		$resultado = $c_sistema->marcarMensajesLeidosConversacionAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='delconver')
	{		
		$resultado = $c_sistema->eliminarConversacionAjax($_POST);		
		echo json_encode($resultado);			
	}
	
	if($_POST['opcion']=='load_not_mens')
	{
		$resultado = $c_sistema->cargarMensajesPendientesAjax($_POST);
		if(count($resultado) > 0)
		{
			$r =  array();
			//$resultado = array_reverse($resultado);
			foreach($resultado as $rec)
			{
				$rec['avatar'] = 'src/avatar/user.png';
			    if (file_exists("../src/avatar/48/".$rec['id_usuario'].".jpg"))
			    {
				   $rec['avatar'] ='src/avatar/48/'.$rec['id_usuario'].'.jpg?op='.rand(); 											  
			    }
			    $rec['mensaje'] = utf8_encode($rec['mensaje']);
			    $rec['fecha'] = $c_sistema->hace_mini($rec['fecha']);

			    $r[] = $rec;
			}
			echo json_encode($r);	
		}
		else
		{
			echo json_encode($resultado);		
		}
		
	}

	#Marca el mensaje como visto
	if($_POST['opcion']=='ms_visto_dash')
	{		
		$resultado = $c_sistema->marcarVistoMensajesAjax($_POST);		
		echo json_encode($resultado);			
	}

	#Marca el mensaje como visto
	if($_POST['opcion']=='regmenmini')
	{	
		$resultado = $c_sistema->registrarMensajeMiniAjax($_POST,$_FILES);		
		echo json_encode($resultado);			
	}

	

	

	if($_POST['opcion']=='validarNombreUsuario')
	{
		$resultado = $c_sistema->validarNombreUsuarioAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='validarCorreoUsuario')
	{
		$resultado = $c_sistema->validarCorreoUsuarioAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='reglike')
	{
		$resultado = $c_sistema->registrarLikeAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='seguir_usuario')
	{
		$resultado = $c_sistema->seguirUsuarioAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='dejar_seguir_usuario')
	{
		$resultado = $c_sistema->dejarSeguirUsuarioAjax($_POST);
		echo json_encode($resultado);	
	}


	if($_POST['opcion']=='bloquearUsuario')
	{
		$resultado = $c_sistema->bloquearUsuarioAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='desbloquearUsuario')
	{
		$resultado = $c_sistema->desBloquearUsuarioAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='repLink')
	{
		$resultado = $c_sistema->reportarLinkAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='actRepLink')
	{
		$resultado = $c_sistema->actualizarReporteLinkAjax($_POST);
		echo json_encode($resultado);	
	}
	
	if($_POST['opcion']=='regGrupo')
	{
		$resultado = $c_sistema->registrarGrupoAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='delCon')
	{
		$resultado = $c_sistema->eliminarContenidoAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='pubCon')
	{
		$resultado = $c_sistema->publicarContenidoAjax($_POST);
		echo json_encode($resultado);		
	}

	if($_POST['opcion']=='priCon')
	{
		$resultado = $c_sistema->privarContenidoAjax($_POST);
		echo json_encode($resultado);		
	}
	
	if($_POST['opcion']=='regcontenido')
	{
		print_r($_POST);
		$resultado = $c_sistema->registrarContenidoAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='com_con')
	{
		$resultado = $c_sistema->compartirContenidoAjax($_POST);
		echo json_encode($resultado);	
	}

	

	if($_POST['opcion']=='loadContenido')
	{
       $_POST['id_categoria'] = $_POST['cat'];
		$result = $c_sistema->listadoContenidoGeneral($_POST);
		$resultado = $result['datos'];
    	$paginacion = $result['paginador'];

		header("Content-Type: text/html;charset=ISO-8859-1");
		
	    if(count($resultado)>0)
	    {
	    	$vista['P']['nombre']   = 'P&uacute;blico';
		    $vista['P']['img']      = 'img/globe-20.png';
		    $vista['R']['nombre']   = 'Usuarios Registrados';
		    $vista['R']['img']      = 'img/user-group-20.png';
		    $vista['S']['nombre']   = 'Seguidores';
		    $vista['S']['img']      = 'img/users.png';
		    $vista['O']['nombre']   = 'Privado';
		    $vista['O']['img']      = 'img/lock.png';

			$vista_default['nombre'] = $vista[$_SESSION['s']['vis_def']]['nombre'];
			$vista_default['img']    = $vista[$_SESSION['s']['vis_def']]['img'];
			$vista_default['valor']  = $_SESSION['s']['vis_def'];
			
	    	/*switch ($_SESSION['s']['tipo_dash']) 
	        {
	            case '1': $dash_url = '../lib/general/contenido_general3.php'; break;
	            case '2': $dash_url = '../lib/general/contenido_mini.php'; break;
	            
	            default : $dash_url = '../lib/general/contenido_general3.php'; break;
	        }*/

	        if($_POST['op2']=='ofi')
            {                
                $dash_url = '../lib/general/contenido_oficina.php';	
            }
            else
            {
                $dash_url = '../lib/general/publicacion.php';	
            }

	        //$dash_url = '../lib/general/contenido_general_minimal.php';	

	        foreach($resultado as $rec)
	        {
	            include($dash_url);
	        }
	    }

	    else
	    {
	    	echo '0';
	    }
	  
		//echo json_encode($resultado);	
	}// fin de cargar contenido


	if($_POST['opcion']=='load_publicaciones')
	{
        $_POST['id_categoria'] = $_POST['cat'];

        //$datos['multimedia'] = 'N';
	    if($_POST['op3']=='super')
	    {
	        $result  = $c_sistema->listadoContenidoGeneralSuperRandom($_POST);    
	    }
	    else
	    {
	        $result  = $c_sistema->listadoContenidoGeneral($_POST);
	    }
		//$result = $c_sistema->listadoContenidoGeneral($_POST);

		$resultado = $result['datos'];
    	$paginacion = $result['paginador'];


    	$data = array();
    	$post = array();

    	$tmp['id_tipo_comentario'] = 1;
    	if(count($resultado)>0)
	    {
			foreach($resultado as $rec)
			{
				// buscar comentarios 
				$tmp['id_ref'] = $rec['id_contenido'];
	            $com =  $c_sistema->listadoUltComentariosDash($tmp);
	            $com = array_reverse($com);


	            $num_com = $c_sistema->ContarComentariosDash($temp);
	            $rec['num_com'] = $num_com['num_comentarios'];

	            //se agrega el id_usuario session
	            $rec['id_usuario_session'] 		= $_SESSION['s']['id_usuario'];
	            $rec['nombre_usuario_session']	= $_SESSION['s']['nombre_usuario'];
	            $rec['id_tipo_usuario'] 		= $_SESSION['s']['tipo_usuario'];
	            $rec['avatar_session'] 			= $_SESSION['s']['avatar'];

	            //se agrega el codigo de los videos de youtube
	            $rec['video'] = $c_sistema->obtener_video_post($rec);

	            //se agrega el codigo de la imagen 
	            $rec['img']    = $c_sistema->obtener_imagen_post($rec);

	            //se agrega el codigo de la imagen 
	            $rec['mp3']    = $c_sistema->obtener_mp3_post($rec);

	            // FECHA MINI
	            $rec['fecha_mini'] = $c_sistema->hace_mini($rec['fecha_p']);

	            // Generacion de tags
	            $rec['descripcion'] = preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']);

	            $rec['des'] 		= $rec['descripcion'];
	            $rec['descripcion'] = $c_sistema->generar_tags($rec['descripcion']);
	            



	            $post['post'] = $rec;
	            $post['come'] = $com;

	            $data[] = $post;
			}
		}

		header("Content-Type: text/html;charset=ISO-8859-1");
		echo json_encode($data);	
	}// fin de cargar contenido

	

	if($_POST['opcion']=='regImgMeme')
	{
		$resultado = $c_sistema->registrarMemeAjax($_POST,$_FILES);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='loadmemes')
	{
		$resultado = $c_sistema->listadoMemes($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='regcon')
	{
		//print_r($_POST);
		//print_r($_FILES);
		
		$tmp = $c_sistema->registrarContenidoAjax($_POST,$_FILES);
		$r['id_contenido'] = $tmp['id'];
		$rec = $c_sistema->obtenerContenidoGeneral($r);

		//print_r($r);

		if(count($rec)>0)
	    {
		    $vista['P']['nombre']   = 'P&uacute;blico';
		    $vista['P']['img']      = 'img/globe-20.png';
		    $vista['R']['nombre']   = 'Usuarios Registrados';
		    $vista['R']['img']      = 'img/user-group-20.png';
		    $vista['S']['nombre']   = 'Seguidores';
		    $vista['S']['img']      = 'img/users.png';
		    $vista['O']['nombre']   = 'Privado';
		    $vista['O']['img']      = 'img/lock.png';

			$vista_default['nombre'] = $vista[$_SESSION['s']['vis_def']]['nombre'];
			$vista_default['img']    = $vista[$_SESSION['s']['vis_def']]['img'];
			$vista_default['valor']  = $_SESSION['s']['vis_def'];

	      	header("Content-Type: text/html;charset=ISO-8859-1");
	      	/*switch ($_SESSION['s']['tipo_dash']) 
	        {
	            case '1': $dash_url = '../lib/general/contenido_general3.php'; break;
	            case '2': $dash_url = '../lib/general/contenido_mini.php'; break;
	            case '3': 
	            default : $dash_url = '../lib/general/contenido_general3.php'; break;
	        }*/

	        $dash_url = '../lib/general/publicacion.php'; 
	        
	        include($dash_url);
	        
	     	//include("../lib/general/contenido_general.php");
	      	
	    }


	}

	if($_POST['opcion']=='reg_categorian')
	{
		$resultado = $c_sistema->registrarCategoria($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='act_categorian')
	{
		$resultado = $c_sistema->actualizarCategoria($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='del_categorian')
	{
		$resultado = $c_sistema->eliminarCategoria($_POST);
		echo json_encode($resultado);	
	}


	if($_POST['opcion']=='reg_frase')
	{
		$resultado = $c_sistema->registrarFraseAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='act_frase')
	{
		$resultado = $c_sistema->actualizarFraseAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='del_frase')
	{
		$resultado = $c_sistema->eliminarFraseAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='cam_dash')
	{
		$resultado = $c_sistema->cambiarDashAjax($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='regMenGlo')
	{
		$resultado = $c_sistema->registrarMensajeGlobal($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='enviar_invitacion')
	{
		$resultado = $c_sistema->registrarInvitacionAjax($_POST);
		echo json_encode($resultado);	
	}


	if($_POST['opcion']=='load_emojis')
	{
		$bloque = $_POST['bloque'];

		$data = array();

		switch ($bloque) 
		{
			case '1':
					
                    for($i = 0;$i <= 188;$i++)
                    {
                        $tmp['emoji'] = '<a href="javascript:void(0)" class="emoji" style="margin:3px;"><img class="em" src="img/svg/'.$i.'.svg" /></a>';
                        $data[] = $tmp;
                    }

			break;

			case '2':
					
                    for($i = 189;$i <= 305;$i++)
                    {
                        $tmp['emoji'] = '<a href="javascript:void(0)" class="emoji" style="margin:3px;"><img class="em" src="img/svg/'.$i.'.svg" /></a>';
                        $data[] = $tmp;
                    }

			break;

			case '3':
					
                    for($i = 306;$i <= 535;$i++)
                    {
                        $tmp['emoji'] = '<a href="javascript:void(0)" class="emoji" style="margin:3px;"><img class="em" src="img/svg/'.$i.'.svg" /></a>';
                        $data[] = $tmp;
                    }

			break;


			case '4':
					
                    for($i = 536;$i <= 636;$i++)
                    {
                        $tmp['emoji'] = '<a href="javascript:void(0)" class="emoji" style="margin:3px;"><img class="em" src="img/svg/'.$i.'.svg" /></a>';
                        $data[] = $tmp;
                    }

			break;	

			case '5':
					
                    for($i = 636;$i <= 844;$i++)
                    {
                        $tmp['emoji'] = '<a href="javascript:void(0)" class="emoji" style="margin:3px;"><img class="em" src="img/svg/'.$i.'.svg" /></a>';
                        $data[] = $tmp;
                    }

			break;			
		}

		echo json_encode($data);
	}


	if($_POST['opcion']=='reg_visi_pub')
	{
		$resultado = $c_sistema->registrarVisitaPublicidad($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='marcar_notificacion_vistas')
	{
		$datos['id_ult_not'] = $_POST['id_last_notifi'];
		$datos['id_usuario'] = $_SESSION['s']['id_usuario'];

		$_SESSION['s']['id_last_n'] = $datos['id_ult_not'];

		$resultado = $c_sistema->actualizarUltNotificacion($datos);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=='reg_tablero')
	{
		$resultado = $c_sistema->registrarTablero($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion']=="add_pub_tab")
	{
		$resultado = $c_sistema->agregarContenidoTablero($_POST);
		echo json_encode($resultado);		
	}

	if($_POST['opcion']=="del_pub_tab")
	{
		$resultado = $c_sistema->eliminarContenidoTablero($_POST);
		echo json_encode($resultado);		
	}


	

	if($_POST['opcion'] == 'borrar_tab')
	{
		$resultado = $c_sistema->eliminarTablero($_POST);
		echo json_encode($resultado);			
	}

	if($_POST['opcion'] == 'edit_tablero')
	{
		$resultado = $c_sistema->actualizarTablero($_POST);
		echo json_encode($resultado);			
	}

	if($_POST['opcion'] == 'act_pass_ser')
	{
		$resultado = $c_sistema->actualizarPassAdmin($_POST);
		echo json_encode($resultado);			
	}

	if($_POST['opcion'] == 'reg_usu_fun')
	{
		$resultado = $c_sistema->actualizarUsuarioFundador();
		echo json_encode($resultado);			
	}

	if($_POST['opcion'] == 'env_cor_inv_fun')
	{
		$resultado = $c_sistema->enviarCorreoInvitacionFundador($_POST);
		echo json_encode($resultado);	
	}


	if($_POST['opcion'] == 'mar_con_adu')
	{
		$resultado = $c_sistema->MarcarContenidoAdulto($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion'] == 'reg_inbox')
	{
		$resultado = $c_sistema->registrarInbox($_POST,$_FILES);
		echo json_encode($resultado);	
	}

	if($_POST['opcion'] == 'marcar_inbox_visto')
	{
		$resultado = $c_sistema->marcarVistoInbox($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion'] == 'eliminar_inbox')
	{
		$resultado = $c_sistema->eliminarInbox($_POST);
		echo json_encode($resultado);	
	}

	

	if($_POST['opcion'] == 'load_inbox_page')
	{
		$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
		$datos['page']		 = $_POST['page'];

		$resultado = $c_sistema->listadoInboxGeneral($datos);
		$data = array();
		foreach($resultado as $rec)
		{	
			
			if($rec['status_m'] == 'V')
			{
				$rec['mensaje_mini'] = '<span class="text-muted">'.substr($rec['mensaje'],0,100).'</span>';
			}
			else
			{
				$rec['mensaje_mini'] = '<span><b>'.substr($rec['mensaje'],0,100).'</b></span> <img src="img/nuevo2.gif" />';
			}

			if($movil)
			{
				$rec['link'] = 'href="index.php?sub=inb&op=ver&inbox='.$rec['id_inbox'];
			}
			else
			{
				$rec['link'] = "javascript:void(0)";
			}

			$rec['fecha_envio_mini'] = $c_sistema->hace($rec['fecha_envio']);

			$rec['src_mini'] = '';
			if($rec['src'] != '')
			{
				$rec['src_mini'] = str_replace('/img/', '/64/', $rec['src']);
			}
			$data[] = $rec;
		}
		echo json_encode($data);	
	}

	if($_POST['opcion'] == 'load_inbox_enviados_page')
	{
		$datos['id_usuario'] = $_SESSION['s']['id_usuario'];
		$datos['page']		 = $_POST['page'];

		$resultado = $c_sistema->listadoInboxEnviadosGeneral($datos);
		$data = array();
		foreach($resultado as $rec)
		{	
			
			if($rec['status_m'] == 'V')
			{
				$rec['mensaje_mini'] = '<span class="text-muted">'.substr($rec['mensaje'],0,100).'</span>';
			}
			else
			{
				$rec['mensaje_mini'] = '<span><b>'.substr($rec['mensaje'],0,100).'</b></span> <img src="img/nuevo2.gif" />';
			}

			if($movil)
			{
				$rec['link'] = 'href="index.php?sub=inb&op=ver&inbox='.$rec['id_inbox'];
			}
			else
			{
				$rec['link'] = "javascript:void(0)";
			}

			$rec['fecha_envio_mini'] = $c_sistema->hace($rec['fecha_envio']);

			$rec['src_mini'] = '';
			if($rec['src'] != '')
			{
				$rec['src_mini'] = str_replace('/img/', '/64/', $rec['src']);
			}
			$data[] = $rec;
		}
		echo json_encode($data);	
	}

	
	if($_POST['opcion'] == 'load_inbox')
	{
		$datos['id_usuario'] 	= $_SESSION['s']['id_usuario'];		
		$datos['id_max']		= $_POST['id_max'];
		$resultado = $c_sistema->listadoInboxSinLeer($datos);
		$data = array();
		array_reverse($resultado);
		foreach($resultado as $rec)
		{	

			$rec['fecha_envio_mini'] = $c_sistema->hace($rec['fecha_envio']);

			$rec['src_mini'] = '';
			if($rec['src'] != '')
			{
				$rec['src_mini'] = str_replace('/img/', '/64/', $rec['src']);
			}
			$data[] = $rec;
		}
		echo json_encode($data);
	}


	if($_POST['opcion'] == 'act_img_like')
	{
		$resultado = $c_sistema->actualizarImgLike($_POST);
		echo json_encode($resultado);	
	}

	if($_POST['opcion'] == 'login_facebook')
	{
		$_POST['tipo_login'] 	= 'facebook';

		//print_r($_POST);
		$resultado = $c_sistema->loginExterno($_POST);
		echo json_encode($resultado);	
	}


	
	if($_POST['opcion']=='cambiar_fondo_web')
	{
		$resultado = $c_sistema->registrarFondoWeb2($_POST);
		echo json_encode($resultado);	
	}


	if($_POST['opcion'] == 'act_img_ava')
	{
		$resultado = $c_sistema->actualizarAvatarPredeterminadoUsuario($_POST);
		echo json_encode($resultado);		
	}

	

	

	

	

		

	



	


	



	

	
	


	


	


	


	

	


	

	

	
	

	

	
	

	

	

	

	


	

	

	
?>