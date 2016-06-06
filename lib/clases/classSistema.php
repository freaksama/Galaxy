<?class Sistema
{
	public $db;
	function Sistema(&$db)
	{
		$this->db=&$db;
	}
	
	function obtenerDatosUsuario($datos)
	{
		$q ="SELECT
				id_usuario,
				nombre_usuario,
				nombre,
				bio,
				tema,
				tipo_usuario,
				avatar,
				id_ult_not,
				per_nsfw,
				fondo_web,
				desp_inf,
				tipo_dash,
				visibilidad_default,
				img_like		
			FROM usuarios 
			WHERE (nombre_usuario = '".$datos['nombre_usuario']."'	OR correo = '".$datos['nombre_usuario']."')
			AND   password 	= '".$datos['password']."'";		
		
		return $this->db->query($q);
	}

	function obtener_datos_usuario_secundario($datos)
	{
		$q ="SELECT
				id_usuario,
				nombre_usuario,
				nombre,
				bio,
				tema,
				tipo_usuario,
				avatar,
				id_ult_not,
				per_nsfw,
				fondo_web,
				desp_inf,
				tipo_dash,
				visibilidad_default,
				img_like		
			FROM usuarios 
			WHERE id_usuario 	= '".$datos['id_usuario']."'";		
		//echo $q;
		return $this->db->query($q);
	}


	function obtener_datos_login_externo($datos)
	{
		$q ="SELECT
				id_usuario,
				nombre_usuario,
				nombre,
				bio,
				tema,
				tipo_usuario,
				avatar,
				id_ult_not,
				per_nsfw,
				fondo_web,
				desp_inf,
				tipo_dash,
				visibilidad_default,
				img_like		
			FROM usuarios 
			WHERE tipo_login_ext = '".$datos['tipo_login_ext']."'
			AND   id_login_ext 	= '".$datos['id_login_ext']."'";		
		
		return $this->db->query($q);
	}

	function actualizar_session_token($datos)
	{
		$q="UPDATE usuarios SET 
				token_session = '".$datos['token_session']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function actualizar_estadisticas_usuario($datos)
	{
		$q="UPDATE usuarios SET 
				num_post 		= '".$datos['num_post']."',
				num_like		= '".$datos['num_like']."',
				seguidores 		= '".$datos['seguidores']."',
				siguiendo 		= '".$datos['siguiendo']."'
			WHERE id_usuario 	= '".$datos['id_usuario']."'";

		return $this->db->query($q);
	}

	function actualizar_estadisticas_contenido($datos)
	{
		$q="UPDATE contenido SET 
				num_com 		= '".$datos['num_com']."',
				num_likes		= '".$datos['num_likes']."',
				num_rt 			= '".$datos['num_rt']."'
			WHERE id_contenido 	= '".$datos['id_contenido']."'";
		return $this->db->query($q);
	}

	function obtener_datos_usuario_token($datos)
	{
		$q="SELECT
				id_usuario,
				nombre,
				nombre_usuario,
				bio,
				tema,
				tipo_usuario,
				avatar,
				id_ult_not,
				per_nsfw,
				fondo_web,
				desp_inf,
				visibilidad_default,
				img_like

			FROM usuarios 
			WHERE token_session = '".$datos['token_session']."'";
		return $this->db->query($q);
	}

	function registrar_correo_recuperacion($datos)
	{
		$q="UPDATE  usuarios SET 
				token 		= '".$datos['token']."',
				fecha_ult 	= '".$datos['fecha_ult']."'
			WHERE correo 	= '".$datos['correo']."'";

		return $this->db->query($q);
	}

    function obtener_datos_usuario_ID($datos)
	{
		$q ="SELECT
				id_usuario,
				nombre_usuario,
				bio,
				tema,
				tipo_usuario,
				avatar,
				id_ult_not,
				per_nsfw, 
                per_enviar_correo
			FROM usuarios 
			WHERE id_usuario = '".$datos['id_usuario']."'";		
		
		return $this->db->query($q);
	}

	function obtener_correo_usuario($datos)
	{
		$q="SELECT correo
			FROM usuarios
			WHERE id_usuario = '".$datos['id_usuario']."'";		
		return $this->db->query($q);
	}

	function actualizar_session_activa($datos)
	{
		$q="UPDATE session_activa SET 
				fecha = '".$datos['fecha']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);	
	}

	function eliminar_session_activa($datos)
	{
		$q="DELETE FROM session_activa WHERE fecha < '".$datos['fecha_limite']."'";
		return $this->db->query($q);	
	}

	function eliminar_session_activa_manual($datos)
	{
		$q="DELETE FROM session_activa WHERE id_usuario = '".$datos['id_usuario']."'";
		
		return $this->db->query($q);	
	}

	function validar_session_activa($datos)
	{
		$q="SELECT 1 FROM session_activa WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function insertar_session_activa($datos)
	{
		$q="INSERT INTO session_activa(
				id_usuario,
				fecha)
			VALUES(
				'".$datos['id_usuario']."',
				'".$datos['fecha']."')";

		$q2="UPDATE usuarios SET fecha_ult = '".$datos['fecha']."' WHERE id_usuario = '".$datos['id_usuario']."'";
		$r = $this->db->query($q2);
		
		return $this->db->query($q);

	}

	function listado_usuarios_online()
	{
		$q="SELECT 
			u.id_usuario,
			u.nombre_usuario,
            u.avatar,
            u.bio,
            u.fecha_ult
		FROM usuarios  u 
		INNER JOIN session_activa sa ON u.id_usuario = sa.id_usuario";
		return $this->db->query($q);
	}
	
	function obtener_datos_usuario2($datos)
	{
		$q ="SELECT
				id_usuario,
				nombre_usuario
			FROM usuarios 
			WHERE id_usuario = '".$datos['id_usuario']."'";		
		
		return $this->db->query($q);
	}

	function obtener_datos_nombre_usuario($datos)
	{
		$q ="SELECT
				id_usuario,
				nombre_usuario,
				avatar
			FROM usuarios 
			WHERE nombre_usuario = '".$datos['nombre_usuario']."'";		
		
		return $this->db->query($q);	
	}

	function registrar_usuario($datos)
	{
		$q="INSERT INTO usuarios(
				tipo_usuario,
				nombre_usuario, 
                avatar,
				password,
				correo,
				tipo_login_ext,
				id_login_ext,
				fecha_reg,
				fecha_ult,
				tema,
				status,
				id_ref,
				img_like)
			VALUES(
				'".$datos['tipo_usuario']."',
				'".$datos['nombre_usuario']."',
                '".$datos['avatar']."',
				'".$datos['password']."',
				'".$datos['correo']."',
				'".$datos['tipo_login_ext']."',
				'".$datos['id_login_ext']."',
				'".$datos['fecha_reg']."',
				'".$datos['fecha_ult']."',
				'".$datos['tema']."',
				'".$datos['status']."',
				'".$datos['id_ref']."',
				'".$datos['img_like']."')";

		return $this->db->query($q);
	}

	function actualizacion_informacion_inicio($datos)
	{
		$q="UPDATE usuarios SET 
				id_sexo 	= '".$datos['id_sexo']."',
				bio 		= '".$datos['bio']."',
				ubicacion	= '".$datos['ubicacion']."',
				fecha_ult	= '".$datos['fecha_ult']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		//echo $q;
		return $this->db->query($q);
	}	

	function actualizar_password($datos)
	{
		$q="UPDATE usuarios SET 
				password = '".$datos['password']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}
	

	

	function listado_contenido_general($datos)
	{
		# Que contenido debe cargar
		# Si es de determinado usuario 
		# Si es de determinada categoria 
		# Si es de determinada etiqueda 
		# Si es de el mejor contenido 
		# Si es lo que el usuario sigue. 

		if($datos['id_usuario'] != '' & $datos['live'] != 'S')
		{
			

			 $filtro_general = "WHERE c.status = 'A'
								AND (	
										(c.visibilidad = 'P') OR  
										(c.visibilidad = 'O' AND c.id_usuario = '".$datos['id_usuario']."')  OR 					
										(c.visibilidad = 'R') OR  
										(c.visibilidad = 'S' AND c.id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status = 'A')) OR
										(c.visibilidad = 'S' AND c.id_usuario = '".$datos['id_usuario']."')
									)								
								AND c.reporte = 'N' 
								OR c.id_usuario = '".$datos['id_usuario']."'";

								$order = " ORDER BY c.fecha_p DESC ";
		}
		else
		{
			$filtro_general = "WHERE c.status = 'A'
			AND c.visibilidad = 'P'								
			AND c.reporte = 'N' ";
		}
		
		$order = " ORDER BY c.id_contenido DESC ";

		if($datos['user'] != '')
		{
			# de deterimnado usuario
			$filtro = " AND c.id_usuario = (SELECT id_usuario  FROM usuarios WHERE nombre_usuario = '".$datos['user']."') ";
		}			
		else if($datos['categoria'] != '0' & $datos['categoria'] != '')
		{				
			# de determianda categoria
			$filtro .= " AND ca.codigo_categoria = '".$datos['categoria']."' ";

			if($datos['rss'] == 'S')
			{
				$filtro .= " 	AND c.id_tipo_contenido != '6'
        							AND c.id_tipo_contenido != '8'";
			}
		}
		else if($datos['tags'] != '')
		{
			# de determinada etiqueta
			$filtro = " AND (c.tags LIKE '%".$datos['tags']."%' OR c.descripcion LIKE '%#".$datos['tags']."%') ";
		}
       else if($datos['all'] == 'S')
		{
			# de determinada etiqueta
			$filtro = "";
		}
		else if($datos['mas_visto']=='S')
		{
			$filtro = "AND 
						(
							(c.id_usuario IN (select id_usuario FROM lista_blanca WHERE status = 'A' ) OR (SELECT count(*) FROM likes WHERE likes.id_contenido = c.id_contenido AND status='A') > 3 OR 
							(SELECT count(*) FROM likes WHERE id_contenido = c.id_contenido AND id_usuario = '1') >= 1 )  
						)";
			$order = 'ORDER BY c.veces_visto DESC';
		}
		else if($datos['mejor'] == 'S')
		{
			# de mejor contenido
			$filtro = "			
								 AND (
										(c.id_usuario IN (select id_usuario FROM lista_blanca WHERE status = 'A' ) OR (SELECT count(*) FROM likes WHERE likes.id_contenido = c.id_contenido AND status='A') > 3 OR 
										(SELECT count(*) FROM likes WHERE id_contenido = c.id_contenido AND id_usuario = '1') >= 1 )  
									AND c.id_tipo_contenido != '6'
        							AND c.id_tipo_contenido != '8'	)";
		}
		else if($datos['like']=='S')
		{
			$filtro = " AND c.id_contenido IN (SELECT id_contenido FROM likes WHERE id_contenido = c.id_contenido AND id_usuario = '".$datos['id_usuario']."' AND status='A') " ;
		}       
		else if($datos['id_usuario'] != '' & $datos['consulta'] == '')
		{
			# de usuarios que sigo
			$filtro = " AND (c.id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status = 'A') OR c.id_usuario = '".$datos['id_usuario']."')";
		}
		else if($datos['consulta'] != '')
		{
			$filtro = "AND (c.nombre LIKE '%".$datos['consulta']."%' OR 
							c.descripcion LIKE '%".$datos['consulta']."%' OR 
							c.tags LIKE '%".$datos['consulta']."%')";

		}		

		if($datos['live']=='S')
		{
			$filtro = "			
								 AND (
										  
									c.id_tipo_contenido != '6'
        							AND c.id_tipo_contenido != '8'	)";
			
			if($datos['id_usuario'] != '')
			{
				# de usuarios que sigo
				///$filtro .= " OR (c.id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status = 'A') OR c.id_usuario = '".$datos['id_usuario']."')";
			}
			$INNER = " LEFT JOIN notificaciones n ON c.id_contenido = n.id_ref AND n.id_tipo_notificacion IN (1,3,10,12) ";
			$order = "ORDER BY c.id_contenido DESC";
		}

		if($datos['super'] == 'S')
		{
			$filtro = "AND (
								c.id_tipo_contenido != '6'
        					AND c.id_tipo_contenido != '8'	)
        				AND c.id_contenido IN (
        				".$datos['rand_1'].",
        				".$datos['rand_2'].",
        				".$datos['rand_3'].",
        				".$datos['rand_4'].",
        				".$datos['rand_5'].",
        				".$datos['rand_6'].",
        				".$datos['rand_7'].",
        				".$datos['rand_8'].",
        				".$datos['rand_9'].",
        				".$datos['rand_10'].",
        				".$datos['rand_11'].",
        				".$datos['rand_12'].",
        				".$datos['rand_13'].",
        				".$datos['rand_14'].",
        				".$datos['rand_15'].",
        				".$datos['rand_16'].",
        				".$datos['rand_17'].",
        				".$datos['rand_18'].",
        				".$datos['rand_19'].",
        				".$datos['rand_20'].",
        				".$datos['rand_21'].",
        				".$datos['rand_22'].",
        				".$datos['rand_23'].",
        				".$datos['rand_24'].",
        				".$datos['rand_25'].",
        				".$datos['rand_26'].",
        				".$datos['rand_27'].",
        				".$datos['rand_28'].",
        				".$datos['rand_29'].",
        				".$datos['rand_30'].") ";
			
			
				# de usuarios que sigo
				///$filtro .= " OR (c.id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status = 'A') OR c.id_usuario = '".$datos['id_usuario']."')";
			
				
			$order = " ORDER BY c.id_contenido DESC";
		}

                    

		$q="SELECT 				
			c.id_contenido,
			c.id_tipo_contenido,				
			c.link,
			c.nombre,
			c.descripcion,
			c.src,
			c.codigo,
			c.tipo_archivo,
			c.tamanio,
			c.tags,
			c.adulto,				
			c.veces_visto,	
			c.visibilidad,					
			u.id_usuario,
			u.avatar,
			c.fecha_p,	
			u.nombre as nombre_real,
			u.nombre_usuario,
			c.num_com as comentarios,				
			c.num_likes as likes,
			c.num_rt as rt,
			uc.nombre_usuario as nombre_usuario_rt,
			(select 1 from likes WHERE id_contenido  = c.id_contenido AND id_usuario = '".$datos['id_usuario']."' AND status = 'A') as id_like,			
			ca.codigo_categoria,
			ca.nombre_categoria,
			(select 1 from contenido_imagenes WHERE id_contenido = c.id_contenido LIMIT 1) as multi_img,
			ca.img
		FROM contenido c 			
		LEFT JOIN usuarios 		u  ON u.id_usuario 	  = c.id_usuario			
		LEFT JOIN contenido 	cc ON cc.id_contenido = c.id_rt
		LEFT JOIN usuarios  	uc ON cc.id_usuario =  uc.id_usuario
		LEFT JOIN c_categorias  ca ON ca.id_categoria = c.id_categoria       
		".$INNER."
		".$filtro_general."     
		".$filtro ."
		".$order."			
		".$datos['limit'];
		//echo '<pre>'.$q.'</pre>';		
		return $this->db->query($q);
	}

	function obtener_imagenes_post($datos)
	{
		$q="SELECT 
				src,
				tipo_archivo
			FROM contenido_imagenes 
			WHERE id_contenido = '".$datos['id_contenido']."'";
		return $this->db->query($q);
	}		

	

	function listado_ultimos_contenido_usuario($datos)
	{
		$q="SELECT 				
			c.id_contenido,
			c.id_tipo_contenido,				
			c.link,
			c.nombre,
			c.descripcion,
			c.src,
			c.codigo,
			c.tipo_archivo,
			c.tags,
			c.adulto,
			c.ip,c.veces_visto,			
			u.id_usuario,
			u.avatar,
			c.fecha_p,	
			u.nombre_usuario,
			(select count(*) from comentarios WHERE id_ref = c.id_contenido and id_tipo_comentario = '1' and status = 'A' ) as comentarios,			
			(SELECT count(*) FROM likes       WHERE likes.id_contenido = c.id_contenido AND status='A' ) as likes,
			(SELECT count(*) FROM contenido   WHERE id_rt = c.id_contenido AND status = 'A') as rt,
			uc.nombre_usuario as nombre_usuario_rt,
			l.id_like,
			ca.codigo_categoria,
			ca.nombre_categoria
		FROM contenido c 			
		LEFT JOIN usuarios 		u  ON u.id_usuario 	= c.id_usuario
		LEFT JOIN likes 		l  ON l.id_contenido = c.id_contenido AND l.id_usuario = '".$datos['id_usuario']."' AND l.status = 'A'
		LEFT JOIN contenido 	cc ON cc.id_contenido = c.id_rt
		LEFT JOIN usuarios  	uc ON cc.id_usuario =  uc.id_usuario
		LEFT JOIN c_categorias ca ON ca.id_categoria = c.id_categoria            
		WHERE c.status = 'A'
		AND c.visibilidad = 'P' 
		AND c.fecha_p <= '".$datos['fecha_p']."'
		AND c.id_tipo_contenido = '2'
		AND c.reporte = 'N' 
		AND c.id_usuario = '".$datos['id_usuario']."'
		AND c.id_contenido < '".$datos['id_contenido']."'
		ORDER BY c.fecha_p DESC
		LIMIT 0,".$datos['limit'];
		return $this->db->query($q);
	}

	function listado_contenido_popular_mes_anterior($datos)
	{
		$filtro = "	AND (
							(c.id_usuario IN (select id_usuario FROM lista_blanca WHERE status = 'A' ) OR (SELECT count(*) FROM likes WHERE likes.id_contenido = c.id_contenido AND status='A') > 1  )  
							
						)
					AND c.id_tipo_contenido = '2'
					";
		$datos['fecha_p'] = date("Y-m-d H:i:s", strtotime("-90 day")); 


		$q="SELECT 				
			c.id_contenido,
			c.id_tipo_contenido,				
			c.link,
			c.nombre,
			c.descripcion,
			c.src,
			c.codigo,
			c.tipo_archivo,
			c.tags,
			c.adulto,
			c.ip,			
			u.id_usuario,
			u.avatar,
			c.fecha_p,	
			u.nombre_usuario,
			c.num_com as comentarios,				
			c.num_likes as likes,
			c.num_rt as rt,
			uc.nombre_usuario as nombre_usuario_rt,
			l.id_like,
			ca.codigo_categoria,
			ca.nombre_categoria
		FROM contenido c 			
		LEFT JOIN usuarios 		u  ON u.id_usuario 	= c.id_usuario
		LEFT JOIN likes 		l  ON l.id_contenido = c.id_contenido AND l.id_usuario = '".$datos['id_usuario']."' AND l.status = 'A'
		LEFT JOIN contenido 	cc ON cc.id_contenido = c.id_rt
		LEFT JOIN usuarios  	uc ON c.id_usuario_rt =  uc.id_usuario
		LEFT JOIN c_categorias ca ON ca.id_categoria = c.id_categoria
		WHERE c.status = 'A'
		AND c.visibilidad = 'P' 
		AND c.fecha_p <= '".$datos['fecha_p']."'
		AND c.reporte != 'S'
		".$filtro."
		ORDER BY c.fecha_p DESC
		".$datos['limit'];

		return $this->db->query($q);
	}




	function listado_links_publicos_reportados($datos)
	{
		if($datos['tags'] != '')
		{
			$filtro = " AND (c.tags LIKE '%".$datos['tags']."%' OR c.descripcion LIKE '%#".$datos['tags']."%') ";
		}

		if($datos['id_usuario_2'] != '')
		{
			$filtro .= " AND c.id_usuario LIKE '".$datos['id_usuario_2']."' ";
		}

		$q="SELECT 				
			c.id_contenido,
			c.id_tipo_contenido,				
			c.link,
			c.nombre,
			c.descripcion,
			c.src,
			c.codigo,
			c.tags,
			c.adulto,	
			c.fecha_p,
			c.ip,			
			u.id_usuario,
			u.nombre_usuario,
			(select count(*) from comentarios WHERE id_ref = c.id_contenido and id_tipo_comentario = '1' and status = 'A' ) as comentarios,
			(SELECT count(*) FROM likes WHERE likes.id_contenido = c.id_contenido AND status='A' ) as likes,
			(SELECT count(*) FROM reportes_links WHERE id_link = c.id_contenido and status ='A' and status_reporte = 'P') as reportes,
			l.id_like
		FROM contenido c 			
		LEFT JOIN usuarios 	u ON u.id_usuario 	= c.id_usuario
		LEFT JOIN likes 	l ON l.id_contenido = c.id_contenido AND l.id_usuario = '".$datos['id_usuario']."' AND l.status = 'A'
		WHERE c.status = 'A'
		AND c.visibilidad = 'P' 
		AND (SELECT count(*) FROM reportes_links WHERE id_link = c.id_contenido and status ='A' and status_reporte = 'P') > 1
		".$filtro."
		ORDER BY c.fecha_p DESC"
		.$datos['limit'];

		return $this->db->query($q);
	}
        
	function obtener_datos_usuario($datos)
	{
		$q="SELECT 
				u.id_usuario,
				nombre,
				u.nombre_usuario,
				u.correo,
				u.bio,
				u.avatar,
				u.ubicacion,
				u.id_sexo,
				s.nombre_sexo,
				u.id_situacion,
				si.nombre_situacion,
				u.intereses,					
				u.pasatiempos,
				u.status,
                u.id_ult_not,
                u.tipo_dash,
                u.per_nsfw,
                u.per_enviar_correo,
                u.visibilidad_default,
                fondo_web,
                desp_inf,
                visitas_perfil,
				(select count(*) from contenido where  id_usuario = u.id_usuario and status = 'A' AND visibilidad='P') as links,
				(select count(*) from seguidores where id_usuario_pri = u.id_usuario and status = 'A') as seguidores,
				(select count(*) from seguidores where id_usuario_seg = u.id_usuario and status = 'A') as sigues,				
				u.img_like
			FROM usuarios u 
            LEFT JOIN c_sexo s ON u.id_sexo = s.id_sexo
            LEFT JOIN c_situaciones si ON si.id_situacion = u.id_situacion
			WHERE u.id_usuario = '".$datos['id_usuario']."'";


		return $this->db->query($q);
	}

	function actualizar_fecha_ingreso($datos)
	{
		$q="UPDATE usuarios SET fecha_ult = '".$datos['fecha_ult']."' WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function obtener_visitas_perfil($datos)
	{
		$q="SELECT 					
                visitas_perfil					
			FROM usuarios                 
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function actualizar_visitas_perfil($datos)
	{
		$q="UPDATE usuarios SET 
				visitas_perfil = '".$datos['visitas_perfil']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function listado_usuarios_para_seguir($datos)
	{
		$q="SELECT 
				u.id_usuario,
				u.nombre_usuario,
				u.bio,
				u.avatar				
			FROM usuarios u 
			WHERE id_usuario NOT IN (select id_usuario_pri from seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status = 'A')	
			AND id_usuario != '".$datos['id_usuario']."'
			AND nombre_usuario != 'pr0nx'
			AND nombre_usuario != 'tetasHD'
			ORDER BY u.fecha_ult DESC
			LIMIT 0,5";
		return $this->db->query($q);		
	}



	function validar_nombre_usuario($datos)
	{	
		$q="SELECT 1 from usuarios WHERE nombre_usuario = '".$datos['nombre_usuario']."' AND id_usuario != '".$datos['id_usuario']."' ";		
		return $this->db->query($q);
	}

	function validar_correo_usuario($datos)
	{
		$q="SELECT 1 from usuarios WHERE correo = '".$datos['correo']."'  
		AND id_usuario != '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function validar_nombre_usuario_nuevo($datos)
	{	
		$q="SELECT 1 from usuarios WHERE nombre_usuario = '".$datos['nombre_usuario']."' ";			
		return $this->db->query($q);
	}

	function validar_correo_usuario_nuevo($datos)
	{
		$q="SELECT 1 from usuarios WHERE correo = '".$datos['correo']."'  ";
		return $this->db->query($q);
	}

	function actualizar_datos_usuario($datos)
	{	
		$q="UPDATE usuarios SET
				nombre 				= '".$datos['nombre']."',
				nombre_usuario 		= '".$datos['nombre_usuario']."',
				correo 				= '".$datos['correo']."',
				bio  				= '".$datos['bio']."',
				id_sexo 			= '".$datos['id_sexo']."',
				id_situacion 		= '".$datos['id_situacion']."',
				ubicacion  			= '".$datos['ubicacion']."'					
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function actualizar_datos_dash_usuario($datos)
	{
		$q="UPDATE usuarios SET
				tipo_dash 	= '".$datos['tipo_dash']."',
				desp_inf 	= '".$datos['desp_inf']."',
				visibilidad_default 	= '".$datos['visibilidad_default']."',
				per_nsfw 	= '".$datos['per_nsfw']."'					
			WHERE id_usuario = '".$datos['id_usuario']."'";			
		return $this->db->query($q);
	}

	function actualizar_datos_notificacion_usuario($datos)
	{
		$q="UPDATE usuarios SET
				per_enviar_correo 	= '".$datos['per_enviar_correo']."'									
			WHERE id_usuario = '".$datos['id_usuario']."'";						
		return $this->db->query($q);
	}

	function obtenter_fondo_web($datos)
	{
		$q="SELECT fondo_web FROM usuarios
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function registrar_fondo_web($datos)
	{
		$q="UPDATE usuarios SET fondo_web = '".$datos['fondo_web']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function listado_comentarios($datos)
	{
		$q="SELECT 
				c.id_comentario,
				c.comentario,
				c.fecha,
				u.id_usuario,
				u.nombre_usuario,
				u.avatar				
			FROM comentarios c 
			LEFT JOIN usuarios u ON c.id_usuario = u.id_usuario
			WHERE c.id_ref = '".$datos['id_ref']."'
			AND c.id_tipo_comentario = '".$datos['id_tipo_comentario']."'
			AND c.status = 'A'";			
		return $this->db->query($q);
	}

	function obtener_comentario($datos)
	{
		$q="SELECT 
				c.id_comentario,
				c.id_ref,
				c.comentario,
				c.id_tipo_comentario,
				c.fecha,
				u.id_usuario,
				u.nombre_usuario				
			FROM comentarios c 
			LEFT JOIN usuarios u ON c.id_usuario = u.id_usuario
			WHERE id_comentario = '".$datos['id_comentario']."'";			
		return $this->db->query($q);
	}

	function registrar_comentario($datos)
	{
		$q="INSERT INTO comentarios(
				id_ref, 
				id_usuario,
				comentario,
				fecha,
				id_tipo_comentario,
				ip,	
				status)
				VALUES(
				'".$datos['id_ref']."',
				'".$datos['id_usuario']."',
				'".$datos['comentario']."',
				'".$datos['fecha']."',
				'".$datos['id_tipo_comentario']."',
				'".$datos['ip']."',
				'".$datos['status']."')";
		return $this->db->query($q);
	}

	function eliminar_comentario($datos)
	{
		$q="UPDATE comentarios SET 	
				status 	= '".$datos['status']."',
				fecha 	= '".$datos['fecha']."'
			WHERE id_comentario = '".$datos['id_comentario']."'
			AND id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function eliminar_comentario_especial($datos)
	{
		$q="UPDATE comentarios SET 	
				status 	= '".$datos['status']."',
				fecha 	= '".$datos['fecha']."'
			WHERE id_comentario = '".$datos['id_comentario']."'";
		return $this->db->query($q);
	}

	function obtener_usuario_contenido_comentario($datos)
	{
		$q=" select c.id_usuario from contenido c 
			LEFT JOIN comentarios co  ON co.id_ref = c.id_contenido
			WHERE co.id_comentario = '".$datos['id_comentario']."'";
		return $this->db->query($q);
	}

	function actualizar_comentario($datos)
	{
		$q="UPDATE comentarios SET 	
				comentario 	= '".$datos['comentario']."',
				fecha 		= '".$datos['fecha']."'
			WHERE id_comentario = '".$datos['id_comentario']."'	";
		return $this->db->query($q);
	}
	
	function listado_ultimos_comentarios_dashboard($datos)
	{
		$q="SELECT 
				c.id_comentario,
				c.comentario,
				c.fecha,
				c.ip,
				u.id_usuario,
				u.nombre_usuario,
				u.avatar				
			FROM comentarios c 
			LEFT JOIN usuarios u ON c.id_usuario = u.id_usuario
			WHERE c.id_ref = '".$datos['id_ref']."'
			AND c.id_tipo_comentario = '".$datos['id_tipo_comentario']."'
			AND c.status = 'A'
			ORDER BY c.id_comentario DESC
			LIMIT 0,".$datos['limit'];			
		return $this->db->query($q);
	}
	
	function contar_comentarios_dashboard($datos)
	{
		$q="SELECT count(*) as num_comentarios		
			FROM comentarios c 
			LEFT JOIN usuarios u ON c.id_usuario = u.id_usuario
			WHERE c.id_ref = '".$datos['id_ref']."'
			AND id_tipo_comentario = '".$datos['id_tipo_comentario']."'
			AND c.status = 'A'				
			LIMIT 0,1";			
		return $this->db->query($q);
	}
	
	function registrar_like($datos)
	{
		$q="INSERT INTO likes(
				id_contenido,
				id_usuario,					
				fecha,
				status)
			VALUES(
				'".$datos['id_contenido']."',
				'".$datos['id_usuario']."',					
				'".$datos['fecha']."',
				'".$datos['status']."')";
		return $this->db->query($q);
	}
	
	function eliminar_like($datos)
	{
		$q="UPDATE likes SET 
				fecha  = '".$datos['fecha']."',
				status = '".$datos['status']."'
			WHERE id_contenido = '".$datos['id_contenido']."'
			AND id_usuario = '".$datos['id_usuario']."'";

		return $this->db->query($q);
	}

	function validar_like($datos)
	{
		$q="SELECT 1 FROM likes 
			WHERE id_contenido 	= '".$datos['id_contenido']."'
			AND id_usuario 		= '".$datos['id_usuario']."'
			AND status = 'A'";
		return $this->db->query($q);
	}


	function actualizar_tema($datos)
	{
		$q="UPDATE usuarios SET 
				tema = '".$datos['tema']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}


	function seguir_usuario($datos)
	{
		$q="INSERT INTO seguidores(
			id_usuario_pri,
			id_usuario_seg,
			fecha,
			status)
			VALUES(
			'".$datos['id_usuario_pri']."',
			'".$datos['id_usuario_seg']."',
			'".$datos['fecha']."',
			'".$datos['status']."')";
		return $this->db->query($q);	
	}

	function validar_usuario_seguidor($datos)
	{
		$q="SELECT id_seguidor
			FROM seguidores 
			WHERE id_usuario_pri 	= '".$datos['id_usuario_pri']."'
			AND id_usuario_seg 		= '".$datos['id_usuario_seg']."'
			AND status = 'A'";
		return $this->db->query($q);
	}

	function dejar_seguir_usuario($datos)
	{
		$q="UPDATE seguidores SET 
				status 	= '".$datos['status']."',
				fecha 	= '".$datos['fecha']."'
			WHERE id_usuario_pri = '".$datos['id_usuario_pri']."'
			AND id_usuario_seg = '".$datos['id_usuario_seg']."'
			AND status  = 'A'";
		//echo $q;
		return $this->db->query($q);
	}

	function listado_usuaios($datos)
	{
		$q="SELECT 
				u.id_usuario,
				u.nombre_usuario,
				u.correo,
				u.bio,
				u.ubicacion,
				s.nombre_sexo,
				u.fecha_ult,
				u.tema,
				u.status,					
				u.num_post,
				u.avatar,
				u.seguidores as seguidores,
				u.siguiendo as siguiendo,
				u.visibilidad_default
				FROM usuarios u
				LEFT JOIN c_sexo s ON u.id_sexo = s.id_sexo
                        ORDER BY u.id_usuario ";
		return $this->db->query($q);
	}

	function cambiar_status_usuario($datos)
	{
		$q="UPDATE usuarios SET
				status = '".$datos['status']."' ,
				fecha_ult = '".$datos['fecha_ult']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function registrar_visita($datos)
	{
		$q="INSERT INTO visitas(
				seccion,
				src,
				page,
				fecha,
				id_usuario,
				ip,
				nav)
				VALUES(
				'".$datos['seccion']."',
				'".$datos['src']."',
				'".$datos['page']."',
				'".$datos['fecha']."',
				'".$datos['id_usuario']."',
				'".$datos['ip']."',
				'".$datos['nav']."')";
		return $this->db->query($q);
	}

	function listado_visitas_general_src()
	{
		$q="SELECT 
			count(*) as visitas,
			src
			FROM visitas 			
			GROUP BY src
			ORDER BY visitas DESC
			";
		return $this->db->query($q);
	}

	function listado_visitas_general()
	{
		$q="SELECT 
			count(*) as visitas		
			FROM visitas				
			";
		return $this->db->query($q);
	}

	function listado_visitas_general_seccion()
	{
		$q="SELECT 
			count(*) as visitas,
			seccion
			FROM visitas 				
			GROUP BY seccion
			ORDER BY visitas DESC
			";
		return $this->db->query($q);
	}

	function listado_visitas_general_fecha()
	{
		$q="SELECT 
			count(*) as visitas,
			DATE(fecha) solofecha
			FROM visitas 			
			GROUP BY solofecha
			ORDER BY solofecha DESC
			";
		return $this->db->query($q);
	}

	function listado_visitas_general_ips()
	{
		$q="SELECT 
			count(*) as visitas,
			ip
			FROM visitas 			
			GROUP BY ip
			ORDER BY visitas DESC
			";
		return $this->db->query($q);
	}

	function listado_paginas_visitados($datos)
	{
		$q="SELECT 
				v.page,				
				u.nombre_usuario,
				v.fecha,
				v.nav,
				v.ip
			FROM visitas v 
			LEFT JOIN usuarios u ON u.id_usuario = v.id_usuario
			WHERE DATE(fecha) = '".$datos['fecha']."'
                        AND v.nav NOT LIKE '%google%'
                        AND v.nav NOT LIKE '%bing%'
                        AND v.nav NOT LIKE '%baidu%'
                        AND v.nav NOT LIKE '%yandex%'
			ORDER BY id_visita DESC";
		return $this->db->query($q);	
	}

	function listado_visitas_general_page()
	{
		$q="SELECT 
			count(*) as visitas,
			page
			FROM visitas 			
			GROUP BY page
			ORDER BY visitas DESC";
		return $this->db->query($q);	
	}

	function bloquear_ip($datos)
	{
		$q="INSERT INTO bloqueos_ip(
			ip,
			tipo,
			motivo,
			fecha)
			VALUES(
			'".$datos['ip']."',
			'".$datos['tipo']."',
			'".$datos['motivo']."',
			'".$datos['fecha']."')";
		return $this->db->query($q);	
	}

	function validar_bloqueo_ip($datos)
	{
		$q="SELECT 1
			FROM bloqueos_ip
			WHERE ip = '".$datos['ip']."'";
		return $this->db->query($q);	
	}

	function validar_bloqueo_usuario($datos)
	{
		$q="SELECT 1
			FROM usuarios
			WHERE id_usuario = '".$datos['id_usuario']."'
			AND status != 'A' ";
		return $this->db->query($q);	
	}

	function registrar_reporte_link($datos)
	{
		$q="INSERT INTO reportes_links(
			id_link,
			id_usuario,
			id_usuario_admin,
			fecha,
			fecha_mod,
			status_reporte,
			status)
			VALUES(
			'".$datos['id_link']."',
			'".$datos['id_usuario']."',
			'".$datos['id_usuario_admin']."',
			'".$datos['fecha']."',
			'".$datos['fecha_mod']."',
			'".$datos['status_reporte']."',
			'".$datos['status']."')";

		return $this->db->query($q);
	}

	function actualizar_reporte_link($datos)
	{
		$q="UPDATE reportes_links SET 
				id_usuario_admin 	= '".$datos['id_usuario_admin']."',
				fecha_mod 			= '".$datos['fecha_mod']."',	
				status_reporte 		= '".$datos['status_reporte']."',
				status 				= '".$datos['status']."'
			WHERE id_link = '".$datos['id_link']."'";

		return $this->db->query($q);	
	}
	
	function listado_notificaciones_general($datos)
    {   
        if($datos['last']!= '')
        {
            $filtro = "AND n.id_notificacion > (select id_ult_not from usuarios where id_usuario = '".$datos['id_usuario']."') ";
        }

        if($datos['id_last_n']!= '')
        {
            $filtro = " AND n.id_notificacion > '".$datos['id_last_n']."'";
        }

        $q="SELECT              
                n.id_notificacion,
                n.id_ref,
                n.id_tipo_notificacion,
                n.detalles,
                n.fecha,                
                u.id_usuario,
                u.nombre_usuario,
                c.nombre,
                c.id_tipo_contenido,
                c.link,
                c.src,
                c.codigo,
                c.descripcion,
                us.nombre_usuario as nombre_usuario_seguidor
            FROM notificaciones n
            LEFT JOIN c_tipo_notificaciones ct  ON n.id_tipo_notificacion   = ct.id_tipo_notificacion               
            LEFT JOIN usuarios              u   ON n.id_usuario             = u.id_usuario                              
            LEFT JOIN contenido             c   ON n.id_ref                 =  c.id_contenido AND c.id_usuario = '".$datos['id_usuario']."' AND c.status = 'A' AND c.visibilidad = 'P'
            LEFT JOIN usuarios              us  ON n.id_tipo_notificacion = '9' AND us.id_usuario = n.id_usuario            
            WHERE ct.nivel = '".$datos['nivel']."'          
            AND (
                    (n.id_usuario != '".$datos['id_usuario']."' OR n.id_usuario = 0)
                    AND n.id_ref in (   SELECT id_contenido from contenido 
                                        WHERE id_contenido = n.id_ref 
                                        AND c.id_usuario = '".$datos['id_usuario']."' 
                                        AND c.status = 'A' AND c.visibilidad = 'P' )    
                    AND  '".$datos['id_usuario']."' IN ( SELECT id_usuario FROM comentarios WHERE id_ref = n.id_ref)
                    OR n.id_ref in (
                    					SELECT id_contenido from contenido
                    					LEFT JOIN comentarios ON contenido.id_contenido = comentarios.id_ref                     					
                    					WHERE comentarios.id_usuario = '".$datos['id_usuario']."'
                    					AND comentarios.status = 'A'
                    				)

                )
                ".$filtro."
                OR (n.id_tipo_notificacion = '9' AND n.id_ref = '".$datos['id_usuario']."' ".$filtro.")
            
            ORDER BY n.id_notificacion DESC
            LIMIT 0,30";
        //echo $q; 
        return $this->db->query($q); 
    }

    function listado_notificaciones_general_mini($datos)
    {
    	if($datos['last']!= '')
        {
            $filtro = "AND n.id_notificacion > (select id_ult_not from usuarios where id_usuario = '".$datos['id_usuario']."') ";
        }

        if($datos['id_last_n']!= '')
        {
            $filtro .= " AND n.id_notificacion > '".$datos['id_last_n']."'";
        }
        
		 $q="SELECT              
                n.id_notificacion,
                n.id_ref,
                n.id_tipo_notificacion,
                n.detalles,
                n.fecha,                
                u.id_usuario,
                u.nombre_usuario,
				c.id_usuario as propietario,
                u.avatar,
                c.nombre,
                c.id_tipo_contenido,
                c.link,
                c.src,
                c.codigo,                
                CONCAT(c.descripcion,c.nombre) as descripcion,
                us.nombre_usuario as nombre_usuario_seguidor,
                us.avatar as avatar_seguidor
            FROM notificaciones n
            LEFT JOIN c_tipo_notificaciones ct  ON n.id_tipo_notificacion   = ct.id_tipo_notificacion               
            LEFT JOIN usuarios              u   ON n.id_usuario             = u.id_usuario                              
            LEFT JOIN contenido             c   ON n.id_ref                 = c.id_contenido AND c.status = 'A'
            LEFT JOIN usuarios              us  ON n.id_tipo_notificacion = '9' AND us.id_usuario = n.id_usuario             
            WHERE  
			((n.id_tipo_notificacion = '11' AND (c.descripcion LIKE '%".$datos['nombre_usuario']."%' || c.nombre LIKE '%".$datos['nombre_usuario']."%') ) 		
			OR (	n.id_ref in ( 	SELECT 
										id_contenido 
									FROM contenido 
									LEFT JOIN comentarios ON contenido.id_contenido = comentarios.id_ref 
									WHERE comentarios.id_usuario = '".$datos['id_usuario']."' 
									AND comentarios.status = 'A'
									AND contenido.id_usuario != '".$datos['id_usuario']."' 
								) 
					AND n.id_tipo_notificacion = '3'
					AND n.id_usuario != '".$datos['id_usuario']."' 
				)	
			OR
			(
				n.id_ref in ( 	SELECT id_contenido from contenido 
							WHERE id_contenido = n.id_ref 
							AND c.id_usuario = '".$datos['id_usuario']."' 
							AND c.status = 'A' 							
						)
				AND  n.id_tipo_notificacion != '9'
				AND  n.id_tipo_notificacion != '11'	
				AND u.id_usuario != '".$datos['id_usuario']."'				
			)
			OR (n.id_tipo_notificacion = '9' AND n.id_ref = '".$datos['id_usuario']."' ) 
			)
			
			".$filtro."
		ORDER BY n.id_notificacion DESC LIMIT 0,30";        
        return $this->db->query($q); 
    }

	function registrar_notificacion($datos)
	{
		$q="INSERT INTO notificaciones(
				id_tipo_notificacion,
				id_ref,
				id_usuario,
				detalles,
				fecha)
			VALUES(
				'".$datos['id_tipo_notificacion']."',
				'".$datos['id_ref']."',
				'".$datos['id_usuario']."',
				'".$datos['detalles']."',
				'".$datos['fecha']."'				
			)";
		return  $this->db->query($q);
	}

	function actualizar_ult_notificacion($datos)
	{
		$q="UPDATE usuarios SET 
				id_ult_not = '".$datos['id_ult_not']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);			
	}

	function listado_usuarios_seguir($datos)
	{
		if($datos['filtro'] != '')
		{
			$filtro = " AND ".$datos['filtro']." LIKE '%".$datos['consulta']."%' ";
		}
		
		$q="SELECT 
			u.id_usuario ,
			u.nombre_usuario,
			u.bio,
			u.peliculas,
			u.musica,
			u.videojuegos,
			u.libros,
			u.otros,
			cs.nombre_sexo,
			u.ubicacion,
			u.fecha_ult,
			si.nombre_situacion,
			(SELECT count(*) FROM seguidores 
				WHERE id_usuario_pri =  u.id_usuario 
				AND id_usuario_seg = '".$datos['id_usuario']."'
				AND status = 'A')  as siguiendo
		FROM usuarios  u						
		LEFT JOIN c_sexo cs 	ON cs.id_sexo = u.id_sexo
		LEFT JOIN c_situaciones si ON si.id_situacion = u.id_situacion
		WHERE u.status = 'A' 			           
		".$filtro;		
		return $this->db->query($q);
	}

	function listado_seguidores_usuarios($datos)
	{		
		$q="SELECT 
			u.id_usuario ,
			u.nombre_usuario,
			u.bio,
			cs.nombre_sexo,
			u.ubicacion,
			u.fecha_ult,
			(SELECT count(*) FROM seguidores 
				WHERE id_usuario_pri =  u.id_usuario 
				AND id_usuario_seg = 
									(SELECT id_usuario FROM usuarios 
										WHERE nombre_usuario = '".$datos['nombre_usuario']."' ) 
				AND status = 'A')  as siguiendo
		FROM usuarios  u			
		LEFT JOIN seguidores 	ss ON ss.id_usuario_seg = u.id_usuario 
		LEFT JOIN c_sexo 		cs ON cs.id_sexo = u.id_sexo
		WHERE ss.id_usuario_pri = (select id_usuario from usuarios WHERE nombre_usuario = '".$datos['nombre_usuario']."')			
		AND ss.status = 'A'    ";		
		return $this->db->query($q);
	}

	function listado_usuarios_siguiendo($datos)
	{
		$q="SELECT 
				u.id_usuario ,
				u.nombre_usuario,
				u.bio,				
				ss.id_usuario_pri,
                cs.nombre_sexo,
				u.ubicacion,
				u.fecha_ult
			FROM usuarios  u
			LEFT JOIN seguidores ss ON ss.id_usuario_pri = u.id_usuario AND ss.status = 'A'
            LEFT JOIN c_sexo 		cs ON cs.id_sexo = u.id_sexo
			WHERE ss.id_usuario_seg = (select id_usuario from usuarios WHERE nombre_usuario = '".$datos['nombre_usuario']."')";		
		return $this->db->query($q);
	}

	function listado_usuarios_siguiendo_mini($datos)
	{
		$q="SELECT 
				u.id_usuario ,
				u.nombre_usuario,
				u.avatar
			FROM usuarios  u
			LEFT JOIN seguidores ss ON ss.id_usuario_pri = u.id_usuario AND ss.status = 'A'            
			WHERE ss.id_usuario_seg = (select id_usuario from usuarios WHERE nombre_usuario = '".$datos['nombre_usuario']."')";		
		return $this->db->query($q);
	}

	function listado_datos_dashboard_usuario2($datos)
	{
		$q="SELECT 
			num_post as links,			
			seguidores,
			siguiendo,
			num_like as likes,
			visitas_perfil			
		FROM usuarios 
		WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function obtener_estadisticas_contenido($datos)
	{
		$q="SELECT 
				num_likes,
				num_com,
				num_rt,
				veces_visto
			FROM contenido
			WHERE id_contenido = '".$datos['id_contenido']."'";
		return $this->db->query($q);		
	}

	function actualizarEstadisticasContenido($datos)
	{
		$q="UPDATE contenido SET 
				num_likes	= '".$datos['num_likes']."',
				num_com 	= '".$datos['num_com']."',
				num_rt 		= '".$datos['num_rt']."',
				veces_visto = '".$datos['veces_visto']."'
			WHERE id_contenido = '".$datos['id_contenido']."'";
		return $this->db->query($q);				
	}	
	
	function listado_datos_dashboard_usuario($datos)
	{
		$q="SELECT 
			(select count(*) FROM contenido WHERE id_usuario = '".$datos['id_usuario']."' AND status ='A' ) as links,			
			(select count(*) from seguidores where id_usuario_pri = '".$datos['id_usuario']."' and status = 'A') as seguidores,
			(select count(*) from seguidores where id_usuario_seg = '".$datos['id_usuario']."' and status = 'A') as siguiendo,
			(select count(*) from likes where id_usuario = '".$datos['id_usuario']."' and status = 'A' ) as likes			
		FROM usuarios 
		LIMIT 0,1";
		return $this->db->query($q);
	}

	function registrar_contenido($datos)
	{
		$q="INSERT INTO contenido(				
				id_tipo_contenido,
				id_usuario,
				id_rt,
                id_categoria,
				nombre,
				descripcion,
				link, 
				src, 
				codigo,
				tags, 
				tipo_archivo,
				tamanio,
				fecha_c,
				fecha_m,
				fecha_p,
				adulto,
				fav,
				visibilidad,
				ip,
				status)
			VALUES(				
				'".$datos['id_tipo_contenido']."',
				'".$datos['id_usuario']."',
				'".$datos['id_rt']."',
                '".$datos['id_categoria']."',
				'".$datos['nombre']."',
				'".$datos['descripcion']."',
				'".$datos['link']."',
				'".$datos['src']."',
				'".$datos['codigo']."',
				'".$datos['tags']."',
				'".$datos['tipo_archivo']."',
				'".$datos['tamanio']."',
				'".$datos['fecha_c']."',
				'".$datos['fecha_m']."',
				'".$datos['fecha_p']."',
				'".$datos['adulto']."',
				'".$datos['fav']."',
				'".$datos['visibilidad']."',
				'".$datos['ip']."',
				'".$datos['status']."')";		
		return $this->db->query($q);
	}

	function actualizar_contenido($datos)
	{
		$q="UPDATE contenido SET 
				id_tipo_contenido 	= '".$datos['id_tipo_contenido']."',
                id_categoria		= '".$datos['id_categoria']."',
				nombre 				= '".$datos['nombre']."',
				descripcion 		= '".$datos['descripcion']."',
				link 				= '".$datos['link']."',					
				codigo 				= '".$datos['codigo']."',
				fecha_m 			= '".$datos['fecha_m']."',
				fecha_p 			= '".$datos['fecha_p']."',
				adulto				= '".$datos['adulto']."',						
				status 				= '".$datos['status']."'
			WHERE id_contenido = '".$datos['id_contenido']."'";
		return $this->db->query($q);
	}

	function actualizar_contenido_usuario($datos)
	{
		$q="UPDATE contenido SET 				
                id_categoria		= '".$datos['id_categoria']."',
				nombre 				= '".$datos['nombre']."',
				descripcion 		= '".$datos['descripcion']."',
				link 				= '".$datos['link']."',					
				codigo 				= '".$datos['codigo']."',
				fecha_m 			= '".$datos['fecha_m']."',				
				adulto				= '".$datos['adulto']."'
			WHERE id_contenido = '".$datos['id_contenido']."'
			AND id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function eliminar_contenido($datos)
	{
		$q="UPDATE contenido SET 				
				fecha_m 	= '".$datos['fecha_m']."',				
				status 		= '".$datos['status']."'
			WHERE id_contenido = '".$datos['id_contenido']."'
			AND id_usuario = '".$datos['id_usuario']."'" ;
		return $this->db->query($q);	
	}

	function eliminar_contenido_rt($datos)
	{
		$q="UPDATE contenido SET 				
				fecha_m 	= '".$datos['fecha_m']."',				
				status 		= '".$datos['status']."'
			WHERE id_rt = '".$datos['id_contenido']."'" ;
		return $this->db->query($q);	
	}

	

    function obtener_contenido_general($datos)
	{
		if($datos['id_usuario'] != '')
		{
			$tmp = " (c.visibilidad = 'R') OR   ";
		}

        $visibilidad = "
		AND (	
				(c.visibilidad = 'P') OR  
				(c.visibilidad = 'O' AND c.id_usuario = '".$datos['id_usuario']."')  OR 					
				".$tmp."
				(c.visibilidad = 'S' AND c.id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status = 'A')) OR
				(c.visibilidad = 'S' AND c.id_usuario = '".$datos['id_usuario']."')
			)
		";
		
		$q="SELECT 				
			c.id_contenido,
			c.id_tipo_contenido,				
			c.link,
			c.nombre,
			c.descripcion,
			c.src,
			c.tipo_archivo,
			c.tamanio,
			c.codigo,
			c.tags,
			c.adulto,				
			c.veces_visto,
			c.status,
			c.id_categoria,	
			c.visibilidad,
			u.id_usuario,
			u.avatar,
			c.fecha_p,	
			u.nombre_usuario,
			(select count(*) from comentarios WHERE id_ref = c.id_contenido and id_tipo_comentario = '1' and status = 'A' ) as comentarios,
			(SELECT count(*) FROM likes       WHERE likes.id_contenido = c.id_contenido AND status='A' ) as likes,
			(SELECT count(*) FROM contenido   WHERE id_rt = c.id_contenido AND status = 'A') as rt,
			uc.nombre_usuario as nombre_usuario_rt,
			l.id_like,
			ca.codigo_categoria,
			ca.nombre_categoria,
			ca.img,            
            (select 1 from contenido_imagenes WHERE id_contenido = c.id_contenido LIMIT 1) as multi_img
		FROM contenido c 			
		LEFT JOIN usuarios 		u  ON u.id_usuario 	= c.id_usuario
		LEFT JOIN likes 		l  ON l.id_contenido = c.id_contenido AND l.id_usuario = '".$datos['id_usuario']."' AND l.status = 'A'
		LEFT JOIN contenido 	cc ON cc.id_contenido = c.id_rt
		LEFT JOIN usuarios  	uc ON cc.id_usuario =  uc.id_usuario
		LEFT JOIN c_categorias ca ON ca.id_categoria = c.id_categoria                
		WHERE (c.status = 'A' OR c.status='P')
		".$visibilidad."
		AND c.id_contenido = '".$datos['id_contenido']."'";
		///echo $q;
		return $this->db->query($q);	
	}

	function obtener_siguiente_contenido($datos)
	{
		$q="SELECT 				
				c.id_contenido,
				c.nombre
			FROM contenido c 									
			WHERE (c.status = 'A' OR c.status='P')
			AND c.visibilidad = 'P' 
			AND c.id_contenido < '".$datos['id_contenido']."'
			AND c.reporte = 'N'		
			AND c.id_tipo_contenido != '6'
        	AND c.id_tipo_contenido != '8'
			ORDER BY c.id_contenido DESC
			LIMIT 0, 1";
			//echo $q;
			return $this->db->query($q);	
	}	
	
	function listado_sexos_activos()
	{
		$q="SELECT id_sexo,nombre_sexo FROM c_sexo WHERE status = 'A'";
		return $this->db->query($q);	
	}

	function listado_sexos()
	{
		$q="SELECT 
				id_sexo,
				nombre_sexo,
				fecha,
				status
			FROM c_sexo WHERE status = 'A'";
		return $this->db->query($q);		
	}

	function registrar_sexo($datos)
	{
		$q="INSERT INTO c_sexo (
			nombre_sexo,
			fecha,
			id_usuario,
			status)
			VALUES (
			'".$datos['nombre_sexo']."',
			'".$datos['fecha']."',
			'".$datos['id_usuario']."',
			'".$datos['status']."')";
		return $this->db->query($q);	
	}

	function registrar_correo_pendiente($datos)
	{
		$q="INSERT INTO correos_pendientes(			
			fromc,
			toc,
			asunto,
			mensaje,
			plantilla,
			tipo,
			fecha_c,
			fecha_e,
			status)
			VALUES(
				'".$datos['from']."',
				'".$datos['to']."',
				'".$datos['asunto']."',
				'".$datos['mensaje']."',
				'".$datos['plantilla']."',
				'".$datos['tipo']."',
				'".$datos['fecha_c']."',
				'".$datos['fecha_e']."',
				'".$datos['status']."')";
		return $this->db->query($q);
	}

	function listado_correos_pendientes()
	{
		$q="SELECT 
				c.id_correo_p,
				c.fromc,
				c.toc,
				c.asunto,
				c.mensaje,
				c.plantilla,
				s.per_enviar_correo
			FROM correos_pendientes c
			LEFT JOIN usuarios s ON s.correo = c.toc 
			WHERE c.status = 'P'";
		return $this->db->query($q);
	}

	function actualizar_correo_enviado($datos)
	{
		$q="UPDATE correos_pendientes SET
				status  = '".$datos['status']."',
				fecha_e = '".$datos['fecha_e']."'
			WHERE id_correo_p = '".$datos['id_correo_p']."'";
		return $this->db->query($q);
	}

	function obtener_datos_correo_seguimiento($datos)
	{
		$q="SELECT 
				nombre_usuario,
				bio,
				avatar,
				(select correo FROM usuarios where id_usuario = '".$datos['id_usuario_pri']."') as correo_usuario_destino
			FROM usuarios 
			WHERE id_usuario = '".$datos['id_usuario_seg']."'";
		return $this->db->query($q);		
	}

	function obtener_datos_correo_mensaje($datos)
	{
		$q="SELECT 
				nombre_usuario,
				bio,
				(select correo FROM usuarios where id_usuario = '".$datos['id_usuario_recibe']."') as correo_usuario_destino
			FROM usuarios 
			WHERE id_usuario = '".$datos['id_usuario_envia']."'";
		return $this->db->query($q);		
	}

	function obtener_categorias()
    {
        $q="SELECT 
                id_categoria,       
                nombre_categoria,
                descripcion,
                codigo_categoria,
                img,
                nsfw
            FROM c_categorias
            WHERE status = 'A'
            ORDER BY nombre_categoria";
        return $this->db->query($q);
    }  

    function registrar_categoria($datos)
    {
    	$q="INSERT INTO c_categorias (    			      
                nombre_categoria,
                descripcion,     
                codigo_categoria,           
                img,
                fecha,
                id_usuario,
                nsfw,
                status)
				VALUES(
					'".$datos['nombre_categoria']."',
					'".$datos['descripcion']."',
					'".$datos['codigo_categoria']."',
					'".$datos['img']."',
					'".$datos['fecha']."',
					'".$datos['id_usuario']."',
					'".$datos['nsfw']."',
					'".$datos['status']."')";
		 return $this->db->query($q);
    }

    function actualizar_categoria($datos)
    {
    	$q="UPDATE c_categorias SET 
                nombre_categoria 	= '".$datos['nombre_categoria']."',
                descripcion  		= '".$datos['descripcion']."',
                codigo_categoria  	= '".$datos['codigo_categoria']."',
                img 				= '".$datos['img']."',
                nsfw 				= '".$datos['nsfw']."',
                fecha 				= '".$datos['fecha']."'
            WHERE id_categoria = '".$datos['id_categoria']."'";
				
		 return $this->db->query($q);
    }

    function eliminar_categoria($datos)
    {
    	$q="UPDATE c_categorias SET                 
                status  	= '".$datos['status']."',
                id_usuario 	= '".$datos['id_usuario']."',
                fecha 		= '".$datos['fecha']."'
            WHERE id_categoria = '".$datos['id_categoria']."'";
				
		 return $this->db->query($q);
    }

    function obtener_datos_generales()
    {
    	$fecha_p = date("Y-m-d H:i:s",time());
    	$q="SELECT 
    			(select count(*) from contenido where status = 'A' and visibilidad = 'P') as num_con,
    			(select count(*) from usuarios where status = 'A') as num_user,
    			(select count(*) from comentarios where status = 'A') as num_comm,
    			(select count(*) from session_activa) as num_online,
    			(select count(*) from contenido WHERE status = 'A' AND fecha_p > '".$fecha_p."') as num_pub_pen,    			
                (select count(*) from contenido WHERE status = 'P' AND id_usuario ='1') as send_post
    		FROM usuarios 
    		LIMIT 0,1";
    	return $this->db->query($q);	
    }

    function obtener_grafica_7_dias()
    {
    	$q="SELECT 
    				DATE(fecha) as fecha,
    				count(*) as num_visitas
    		FROM visitas
    		GROUP BY DATE(fecha)
    		ORDER BY DATE(fecha) DESC 
    		LIMIT 0,7";
    	return $this->db->query($q);

    }

    function obtener_grafica_visitas_general($datos)
    {
        if($datos['anio'] != '')
        {
            $anio = $datos['anio'];
        }
        $q = "SELECT 
                (select count(*) from visitas WHERE fecha >= '".$anio."-01-01 00:00:00' AND fecha <= '".$anio."-01-31 23:59:59' ) as enero,
                (select count(*) from visitas WHERE fecha >= '".$anio."-02-01 00:00:00' AND fecha <= '".$anio."-02-28 23:59:59' ) as febrero,
                (select count(*) from visitas WHERE fecha >= '".$anio."-03-01 00:00:00' AND fecha <= '".$anio."-03-31 23:59:59' ) as marzo,
                (select count(*) from visitas WHERE fecha >= '".$anio."-04-01 00:00:00' AND fecha <= '".$anio."-04-30 23:59:59' ) as abril,
                (select count(*) from visitas WHERE fecha >= '".$anio."-05-01 00:00:00' AND fecha <= '".$anio."-05-31 23:59:59' ) as mayo,
                (select count(*) from visitas WHERE fecha >= '".$anio."-06-01 00:00:00' AND fecha <= '".$anio."-06-30 23:59:59' ) as junio,
                (select count(*) from visitas WHERE fecha >= '".$anio."-07-01 00:00:00' AND fecha <= '".$anio."-07-31 23:59:59' ) as julio,
                (select count(*) from visitas WHERE fecha >= '".$anio."-08-01 00:00:00' AND fecha <= '".$anio."-08-31 23:59:59' ) as agosto,
                (select count(*) from visitas WHERE fecha >= '".$anio."-09-01 00:00:00' AND fecha <= '".$anio."-09-30 23:59:59' ) as septiembre,
                (select count(*) from visitas WHERE fecha >= '".$anio."-10-01 00:00:00' AND fecha <= '".$anio."-10-31 23:59:59' ) as octubre,
                (select count(*) from visitas WHERE fecha >= '".$anio."-11-01 00:00:00' AND fecha <= '".$anio."-11-30 23:59:59' ) as noviembre,
                (select count(*) from visitas WHERE fecha >= '".$anio."-12-01 00:00:00' AND fecha <= '".$anio."-12-31 23:59:59' ) as diciembre
            FROM visitas
            LIMIT 1 OFFSET 0";
        return $this->db->query($q);
    }

    function obtener_visitas_ip($datos)
    {
        $q="SELECT 
                v.ip,
                count(*) as num_vis,
                i.nombre_ip,
                i.des
            FROM visitas v
            LEFT JOIN c_ip i ON v.ip = i.ip
            WHERE DATE(v.fecha) = '".$datos['fecha']."'
            GROUP BY v.ip
            ORDER BY num_vis DESC ";
        return $this->db->query($q);    
    }

    function obtener_ultimos_comentarios()
    {
    	$q="SELECT 
    			c.id_comentario,
    			c.id_ref,
    			c.comentario,
    			c.fecha,
    			u.nombre_usuario
    		FROM comentarios c 
    		LEFT JOIN usuarios u ON u.id_usuario = c.id_usuario
    		WHERE c.status = 'A'
    		ORDER BY id_comentario DESC
    		LIMIT 0,5";
    	return $this->db->query($q);
    }

    function actualizar_ruta_avatar($datos)
    {
    	$q="UPDATE usuarios SET
    			avatar = '".$datos['avatar']."' 
    		WHERE id_usuario = '".$datos['id_usuario']."'";
    	return $this->db->query($q);
    }	

    function count_contenido_nuevo($datos)
    {
    	$q="SELECT 
    			(select MAX(id_contenido) FROM contenido c
    				WHERE id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status ='A' )
    				AND id_contenido > '".$datos['id_last_c']."'
    				AND fecha_p <= '".$datos['fecha_p']."'
    				AND status = 'A'
				AND visibilidad = 'P'  ) as id,
				(select count(*) FROM contenido c
    				WHERE id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status ='A' )     										
    				AND id_contenido > '".$datos['id_last_c']."'
    				AND fecha_p <= '".$datos['fecha_p']."'
    				AND status = 'A'
				AND visibilidad = 'P'  ) as count
				
    		FROM usuarios
    		LIMIT 0,1";
    	return $this->db->query($q);
    }

    function obtener_tags()
	{
		$q="SELECT tags,descripcion FROM contenido where status = 'A'";
		return $this->db->query($q);
	}

	function borrar_tags()
	{
		$q="DELETE FROM tags_count";
		return $this->db->query($q);
	}

	function registrar_tag($datos)
	{
		$q="INSERT INTO tags_count(
			tags,
			valor)
			VALUES(
			'".$datos['tags']."',
			'".$datos['valor']."')";
		return $this->db->query($q);
	}

	function obtener_nube_tags()
	{
	   $q="SELECT tags,valor FROM tags_count ORDER BY valor DESC LIMIT 0,150";
	   return $this->db->query($q);
	}

	function obtener_nube_tags_comp()
	{
	   $q="SELECT tags,valor FROM tags_count ORDER BY valor DESC ";
	   return $this->db->query($q);
	}

	function permitir_nsfw($datos)
	{
		$q="UPDATE usuarios SET 
				per_nsfw = '".$datos['per_nsfw']."'
			WHERE id_usuario = '".$datos['id_usuario']."' ";
                //echo $q;
		return $this->db->query($q);
	}

	function obtener_fecha_ult_publicacion()
	{
		$q="SELECT MAX(fecha_p) as fecha_u FROM contenido WHERE id_usuario = '".$_SESSION['s']['id_usuario']."'";
		return $this->db->query($q);
	}

    

    

	function obtener_usuario_token($datos)
	{
		$q="SELECT 
				id_usuario
			FROM usuarios 
			WHERE token ='".$datos['token']."'";

		return $this->db->query($q);
	}

    function obtener_paginas_visitas_ip($datos)
    {
        $q="SELECT 
            v.fecha,
            v.page,          
            v.nav,
            u.nombre_usuario
            FROM visitas v
            LEFT JOIN usuarios u ON v.id_usuario = u.id_usuario
            WHERE v.ip = '".$datos['ip']."'
            AND DATE(v.fecha) = '".$datos['fecha']."'
            ORDER BY v.fecha DESC
            ";
        return $this->db->query($q);
    }

    function obtener_fechas_visitas_ip($datos)
    {
        $q="SELECT
            count(*) as visitas,
            DATE(fecha) as fecha
            FROM visitas
            WHERE ip = '".$datos['ip']."'
            GROUP BY DATE(fecha)
            ORDER BY fecha DESC";
        return $this->db->query($q);
    }


    function ranking_usuarios()
	{
		$q="SELECT 
				u.id_usuario,
				u.nombre_usuario, 
				u.avatar, 
				count(*) as publicaciones 
			FROM usuarios u 
			LEFT JOIN contenido c ON u.id_usuario =  c.id_usuario
			WHERE u.status = 'A'
			AND u.nombre_usuario != 'pr0nx'
			AND u.nombre_usuario != 'tetasHD'
			AND u.nombre_usuario != 'diego'
			GROUP BY u.id_usuario
			ORDER BY publicaciones DESC
			LIMIT 0,10  ";
		return $this->db->query($q);
	}

	function obtener_ID_usuario_nombre($datos)
	{
		$q="SELECT id_usuario FROM usuarios WHERE nombre_usuario = '".$datos."' LIMIT 0,1";
		$r = $this->db->query($q);
		if($r->size() > 0)
		{
			$rec = $r->fetch();
			return $rec['id_usuario'];
		}
		return 0;

	}

	function registrar_busqueda($datos)
	{
		$q="INSERT INTO busquedas(
				consulta,
				nav,
				id_usuario,
				ip,
				fecha)	
				VALUES(
				'".$datos['consulta']."',
				'".$datos['nav']."',
				'".$datos['id_usuario']."',
				'".$datos['ip']."',
				'".$datos['fecha']."')";
		return $this->db->query($q);
	}


	function listado_comentarios_general($datos)
	{
		if($datos['id_usuario'] != '')
		{
			$filtro = " AND cm.id_usuario = '".$datos['id_usuario']."' ";
		}
		
        $q="SELECT                              
                u.nombre_usuario,				
                u.avatar,
                c.nombre,
                c.id_contenido,
                c.id_tipo_contenido,
                c.link,
                c.src,
                c.codigo,
                c.descripcion,
                cm.comentario,
                cm.fecha
            FROM comentarios cm            
            LEFT JOIN contenido c   ON cm.id_ref     = c.id_contenido 
            LEFT JOIN usuarios  u   ON cm.id_usuario  = u.id_usuario                                  
            WHERE c.status ='A'
            AND cm.status = 'A'
            ".$filtro."
            ORDER by cm.id_comentario DESC
            LIMIT 0,50";
        return $this->db->query($q); 
	}

	 function obtener_veces_visto_publicacion($datos)
    {
        $q="SELECT veces_visto FROM contenido WHERE id_contenido = '".$datos['id_contenido']."'";
        return $this->db->query($q);
    }   

    function actualizar_veces_visto_publicacion($datos)
    {
        $q="UPDATE contenido  SET 
                veces_visto = '".$datos['veces_visto']."'
            WHERE id_contenido = '".$datos['id_contenido']."'";
        return $this->db->query($q);
    }

    function obtener_busquedas()
    {
    	$q="SELECT 
    			consulta,
    			count(*) as num_q
    		FROM busquedas
    		GROUP BY consulta
    		ORDER BY num_q DESC";
    	return $this->db->query($q);
    }

    function obtener_frases()
    {
    	$q="SELECT id_frase,frase FROM frases_random WHERE status = 'A'";
    	return $this->db->query($q);
    }


    function registrar_frase($datos)
    {
    	$q="INSERT INTO frases_random(
    			frase,
    			fecha,
    			id_usuario,
    			status)
				VALUES(
				'".$datos['frase']."',
				'".$datos['fecha']."',
				'".$datos['id_usuario']."',
				'".$datos['status']."')";
		return $this->db->query($q);
    }

    function actualizar_frase($datos)
    {
    	$q="UPDATE frases_random SET 
    			frase = '".$datos['frase']."',
    			fecha = '".$datos['fecha']."'
    		WHERE id_frase = '".$datos['id_frase']."'";
		return $this->db->query($q);
    }

    function eliminar_frase($datos)
    {
    	$q="UPDATE frases_random SET 
    			status 	= '".$datos['status']."',
    			fecha 	= '".$datos['fecha']."'
    		WHERE id_frase = '".$datos['id_frase']."'";
		return $this->db->query($q);
    }

    function obtener_max_frases()
    {
    	$q="SELECT MAX(id_frase) as max FROM frases_random WHERE status = 'A'";
    	return $this->db->query($q);
    }

    function obtener_frase_id($id)
    {
    	$q="SELECT 
    			frase 
    		FROM frases_random 
    		WHERE id_frase = '".$id."'
    		AND status = 'A'";    	
    	return $this->db->query($q);	
    }

    function cambiar_dashboard($datos)
    {
    	$q="UPDATE usuarios SET 
    			tipo_dash = '".$datos['tipo_dash']."'
    		WHERE id_usuario = '".$datos['id_usuario']."'";
    	//echo $q;
    	return $this->db->query($q);	
    }

   
	function count_categorias()
	{
		$q="SELECT 
				cat.nombre_categoria,
				cat.codigo_categoria,
				cat.descripcion,
				cat.img,
				cat.nsfw, 
				(select count(*) from contenido where id_categoria = cat.id_categoria AND status = 'A') as num
			FROM c_categorias cat 
			WHERE cat.status = 'A'
			AND cat.nsfw != 'S' 
			AND (select count(*) from contenido where id_categoria = cat.id_categoria AND status = 'A') > 0
			ORDER BY num DESC ";
		return $this->db->query($q);
	}

	function obtener_publicidad($datos)
	{
		$q="SELECT 
				id_publicidad,
				link_ref,
				src
			FROM publicidad 
			WHERE fecha_inicio <= '".$datos['fecha']."'
			AND   fecha_fin    >= '".$datos['fecha']."'
			AND   status   		= '".$datos['status']."'";
		
		return $this->db->query($q);	
	}

	function registrar_visita_publicidad($datos)
	{
		$q="INSERT INTO publicidad_visitas(
				id_publicidad,
				ip,
				page_src,
				nav,
				fecha,
				tipo_canal,
				id_usuario)
				VALUES(
				'".$datos['id_publicidad']."',
				'".$datos['ip']."',
				'".$datos['page_src']."',
				'".$datos['nav']."',
				'".$datos['fecha']."',
				'".$datos['tipo_canal']."',
				'".$datos['id_usuario']."')";
		return $this->db->query($q);
	}

	function obteneter_publicidad_general()
	{
		$q="SELECT 
				p.nombre_publicidad,
				p.cliente,
				p.id_publicidad,
				p.link_ref,
				p.fecha_inicio,
				p.fecha_fin,
				p.monto,
				(select count(*) from publicidad_visitas WHERE id_publicidad = p.id_publicidad) as visitas
			FROM publicidad p
			WHERE p.status   		= 'A'";
			
		return $this->db->query($q);
	}

	function obtener_pasatiempos_usuario($datos)
	{
		$q="SELECT 
				peliculas,
				musica,
				libros,
				videojuegos,
				otros
			FROM usuarios 
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function actualizar_pasatiempos_usuario($datos)
	{
		$q="UPDATE usuarios SET 
				peliculas 	= '".$datos['peliculas']."',
				musica 		= '".$datos['musica']."',
				libros 		= '".$datos['libros']."',
				videojuegos = '".$datos['videojuegos']."',
				otros 		= '".$datos['otros']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	function obtener_situaciones_sentimentales()
	{
		$q="SELECT 
				id_situacion,
				nombre_situacion
			FROM c_situaciones
			WHERE status = 'A'";

		return $this->db->query($q);
	}
	

	function listado_ip_bloquedas()
	{
		$q="SELECT 
				id_bloqueo_ip,
				ip,
				motivo, 
				fecha
			FROM bloqueos_ip";
		return $this->db->query($q);		
	}	

	function marcar_contenido_adulto($datos)
	{
		$q="UPDATE contenido SET 
				adulto = '".$datos['adulto']."'
			WHERE id_contenido = '".$datos['id_contenido']."'";
		return $this->db->query($q);
	}
	/***************************************************************************
	*
	*   S I S T E M A           D E           I N B O X 
	*
	****************************************************************************/
	function registrar_inbox($datos)
	{
		$q="INSERT INTO inbox(
			id_usuario_e,
			id_usuario_r,
			mensaje,
			src, 
			tamanio,
			tipo_archivo,
			fecha_envio,
			fecha_visto,			
			status_m,
			status)
			VALUES(
			'".$datos['id_usuario_e']."',
			'".$datos['id_usuario_r']."',
			'".$datos['mensaje']."',
			'".$datos['src']."',
			'".$datos['tamanio']."',
			'".$datos['tipo_archivo']."',
			'".$datos['fecha_envio']."',			
			'".$datos['fecha_mod']."',
			'".$datos['status_m']."',
			'".$datos['status']."')";
		return $this->db->query($q);
	}

	function listado_usuarios_inbox($datos)
	{
		$q="SELECT 
				id_usuario,
				nombre_usuario,				
				avatar,
				bio,
				fecha_ult
			FROM usuarios 
			WHERE id_usuario != '".$datos['id_usuario']."'			
			AND status = 'A'
			ORDER BY fecha_ult DESC";
		return $this->db->query($q);
	}

	function listado_conversacion_anterior_usuario($datos)
	{
		$q="SELECT 	
				i.id_inbox,
				i.mensaje, 
				i.src, 
				i.tamanio, 
				i.fecha_envio, 
				i.fecha_visto,
				i.status_m,
				i.id_usuario_r,
				i.id_usuario_e 		as id_usuario_envia,
				ue.nombre_usuario 	as usuario_envia,
				ue.nombre_usuario, 				
				ue.avatar  			as avatar_usuario_envia
			FROM inbox i 
			INNER JOIN usuarios ue ON i.id_usuario_e = ue.id_usuario
			WHERE ((i.id_usuario_r = '".$datos['id_usuario_r']."' AND i.id_usuario_e = '".$datos['id_usuario_e']."') OR 
					(i.id_usuario_r = '".$datos['id_usuario_e']."' AND i.id_usuario_e = '".$datos['id_usuario_r']."')
				  )
			AND i.status = 'A'			
			".$filtro."			
			ORDER BY i.id_inbox ";
		return $this->db->query($q);
	}

	function listado_inbox_sin_leer_general($datos)
	{
		$q="SELECT 	
				i.id_inbox,
				i.mensaje, 
				i.src, 
				i.tamanio, 
				i.fecha_envio, 
				i.fecha_visto,
				i.status_m,
				i.id_usuario_r,
				i.id_usuario_e 		as id_usuario_envia,				
				ue.nombre_usuario,
				ue.avatar  			as avatar_usuario_envia
			FROM inbox i 
			INNER JOIN usuarios ue ON i.id_usuario_e = ue.id_usuario
			WHERE i.id_usuario_r = '".$datos['id_usuario_r']."'
			AND i.status = 'A'
			AND i.status_m = 'E'
			AND i.id_inbox > ".$datos['id_inbox_max']."
			".$filtro."			
			ORDER BY i.id_inbox 
			".$datos['limit'];
		return $this->db->query($q);
	}

	function eliminar_inbox($datos)
	{
		$q="UPDATE inbox SET 
				status 		= '".$datos['status']."'				
			WHERE id_inbox 	= '".$datos['id_inbox']."' ";
		return $this->db->query($q);
	}

	function marcar_visto_inbox($datos)
	{
		$q="UPDATE inbox SET 
				status_m 	= '".$datos['status_m']."',
				fecha_visto = '".$datos['fecha_visto']."'
			WHERE id_inbox 	<= '".$datos['id_inbox']."' ";
		return $this->db->query($q);	
	}

	function listado_inbox_general($datos)
	{
		if($datos['id_usuario_e'] != '')
		{
			$filtro = " AND i.id_usuario_e = '".$datos['id_usuario_e']."' ";
		}

		$q="SELECT 	
				i.id_inbox,
				i.mensaje, 
				i.src, 
				i.tamanio, 
				i.fecha_envio, 
				i.fecha_visto,
				i.status_m,
				i.id_usuario_e 		as id_usuario_envia,
				ue.nombre_usuario 	as usuario_envia,
				ue.avatar  			as avatar_usuario_envia
			FROM inbox i 
			INNER JOIN usuarios ue ON i.id_usuario_e = ue.id_usuario
			WHERE i.id_usuario_r = '".$datos['id_usuario_r']."'
			AND i.status = 'A'
			".$filtro."			
			ORDER BY i.id_inbox DESC
			".$datos['limit'];
		return $this->db->query($q);	
	}

	function listado_inbox_general_sin_leer($datos)
	{
		if($datos['id_usuario_e'] != '')
		{
			$filtro = " AND i.id_usuario_e = '".$datos['id_usuario_e']."' ";
		}

		$q="SELECT 	
				i.id_inbox,
				i.mensaje, 
				i.src, 
				i.tamanio, 
				i.fecha_envio, 
				i.fecha_visto,
				i.status_m,
				i.id_usuario_e 		as id_usuario_envia,
				ue.nombre_usuario 	as usuario_envia,
				ue.avatar  			as avatar_usuario_envia
			FROM inbox i 
			INNER JOIN usuarios ue ON i.id_usuario_e = ue.id_usuario
			WHERE i.id_usuario_r = '".$datos['id_usuario_r']."'
			AND i.status = 'A'
			AND i.status_m = 'E'
			".$filtro."			
			ORDER BY i.id_inbox DESC
			".$datos['limit'];	
		return $this->db->query($q);
	}

	function listado_inbox_enviados_general($datos)
	{	
		$q="SELECT 	
				i.id_inbox,
				i.mensaje, 
				i.src, 
				i.tamanio, 
				i.fecha_envio, 
				i.fecha_visto,
				i.status_m,
				i.id_usuario_e 		as id_usuario_envia,
				ue.nombre_usuario 	as usuario_envia,
				ue.avatar  			as avatar_usuario_envia
			FROM inbox i 
			INNER JOIN usuarios ue ON i.id_usuario_e = ue.id_usuario
			WHERE i.id_usuario_e = '".$datos['id_usuario_e']."'
			AND i.status = 'A'
			".$filtro."			
			ORDER BY i.id_inbox DESC
			".$datos['limit'];
		return $this->db->query($q);	
	}

	function count_inbox_general($datos)
	{
		$q="SELECT 	
				count(*) as num_men,
				(select max(id_inbox) from inbox where id_usuario_r = '".$datos['id_usuario_r']."' AND status_m = 'E' AND status = 'A') as id_inbox_max
			FROM inbox i 			
			WHERE i.id_usuario_r = '".$datos['id_usuario_r']."'
			AND i.id_inbox > ".$datos['id_inbox']."
			AND i.status_m = 'E'
			AND i.status = 'A'";	
		return $this->db->query($q);	
	}

	function obtener_inbox($datos)
	{
		$q="SELECT 	
				i.id_inbox,
				i.mensaje, 
				i.src, 
				i.tamanio, 
				i.fecha_envio, 
				i.fecha_visto,
				i.status_m,
				ue.nombre_usuario as usuario_envia			
			FROM inbox i 
			INNER JOIN usuarios ue ON i.id_usuario_e = ue.id_usuario
			WHERE i.id_inbox =  '".$datos['id_inbox']."'
			AND i.id_usuario_r = '".$datos['id_usuario_r']."'";		
		return $this->db->query($q);
	}

	function actualizar_img_like($datos)
	{
		$q="UPDATE usuarios SET 
				img_like = '".$datos['img_like']."'
			WHERE id_usuario ='".$datos['id_usuario']."' ";
		return $this->db->query($q);
	}

	function registrar_contenido_imagenes($datos)
	{
		$q="INSERT INTO contenido_imagenes(
				id_contenido,
				src,
				tipo_archivo,
				tamanio)
			VALUES(
			'".$datos['id_contenido']."',
			'".$datos['src']."',
			'".$datos['tipo_archivo']."',
			'".$datos['tamanio']."')"; 
		return $this->db->query($q);

	}

	function obtener_cuentas_usuario($datos)
	{
		$q="SELECT 
				sc.id_usuario_sec,								
				u.nombre_usuario,				
				u.bio,
				u.avatar,				
				u.fecha_ult
			FROM sub_cuentas sc 
			LEFT JOIN usuarios u ON sc.id_usuario_sec = u.id_usuario
			WHERE sc.id_usuario_prin = '".$datos['id_usuario_prin']."'";
		return $this->db->query($q);
	}

	function valida_cuenta_primaria_secuendaria($datos)
	{
		$q="SELECT 1
			FROM sub_cuentas sc 			
			WHERE sc.id_usuario_prin = '".$datos['id_usuario_prin']."'
			AND sc.id_usuario_sec = '".$datos['id_usuario_sec']."'
			AND sc.status = 'A'";
		return $this->db->query($q);
	}

	function registra_sub_cuenta($datos)
	{
		$q="INSERT INTO sub_cuentas(
			id_usuario_prin,
			id_usuario_sec,
			fecha_reg,
			fecha_mod,
			status)
			VALUES(
			'".$datos['id_usuario_prin']."',
			'".$datos['id_usuario_sec']."',
			'".$datos['fecha_reg']."',
			'".$datos['fecha_mod']."',
			'".$datos['status']."')";
		return $this->db->query($q);
	}




	function calcularMinMaxIDpublicaciones()
	{
		$q="SELECT 
				MIN(id_contenido) as min, 
				MAX(id_contenido) as max
			FROM contenido  c
			WHERE c.status = 'A'
			AND ((c.visibilidad = 'P') OR  
					(c.visibilidad = 'O' AND c.id_usuario = '".$datos['id_usuario']."')  OR 					
					(c.visibilidad = 'R') OR  
					(c.visibilidad = 'S' AND c.id_usuario IN (select id_usuario_pri FROM seguidores where id_usuario_seg = '".$datos['id_usuario']."' AND status = 'A')) OR
					(c.visibilidad = 'S' AND c.id_usuario = '".$datos['id_usuario']."')
				)
			AND c.reporte = 'N'
			AND c.id_tipo_contenido != '6'
        	AND c.id_tipo_contenido != '8' ";
		return $this->db->query($q);
	}


	function actualizar_avatar_predeterminado_usuario($datos)
	{
		$q="UPDATE usuarios SET  
				avatar = '".$datos['avatar']."'
			WHERE id_usuario = '".$datos['id_usuario']."'";
		return $this->db->query($q);
	}

	# NUMERO DE LINEAS INICIALES 4729
	# NUMERO DE LINEAS FINALES   2745
	
}
?>