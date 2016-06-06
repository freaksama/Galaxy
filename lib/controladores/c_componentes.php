<?

	switch ($_GET['sub'])
	{			
		case 'link':
			switch ($_GET['op'])
			{
				case 'reg'	:	include('lib/general/links/frm_registrar_links.php'); 				break;
				case 'act'	:	include('lib/general/links/frm_actualizar_links.php'); 				break;
				case 'lis'	:	include('lib/general/links/listado_links.php');					break;	
		        case 'lisp'	:	include('lib/general/explorar.php');						break;
                case 'det'	:	include('lib/general/links/detalles_link.php'); 				break;
		        case 'lisi'	:	include('lib/general/links/listado_imagenes.php');				break;	
                case 'lisc'	:	include('lib/general/links/listado_chistes.php');				break;				
			}
		break;
		
		case 'img':
			switch($_GET['op'])
			{
				case 'reg'	: 	include('lib/general/imagenes/frm_registrar_publicacion.php');			break;					
				case 'reg3'	: 	include('lib/general/imagenes/frm_registrar_publicacion_movil.php');	break;	                
			}
		break;

		case 'vid':
			switch($_GET['op'])
			{
				case 'reg'	: 	include('lib/general/videos/frm_registrar_video.php');				break;	
				case 'lis'	: 	include('lib/general/videos/listado_videos.php');					break;
			}
		break;

		case 'inb':
			switch ($_GET['op'])
			{	
				case 'lis'	:	include('lib/general/inbox/listado_inbox.php');						break;
				case 'env'	:	include('lib/general/inbox/listado_enviados.php');					break;
				case 'ver'	:	include('lib/general/inbox/detalles_inbox.php');					break;
				case 'reg'	:	include('lib/general/inbox/frm_registrar_mensaje.php');				break;
				
			}
		break;



		case 'gpo':
			switch ($_GET['op'])
			{
				case 'reg'	:	include('lib/general/grupos/frm_registrar_grupo.php'); 				break;
				case 'act'	:	include('lib/general/grupos/frm_actualizar_grupo.php'); 			break;
				case 'lis'	:	include('lib/general/grupos/listado_grupos.php');				break;				
			}
		break;

		case 'pen':
			switch ($_GET['op'])
			{
				case 'reg'	:	include('lib/general/pendientes/frm_registrar_pendientes.php'); 		break;
				case 'act'	:	include('lib/general/pendientes/frm_actualizar_pendientes.php'); 		break;
				case 'lis'	:	include('lib/general/pendientes/listado_pendientes.php');			break;				
				case 'lisa'	:	include('lib/general/pendientes/listado_pendientes_atendidas.php');		break;
			}
		break;

		case 'cod':
			switch ($_GET['op'])
			{
				case 'reg'	:	include('lib/general/codigos/frm_registrar_codigo.php'); 			break;
				case 'act'	:	include('lib/general/codigos/frm_actualizar_codigo.php'); 			break;
				case 'lis'	:	include('lib/general/codigos/listado_codigos.php');					break;				
				case 'lisa'	:	include('lib/general/codigos/listado_pendientes_atendidas.php');	break;
			}
		break;

		# FUNDADORES 
		case 'fun':
			switch ($_GET['op'])
			{
				case 'info'	:	include('lib/general/fundadores/informacion.php'); 					break;
				case 'panel':   include('lib/general/fundadores/panel.php'); 						break;
				case 'esta'	:	include('lib/general/fundadores/estadisticas.php'); 				break;
				case 'user'	:	include('lib/general/fundadores/usuarios.php');						break;				
				case 'gana'	:	include('lib/general/fundadores/ganancias.php');					break;
				case 'preg'	:	include('lib/general/fundadores/preguntas.php');					break;
				case 'term' :	include('lib/general/fundadores/terminos.php');					break;
				
			}
		break;



		case 'cue':
			switch ($_GET['op'])
			{
				case 'actp'	: include('lib/general/usuarios/frm_actualizar_password.php'); 			break;
				case 'det'	: include('lib/general/usuarios/detalles_usuario.php'); 				break;
				case 'ava'	: include('lib/general/usuarios/frm_actualizar_avatar.php'); 			break;
				case 'fon'	: include('lib/general/usuarios/frm_actualizar_fondo.php'); 			break;
				case 'act'	: include('lib/general/usuarios/frm_actualizar_datos.php'); 			break;
				case 'tem'	: include('lib/general/usuarios/frm_actualizar_tema.php'); 				break;
				case 'per'	: include('lib/general/usuarios/perfil_usuario.php'); 					break;
                case 'seg'  : include('lib/general/usuarios/listado_seguidores.php'); 				break;
                case 'sig'  : include('lib/general/usuarios/listado_siguiendo.php'); 				break;
                case 'inv'  : include('lib/general/usuarios/frm_enviar_invitacion.php'); 			break;
                case 'soc'  : include('lib/general/usuarios/frm_actualizar_redes.php'); 			break;
                case 'dash' : include('lib/general/usuarios/frm_actualizar_dashboard.php'); 		break;
                case 'inte' : include('lib/general/usuarios/frm_actualizar_intereses_pasatiempos.php'); 		break;
                case 'notif': include('lib/general/usuarios/frm_actualizar_notificaciones.php'); 	break;
                case 'like' : include('lib/general/usuarios/frm_registrar_img_like.php'); 			break;
                case 'sub'  : include('lib/general/usuarios/panel_sub_cuentas.php'); 				break;
                case 'camb' : include('lib/general/usuarios/panel_cambio_usuario.php'); 			break;

                
			}
		break;

		case 'com':
			switch ($_GET['op'])
			{
				case 'act'	:	include('lib/general/comentarios/frm_actualizar_comentario.php'); 	break;
				case 'reg'	:	include('lib/general/comentarios/frm_registrar_comentario.php'); 	break;
			}
		break;

		case 'come':
			switch ($_GET['op'])
			{
				case 'lis'	:	include('lib/general/comentarios/listado_comentarios_general.php'); 	break;
				case 'mio'	:	include('lib/general/comentarios/frm_registrar_comentario.php'); 	break;
			}
		break;
		
		case 'men':
			switch ($_GET['op'])
			{
				case 'lis'	:	include('lib/general/mensajes/listado_conversaciones.php');				break;				
				case 'con'	: 	include('lib/general/mensajes/frm_conversacion2.php');					break;				
			}
		break;

		case 'not':
			switch ($_GET['op'])
			{
				case 'new'	:	include('lib/general/usuarios/caracteristicas.php'); 	break;				
				case 'list'	:	include('lib/general/notificaciones/listado_notificaciones_general.php'); 	break;				
			}
		break;

		case 'pre':
			switch ($_GET['op'])
			{
				case 'lis'	:	include('lib/general/preguntas/listado_preguntas_activas.php'); break;	
				case 'lisr'	:	include('lib/general/preguntas/listado_preguntas_respondidas.php'); break;	
				case 'lish'	:	include('lib/general/preguntas/listado_preguntas_hechas.php'); break;				
				case 'rep'	:	include('lib/general/preguntas/frm_responder.php'); break;
				case 'pre'	:	include('lib/general/preguntas/frm_preguntar.php'); break;
				
			}
		break;

		case 'adm':
				if($_SESSION['s']['tipo_usuario']=='2')
				{
					switch ($_GET['op'])
					{
					
						case 'lisu'	:	include('lib/admin/usuarios/listado_usuarios.php'); 			break;				
						case 'detu'	:	include('lib/admin/usuarios/detalles_usuario.php'); 			break;				
						case 'visi'	:	include('lib/admin/usuarios/listado_visitas.php'); 				break;				
						case 'blip'	:	include('lib/admin/usuarios/frm_bloquear_ip.php'); 				break;		
						case 'lkrp'	:	include('lib/admin/usuarios/listado_link_reportados.php'); 		break;				
						case 'pan'	: 	include('lib/admin/usuarios/panel_principal.php'); 				break;
						case 'cam'	: 	include('lib/admin/usuarios/frm_cambio_usuario.php'); 			break;
						case 'seip'	: 	include('lib/admin/usuarios/seguimiento_ip.php'); 				break;
		                case 'editpost':include('lib/general/imagenes/frm_actualizar_post.php');		break;
		                case 'bus' :    include('lib/admin/usuarios/busquedas.php'); 					break;
		                case 'adm' :    include('lib/admin/panel.php'); 								break;
		                case 'cat' :    include('lib/admin/usuarios/listado_categorias.php'); 			break;
		                case 'fra' :    include('lib/admin/usuarios/listado_frases.php'); 				break;
		                case 'pub' :    include('lib/admin/usuarios/listado_publicidad_general.php'); 	break;
		                case 'pre' :    include('lib/admin/preparar/preparar.php'); 					break;
		                case 'prec':  	include('lib/admin/preparar/preparar_contenido.php'); 			break;
		                case 'pass':  	include('lib/admin/usuarios/frm_reset_pass_admin.php'); 		break;
		                case 'fun':   	include('lib/admin/usuarios/listado_fundadores.php'); 			break;
		                case 'ipbloc':  include('lib/admin/usuarios/listado_ip_bloqueadas.php'); 		break;
		                case 'mod_nsfw':include('lib/admin/publicaciones/moderar_contenido.php'); 			break;
		            }
		    	}
		break;

		case 'con': 
			switch ($_GET['op']) 
			{
				case 'lis':		include('lib/general/contactos/listado_contactos.php');			break;
				case 'reg':		include('lib/general/contactos/frm_registrar_contacto.php');	break;
				case 'act':		include('lib/general/contactos/frm_actualizar_contacto.php');	break;
				case 'del':		include('lib/general/contactos/frm_eliminar_contacto.php');		break;
			}
		break;

		case 'lib': 
			switch ($_GET['op']) 
			{
				case 'lis':		include('lib/general/libros/listado_libros.php');				break;
				case 'reg':		include('lib/general/libros/frm_registrar_libro.php');			break;
				case 'act':		include('lib/general/libros/frm_actualizar_libro.php');			break;
				case 'del':		include('lib/general/libros/frm_eliminar_libro.php');			break;
			}
		break;
        
        	case 'rss': 
			switch ($_GET['op']) 
			{
				case 'lis':		include('lib/general/rss/prueba.php');				break;
				case 'reg':		include('lib/general/libros/frm_registrar_libro.php');			break;
				case 'act':		include('lib/general/libros/frm_actualizar_libro.php');			break;
				case 'del':		include('lib/general/libros/frm_eliminar_libro.php');			break;
			}
		break;

		case 'sex': 
			switch ($_GET['op']) 
			{
				case 'reg': 	include('lib/admin/sexo/frm_registrar_sexo.php');			break;
				case 'lis':		include('lib/admin/sexo/listado_sexos.php');			break;
			}
		break;

		case 'mem': 
			switch ($_GET['op']) 
			{
				case 'reg': 	include('lib/admin/memes/frm_registrar_meme.php');			break;
				case 'act': 	include('lib/admin/memes/frm_actualizar_meme.php');			break;
				case 'lis':		include('lib/admin/memes/listado_memes.php');				break;
			}
		break;




		//default:	include('lib/general/bienvenida.php');			break;
		default:		
			
				if($_GET['u']!='')	
				{
					include('lib/general/perfil_usuario.php'); 			break;
				}
				else if($_GET['op']=='correo')
				{
					include('lib/general/usuarios/correo.php'); 			break;	
				}
				else
				{
					switch ($_GET['op'])
					{
						case 'dash'		:
							if($_SESSION['s']['id_usuario'] != '')
							{
								include('lib/general/dashboard.php');
							}
							else
							{
								include('lib/general/portada.php');
							}
							break;
						include('lib/general/dashboard.php'); 					break;
						
						case '404'		: include('lib/general/usuarios/404.php'); 				break;
						case 'evento'	: include('lib/general/evento/evento_principal.php'); 				break;
						case 'chat_g'	: include('lib/general/evento/evento_principal.php'); 				break;
						case 'rss'		: include('lib/general/usuarios/listado_rss.php'); 				break;
						case 'tags_all'	: include('lib/general/usuarios/tags.php'); 				break;
						case 'dash2'	: include('lib/general/dashboard2.php'); 				break;
						case 'dashini'	: include('lib/general/portada.php'); 				break;
						case 'ver'		: include('lib/general/detalles_contenido.php'); 			break;
                        case 'inf'		: include('lib/general/empresa/inicio.php'); 			break;
                        case 'obj'		: include('lib/general/empresa/objetivo.php'); 			break;
                        case 'cara'		: include('lib/general/empresa/cara.php'); 			break;
						case 'registro'	: include('lib/general/usuarios/frm_registrar_usuario.php'); 		break;
						case 'login'	: include('lib/general/usuarios/login.php'); 				break;	
						case 'usuarios'	: include('lib/general/usuarios/listado_usuarios_publicos.php'); break;
						case 'tags'     : include('lib/admin/usuarios/tags.php'); break;
						case 'contacto' : include('lib/general/usuarios/contacto.php'); break;
						case 'categorias':include('lib/general/usuarios/categorias.php'); break;
						case 'mejor'	: include('lib/general/dashboard.php'); break;
						case 'recu_pass': include('lib/general/usuarios/frm_recuperar_pass.php'); break;
						case 'recpass' 	: include('lib/general/usuarios/frm_recuperar_pass_completo.php'); break;
						case 'loging' 	: include('lib/general/login-google-plus.php'); break;
						//case 'permiso-nsfw': include('lib/general/permiso_nsfw.php'); break;
						case 'tableros' : include('lib/general/usuarios/frm_tableros_usuario.php'); break;
						case 'edit_post': include('lib/general/imagenes/frm_actualizar_post_usuario.php'); break;
						case 'post_random': include('lib/general/random_post.php'); 			break;
						default:	

							if($_SESSION['s']['id_usuario'] != '')
							{
								include('lib/general/dashboard.php');
							}
							else
							{
								include('lib/general/portada.php');
							}
						break;
						
					}
					break;
				}
				
			
			
                        
			
	}
	
	


		


?>