<?php
	class sistema_controlador extends Sistema
	{
		function __construct($db)
		{
			parent::__construct($db);
		}
		/*************************************************************
		*	BLOQUES
		*
		*	1).- Usuarios 		#BLOQUE_USER
		*	2).- publicaciones 	#PUBLICACIONES
		*	3).- Comentarios   	#COMENTARIOS
		*
		*
		*
		*
		*
		*
		*************************************************************/


		/*************************************************************
		*	
		*
		*	#BLOQUE_USER		
		*
		*
		**************************************************************/	






		#*****************************************************************************
		# Descripcion	: Funcion que realiza el inicio de session 			
		# Parametros 	: cod_usuario, password 
		# salida		: codigo, mensaje 
		# Autor 		: Diego Guerra
		# fecha ultmod 	: 2013/03/27
		#*****************************************************************************
		function iniciarSession($datos)
		{
			$data = array();

			$valores['nombre_usuario']  = $datos['nombre_usuario'];
			$valores['password'] 	 = md5($datos['password']);

			$resultado = $this->obtenerDatosUsuario($valores);
			if($resultado->size()>0)
			{
				$rec = $resultado->fetch();
				//session_destroy();
				unset($_SESSION['ss']);
				$_SESSION['s'] = array();

				$_SESSION['s'] = array();
			    $_SESSION['s']['id_usuario']  		= $rec['id_usuario'];
			    $_SESSION['s']['nombre_usuario']    = $rec['nombre_usuario'];			    			    
			    $_SESSION['s']['tema']   			= $rec['tema'];
			    $_SESSION['s']['tipo_usuario']   	= $rec['tipo_usuario'];
			    $_SESSION['s']['avatar']			= $rec['avatar'];
			    $_SESSION['s']['id_last_n']			= $rec['id_ult_not'] ;
			    $_SESSION['s']['per_nsfw']			= $rec['per_nsfw'];
			    $_SESSION['s']['fondo_web']			= $rec['fondo_web'];
			    $_SESSION['s']['desp_inf']			= $rec['desp_inf'];			    
			    $_SESSION['s']['vis_def']			= $rec['visibilidad_default'];			    
			    $_SESSION['s']['id_usuario_prin']	= $rec['id_usuario'];
			    
			    if($datos['det']=='new')
			    {
			    	$_SESSION['s']['new'] = 'S';
			    }

			    if($_SESSION['s']['id_last_n'] == '')
			    {
			    	$_SESSION['s']['id_last_n'] = 0;
			    }
			    if($_SESSION['s']['id_last_c'] == '')
			    {
			    	$_SESSION['s']['id_last_c'] = 0;
			    }

			    $tmp['id_usuario'] 		= $rec['id_usuario'];
			    $tmp['fecha_ult']		= date("Y-m-d H:i:s",time());
			    $tmp['token_session']	= md5(uniqid(md5(time())));

			    $t = $this->actualizarSessionToken($tmp);

			    $t2 = $this->actualizar_fecha_ingreso($tmp);

			    if($t['codigo'] == '000')
			    {
			    	$_SESSION['s']['token']	= $tmp['token_session'];
			    }
			    
		        $data['mensaje'] = 'Ingreso exitoso!';
				$data['codigo']  = '000';
			}
			else
			{
				$data['mensaje'] = 'No se encontro el usuario en la base de datos';
				$data['codigo'] = '001';
			}
			return $data;
		}

		#*****************************************************************************
		# Descripcion	: Funcion que realiza el inicio de session con cookies		
		# Parametros 	: token_session
		# salida		: codigo, mensaje 
		# Autor 		: Diego Guerra
		# fecha ultmod 	: 2016/03/26
		#*****************************************************************************
		function iniciarSessionToken($datos)
		{
			$valores['token_session'] = $datos['token_session'];

			$resultado = $this->obtener_datos_usuario_token($valores);

			if($resultado->size()>0)
			{
				$rec = $resultado->fetch();
				
				unset($_SESSION['ss']);				

				$_SESSION['s'] = array();
			    $_SESSION['s']['id_usuario']  		= $rec['id_usuario'];
			    $_SESSION['s']['nombre_usuario']    = $rec['nombre_usuario'];			    
			    $_SESSION['s']['tema']   			= $rec['tema'];
			    $_SESSION['s']['tipo_usuario']   	= $rec['tipo_usuario'];
			    $_SESSION['s']['avatar']			= $rec['avatar'];
			    $_SESSION['s']['id_last_n']			= $rec['id_ult_not'] ;
			    $_SESSION['s']['per_nsfw']			= $rec['per_nsfw'];			    
			    $_SESSION['s']['desp_inf']			= $rec['desp_inf'];
			    $_SESSION['s']['token']				= $valores['token_session'];			    
			    $_SESSION['s']['vis_def']			= $rec['visibilidad_default'];			    
			    $_SESSION['s']['id_usuario_prin']	= $rec['id_usuario'];
			    
			    if($datos['det']=='new')
			    {
			    	$_SESSION['s']['new'] 			= 'S';
			    }

			    if($_SESSION['s']['id_last_n'] == '')
			    {
			    	$_SESSION['s']['id_last_n'] = 0;
			    }
			    if($_SESSION['s']['id_last_c'] == '')
			    {
			    	$_SESSION['s']['id_last_c'] = 0;
			    }

			    if($t['codigo'] == '000')
			    {
			    	$_SESSION['s']['token']	= $tmp['token_session'];
			    }
			    
		        $data['mensaje'] = 'Ingreso exitoso!';
				$data['codigo']  = '000';
			}
			else
			{
				$data['mensaje'] = 'No se encontro el usuario en la base de datos';
				$data['codigo'] = '001';
			}
			return $data;
	}

	#*****************************************************************************
	# Descripcion	: Funcion que regresa la url del tema del usuario		
	# Parametros 	: 
	# salida		: ruta tema
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerTemaSistema()
	{
		switch ($_SESSION['s']['tema']) 
	    {
	        case '1' : $tema_css = 'css/temas/bootstrap_cerulean.css';      break;
	        case '2' : $tema_css = 'css/temas/bootstrap_cosmo.css';         break;
	        case '3' : $tema_css = 'css/temas/bootstrap_cyborg.css';        break;
	        case '4' : $tema_css = 'css/temas/bootstrap_darkly.css';        break;
	        case '5' : $tema_css = 'css/temas/bootstrap_flatly.css';        break;
	        case '6' : $tema_css = 'css/temas/bootstrap_journal.css';       break;
	        case '7' : $tema_css = 'css/temas/bootstrap_lumen.css';         break;
	        case '8' : $tema_css = 'css/temas/bootstrap_paper.css';         break;
	        case '9' : $tema_css = 'css/temas/bootstrap_readable.css';      break;
	        case '10': $tema_css = 'css/temas/bootstrap_sandstone.css';     break;
	        case '11': $tema_css = 'css/temas/bootstrap_simplex.css';       break;
	        case '12': $tema_css = 'css/temas/bootstrap_slate.css';         break;
	        case '13': $tema_css = 'css/temas/bootstrap_spacelab.css';      break;
	        case '14': $tema_css = 'css/temas/bootstrap_superhero.css';     break;
	        case '15': $tema_css = 'css/temas/bootstrap_united.css';        break;
	        case '16': $tema_css = 'css/temas/bootstrap_yeti.css';          break;                
	        default  : $tema_css = 'css/temas/bootstrap_united.css';                  break;
	    }

	    return $tema_css;
	}
	
	#*****************************************************************************
	# Descripcion	: Actualiza el token de la session cuando se crea una session nueva
	# Parametros 	: id_usuario, token_session
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function actualizarSessionToken($datos)		
	{
		$valores['id_usuario'] 		= $datos['id_usuario'];
		$valores['token_session']	= $datos['token_session'];

		$r = $this->actualizar_session_token($valores);

		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Actualizacion de token de session';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al actualizar token session';	
		}

		return $data;
	}
	
	#*****************************************************************************
	# Descripcion	: Actualiza el token de la session cuando se crea una session nueva
	# Parametros 	: id_usuario, token_session
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function EnviarRecuperacionPass($datos)
	{
		$data = array();

		$datos = $this->limpiar($datos);
		
		$valores['correo'] 		= $datos['txtcorreo'];			
		
		$resultado= $this->validarCorreoUsuarioAjax($valores);

		if($resultado['codigo'] == '003')			
		{
			
			$valores['fecha_ult']  	= date('Y-m-d H:i:s',time());		
			$valores['token']		= md5(time().'123456');

			$r2 = $this->registrar_correo_recuperacion($valores);
			
			if($r2->affectedRows() > 0)
			{
				$tmp = $this->EnviarCorreoRecuperacionPass($valores);
				$data['codigo']  = '000';
				$data['mensaje'] = 'Se ha enviado a su correo, favor de seguir las instrucciones.';
			}
			else
			{
				$data['codigo']  = '001';
				$data['mensaje'] = 'Ha ocurrio un error';	
			}
		}
		else
		{
			$data['codigo']  = '002';
			$data['mensaje'] = 'El correo no pertenece a ningun usuario';	
		}

		return $data;

	}

	#*****************************************************************************
	# Descripcion	: Esta funcion si el usuario esta online o offline con la tabla session_activa
	# Parametros 	: 
	# salida		: 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function validarSessionActiva()
	{
		// fecha hace 10 minutos
		$minutos = 1200;
		$time  = time() - $minutos;
		$valores['fecha']		= date('Y-m-d H:i:s',time());
		$valores['fecha_limite']= date('Y-m-d H:i:s',$time);
		$valores['id_usuario']	= $_SESSION['s']['id_usuario'];

		if($valores['id_usuario'] != '')
		{
			// valida que exista en la tabla session_Activa
			$r = $this->validar_session_activa($valores);


			if($r->size() > 0 )
			{
				// si existe actualiza el tiempo 	
				$r2 = $this->actualizar_session_activa($valores);
			}
			else
			{
				// Si no existe elimina el registro
				$r2 = $this->insertar_session_activa($valores);
			}	
		}
		// elimina todos los registros con mas de 10 minutos
		$r = $this->eliminar_session_activa($valores);

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Se cambio a offline el usuario
	# Parametros 	: 
	# salida		: 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function terminarSessionActiva()
	{
		$valores['id_usuario']	= $_SESSION['s']['id_usuario'];
		$r = $this->eliminar_session_activa_manual($valores);
	}

	#*****************************************************************************
	# Descripcion	: Funcion general para crear un usuario nuevo
	# Parametros 	: nombre_usuario,password,correo
	# salida		: codigo,mensaje
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function registrarUsuario($datos)
	{
		$valores['tipo_usuario']	= '1';
		$valores['nombre_usuario'] 	= $datos['txnombre_usuario'];
		$valores['password']		= md5($datos['txt_new_pass']);
		$valores['pass']			= $datos['txt_new_pass'];
		$valores['correo']			= $datos['txt_correo'];
		$valores['fecha_reg']		= date('Y-m-d',time());
		$valores['tema']			= '1';			
		$valores['status']			= 'A';
        $valores['avatar']          = 'http://redgalaxy.org/img/user.png';
		$valores['fecha_ult']		= date('Y-m-d H:i:s',time());
		$valores['id_ref']			= $datos['txt_id_ref'];
		$valores['img_like']		= 'img/like.png';

		$r =  $this->validar_nombre_usuario_nuevo($valores);

		if($r->size()> 0)
		{
			$data['codigo']  = '005';
			$data['mensaje'] = 'El usuario ya se encuentra registrado';					
			return $data;
		}

		
		$r2 = $this->validar_correo_usuario_nuevo($valores);

		if($r2->size() > 0)
		{
			$data['codigo']  = '005';
			$data['mensaje'] = 'El correo ya se encuentra registrado';
			return $data;
		}



		if($valores['nombre_usuario'] == '')
		{
			$valores['nombre_usuario'] = $this->generar_nombre_random();	
		}

		$resultado = $this->registrar_usuario($valores);
		if($resultado->affectedRows() > 0)
		{
			$this->enviar_correo_nuevo_usuario($valores);
			$this->enviar_correo_nuevo_usuario2($valores);
			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro de usuario exitoso :D';

			$data['nombre_usuario'] = $valores['nombre_usuario'];
			$data['password'] 		= $valores['password'];
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar usuario D:';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Funcion  para crear una subcuenta
	# Parametros 	: nombre_usuario,password,correo
	# salida		: codigo,mensaje
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function registrarUsuarioSubCuenta($datos)
	{
		$valores['tipo_usuario']	= '4';// sub cuenta
		$valores['nombre_usuario'] 	= $datos['txnombre_usuario'];
		$valores['password']		= md5($datos['txt_new_pass']);
		$valores['pass']			= $datos['txt_new_pass'];
		
		$valores['fecha_reg']		= date('Y-m-d',time());
		$valores['tema']			= '1';			
		$valores['status']			= 'A';
        $valores['avatar']          = 'img/user.png';
		$valores['fecha_ult']		= date('Y-m-d H:i:s',time());
		$valores['id_ref']			= $datos['txt_id_ref'];
		$valores['img_like']		= 'img/like.png';

		$tmp['id_usuario']			= $_SESSION['s']['id_usuario'];
		$user 						= $this->obtenerCorreoIDUsuario($tmp);
		$valores['correo']			= $user['correo'];

		$r =  $this->validar_nombre_usuario_nuevo($valores);

		if($r->size()> 0)
		{
			$data['codigo']  = '005';
			$data['mensaje'] = 'El usuario ya se encuentra registrado';					
			return $data;
		}		

		if($valores['nombre_usuario'] == '')
		{
			$valores['nombre_usuario'] = $this->generar_nombre_random();	
		}

		$resultado = $this->registrar_usuario($valores);
		if($resultado->affectedRows() > 0)
		{
			$this->enviar_correo_nuevo_usuario($valores);
			$this->enviar_correo_nuevo_usuario2($valores);

			$valores['id_usuario'] = $resultado->insertID();

			$tmp = $this->registraSubcuenta($valores);

			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro de usuario exitoso :D';

			$data['nombre_usuario'] = $valores['nombre_usuario'];
			$data['password'] 		= $valores['password'];
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar usuario D:';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Registra la sub cuenta en la tabla sucuentas para ligar los usuarios
	# Parametros 	: id_usuario_principal,id_usuario_secundario
	# salida		: codigo,mensaje
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function registraSubcuenta($datos)
	{
		$valores['id_usuario_prin'] = $_SESSION['s']['id_usuario_prin'];
		$valores['id_usuario_sec']	= $datos['id_usuario'];
		$valores['fecha_reg']		= date('Y-m-d H:i:s',time());
		$valores['fecha_mod']		= date('Y-m-d H:i:s',time());
		$valores['status']			= 'A';

		$valida = $this->valida_cuenta_primaria_secuendaria($valores);

		if($valida->size() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Ya existe la sub cuenta';
			return $data;
		}

		$r = $this->registra_sub_cuenta($valores);

		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Se registrado la subcuenta exitosamente';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error';	
		}

		return $data;
	}


	#*****************************************************************************
	# Descripcion	: Genera un nombre de usuario random
	# Parametros 	: 
	# salida		: nombre_random
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function generar_nombre_random()
	{
		$nombre_valido = true;
		while ($nombre_valido)
		{
			$valores['nombre_usuario'] ="anon".substr(rand(1,time()),6);
			$tmp = $this->validar_nombre_usuario_nuevo($valores);
			if($tmp->size() > 0)
			{
				$nombre_valido = true;
			}
			else
			{
				$nombre_valido = false;
			}
		}


		return $valores['nombre_usuario'];
		


	}

	

	#*****************************************************************************
	# Descripcion	: Actualiza el password del usuario
	# Parametros 	: cod_usuario, password, password nuevo
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2014/02/17
	#*****************************************************************************
	function actualizarPassword($datos)
	{
		$valores['cod_usuario'] 	= $_SESSION['s']['cod_usuario'];
		$valores['password_actual']	= md5($datos['txtpassword']);
		$valores['password_nuevo'] 	= md5($datos['txtconfirmarpassword']);

		$resultado = $this->actualizar_password_general($valores);
		if($resultado->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Se ha actualizado el password de maneja exitosa';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al actualizar el password';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Actualiza el password opcion para administradores
	# Parametros 	: cod_usuario, password 
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2014/02/17
	#*****************************************************************************
	function actualizarPassAdmin($datos)
	{
		$valores['id_usuario'] 	= $datos['id'];
		$valores['password']	= md5($datos['pass']);			

		$resultado = $this->actualizar_password($valores);
		
		if($resultado->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Se ha actualizado el password de manera exitosa';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al actualizar el password';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Valida que el nombre de usuario no contenga caracteres especiales y no exista
	# Parametros 	: nombre_usuario 
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function validarNombreUsuarioAjax($datos)
	{
		$valores['nombre_usuario'] = $datos['nombre'];

		$valores['nombre_usuario'] 	=  str_replace(' ', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('"', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace("'", '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('/', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('..', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('*', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('-', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('$', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('#', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('%', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('(', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace(')', '', $valores['nombre_usuario']);
		$valores['nombre_usuario'] 	=  str_replace('|', '', $valores['nombre_usuario']);

		if($valores['nombre_usuario']=='')
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Debe capturar un nombre de usuario valido';
			return $data;
		}

		$v_nombre_usuario = $this->validar_nombre_usuario_nuevo($valores);
		if($v_nombre_usuario->size() > 0)
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'El nombre de usuario <b>'.$valores['nombre_usuario'].'</b> no esta disponible';			
		}
		else
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'El nombre de usuario se encuentra <b>disponible</b>';
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Valida que el correo no contenga caracteres especiales y no exista
	# Parametros 	: correo 
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function validarCorreoUsuarioAjax($datos)
	{
		$valores['correo'] = $datos['correo'];

		$valores['correo'] 	=  str_replace(' ', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('"', '', $valores['correo']);
		$valores['correo'] 	=  str_replace("'", '', $valores['correo']);
		$valores['correo'] 	=  str_replace('/', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('..', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('*', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('-', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('$', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('#', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('%', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('(', '', $valores['correo']);
		$valores['correo'] 	=  str_replace(')', '', $valores['correo']);
		$valores['correo'] 	=  str_replace('|', '', $valores['correo']);

		if($valores['correo']=='')
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Debe capturar un correo valido';
			return $data;
		}

		if($this->comprobar_email($valores['correo'])==0)
    	{
    		$data['codigo']  = '002';
    		$data['mensaje'] = 'El Formato del correo no es valido';
    		return $data;
    	}

		$v_correo_usuario = $this->validar_correo_usuario_nuevo($valores);
		if($v_correo_usuario->size() > 0)
		{
			$data['codigo']  = '003';
			$data['mensaje'] = 'El correo ya se encuentra registrado';
		}
		else
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'El correo es valido';
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: obtiene los datos del usuario con el nombre de usuario
	# Parametros 	: nombre_usuario 
	# salida		: array
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerDatosNombreUsuario($datos)
	{
		$valores['nombre_usuario'] = $datos['nombre_usuario'];
		$r = $this->obtener_datos_nombre_usuario($valores);
		$r = $this->ConvertirResultArray($r);
		return $r;
	}

	#*****************************************************************************
	# Descripcion	: obtiene los datos de un usuario
	# Parametros 	: id-usuario
	# salida		: datos usuario
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerDatosUsuario2($datos)
	{	
		$valores['id_usuario'] = $datos['id_usuario'];
		$r = $this->obtener_datos_usuario($valores);
		$d = $this->ConvertirResultArray($r);
		return $d;
	}

	#*****************************************************************************
	# Descripcion	: obtiene los datos del usuario logueado
	# Parametros 	: id-usuario
	# salida		: datos usuario
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerPerfilUSuario()
	{	
		$valores['id_usuario'] = $_SESSION['s']['id_usuario'];
		$r = $this->obtener_datos_usuario($valores);
		$d = $this->ConvertirResultArray($r);
		return $d;
	}

	#*****************************************************************************
	# Descripcion	: contador de visitas para los perfiles
	# Parametros 	: id-usuario
	# salida		: 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function registrarVisitaPerfil($datos)
	{
		if($datos['id_usuario'] != $_SESSION['s']['id_usuario'])
		{
			$r = $this->obtener_visitas_perfil($datos);				
			$r = $this->ConvertirResultArray($r);

			$datos['visitas_perfil'] = $r['visitas_perfil'] + 1;

			$r2 = $this->actualizar_visitas_perfil($datos);				

		}
	}

	#*****************************************************************************
	# Descripcion	: actualiza la informacion de un usuario
	# Parametros 	: datos
	# salida		: datos usuario
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function actualizarDatosUsuario($datos)
	{
		$valores['id_usuario']		= $_SESSION['s']['id_usuario'];
		$valores['nombre'] 			= $datos['txtnombrereal'];
		$valores['nombre_usuario'] 	= $datos['txtnombre'];
		$valores['correo'] 			= $datos['txtcorreo'];
		$valores['bio'] 			= $datos['txtbio'];
		$valores['id_sexo'] 		= $datos['txtsexo'];
		$valores['ubicacion'] 		= $datos['txtubicacion'];
		$valores['id_situacion'] 	= $datos['txtsituacion'];	

		//valido que el nombre de usuario no existas
		$v_nombre_usuario = $this->validar_nombre_usuario($valores);
		if($v_nombre_usuario->size() > 0)
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'El nombre de usuario <b>'.$valores['nombre_usuario'].'</b> no esta disponible';
			return $data;
		}

		//valida el correo que no exista
		$v_correo = $this->validar_correo_usuario($valores);
		if($v_correo->size() > 0 & $_SESSION['s']['tipo_usuario'] != '4')
		{
			$data['codigo']  = '002';
			$data['mensaje'] = 'El correo ya se encuentra registrado';
			return $data;
		}

		$r1 = $this->actualizar_datos_usuario($valores);
		if($r1->affectedRows() > 0)
		{	

			
		    $_SESSION['s']['nombre_usuario']    = $valores['nombre_usuario'];
		    $_SESSION['s']['bio']               = $valores['bio'];			    			    			    
		    //$_SESSION['s']['per_nsfw']			= $valores['per_nsfw'];			    
		    //$_SESSION['s']['desp_inf']			= $valores['desp_inf'];


			$data['codigo']  = '000';
			$data['mensaje'] = 'Actualizacion correcta';
		}
		else
		{
			$data['codigo'] = '000';
			$data['mensaje'] = 'No se realizo la actualizacion';	
		}

		return $data;
	}

	function actualizarDatosDashUsuario($datos)
	{
		$valores['id_usuario']		= $_SESSION['s']['id_usuario'];			
		$valores['per_nsfw'] 		= $datos['txtpern_nsfw'];
		$valores['tipo_dash']		= $datos['txttipodash'];
		$valores['desp_inf']		= $datos['txtdesinf'];	
		$valores['visibilidad_default']	= $datos['txt_vista_default'];

		

		$r1 = $this->actualizar_datos_dash_usuario($valores);
		if($r1->affectedRows() > 0)
		{	
		    //$_SESSION['s']['nombre_usuario']    = $valores['nombre_usuario'];
		    $_SESSION['s']['tipo_dash']         = $valores['tipo_dash'];			    			    			    
		    $_SESSION['s']['per_nsfw']			= $valores['per_nsfw'];			    
		    $_SESSION['s']['desp_inf']			= $valores['desp_inf'];
		    $_SESSION['s']['vis_def']			= $valores['visibilidad_default'];


			$data['codigo']  = '000';
			$data['mensaje'] = 'Actualizacion correcta';
		}
		else
		{
			$data['codigo'] = '000';
			$data['mensaje'] = 'No se realizo la actualizacion';	
		}

		return $data;
	}

	function actualizarDatosNotificacionUsuario($datos)
	{
		$valores['id_usuario']		  = $_SESSION['s']['id_usuario'];			
		$valores['per_enviar_correo'] = $datos['txtpermcorreo'];

		$r1 = $this->actualizar_datos_notificacion_usuario($valores);
		if($r1->affectedRows() > 0)
		{	
			$data['codigo']  = '000';
			$data['mensaje'] = 'Actualizacion correcta';
		}
		else
		{
			$data['codigo'] = '000';
			$data['mensaje'] = 'No se realizo la actualizacion';	
		}

		return $data;
	}






















	/*************************************************************
	*	
	*
	*	#PUBLICACIONES		
	*
	*
	**************************************************************/

	
	#*****************************************************************************
	# Descripcion	: Obtiene el listado de categorias
	# Parametros 	:  
	# salida		: listado
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerCategorias()
	{   
    	$r = $this->obtener_categorias();
    	$r = $this->ConvertirResultMatriz($r);
    	return $r;
	}  

	#*****************************************************************************
	# Descripcion	: registra una categoria nueva.
	# Parametros 	: nombre categoria,descripcion,clave
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function registrarCategoria($datos)
	{
		$valores['nombre_categoria'] 	= utf8_decode($datos['nombre']);
		$valores['descripcion'] 	 	= utf8_decode($datos['descripcion']);
		$valores['codigo_categoria'] 	= utf8_decode($datos['codigo']);
		$valores['img'] 				= $datos['img'];
		$valores['nsfw'] 				= $datos['nsfw'];
		$valores['fecha']				= date('Y-m-d',time());
		$valores['id_usuario'] 			= $_SESSION['s']['id_usuario'];
		$valores['status'] 				= 'A';

		$r = $this->registrar_categoria($valores);
		if($r->affectedRows() > 0)
		{
			$data['id_categoria'] = $r->insertID();
			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro Exitoso';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: actualiza algun detalle de la categoria
	# Parametros 	: nombre categoria,descripcion,clave
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function actualizarCategoria($datos)
	{
		$valores['id_categoria']	= utf8_decode($datos['id']);
		$valores['nombre_categoria'] = utf8_decode($datos['nombre']);
		$valores['descripcion'] = utf8_decode($datos['descripcion']);
		$valores['codigo_categoria'] = utf8_decode($datos['codigo']);
		$valores['nsfw'] 		= $datos['nsfw'];
		$valores['img'] 		= $datos['img'];
		$valores['fecha']		= date('Y-m-d',time());
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];			

		$r = $this->actualizar_categoria($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro Exitoso';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Elimina la categoria
	# Parametros 	: nombre categoria,descripcion,clave
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function eliminarCategoria($datos)
	{
		$valores['id_categoria']= $datos['id'];    		
		$valores['fecha']		= date('Y-m-d',time());
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];	
		$valores['nsfw'] 		= $datos['nsfw'];		
		$valores['status']		= 'C';

		$r = $this->eliminar_categoria($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Eliminacion Exitoso';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al eliminar';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: registra una publicacion (contenido) pudiendo ser de varios tipos
	# 				  1) Link 
	# 				  2) Imagen o grupo de imagenes (max 10).	
	# 				  3) Video, puede ser codigo embebido, o archivos *.mp4 o *.webm
	# 				  6) Estado, solo texto
	# Parametros 	: nombre categoria,descripcion,clave
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
		
	function registrarContenido($datos,$file)
	{
		$valores['id_tipo_contenido'] = $this->remover_javascript($datos['txtcontenido']);
        $valores['id_categoria']= $this->remover_javascript($datos['categoria']);
		$valores['nombre'] 		= $this->remover_javascript($datos['txtnombre']);
		$valores['descripcion'] = $this->remover_javascript($datos['txtdes']);
		$valores['link'] 		= $this->remover_javascript($datos['txtlink']);
		$valores['src']			= '';
		$valores['codigo']		= $this->remover_javascript($datos['txtcodigo']);		
		$valores['tipo_archivo']= '';
		$valores['tamanio']		= '';
		$valores['fecha_c']		= date('Y-m-d H:i:s',time());
		$valores['fecha_m']		= date('Y-m-d H:i:s',time());
		$valores['fecha_p']		= date('Y-m-d H:i:s',time());
		$valores['visibilidad']	= $datos['txtvista'];
		$valores['adulto']		= $datos['btn_nsfw'];		
		$valores['ip']			= $_SERVER['REMOTE_ADDR'];
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['status']		= 'A';
		
		$valores['fecha_p'] = $valores['fecha_c'];

		if($valores['id_tipo_contenido']=='1' & $valores['nombre']=='')
		{
			$valores['nombre'] = $this->saca_dominio($valores['link']);
		}

		if($datos['txtfechap']!= '')
		{
			$valores['fecha_p'] = $datos['txtfechap'];
		}

		if($datos['txtusuario']!= '')
		{
			$valores['id_usuario'] = $datos['txtusuario'];
		}

		# En el caso de imagenes primero se sube la imagen 		
		if($valores['id_tipo_contenido']=='2')
		{
			$img = $this->registrarImagenGeneral($file);
			
			if($img['codigo'] == '000')
			{
				$valores['src']			= $img['src'];
				$valores['tipo_archivo']= $img['tipo_archivo'];
				$valores['tamanio']		= $img['tamanio'];
			}
			else
			{
				$data['codigo'] = $img['codigo'];
				$data['mensaje']= $img['mensaje'];
				return $data;
			}
		}
		
		# En el caso de que sea un video se procede a guardarlo 
		if($valores['id_tipo_contenido']=='3' & $valores['codigo']== '')
		{
			$img = $this->registrarArchivoGeneral($file);

			if($img['codigo'] == '000')
			{
				$valores['src']			= $img['src'];
				$valores['tipo_archivo']= $img['tipo_archivo'];
				$valores['tamanio']		= $img['tamanio'];
			}
			else
			{
				$data['codigo'] = $img['codigo'];
				$data['mensaje']= $img['mensaje'];
				return $data;
			}
		}

		$r = $this->registrar_contenido($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']  			= '000';
			$data['mensaje'] 			= 'Registro de contenido Exitoso';
			$data['id']      			= $r->insertID();				
			$valores['id_contenido'] 	= $data['id'];

			$this->generar_notificaciones_menciones($valores);

			$t['id_usuario'] 	= $valores['id_usuario'];
			$t['tipo']			= 'mas_post';

			$this->aumentar_estadisticas_usuario($t);            
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: registra una publicacion (contenido) pudiendo ser de varios tipos
	# 				  1) Link 
	# 				  2) Imagen o grupo de imagenes (max 10).	
	# 				  3) Video, puede ser codigo embebido, o archivos *.mp4 o *.webm
	# 				  6) Estado, solo texto
	# Parametros 	: nombre categoria,descripcion,clave
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function registrarContenidoAjax($datos,$file)
	{
		
		$valores['id_tipo_contenido'] = utf8_decode($this->remover_javascript($datos['txtcontenido']));
        $valores['id_categoria']= utf8_decode($this->remover_javascript($datos['categoria']));
		$valores['nombre'] 		= utf8_decode($this->remover_javascript($datos['txtnombre']));
		$valores['descripcion'] = utf8_decode($this->remover_javascript($datos['txtdes']));
		$valores['link'] 		= utf8_decode($this->remover_javascript($datos['txtlink']));
		$valores['src']			= '';
		$valores['codigo']		= utf8_decode($this->remover_javascript($datos['txtcodigo']));		
		$valores['tipo_archivo']= '';
		$valores['tamanio']		= '';
		$valores['fecha_c']		= date('Y-m-d H:i:s',time());
		$valores['fecha_m']		= date('Y-m-d H:i:s',time());
		$valores['fecha_p']		= '0000-00-00';
		$valores['visibilidad']	= $datos['txtvista'];
		$valores['adulto']		= $datos['btn_nsfw'];		
		$valores['ip']			= $_SERVER['REMOTE_ADDR'];
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['status']		= 'A';
		
		$valores['fecha_p'] = $valores['fecha_c'];		

		if($valores['id_tipo_contenido']=='1' & $valores['link']=='')
		{
			$valores['nombre'] = $this->saca_dominio($valores['link']);
		}

		if($datos['txtfechap']!= '')
		{
			$valores['fecha_p'] = $datos['txtfechap'];
		}

		# En el caso de imagenes primero se sube la imagen 		
		if($valores['id_tipo_contenido']=='2')
		{
			$img = $this->registrarImagenGeneralAjax($file);
			
			if($img['codigo'] == '000')
			{

				$valores['src']			= $img['src'];
				$valores['tipo_archivo']= $img['tipo_archivo'];
				$valores['tamanio']		= $img['tamanio'];
			}
			else
			{
				$data['codigo'] = $img['codigo'];
				$data['mensaje']= $img['mensaje'];
				return $data;
			}
		}

		# en el caso de videos primero se sube el video 
		if($valores['id_tipo_contenido']=='3' & $valores['codigo']== '')
		{
			$img = $this->registrarArchivoGeneralAjax($file);

			if($img['codigo'] == '000')
			{
				$valores['src']			= $img['src'];
				$valores['tipo_archivo']= $img['tipo_archivo'];
				$valores['tamanio']		= $img['tamanio'];
			}
			else
			{
				$data['codigo'] = $img['codigo'];
				$data['mensaje']= $img['mensaje'];
				return $data;
			}
		}

		# en el caso de un audio se sube el archivo mp3
		if($valores['id_tipo_contenido']=='9' & $valores['codigo']== '')
		{
			$img = $this->registrarArchivoMp3lAjax($file);

			if($img['codigo'] == '000')
			{
				$valores['src']			= $img['src'];
				$valores['tipo_archivo']= $img['tipo_archivo'];
				$valores['tamanio']		= $img['tamanio'];
			}
			else
			{
				$data['codigo'] = $img['codigo'];
				$data['mensaje']= $img['mensaje'];
				return $data;
			}
		}
		
		$r = $this->registrar_contenido($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']  			= '000';
			$data['mensaje'] 			= 'Registro de contenido Exitoso';
			$data['id']      			= $r->insertID();
			$valores['id_contenido'] 	= $data['id'];

			if($valores['id_tipo_contenido']=='2' & count($file) > 1)
			{	
				$img = $this->registrarImagenGeneralDetalladoAjax($file,$valores['id_contenido']);
			}

			$this->generar_notificaciones_menciones($valores);

			$t['id_usuario'] 	= $valores['id_usuario'];
			$t['tipo']			= 'mas_post';

			$this->aumentar_estadisticas_usuario($t);
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Elimina todo el codigo javascript de una cadena
	# Parametros 	: cadena
	# salida		: cadana sin javascript
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function remover_javascript($html)
	{
		$javascript = '/<script[^>]*?>.*?<\/script>/si';  //Expresión regular buscará todos los códigos Javascripts 
		$html = preg_replace($javascript, "", $html);
		$javascript = '/<script[^>]*?javascript{1}[^>]*?>.*?<\/script>/si';
		$html = preg_replace($javascript, "", $html); //Expresión regular buscará todos los códigos Javascripts 
		return $html;
	}

	
	#*****************************************************************************
	# Descripcion	: Actualiza los detalles de una publicacion mas no los archivos capturados para administradores
	# Parametros 	: array
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function actualizarDetallesContenido($datos)
	{
		$valores['id_tipo_contenido'] = $datos['txtcontenido'];
		$valores['id_contenido']= $datos['txtidcontenido'];			
        $valores['id_categoria']= $datos['categoria'];
		$valores['nombre'] 		= $datos['txtnombre'];
		$valores['descripcion'] = $datos['txtdes'];
		$valores['link'] 		= $datos['txtlink'];			
		$valores['codigo']		= $datos['txtcodigo'];			
		$valores['fecha_m']		= date('Y-m-d H:i:s',time());
		$valores['fecha_p']		= $datos['txtfechap'];
		$valores['visibilidad']	= $datos['txtvista'];
		$valores['adulto']		= $datos['txtadulto'];		
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['status']		= $datos['txtstatus'];

		if($valores['adulto'] == 'on'){ $valores['adulto'] = 'S';}else {$valores['adulto'] = 'N';}
		
		if($valores['id_tipo_contenido']=='1' & $valores['link']=='')
		{
			$valores['nombre'] = $this->saca_dominio($valores['link']);
		}

		$r = $this->actualizar_contenido($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']  			= '000';
			$data['mensaje'] 			= 'Registro de contenido Exitoso';			
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Actualiza los detalles de una publicacion mas no los archivos capturados para usuarios
	# Parametros 	: array
	# salida		: codigo, mensaje 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function actualizarDetallesContenidoUsuario($datos)
	{
		$valores['id_contenido']= $datos['txtidcontenido'];			
        $valores['id_categoria']= $datos['categoria'];
		$valores['nombre'] 		= $datos['txtnombre'];
		$valores['descripcion'] = $datos['txtdes'];
		$valores['link'] 		= $datos['txtlink'];			
		$valores['codigo']		= $datos['txtcodigo'];			
		$valores['fecha_m']		= date('Y-m-d H:i:s',time());
		$valores['adulto']		= $datos['btn_nsfw'];			
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		
		if($valores['id_tipo_contenido']=='1' & $valores['link']=='')
		{
			$valores['nombre'] = $this->saca_dominio($valores['link']);
		}			

		$r = $this->actualizar_contenido_usuario($valores);

		if($r->affectedRows() > 0)
		{
			$data['codigo']  			= '000';
			$data['mensaje'] 			= 'Registro de contenido Exitoso';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;
	}

	
	#*****************************************************************************
	# Descripcion	: Genera una notificacion de que vieron tu publicacion
	# Parametros 	: id-contenido
	# salida		: 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function generar_notificacion_post_visto($datos)
	{
		$valores['id_tipo']		= '12';
    	$valores['id_ref'] 		= $datos['id_contenido'];
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario']; 
		$valores['detalles'] 	= " vio tu publicaci&oacute;n ";

		$this->registrarNotificacion($valores);
	}

	#*****************************************************************************
	# Descripcion	: Genera una notificacion cuando alguien te menciona (@usuario)
	# Parametros 	: cadena
	# salida		: 
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function generar_notificaciones_menciones($datos)
	{
    	$cadenas = explode(" ", strip_tags($datos['nombre'].' '.$datos['descripcion'].' '.$datos['comentario']));
    	$des 	 = '';

    	$valores['id_tipo']	= '11';
    	$valores['id_ref'] 	= $datos['id_contenido'];

      	if(count($cadenas) > 0)
		{            
			for($i=0 ;$i <= count($cadenas) ;$i++)
			{
				//Se busca a los usuarios mencionados en el texto 
				$findme   = '@';
                $pos2 = strpos($cadenas[$i], $findme);

				if ($pos2 !== false) 
				{
					$user = '';
					if($pos2 == 0)
					{	
						$valores['id_usuario'] = $_SESSION['s']['id_usuario']; //$this->obtener_ID_usuario_nombre($user);
						$valores['detalles'] = " te mencion&oacute;: ";
						$this->registrarNotificacion($valores);
						break;
					}		    
				}
			}
		}
	}// fin de funcion 
	
	#*****************************************************************************
	# Descripcion	: elimina una publicacion
	# Parametros 	: id-contenido
	# salida		: codigo,mensaje
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************	
	function eliminarContenidoAjax($datos)
	{
		$valores['id_contenido']	= $datos['id'];
		$valores['id_usuario']		= $_SESSION['s']['id_usuario'];
		$valores['fecha_m']			= date('Y-m-d H:i:s',time());
		$valores['status']			= 'B';

		$r = $this->eliminar_contenido($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo'] = '000';
			$data['mensaje']= 'Contenido Eliminado correctamente';
			$r = $this->eliminar_contenido_rt($valores);

			$t['id_usuario'] 	= $valores['id_usuario'];
			$t['tipo']			= 'men_post';
			$this->aumentar_estadisticas_usuario($t);
		}
		else
		{
			$data['codigo'] ='001';
			$data['mensaje']='Ocurrio un error al eliminar el contenido';				
		}			
		return $data;
	}

	#*****************************************************************************
	# Descripcion	: Realia un repost a una publicacion
	# Parametros 	: id-contenido
	# salida		: codigo,mensaje
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function compartirContenidoAjax($datos)
	{
		// obtener los datos del contenido. 
		// modificar los datos y poner lo del usuario 
		// poner el id_rt del contenido original . 
		// regresar respues de ejecucion 
		// diego

		$valores['id_contenido']		= $datos['id'];

		$r = $this->obtener_contenido_general($valores);
		$r = $this->ConvertirResultArray($r);
		
		$r['id_rt'] 		= $valores['id_contenido'];
		$r['id_usuario']	= $_SESSION['s']['id_usuario'];
		$r['fecha_c']		= date('Y-m-d H:i:s',time());
		$r['fecha_p']		= date('Y-m-d H:i:s',time());
		$r['fecha_m']		= date('Y-m-d H:i:s',time());
		$r['ip']			= $_SERVER['REMOTE_ADDR'];
		$r['status']		= 'A';
		$r['visibilidad']	= 'P';
		$r['fav']			= 'N';

		$rec = $this->registrar_contenido($r);
		if($rec->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro de contenido Exitoso';

			#registro de notificacion
			$t['id_tipo'] 	= '10';
			$t['id_ref'] 	= $valores['id_contenido'];
			$t['detalles']	= 'compartio';

			$rt = $this->registrarNotificacion($t);

			$t2['id_contenido']	= $r['id_rt'];
			$t2['tipo']			= 'mas_rt';

			$this->aumentar_estadisticas_contenido($t2);
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;

	}

		
	
	#*****************************************************************************
	# Descripcion	: Obtiene la siguiente publicacion de un usuario
	# Parametros 	: id-contenido
	# salida		: publicacion
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerSiguienteContenido($datos)
	{
		$valores['id_contenido']		= $datos['id_contenido'];

		$r = $this->obtener_siguiente_contenido($valores);
		$r = $this->ConvertirResultArray($r);
		
		return $r;	
	}


	#*****************************************************************************
	# Descripcion	: Listado General de publicaciones dependiendo los parametros genera el listado
	# Parametros 	: array
	# salida		: listado publicaciones
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function listadoContenidoGeneral($datos)
	{
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];   	// usuario logueado
		$valores['user']		= $datos['user']; 					// Para cargar contenido de un usuario
		$valores['categoria']	= $datos['cat']; 					// para cargar contenido de una categoria 
		$valores['consulta']	= $datos['consulta'];           	// para cargar contenido por determinada busqueda. 			
		$valores['tags']		= $datos['tags'];         			// para cargar contenido por un tags
		$valores['fecha_p']		= date("Y-m-d H:i:s",time()); 		// para obtener solo las publicaciones del momento			
		$valores['page']		= $datos['page'];         			// para saber que pagina cargar
		$valores['mejor']		= $datos['mejor'];        			// cuando la op sea mejor o no siga a nadie.
		$valores['like']		= $datos['like'];		 			// para cargar el contenido que le di LIKE
		$valores['mas_visto'] 	= $datos['mas_visto']; 				// para cargar el contenido mas visto
		$valores['rss'] 		= $datos['rss']; 					// para cargar el contenido mas visto
        $valores['all'] 		= $datos['all']; 					// para cargar todas las publicaciones
        $valores['live'] 		= $datos['live'];         			// para cargar el contenido con las ultimas notificaciones        
        $valores['id_last_c']	= $datos['id_last_c'];
        $valores['multimedia']  = $datos['multimedia'];

        if($valores['multimedia'] == '')
        {
             $valores['multimedia'] = 'S';
        }
		
		if($valores['page'] == '' ||  $valores['page'] <= 0)
		{
			$valores['page'] = 1;
		}
		if($valores['page'] == 1 & $valores['consulta'] != '')
		{
			$tmp = $this->registrarBusqueda($valores);
		}

		$valores['limit']			= ' LIMIT '.(10 * ($valores['page'] - 1)).',10';

		$r = $this->listado_contenido_general($valores);
		$r = $this->ConvertirResultMatriz($r);

		$metadata['datos'] 		= $r;
		$metadata['paginador']	= $paginador;		
		return $metadata;	
	}	

	function listadoContenidoGeneralSuperRandom($datos)
	{
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];   	// usuario logueado


		// primero se calcula la ultima y primer publicacion. 

		// se sacan 30 numeros random de esa cantidad

		// se mandan a llamar todas las publicaciones excepto estados con los ramdomw

		// se limita las publicaciones a 10

		// se envian de regreso

		$rango = $this->calcularMinMaxIDpublicaciones();
		$rango = $this->ConvertirResultArray($rango);

		$valores['rand_1'] = rand($rango['min'],$rango['max']);
		$valores['rand_2'] = rand($rango['min'],$rango['max']);
		$valores['rand_3'] = rand($rango['min'],$rango['max']);
		$valores['rand_4'] = rand($rango['min'],$rango['max']);
		$valores['rand_5'] = rand($rango['min'],$rango['max']);
		$valores['rand_6'] = rand($rango['min'],$rango['max']);
		$valores['rand_7'] = rand($rango['min'],$rango['max']);
		$valores['rand_8'] = rand($rango['min'],$rango['max']);
		$valores['rand_9'] = rand($rango['min'],$rango['max']);
		$valores['rand_10'] = rand($rango['min'],$rango['max']);
		$valores['rand_11'] = rand($rango['min'],$rango['max']);
		$valores['rand_12'] = rand($rango['min'],$rango['max']);
		$valores['rand_13'] = rand($rango['min'],$rango['max']);
		$valores['rand_14'] = rand($rango['min'],$rango['max']);
		$valores['rand_15'] = rand($rango['min'],$rango['max']);
		$valores['rand_16'] = rand($rango['min'],$rango['max']);
		$valores['rand_17'] = rand($rango['min'],$rango['max']);
		$valores['rand_18'] = rand($rango['min'],$rango['max']);
		$valores['rand_19'] = rand($rango['min'],$rango['max']);
		$valores['rand_20'] = rand($rango['min'],$rango['max']);
		$valores['rand_21'] = rand($rango['min'],$rango['max']);
		$valores['rand_22'] = rand($rango['min'],$rango['max']);
		$valores['rand_23'] = rand($rango['min'],$rango['max']);
		$valores['rand_24'] = rand($rango['min'],$rango['max']);
		$valores['rand_25'] = rand($rango['min'],$rango['max']);
		$valores['rand_26'] = rand($rango['min'],$rango['max']);
		$valores['rand_27'] = rand($rango['min'],$rango['max']);
		$valores['rand_28'] = rand($rango['min'],$rango['max']);
		$valores['rand_29'] = rand($rango['min'],$rango['max']);
		$valores['rand_30'] = rand($rango['min'],$rango['max']);

        
        $valores['super'] = 'S';
        
		
		if($valores['page'] == '' ||  $valores['page'] <= 0)
		{
			$valores['page'] = 1;
		}
		if($valores['page'] == 1 & $valores['consulta'] != '')
		{
			$tmp = $this->registrarBusqueda($valores);
		}

		$valores['limit']			= ' LIMIT '.(10 * ($valores['page'] - 1)).',10';

		$r = $this->listado_contenido_general($valores);
		$r = $this->ConvertirResultMatriz($r);

		$metadata['datos'] 		= $r;
		$metadata['paginador']	= $paginador;		
		return $metadata;	
	}

	#*****************************************************************************
	# Descripcion	: obtiene la url de una publicacion
	# Parametros 	: id-contenido
	# salida		: publicacion
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerImagenesPost($datos)
	{
		$valores['id_contenido'] = $datos['id_contenido'];
		$r = $this->obtener_imagenes_post($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	
	#*****************************************************************************
	# Descripcion	: obtiene una publicacion
	# Parametros 	: id-contenido
	# salida		: publicacion
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerContenidoGeneral($datos)
	{
		$valores['id_contenido']	= $datos['id_contenido'];
		$valores['id_usuario'] 		= $_SESSION['s']['id_usuario']; 
		$r = $this->obtener_contenido_general($valores);
		$r = $this->ConvertirResultArray($r);		
		return $r;	
	}


	#*****************************************************************************
	# Descripcion	: obtiene una publicacion al azar
	# Parametros 	: id-contenido
	# salida		: publicacion
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function obtenerContenidoRandom($datos)
	{
		$valores['id_contenido']	= rand(0,20000);
		$valores['id_usuario'] 		= $_SESSION['s']['id_usuario']; 
		$r = $this->obtener_contenido_general($valores);
		$r = $this->ConvertirResultArray($r);		
		return $r;	
	}

	#*****************************************************************************
	# Descripcion	: obtiene las ultimas publicaciones de un usuario
	# Parametros 	: id-contenido
	# salida		: 5 publicaciones
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function listadoUltimosPublicacionesUsuario($datos)
	{
		$valores['id_usuario'] 	= $datos['id_usuario'];   // usuario
		$valores['id_contenido']= $datos['id_contenido']; // id_contenido max
		$valores['fecha_p']		= date("Y-m-d H:i:s",time()); // para obtener solo las publicaciones del momento			
		$valores['limit']		= 5	;
		
		$r = $this->listado_ultimos_contenido_usuario($valores);
		$r = $this->ConvertirResultMatriz($r);
		
		return $r;	
	}

	#*****************************************************************************
	# Descripcion	: obtiene las publicaciones del mes anterio
	# Parametros 	: id-contenido
	# salida		: 5 publicaciones
	# Autor 		: Diego Guerra
	# fecha ultmod 	: 2016/03/26
	#*****************************************************************************
	function listadoContenidoPopularesMenAnterior($datos)
	{
		$valores['page']		= $datos['page']; 

		if($valores['page'] == '' ||  $valores['page'] <= 0)
		{
			$valores['page'] = 1;
		}
		$valores['limit']			= ' LIMIT '.(0 * ($valores['page'] - 1)).',5';

		$r = $this->listado_contenido_popular_mes_anterior($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;	
	}	


		
			
	/*************************************************************
	*	
	*
	*	#COMENTARIOS		
	*
	*
	**************************************************************/		
	
	function registrarComentarioAjax($datos)
	{

		$valores['id_usuario'] 			= $_SESSION['s']['id_usuario'];
		$valores['id_ref']				= $datos['id'];
		$valores['comentario'] 			= utf8_decode(trim($datos['com']));
		$valores['fecha'] 				= date('Y-m-d H:i:s',time());
		$valores['id_tipo_comentario'] 	= utf8_decode($datos['tipo']);
		$valores['ip']					= $_SERVER['REMOTE_ADDR'];
		$valores['status']				= 'A';

		

		$r = $this->registrar_comentario($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']			= '000';
			$data['mensaje']		= 'Registro exitoso';
			$data['id_comentario']	= $r->insertID();
			$data['fecha']			= $this->hace_mini($valores['fecha']);
			//Registro de notificacion de comentario 
			$t['id_tipo'] 	= '3';
			$t['id_ref'] 	= $valores['id_ref'];
			$t['detalles']	= $valores['comentario'];				
			$rt = $this->registrarNotificacion($t);

			$correo = $this->enviar_correo_nuevo_comentario($valores);
                            $valores['id_contenido'] =  $valores['id_ref'];
                            $this->generar_notificaciones_menciones($valores);

            $t2['id_contenido'] = $valores['id_ref'];
			$t2['tipo']			= 'mas_com';
			$this->aumentar_estadisticas_contenido($t2);


		}
		else
		{
			$data['codigo']	= '001';
			$data['mensaje']= 'Ocurrio un error al registrar';
		}
		return $data;
	}


		function registrarComentario($datos)
		{
			$valores['id_usuario'] 			= $_SESSION['s']['id_usuario'];
			$valores['id_ref']				= $datos['txtid'];
			$valores['comentario'] 			= utf8_decode($datos['txtcom']);
			$valores['fecha'] 				= date('Y-m-d H:i:s',time());
			$valores['id_tipo_comentario'] 	= '1';
			$valores['ip']					= $_SERVER['REMOTE_ADDR'];
			$valores['status']				= 'A';

			$r = $this->registrar_comentario($valores);
			if($r->affectedRows() > 0)
			{
				$data['codigo']			= '000';
				$data['mensaje']		= 'Registro exitoso';
				$data['id_comentario']	= $r->insertID();
				$data['fecha']			= $this->hace($valores['fecha']);
				//Registro de notificacion de comentario 
				$t['id_tipo'] 	= '3';
				$t['id_ref'] 	= $valores['id_ref'];
				$t['detalles']	= $valores['comentario'];				
				$rt = $this->registrarNotificacion($t);

				$correo = $this->enviar_correo_nuevo_comentario($valores);

			}
			else
			{
				$data['codigo']	= '001';
				$data['mensaje']= 'Ocurrio un error al registrar';
			}
			return $data;
		}

		function registrarComentarioAnonimo($datos)
		{
			$valores['id_usuario'] 			= 0;
			$valores['id_ref']				= $datos['txt_post_det'];
			$valores['comentario'] 			= strip_tags(trim($datos['txt_comentario']));
			$valores['fecha'] 				= date('Y-m-d H:i:s',time());
			$valores['id_tipo_comentario'] 	= '1';
			$valores['ip']					= $_SERVER['REMOTE_ADDR'];
			$valores['status']				= 'A';

			

			$r = $this->registrar_comentario($valores);
			if($r->affectedRows() > 0)
			{
				$data['codigo']			= '000';
				$data['mensaje']		= 'Registro exitoso';
				$data['id_comentario']	= $r->insertID();
				$data['fecha']			= $this->hace_mini($valores['fecha']);
				//Registro de notificacion de comentario 
				$t['id_tipo'] 	= '3';
				$t['id_ref'] 	= $valores['id_ref'];
				$t['detalles']	= $valores['comentario'];				
				$rt = $this->registrarNotificacion($t);

				$correo = $this->enviar_correo_nuevo_comentario($valores);
                $valores['id_contenido'] =  $valores['id_ref'];
                $this->generar_notificaciones_menciones($valores);

                $t2['id_contenido'] = $valores['id_ref'];
				$t2['tipo']			= 'mas_com';
				$this->aumentar_estadisticas_contenido($t2);
                
			}
			else
			{
				$data['codigo']	= '001';
				$data['mensaje']= 'Ocurrio un error al registrar';
			}
			return $data;
		}
		

		function actualizarComentario($datos)
		{
			$valores['id_comentario']		= $datos['txtid'];		
			$valores['comentario'] 			= $datos['txtcom'];
			$valores['fecha'] 				= date('Y-m-d H:i:s',time());		

			$r = $this->actualizar_comentario($valores);
			if($r->affectedRows() > 0)
			{
				$data['codigo']	= '000';
				$data['mensaje']= 'Actualizacion exitoso';
			}
			else
			{
				$data['codigo']	= '001';
				$data['mensaje']= 'Ocurrio un error al actualizar';
			}
			return $data;
		}

		

		function eliminarComentarioAjax($datos)
		{
			$valores['id_comentario']	= $datos['id'];
			$valores['id_contenido']	= $datos['id_ref'];
			$valores['id_usuario']		= $_SESSION['s']['id_usuario'];
			$valores['fecha'] 			= date('Y-m-d H:i:s',time());
			$valores['status']			= 'B';			

			$temp = $this->obtener_usuario_contenido_comentario($valores);
			$temp = $this->ConvertirResultArray($temp);
			// valida si eres dueño del contenido del comentario 
			if($temp['id_usuario'] == $valores['id_usuario'] || $_SESSION['s']['tipo_usuario']=='2')
			{
				$r  = $this->eliminar_comentario_especial($valores);
			}
			else
			{
				$r  = $this->eliminar_comentario($valores);	
			}

			if($r->affectedRows() > 0)
			{
				$data['codigo']	= '000';
				$data['mensaje']= 'Eliminacion exitosa';
				$data['id']		= $valores['id_comentario'];

				$t2['id_contenido'] = $valores['id_contenido'];
				$t2['tipo']			= 'men_com';
				$this->aumentar_estadisticas_contenido($t2);
			}
			else
			{
				$data['codigo']	= '001';
				$data['mensaje']= 'Ocurrio un error al eliminar';
			}
			return $data;
		}	

		function obtenerComentario($datos)
		{
			$valores['id_comentario'] = $datos['id_comentario'];
			

			$r = $this->obtener_comentario($valores);
			$r = $this->ConvertirResultArray($r);

			return $r;
		}


		


		function listadoComentarios($datos)
		{
			$valores['id_ref'] 				= $datos['id_ref'];
			$valores['id_tipo_comentario']	= $datos['tipo_comentario'];

			$r = $this->listado_comentarios($valores);
			$r = $this->ConvertirResultMatriz($r);

			return $r;
		}

		function cargarComentariosAjax($datos)
		{
			$valores['id_ref'] 				= $datos['id'];
			$valores['id_tipo_comentario']	= $datos['tipo'];

			$r = $this->listado_comentarios($valores);
			$r = $this->ConvertirResultMatriz($r);

			return $r;
		}
		
		function listadoUltComentariosDash($datos)
		{
			$valores['id_ref'] 				= $datos['id_ref'];
			$valores['id_tipo_comentario']	= '1';
			$valores['limit']				= 3;

			$data =array();

			$r = $this->listado_ultimos_comentarios_dashboard($valores);
			if($r->size() > 0)
			{
				while($rec = $r->fetch())
				{
					$rec['fecha_mini']	= $this->hace_mini($rec['fecha']);
					$data[] = $rec;
				}
			}
			//$r = $this->ConvertirResultMatriz($r);

			return $data;
		}

		
		
		function ContarComentariosDash($datos)
		{
			$valores['id_ref'] 				= $datos['id_ref'];
			$valores['id_tipo_comentario']	= $datos['tipo_comentario'];			

			$r = $this->contar_comentarios_dashboard($valores);
			$r = $this->ConvertirResultArray($r);
			//$r['num_comentarios'] = $r['num_comentarios'] - 3;

			return $r;
		}


		function actualizarTemaUsuario($datos)
		{
			$valores['id_usuario'] = $_SESSION['s']['id_usuario'];
			$valores['tema']		= $datos['txttema'];

			$r = $this->actualizar_tema($valores);

			if($r->affectedRows() > 0)
		    {
		        $data['codigo'] = '000' ;
		        $data['mensaje']= 'exito';
		        $data['tema']	= $valores['tema'];
		    }
		    else
		    {   
		        $data['codigo'] = '001' ;
		        $data['mensaje'] ='Error';
		    }

		    return $data;

		}


		

		///
		////////// FUNCIONES KARMA  
		///


		function registrarLikeAjax($datos)
		{
			$valores['id_contenido']= $datos['id'];
			$valores['id_usuario']	= $_SESSION['s']['id_usuario'];			
			$valores['fecha']		= date('Y-m-d',time());
			
			//valida si ya se le habia dado like a ese contenido 	
			$v = $this->validar_like($valores);

			if($v->size()> 0)
			{
				$valores['status']		= 'C';	
				$r = $this->eliminar_like($valores);

				if($r->affectedRows() > 0)
				{
					$data['codigo']	= '000';
					$data['mensaje']= 'Registro exitoso';
					$data['tipo']	= '0';

					$t['id_usuario'] 	= $valores['id_usuario'];
					$t['tipo']			= 'men_like';
					$this->aumentar_estadisticas_usuario($t);

					$t2['id_contenido'] = $valores['id_contenido'];
					$t2['tipo']			= 'men_like';
					$this->aumentar_estadisticas_contenido($t2);

				}
				else
				{
					$data['codigo']	= '001';
					$data['mensaje']= 'Ocurrio un error al registrar like';
				}

			}else
			{
				$valores['status']		= 'A';
				$r = $this->registrar_like($valores);	

				if($r->affectedRows() > 0)
				{
					$data['codigo']	= '000';
					$data['mensaje']= 'Registro exitoso';
					$data['tipo']	= '1';					
					
			        #registro de notificacion
					$t['id_tipo'] 	= '1';
					$t['id_ref'] 	= $valores['id_contenido'];
					$t['detalles']	= utf8_decode('Le gustó ');
					
					$rt = $this->registrarNotificacion($t);

					$correo = $this->enviar_correo_nuevo_like($valores);


					$t['id_usuario'] 	= $valores['id_usuario'];
					$t['tipo']			= 'mas_like';
					$this->aumentar_estadisticas_usuario($t);

					$t2['id_contenido'] = $valores['id_contenido'];
					$t2['tipo']			= 'mas_like';
					$this->aumentar_estadisticas_contenido($t2);

					// new_like

				}
				else
				{
					$data['codigo']	= '001';
					$data['mensaje']= 'Ocurrio un error al registrar like';
				}
				
			}

			return $data;

			
			
		}// fin de like

		

		function eliminarKarma($datos)
		{
			$valores['id_karma']	= $datos['id_karma'];		
			$valores['fecha']		= date('Y-m-d',time());
			$valores['status']		= 'B';

			$r = $this->eliminar_karma($valores);
			if($r->affectedRows() > 0)
			{
				$data['codigo']	= '000';
				$data['mensaje']= 'Eliminacion exitosa';
			}
			else
			{
				$data['codigo']	= '001';
				$data['mensaje']= 'Ocurrio un error al eliminar';
			}
			return $data;
		}
		
		///////////////////MENSAJES

		

		

		function buscarNombreUsuario($datos)
		{
			$valores['id_usuario'] = $datos['id_usuario'];

			$r = $this->obtener_datos_usuario2($valores);
			$r = $this->ConvertirResultArray($r);

			return $r;
		}

		


		function seguirUsuarioAjax($datos)
		{
			$valores['id_usuario_pri']	= $datos['id'];
			$valores['id_usuario_seg']	= $_SESSION['s']['id_usuario'];
			$valores['fecha']		= date('Y-m-d',time());
			$valores['status']		= 'A';

			$r = $this->seguir_usuario($valores);

			if($r->affectedRows() > 0)
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'Ok';
				$data['id']			= $r->insertID();

				$t['id_tipo'] 		= '9';
				$t['id_ref'] 		= $valores['id_usuario_pri'];
				$t['detalles']		= 'Ha empezado a seguirte ;) ';
		
				$rt = $this->registrarNotificacion($t);

				$this->correo_nuevo_seguidor($valores);				

				//Aumento +1 siguiendo.
				$t['id_usuario'] 	= $valores['id_usuario_seg'];
				$t['tipo']			= 'mas_sig';
				$this->aumentar_estadisticas_usuario($t);

				// Aumenta + 1 Seguidores otro usuario
				$t['id_usuario'] 	= $valores['id_usuario_pri'];
				$t['tipo']			= 'mas_seg';
				$this->aumentar_estadisticas_usuario($t);



			}
			else
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'no se actualizo nada';					
				$datos['id']		= '0';
			}

			return $data;
		}


		function validarSeguidor($datos)
		{
			$valores['id_usuario_seg'] =  $_SESSION['s']['id_usuario'];
			$valores['id_usuario_pri'] =  $datos['id_usuario'];

			$r = $this->validar_usuario_seguidor($valores);

			if($r->size() > 0)
			{
				$rec = $r->fetch();

				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'Ok';
				$data['id'] 		= $rec['id_seguidor'];
			}
			else
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= '';					
				$data['id'] 	= '0';
			}

			return $data;
		}

		function dejarSeguirUsuarioAjax($datos)
		{			
			$valores['id_usuario_seg']  = $_SESSION['s']['id_usuario'];
			$valores['id_usuario_pri']  = $datos['id'];
			$valores['fecha']			= date('Y-m-d',time());
			$valores['status']			= 'C';

			$r = $this->dejar_seguir_usuario($valores);

			if($r->affectedRows() > 0)
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'Ok';						

				//Disminuye -1 siguiendo.
				$t['id_usuario'] 	= $valores['id_usuario_seg'];
				$t['tipo']			= 'men_sig';
				$this->aumentar_estadisticas_usuario($t);

				// Disminuye - 1 Seguidores otro usuario
				$t['id_usuario'] 	= $valores['id_usuario_pri'];
				$t['tipo']			= 'men_seg';
				$this->aumentar_estadisticas_usuario($t);	
			}
			else
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'error';				
			}

			return $data;
		}

		/// ADMINISTRACION

		function obtenerUsuariosAdmin($datos)
		{
			$valores['consulta']	= $datos['consulta'];

			$r = $this->listado_usuaios($valores);
			$r = $this->ConvertirResultMatriz($r);

			return $r;
		}

		function bloquearUsuarioAjax($datos)
		{
			$valores['id_usuario'] 	= $datos['id'];
			$valores['fecha_ult']	= date('Y-m-d H:i:s',time());
			$valores['status']		= 'B';

			$r = $this->cambiar_status_usuario($valores);

			if($r->affectedRows() > 0)
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'Ok';				
			}
			else
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'error';				
			}

			return $data;
		}

		function desBloquearUsuarioAjax($datos)
		{
			$valores['id_usuario'] 	= $datos['id'];
			$valores['fecha_ult']	= date('Y-m-d H:i:s',time());
			$valores['status']		= 'A';

			$r = $this->cambiar_status_usuario($valores);

			if($r->affectedRows() > 0)
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'Ok';				
			}
			else
			{
				$data['codigo'] 	= '000';
				$data['mensaje'] 	= 'error';				
			}

			return $data;
		}


		function registrarVisita()
		{

			$datos['ip']           = $_SERVER['REMOTE_ADDR'];
		    $datos['nav']          = $_SERVER['HTTP_USER_AGENT'];
		    $datos['seccion']      = $_GET['op'];
		    $datos['src']          = $_GET['src'];
		    $datos['id_usuario']   = $_SESSION['s']['id_usuario'];
		    $datos['fecha']        = date('Y-m-d H:i:s',time());

			if($datos['seccion']=='')
			{
				$datos['seccion'] = 'index';
			}

			if($datos['src']=='')
			{
				$datos['src'] = 'Pagina Principal';
			}

			$datos['page'] = " http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 

			$r = $this->registrar_visita($datos);

			if($r->affectedRows() > 0)
		    {
		        $data['codigo'] = '000' ;
		        $data['mensaje'] ='exito';
		    }
		    else
		    {   
		        $data['codigo'] = '001' ;
		        $data['mensaje'] ='Error';
		    }

		    return $data;
		}

		function listadoVisitasGeneralSRC()
		{
			$r = $this->listado_visitas_general_src();
			$data = $this->ConvertirResultMatriz($r);
			return $data;
		}

		function listadoVisitasGeneralSeccion()
		{
			$r = $this->listado_visitas_general_seccion();
			$data = $this->ConvertirResultMatriz($r);
			return $data;
		}

		function listadoVisitasGeneralFecha()
		{
			$r = $this->listado_visitas_general_fecha();
			$data = $this->ConvertirResultMatriz($r);
			return $data;	
		}

		function listadoVisitasGeneralIPs()
		{
			$r = $this->listado_visitas_general_ips();
			$data = $this->ConvertirResultMatriz($r);
			return $data;		
		}

		function listadoVisitasGeneralPage()
		{
			$r = $this->listado_visitas_general_page();
			$data = $this->ConvertirResultMatriz($r);
			return $data;	
		}

		function bloquearIP($datos)
		{
			$valores['ip']		= $datos['txtip'];
			$valores['motivo']	= $datos['txtcom'];
			$valores['tipo']	= '1';
			$valores['fecha']	= date('Y-m-d',time());

			$r = $this->bloquear_ip($valores);

			if($r->affectedRows() > 0)
		    {
		        $data['codigo'] = '000' ;
		        $data['mensaje'] ='exito';
		    }
		    else
		    {   
		        $data['codigo'] = '001' ;
		        $data['mensaje'] ='Error';
		    }

		    return $data;

		}

		function validarBloqueoIP($datos)
		{
			$valores['ip'] = $datos['ip'];

			$r = $this->validar_bloqueo_ip($valores);
			if($r->size() > 0)
			{
				$data['valor'] = 'S';
			}
			else
			{
				$data['valor'] = 'N';	
			}

			return $data;
		}

		function validarBloqueoUsuario($datos)
		{
			$valores['id_usuario'] = $_SESSION['s']['id_usuario'];

			$r = $this->validar_bloqueo_usuario($valores);
			if($r->size() > 0)
			{
				$data['valor'] = 'S';
			}
			else
			{
				$data['valor'] = 'N';	
			}

			return $data;
		}
		

		function reportarLinkAjax($datos)
		{
			$valores['id_link']			= $datos['id'];
			$valores['id_usuario']		= $_SESSION['s']['id_usuario'];
			$valores['id_usuario_admin']= 0;
			$valores['fecha']			= date('Y-m-d H:i:s',time());
			$valores['fecha_mod']		= date('Y-m-d H:i:s',time());
			$valores['status_reporte']	= 'P';
			$valores['status']			= 'A';

			$r = $this->registrar_reporte_link($valores);

			if($r->affectedRows() > 0)
			{
				$data['codigo'] = '000';
				$data['mensaje']= 'Link reportado';
			}
			else
			{
				$data['codigo'] = '001';
				$data['mensaje'] = 'Ocurrio un error al reportar el links';
			}

			return $data;
		}

		function actualizarReporteLinkAjax($datos)
		{
			$valores['id_link']			= $datos['id'];			
			$valores['id_usuario_admin']= $_SESSION['s']['id_usuario'];
			$valores['fecha_mod']		= date('Y-m-d H:i:s',time());
			$valores['status_reporte']	= $datos['statusrp'];
			$valores['status']			= $datos['status'];

			$r = $this->actualizar_reporte_link($valores);

			if($r->affectedRows() > 0)
			{
				$data['codigo'] = '000';
				$data['mensaje']= 'Link reportado';
			}
			else
			{
				$data['codigo'] = '001';
				$data['mensaje'] = 'Ocurrio un error al reportar el links';
			}

			return $data;
		}

		

		function ultimosComentariosInicio()
		{
			$r = $this->obtener_ultimos_comentarios();
			$r = $this->ConvertirResultMatriz($r);
			return $r;
		}

		function listadoNotificacionesUsuario($datos)
		{
			$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
			$valores['nivel']		= '1';
			$valores['last']		= $datos['last'];
			$valores['id_last_n']		= $datos['id_last_n'];
			$r = $this->listado_notificaciones_general($valores);
			$r = $this->ConvertirResultMatriz($r);
			return $r;
		}

		function listadoNotificacionGeneral($datos)
		{
			$valores['id_usuario'] 		= $_SESSION['s']['id_usuario'];
			$valores['nombre_usuario']	= $_SESSION['s']['nombre_usuario'];
			$valores['nivel']		= '1';
			$valores['last']		= $datos['last'];
			$valores['id_last_n']	= $datos['id_last_n'];

			$r = $this->listado_notificaciones_general_mini($valores);
			$r = $this->ConvertirResultMatriz($r);
			// se general el resumen de la notificacion
			if(count($r) > 0)
			{
				$data = array();

				$iconos['1'] = '<img src="img/like.png"   style="width:20px" />';
				$iconos['3'] = '<img src="img/response.png"  style="width:20px" />';
				$iconos['9'] = '<img src="img/new.png"  style="width:20px" />';
				$iconos['10'] = '<img src="img/rt.png"  style="width:20px" />';
				$iconos['11'] = '<img src="img/response.png"  style="width:20px" />';
				$iconos['12'] = '<img src="img/eye-16.png"  style="width:20px" />';

				foreach ($r as $rec) 
				{
					$link =  '';
					$tipo_contenido = '';
					switch ($rec['id_tipo_contenido']) 
					{
						case '1' :
							$link  = '<a href="index.php?op=ver&id='.$rec['id_ref'].'">'.$rec['nombre'].'</a>';
							$tipo_contenido = 'Enlace';
						break;

						case '2' :

						$buscar = "mypack";
	                    $resultado = strpos($rec['src'], $buscar);
	                    
	                    $extension = end( explode('.',$rec['src']) );
	                    

	                    if($resultado !== FALSE & $extension != 'gif')
	                    {
	                        // con esto se toma la miniatura de 640
	                        //echo $rec['src'].'<br>';
	                        $rec['src'] = str_replace('/img/','/640/', $rec['src']);
	                        //echo $rec['src'];
	                        //echo "La subcadena '$buscar' fue encontrada dentro de la cadena '$cadena' en la posición: '$resultado'";
	                    }

							$link  ='<a href="/post/'.$rec['id_ref'].'" style="text-decoration:none">
										<img src="'.$rec['src'].'" class="" style="max-width: 100px;" />
							  		</a>';
							$tipo_contenido = 'Imagen';
						break;

						case '3' :
							$video = $this->parse_youtube_url($rec['codigo'],'hqthumb');	
							if($video == 'codigo_embed')
		                    {
		                        $video      = 'img/mini_video.png';
		                        $cod_video  = $rec['codigo'];
		                    }
		                    else
		                    {
		                        //$cod_video  = $c_sistema->parse_youtube_url($rec['codigo'],'embed');    
		                    }
		                    
		                    $link = '<img  src="'.$video.'" width="32" class="mini" /><span class="text-muted"> '.preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']).'</span>';
		                    $tipo_contenido = 'Video';

						break;

						case '6':
							$link = ' <a href="/post/'.$rec['id_ref'].'" style="text-decoration:none"><span class="text-primary">'.$rec['descripcion'].';</span></a>';
							$tipo_contenido = 'Estado';
						break;
						
					}

					switch ($rec['id_tipo_notificacion']) 
					{
						case '1':
							// Cuando le gustan un contenido
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'le gusto tu '.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '2':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'le gusto tu '.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '3':
							// Cuando comentan en un contenido
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];							
							$tmp['des']				= 'coment&oacute; :  &Prime;'. $rec['detalles'].'&Prime;';
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '4':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'le gusto tu '.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '5':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'le gusto tu '.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '6':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'le gusto tu '.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '7':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'le gusto tu .'.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							//$tmp['contenido']		= $link;						
						break;

						case '8':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'le gusto tu '.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '9':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'comenz&oacute; a seguirte ;)';
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= '';
						break;

						case '10':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= 'compartio tu '.$tipo_contenido;
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;						
						break;

						case '11':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= $rec['detalles'];
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;					
						break;

						case '12':
							// contenido de links
							$tmp['avatar']			= $rec['avatar'];
							$tmp['tipo']			= $rec['id_tipo_notificacion'];
							$tmp['nombre_usuario']	= $rec['nombre_usuario'];
							$tmp['icono']			= $iconos[$rec['id_tipo_notificacion']];
							$tmp['detalles']		= $rec['detalles'];
							$tmp['des']				= $rec['detalles'];
							$tmp['comentario']		= $rec['comentario'];
							$tmp['fecha_mini']		= $this->hace($rec['fecha']);
							$tmp['link_c']			= $rec['id_ref'];
							$tmp['contenido']		= $link;					
						break;


					}// fin switch 
					$tmp['id_notificacion'] = $rec['id_notificacion'];
					$data[] = $tmp;
				} // fin foreach


				
			}// fin count
			else
			{
				$data = $r;
			}


			return $data;
		}


        function registrarNotificacion($datos)
		{
			$valores['id_tipo_notificacion']= $datos['id_tipo'];
			$valores['id_ref'] 				= $datos['id_ref'];
			
			$valores['detalles'] 			= $datos['detalles'];
			$valores['fecha'] 				= date('Y-m-d H:i:s',time());

			if($datos['id_usuario'] != '')
			{
				$valores['id_usuario']			= $datos['id_usuario'];	
			}
			else
			{
				$valores['id_usuario']			= $_SESSION['s']['id_usuario'];
			}
			

		 	$r = $this->registrar_notificacion($valores);

		 	if($r->affectedRows() > 0 )
			{
				$data['codigo']  = '000';
				$data['mensaje'] = 'Exito';
			}
			else
			{
				$data['codigo']  = '001';
				$data['mensaje'] = 'Error';
			}

			return $data;
		}

         function obtenerNumNotificacionesPendientes()
		{
			$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
			$valores['nivel'] 		= '1';

			$r = $this->count_notificaciones_pendientes($valores);
			$r = $this->ConvertirResultArray($r);

			return $r;
		}

		function actualizarUltNotificacion($datos)
		{
			$valores['id_ult_not'] 	= $datos['id_ult_not'];
			$valores['id_usuario']	= $datos['id_usuario'];

			$r = $this->actualizar_ult_notificacion($valores);

			if($r->affectedRows() > 0 )
			{
				$data['codigo']  = '000';
				$data['mensaje'] = 'Exito';
			}
			else
			{
				$data['codigo']  = '001';
				$data['mensaje'] = 'Error';
			}

			return $data;
		}

		function obtenerSeguidoresNombreUsuario($datos)
        {
	     	$valores['nombre_usuario'] 	= $datos['nombre_usuario'];
	     	$valores['id_usuario']		= $_SESSION['s']['id_usuario'];

	     	$r = $this->listado_seguidores_usuarios($valores);
	     	$r = $this->ConvertirResultMatriz($r);

	     	return $r;
       }

        function obtenerSiguiendoNombreUsuarioMini($datos)
        {
	     	$valores['nombre_usuario'] 	= $datos['nombre_usuario'];
	     	$valores['id_usuario']		= $_SESSION['s']['id_usuario'];

	     	$r = $this->listado_usuarios_siguiendo_mini($valores);
	     	$r = $this->ConvertirResultMatriz($r);

	     	return $r;
       }

       function obtenerSiguiendoNombreUsuario($datos)
        {
	     	$valores['nombre_usuario'] 	= $datos['nombre_usuario'];
	     	$valores['id_usuario']		= $_SESSION['s']['id_usuario'];

	     	$r = $this->listado_usuarios_siguiendo($valores);
	     	$r = $this->ConvertirResultMatriz($r);

	     	return $r;
       }

       function obtenerUsuarioSeguir($datos)
       {
	     	$valores['id_usuario']	= $_SESSION['s']['id_usuario'];

	     	$valores['filtro']		= $datos['filtro'];
	     	$valores['consulta']	= $datos['consulta'];

	     	$r = $this->listado_usuarios_seguir($valores);
	     	$r = $this->ConvertirResultMatriz($r);

	     	return $r;
       }

       

		function obtenerDatosDashboardUsuario()
        {
	     	$valores['id_usuario']		= $_SESSION['s']['id_usuario'];

	     	$r = $this->listado_datos_dashboard_usuario2($valores);
	     	$r = $this->ConvertirResultArray($r);

	     	return $r;
       }

       function obtenerDatosDashboardUsuario2($datos)
        {
	     	$valores['id_usuario']		= $datos['id_usuario'];

	     	$r = $this->listado_datos_dashboard_usuario($valores);
	     	$r = $this->ConvertirResultArray($r);

	     	return $r;
       }

       function actualizarEstadisticasUsuario($datos)
       {
       		$r = $this->actualizar_estadisticas_usuario($datos);

			if($r->affectedRows() > 0 )
			{
				$data['codigo']  = '000';
				$data['mensaje'] = 'Exito';
			}
			else
			{
				$data['codigo']  = '001';
				$data['mensaje'] = 'Error';
			}

			return $data;
       }

       function actualizarEstadisticasContenido($datos)
       {
       		$r = $this->actualizar_estadisticas_contenido($datos);

			if($r->affectedRows() > 0 )
			{
				$data['codigo']  = '000';
				$data['mensaje'] = 'Exito';
			}
			else
			{
				$data['codigo']  = '001';
				$data['mensaje'] = 'Error';
			}

			return $data;
       }

	    


	    function listadoUsuariosParaSeguir()
	    {
	    	$valores['id_usuario'] = $_SESSION['s']['id_usuario'];

	    	$r = $this->listado_usuarios_para_seguir($valores);
	    	$r = $this->ConvertirResultMatriz($r);

	     	return $r;	
	     	
	    }

	    function obtenerUsuariosOnline()
	    {	    	
	    	$r = $this->listado_usuarios_online();
	    	$r = $this->ConvertirResultMatriz($r);

	     	return $r;	
	    }
	
	
	    function registrarArchivoGeneral($file)
	    {
	    	$valores     = array();
	        $data        = array();
	        $alto        = 160;
	        $ancho       = 160;	        
	        $raiz        = 'src/videos/';	        
	        $dir_temp    = 'src/tmp/'; 

	        //$calidad     = 95; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        //print_r($file);

	        
	       
	        #Nombre del archivo 
	        $nombre = time();

	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file2']["type"];
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file2']["tmp_name"];
	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file2']["size"];

	        

	        

	        $data['tamanio'] = $this->tamano_archivo($file['file2']["size"]);

	        //print_r($tamanio);

	        if($tamanio > 10000240)
	        {
	        	$data['codigo']  = '001';
	            $data['mensaje'] = 'El tama&ntilde;o del video es mayor a 10 MB';               
	            return $data;
	        }


	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file2']["type"];

	         #Obtenemos el nombre real del archivo   
	        $valores['tipo_archivo']  = $this->extension($file['file2']['name']);
	        $nombre_archivo = $nombre.'.'.$valores['tipo_archivo'];
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch( $valores['tipo_archivo'])
	        {
	        	case 'webm' : $data['tipo_archivo'] = 'webm' ;	break;	  
	        	case '3gp'  : $data['tipo_archivo'] = '3gp' ;	break;	  
	        	case 'mp4'  : $data['tipo_archivo'] = 'mp4' ;	break;	  

	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos WEBM';
	                return $data;
	            break;
	               
	        }
	       
	       


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $raiz;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;	               
	                
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['tipo_archivo']   = $valores['tipo_archivo'];
	                $data['src']			= $raiz.$nombre_archivo;
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
	    }

	    function registrarArchivoGeneralAjax($file)
	    {
	    	$valores     = array();
	        $data        = array();
	        $alto        = 160;
	        $ancho       = 160;	        
	        $raiz        = '../src/videos/';	        
	        $dir_temp    = '../src/tmp/'; 

	        //$calidad     = 95; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        //print_r($file);
	       
	        #Nombre del archivo 
	        $nombre = time();

	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file2']["type"];
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file2']["tmp_name"];
	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file2']["size"];

	        $data['tamanio'] = $this->tamano_archivo($file['file2']["size"]);


	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file2']["type"];

	         #Obtenemos el nombre real del archivo   
	        $valores['tipo_archivo']  = $this->extension($file['file2']['name']);
	        $nombre_archivo = $nombre.'.'.$valores['tipo_archivo'];
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch( $valores['tipo_archivo'])
	        {
	        	case 'webm' : $data['tipo_archivo'] = 'webm' ;	break;	            
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos WEBM';
	                return $data;
	            break;
	               
	        }
	       
	       


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $raiz;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;	               
	                
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['tipo_archivo']   = $valores['tipo_archivo'];
	                $data['src']			= $raiz.$nombre_archivo;
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
	    }

	    function registrarArchivoMp3lAjax($file)
	    {
	    	$valores     = array();
	        $data        = array();	        
	        $raiz        = '../src/mp3/';	        
	        $dir_temp    = '../src/tmp/'; 

	        //$calidad     = 95; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        //print_r($file);
	       
	        #Nombre del archivo 
	        $nombre = time();

	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file_mp3']["type"];
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file_mp3']["tmp_name"];
	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file_mp3']["size"];

	        $data['tamanio'] = $this->tamano_archivo($file['file_mp3']["size"]);


	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file_mp3']["type"];

	         #Obtenemos el nombre real del archivo   
	        $valores['tipo_archivo']  = $this->extension($file['file_mp3']['name']);
	        $nombre_archivo = $nombre.'.'.$valores['tipo_archivo'];
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch( $valores['tipo_archivo'])
	        {
	        	case 'mp3' : $data['tipo_archivo'] = 'mp3' ;	break;	            
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos MP3';
	                return $data;
	            break;
	               
	        }
	       
	       


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $raiz;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;	               
	                
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['tipo_archivo']   = $valores['tipo_archivo'];
	                $data['src']			= str_replace('../','', $raiz.$nombre_archivo);
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
	    }


	    function registrarArchivoFondoWeb($file)
	    {
	    	$valores     = array();
	        $data        = array();
	        $alto        = 160;
	        $ancho       = 160;	        
	        $raiz        = 'src/wall/';	    
	        $dir_temp    = 'src/tmp/'; 

	        //$calidad     = 95; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        
	       
	        #Nombre del archivo 
	        $nombre = time();

	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file1']["type"];
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file1']["tmp_name"];
	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file1']["size"];

	        $data['tamanio'] = $this->tamano_archivo($file['file1']["size"]);


	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file1']["type"];

	         #Obtenemos el nombre real del archivo   
	        $valores['tipo_archivo']  = $this->extension($file['file1']['name']);
	        $nombre_archivo = $nombre.'.'.$valores['tipo_archivo'];
	       
	        
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch($valores['tipo'])
	        {
	        	case 'image/jpg' : $data['tipo_archivo'] = 'jpg' ;	break;
	            case 'image/jpeg': $data['tipo_archivo'] = 'jpeg' ;	break;                                           
	            case 'image/png' : $data['tipo_archivo'] = 'png' ;	break;
	            case 'image/gif' : $data['tipo_archivo'] = 'gif' ;	break;
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
	                return $data;
	            break;
	               
	        }
	       
	       


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $raiz;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;	               
	                
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['tipo_archivo']   = $valores['tipo_archivo'];
	                $data['src']			= $raiz.$nombre_archivo;
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
	    }



	    function extension($str) 
		{
		        return end(explode(".", $str));
		}


		function registrarImagenGeneral($file)
		{
			$valores     = array();
	        $data        = array();
	        $alto        = 720;
	        $ancho       = 720;	        
	        $raiz        = 'src/pic/640/';	        
	        $dir_temp    = 'src/pic/img/'; 

	        $calidad     = 100; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        //print_r($file);
	       
	        #Nombre del archivo 
	        $nombre = 'redgalaxy.org_'.time();
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file1']["tmp_name"];
	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file1']["size"];

	        $data['tamanio'] = $this->tamano_archivo($file['file1']["size"]);


	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file1']["type"];

	        
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch($valores['tipo'])
	        {
	        	case 'image/jpg' : $data['tipo_archivo'] = 'jpg' ;	break;
	            case 'image/jpeg': $data['tipo_archivo'] = 'jpeg' ;	break;                                           
	            case 'image/png' : $data['tipo_archivo'] = 'png' ;	break;
	            case 'image/gif' : $data['tipo_archivo'] = 'gif' ;	break;
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
	                return $data;
	            break;
	               
	        }
	       
	        #Obtenemos el nombre real del archivo                
	        $nombre_archivo = $nombre.'.'.$data['tipo_archivo'];


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $dir_temp;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;
	               
	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho;
	                $max_alto = $alto;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz . $nombre_archivo,$calidad);

	                
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['src_mini']    	= str_replace('../', '',$raiz.$nombre_archivo);
	                $data['src']			= str_replace('../', '',$dir_temp.$nombre_archivo);
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
		}


		function registrarImagenGeneralAjax($file)
		{
			$valores     = array();
	        $data        = array();
	        $alto        = 720;
	        $ancho       = 720;	        
	        $raiz        = '../src/pic/640/';	        
	        $dir_temp    = '../src/pic/img/'; 

	        $calidad     = 100; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        //print_r($file);
	       
	        #Nombre del archivo 
	        $nombre = 'redgalaxy.org_'.time();
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file1']["tmp_name"];
	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file1']["size"];

	        $data['tamanio'] = $this->tamano_archivo($file['file1']["size"]);


	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file1']["type"];

	        
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch($valores['tipo'])
	        {
	        	case 'image/jpg' : $data['tipo_archivo'] = 'jpg' ;	break;
	            case 'image/jpeg': $data['tipo_archivo'] = 'jpeg' ;	break;                                           
	            case 'image/png' : $data['tipo_archivo'] = 'png' ;	break;
	            case 'image/gif' : $data['tipo_archivo'] = 'gif' ;	break;
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
	                return $data;
	            break;
	               
	        }
	       
	        #Obtenemos el nombre real del archivo                
	        $nombre_archivo = $nombre.'.'.$data['tipo_archivo'];


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $dir_temp;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;
	               
	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho;
	                $max_alto = $alto;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz . $nombre_archivo,$calidad);

	                
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['src_mini']    	= str_replace('../', '',$raiz.$nombre_archivo);
	                $data['src']			= str_replace('../', '',$dir_temp.$nombre_archivo);
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
		}

		function registrarImagenGeneralDetalladoAjax($file,$id)
		{
			$valores     = array();
	        $data        = array();
	        $alto        = 720;
	        $ancho       = 720;	        
	        $raiz        = '../src/pic/640/';	        
	        $dir_temp    = '../src/pic/img/'; 

	        $calidad     = 100; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        //print_r($file);
	       
	        #Nombre del archivo 
	        

	        for($i=2;$i<=count($file);$i++)
	        {
	        	$nombre = 'redgalaxy.org_'.time().rand();

	        	$index = "file_new_".$i;
	        	//echo 'Bandera 1';	        	
	        	//echo $index;
	        	//print_r($file[$index]);
	        	#verificamos que se selecciono una imagen
		        if(sizeof($file[$index])==0)
		        {
		            $data['codigo']  = '001';
		            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
		            return $data;
		        }

		        

		         #nombre temporal del archivo a subir
		        $valores['archivo'] = $file[$index]["tmp_name"];
		       
		        #Definimos un array para almacenar el tamaño del archivo
		        $tamanio=array();
		       
		        #obtenemos el tamaño del archivo
		        $tamanio =$file[$index]["size"];

		        $data['tamanio'] = $this->tamano_archivo($file[$index]["size"]);

		        //$file['file_img_'.$i]

		        #Obtenemos el mime o tipo de archivo
		        $valores['tipo'] = $file[$index]["type"];

		        
		       
		        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
		        switch($valores['tipo'])
		        {
		        	case 'image/jpg' : $data['tipo_archivo'] = 'jpg' ;	break;
		            case 'image/jpeg': $data['tipo_archivo'] = 'jpeg' ;	break;                                           
		            case 'image/png' : $data['tipo_archivo'] = 'png' ;	break;
		            case 'image/gif' : $data['tipo_archivo'] = 'gif' ;	break;
		            default:               
		                $data['codigo'] = '002';
		                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
		                return $data;
		            break;
		               
		        }

		        
		        #Obtenemos el nombre real del archivo                
	       		 $nombre_archivo = $nombre.'.'.$data['tipo_archivo'];

	       		 //Verificamos de nuevo que se selecciono un archivo
		        if( $valores['archivo'] != "none" )
		        {   
		            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
		            if(!is_dir($dir_temp))
		            {
		                //mkdir($raiz, 0777, true);
		                mkdir($dir_temp,0777); 
		            }

		            #Crea la ruta de destino de la carpeta del folio
		            $destino = $dir_temp;
		           
		            #Aqui se mueve el archivo y se le coloca el nombre final
		            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
		            {
		                #Ruta de la original
		                $rtOriginal = $destino.$nombre_archivo;
		               
		                #Dependiendo de la extensión llamamos a distintas funciones
		                switch ($valores['tipo'])
		                {
		                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
		                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
		                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
		                }
		                    
		                //Definir tamaño máximo y mínimo
		                $max_ancho = $ancho;
		                $max_alto = $alto;
		                 
		                #Recoger ancho y alto de la original
		                list($ancho,$alto)=getimagesize($rtOriginal);
		                 
		                #/Calcular proporción ancho y alto
		                $x_ratio = $max_ancho / $ancho;
		                $y_ratio = $max_alto / $alto;


		                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
		                #Si es más pequeña que el máximo no redimensionamos
		                    $ancho_final = $ancho;
		                    $alto_final = $alto;
		                }
		                #si no calculamos si es más alta o más ancha y redimensionamos
		                elseif (($x_ratio * $alto) < $max_alto){
		                    $alto_final = ceil($x_ratio * $alto);
		                    $ancho_final = $max_ancho;
		                }
		                else{
		                    $ancho_final = ceil($y_ratio * $ancho);
		                    $alto_final = $max_alto;
		                }

		                #Crear lienzo en blanco con proporciones
		                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
		                 
		                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
		                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
		                 
		                #Limpiar memoria
		                imagedestroy($original);

		                #Se crea la imagen final en el directorio indicado
		                imagejpeg($lienzo,$raiz . $nombre_archivo,$calidad);

		                
		                $data['codigo']     	= '000';
		                $data['mensaje']    	= 'Archivo subido exitosamente';
		                $data['src_mini']    	= str_replace('../', '',$raiz.$nombre_archivo);
		                $data['src']			= str_replace('../', '',$dir_temp.$nombre_archivo);

		                $data['id_contenido']	= $id;

		                $r = $this->registrar_contenido_imagenes($data);


		            }
		            else
		            {
		                $data['codigo'] = '003';
		                $data['mensaje']= 'Error al Subir el archivo';
		            }
		        }


	        }
	       
	       
	        

	       


	       
	        
	       
	        


	        
	       
	        return $data;
		}

		

		function registrarImagenGeneralMensajeInboxAjax($file)
		{
			$valores     = array();
	        $data        = array();
	        $alto        = 64;
	        $ancho       = 64;	        
	        $raiz        = '../src/inbox/64/';
	        $dir_temp    = '../src/inbox/img/'; 

	        $calidad     = 95; #Definimos la calidad de la imagen final

	        $data['src'] 			= '';
	        $data['tipo_archivo']	= '';
	        $data['tamanio']		= '';

	        //print_r($file);
	       
	        #Nombre del archivo 
	        $nombre = 'in_'.time().'_'.md5(uniqid(rand()));
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file_inbox']["tmp_name"];
	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file_inbox']["size"];

	        $data['tamanio'] = $this->tamano_archivo($file['file_inbox']["size"]);


	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file_inbox']["type"];

	        
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch($valores['tipo'])
	        {
	        	case 'image/jpg' : $data['tipo_archivo'] = 'jpg' ;	break;
	            case 'image/jpeg': $data['tipo_archivo'] = 'jpeg' ;	break;                                           
	            case 'image/png' : $data['tipo_archivo'] = 'png' ;	break;
	            case 'image/gif' : $data['tipo_archivo'] = 'gif' ;	break;
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
	                return $data;
	            break;
	               
	        }
	       
	        #Obtenemos el nombre real del archivo                
	        $nombre_archivo = $nombre.'.'.$data['tipo_archivo'];


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $dir_temp;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;
	               
	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho;
	                $max_alto = $alto;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz . $nombre_archivo,$calidad);

	                
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['src_mini']    	= str_replace('../', '',$raiz.$nombre_archivo);
	                $data['src']			= str_replace('../', '',$dir_temp.$nombre_archivo);
	                $data['tipo_archivo']	= $data['tipo_archivo'];
	                $data['tamanio']		= $data['tamanio'];
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
		}






		function tamano_archivo($peso , $decimales = 2 ) 
		{
			$clase = array(" Bytes", " KB", " MB", " GB", " TB"); 
			$decimales = 2;

			//echo 'peso : '.$peso;

			//echo (int)pow(1024,($i = floor(log($peso, 1024))));	

			return round($peso/(int)pow(1024,($i = floor(log($peso, 1024)))),$decimales ).$clase[$i];
		} 

		function registrarImagenGeneralMeme($file)
		{
	        $valores     = array();
	        $data        = array();
	        $alto        = 128;
	        $ancho       = 128;
	        $alto2       = 480;
	        $ancho2      = 480;        
	        $raiz        = 'src/memes/128/';
	        $raiz2       = 'src/memes/480/';
	        $dir_temp    = 'src/memes/temp/'; 

	        $calidad     = 100; #Definimos la calidad de la imagen final
	       
	        //$valores['id_usuario'] = $_SESSION['s']['id_usuario'];     

	        #Nombre del archivo 
	        $nombre = 'redgalaxy.org_'.time();
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file1']["tmp_name"];


	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file1']["size"];
	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file1']["type"];

	        
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch($valores['tipo'])
	        {
	            case 'image/jpg' : $data['tipo_archivo'] = 'jpg' ;	break;
	            case 'image/jpeg': $data['tipo_archivo'] = 'jpeg' ;	break;                                           
	            case 'image/png' : $data['tipo_archivo'] = 'png' ;	break;
	            case 'image/gif' : $data['tipo_archivo'] = 'gif' ;	break;
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
	                return $data;
	            break;
	               
	        }
	       
	        #Obtenemos el nombre real del archivo                
	        //$nombre_archivo = $valores['id_usuario'].'.jpg';
	        $nombre_archivo = $nombre.'.'.$data['tipo_archivo'];
	          


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $dir_temp;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;
	               
	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho;
	                $max_alto = $alto;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz . $nombre_archivo,$calidad);

	                ////////////////////////////////////////////////////////////////////////////
	                // SEGUNDA IMAGEN    
	                ////////////////////////////////////////////////////////////////////////////

	                #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	                if(!is_dir($raiz2))
	                {
	                    //mkdir($raiz, 0777, true);
	                    mkdir($raiz2,0777); 
	                }

	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho2;
	                $max_alto = $alto2;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz2 . $nombre_archivo,$calidad);
	               
	                $data['id_usuario'] 	= $valores['id_usuario'];
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['src_mini']    	= str_replace('../', '',$raiz.$nombre_archivo);
	                $data['src']			= str_replace('../', '',$raiz2.$nombre_archivo);

	                $data['avatar']			= 'http://redgalaxy.org/'.$data['rutaimagen'];
	                //$data['avatar']			= 'http:///s/'.$data['rutaimagen'];

	                //$this->actualizar_ruta_avatar($data);
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
		}

		function registrarImagenGeneralMemeAjax($file)
		{
	        $valores     = array();
	        $data        = array();
	        $alto        = 128;
	        $ancho       = 128;
	        $alto2       = 480;
	        $ancho2      = 480;        
	        $raiz        = '../src/memes/128/';
	        $raiz2       = '../src/memes/480/';
	        $dir_temp    = '../src/memes/temp/'; 

	        $calidad     = 100; #Definimos la calidad de la imagen final
	       
	        //$valores['id_usuario'] = $_SESSION['s']['id_usuario'];     

	        #Nombre del archivo 
	        $nombre = 'redgalaxy.org_'.time();
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file1']["tmp_name"];


	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file1']["size"];
	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file1']["type"];

	        
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch($valores['tipo'])
	        {
	            case 'image/jpg' : $data['tipo_archivo'] = 'jpg' ;	break;
	            case 'image/jpeg': $data['tipo_archivo'] = 'jpeg' ;	break;                                           
	            case 'image/png' : $data['tipo_archivo'] = 'png' ;	break;
	            case 'image/gif' : $data['tipo_archivo'] = 'gif' ;	break;
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
	                return $data;
	            break;
	               
	        }
	       
	        #Obtenemos el nombre real del archivo                
	        //$nombre_archivo = $valores['id_usuario'].'.jpg';
	        $nombre_archivo = $nombre.'.'.$data['tipo_archivo'];
	          


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $dir_temp;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;
	               
	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho;
	                $max_alto = $alto;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz . $nombre_archivo,$calidad);

	                ////////////////////////////////////////////////////////////////////////////
	                // SEGUNDA IMAGEN    
	                ////////////////////////////////////////////////////////////////////////////

	                #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	                if(!is_dir($raiz2))
	                {
	                    //mkdir($raiz, 0777, true);
	                    mkdir($raiz2,0777); 
	                }

	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho2;
	                $max_alto = $alto2;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz2 . $nombre_archivo,$calidad);
	               
	                $data['id_usuario'] 	= $valores['id_usuario'];
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['src_mini']    	= str_replace('../', '',$raiz.$nombre_archivo);
	                $data['src']			= str_replace('../', '',$raiz2.$nombre_archivo);

	                $data['avatar']			= 'http://redgalaxy.org/'.$data['rutaimagen'];
	                //$data['avatar']			= 'http:///s/'.$data['rutaimagen'];

	                //$this->actualizar_ruta_avatar($data);
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;
		}


		function subirAvatarUsuario($file,$datos)
	    {
		    $valores     = array();
	        $data        = array();
	        $alto        = 48;
	        $ancho       = 48;
	        $alto2       = 200;
	        $ancho2      = 200;        
	        $raiz        = 'src/avatar/48/';
	        $raiz2       = 'src/avatar/200/';
	        $dir_temp    = 'src/avatar/temp/'; 

	        $calidad     = 90; #Definimos la calidad de la imagen final
	       
	        $valores['id_usuario'] = $_SESSION['s']['id_usuario'];     
	       
	       
	        #verificamos que se selecciono una imagen
	        if(sizeof($file)==0)
	        {
	            $data['codigo']  = '001';
	            $data['mensaje'] = 'Es necesario seleccionar un archivo';               
	            return $data;
	        }

	        #nombre temporal del archivo a subir
	        $valores['archivo'] = $file['file1']["tmp_name"];


	       
	        #Definimos un array para almacenar el tamaño del archivo
	        $tamanio=array();
	       
	        #obtenemos el tamaño del archivo
	        $tamanio = $file['file1']["size"];
	       
	        #Obtenemos el mime o tipo de archivo
	        $valores['tipo'] = $file['file1']["type"];

	        
	       
	        # solo se permite subir archivos, open projec, projec manager, excel,  y pdf               
	        switch($valores['tipo'])
	        {
	            case 'image/jpeg': break;                                           
	            case 'image/png' : break;
	            case 'image/gif' : break;
	            default:               
	                $data['codigo'] = '002';
	                $data['mensaje']= 'Solo se permite subir archivos open *.jpe, *.png, y *.gif';
	                return $data;
	            break;
	               
	        }
	       
	        #Obtenemos el nombre real del archivo                
	        $nombre_archivo = $valores['id_usuario'].'.jpg';


	        //Verificamos de nuevo que se selecciono un archivo
	        if( $valores['archivo'] != "none" )
	        {   
	            #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	            if(!is_dir($dir_temp))
	            {
	                //mkdir($raiz, 0777, true);
	                mkdir($dir_temp,0777); 
	            }

	            #Crea la ruta de destino de la carpeta del folio
	            $destino = $dir_temp;
	           
	            #Aqui se mueve el archivo y se le coloca el nombre final
	            if (move_uploaded_file($valores['archivo'], $destino.$nombre_archivo))
	            {
	                #Ruta de la original
	                $rtOriginal = $destino.$nombre_archivo;
	               
	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho;
	                $max_alto = $alto;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz . $nombre_archivo,$calidad);

	                ////////////////////////////////////////////////////////////////////////////
	                // SEGUNDA IMAGEN    
	                ////////////////////////////////////////////////////////////////////////////

	                #Valida que el directorio exista, si no lo crea y le asigna los permisos.   
	                if(!is_dir($raiz2))
	                {
	                    //mkdir($raiz, 0777, true);
	                    mkdir($raiz2,0777); 
	                }

	                #Dependiendo de la extensión llamamos a distintas funciones
	                switch ($valores['tipo'])
	                {
	                    case "image/jpeg": $original = imagecreatefromjpeg($rtOriginal);         break;
	                    case "image/png" : $original = imagecreatefrompng($rtOriginal);         break;
	                    case "image/gif" : $original = imagecreatefromgif($rtOriginal);         break;
	                }
	                    
	                //Definir tamaño máximo y mínimo
	                $max_ancho = $ancho2;
	                $max_alto = $alto2;
	                 
	                #Recoger ancho y alto de la original
	                list($ancho,$alto)=getimagesize($rtOriginal);
	                 
	                #/Calcular proporción ancho y alto
	                $x_ratio = $max_ancho / $ancho;
	                $y_ratio = $max_alto / $alto;


	                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	                #Si es más pequeña que el máximo no redimensionamos
	                    $ancho_final = $ancho;
	                    $alto_final = $alto;
	                }
	                #si no calculamos si es más alta o más ancha y redimensionamos
	                elseif (($x_ratio * $alto) < $max_alto){
	                    $alto_final = ceil($x_ratio * $alto);
	                    $ancho_final = $max_ancho;
	                }
	                else{
	                    $ancho_final = ceil($y_ratio * $ancho);
	                    $alto_final = $max_alto;
	                }

	                #Crear lienzo en blanco con proporciones
	                $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
	                 
	                #Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
	                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	                 
	                #Limpiar memoria
	                imagedestroy($original);

	                #Se crea la imagen final en el directorio indicado
	                imagejpeg($lienzo,$raiz2 . $nombre_archivo,$calidad);
	               
	                $data['id_usuario'] 	= $valores['id_usuario'];
	                $data['codigo']     	= '000';
	                $data['mensaje']    	= 'Archivo subido exitosamente';
	                $data['rutaimagen']    	= str_replace('../', '',$raiz.$nombre_archivo);
	                $data['rutaimageng']	= str_replace('../', '',$raiz2.$nombre_archivo);

	                //print_r($data);

	                $data['avatar']			= $data['rutaimageng'];//'http://mypack.me/'.$data['rutaimagen'];
	                //$data['avatar']			= 'http:///s/'.$data['rutaimagen'];

	                $_SESSION['s']['avatar']	= $data['rutaimageng'];

	                $this->actualizar_ruta_avatar($data);
	            }
	            else
	            {
	                $data['codigo'] = '003';
	                $data['mensaje']= 'Error al Subir el archivo';
	            }
	        }
	       
	        return $data;

	    }

		function ConvertirResultArray($result)
		{
			$data = array();

			if($result->size() > 0)
			{
				$data = $result->fetch();
			}

			return $data;
		}

		function ConvertirResultMatriz($result)
		{
			$data = array();

			if($result->size() > 0)
			{
				while($rec = $result->fetch())
				{
					$data[] = $rec;
				}
			}

			return $data;
		}

		function obtenerDatosGenerales()
		{
			$r = $this->obtener_datos_generales();
			$r = $this->ConvertirResultArray($r);

			return $r;
		}

		function obtenerGrafica7dias()
		{
			$r = $this->obtener_grafica_7_dias();
			$r = $this->ConvertirResultMatriz($r);

			return $r;
		}

       function obtenerGraficaAnual()
		{
            $valores['anio'] = '2016';
			$r = $this->obtener_grafica_visitas_general($valores);
			$r = $this->ConvertirResultArray($r);

			return $r;
		}

	    function obtenerPaginasVisitasIP($datos)
	    {
	        $valores['fecha']   = $datos['fecha'];
	        $valores['ip']      = $datos['ip'];

	        $r = $this->obtener_paginas_visitas_ip($valores);
	        $r = $this->ConvertirResultMatriz($r);

	        return $r;
	    }

		function obtenerFechasVisitasIP($datos)
	    {
	        $valores['ip']      = $datos['ip'];

	        $r = $this->obtener_fechas_visitas_ip($valores);
	        $r = $this->ConvertirResultMatriz($r);

	        return $r;
	    }

		function obtenerVisitasIP()
		{
			$valores['fecha']	= date('Y-m-d',time());

			$r = $this->obtener_visitas_ip($valores);

			$r = $this->ConvertirResultMatriz($r);

			return $r;
		}

		
		#Funciona que calcula el numero de paginas y el limit para el paginado en la consulta
		# En esta funcion no se calcula el numero de registro para la pantalla utilizada
		function crear_paginas2($datos)
		{
			$data['row_page'] 	= '10';
			$data['page']	  	= $datos['page'];			
			$data['num_row']  	= $datos['num_row'];

			$data['lastpage'] 	  = ceil( $data['num_row'] / $data['row_page']);
			
			if($data['page']=='')
			{
				$data['page'] = 1;	
			}
			if($data['page'] > $data['lastpage'] )
			{
				$data['page'] = $data['lastpage'];
			}
			if($data['page'] <= 0)
			{
				$data['page'] = 1;
			}

			$data['limit'] = ' LIMIT '.($data['row_page'] * ($data['page'] - 1)).','.$data['row_page'];

			return $data;
		}

		function comprobar_email($email)
	    {
		    $mail_correcto = 0;
		    //compruebo unas cosas primeras
		    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
		       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
		          //miro si tiene caracter .
		          if (substr_count($email,".")>= 1){
		             //obtengo la terminacion del dominio
		             $term_dom = substr(strrchr ($email, '.'),1);
		             //compruebo que la terminación del dominio sea correcta
		             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
		                //compruebo que lo de antes del dominio sea correcto
		                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
		                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
		                if ($caracter_ult != "@" && $caracter_ult != "."){
		                   $mail_correcto = 1;
		                }
		             }
		          }
		       }
		    }
		    if ($mail_correcto)
		       return 1;
		    else
		       return 0;
		} 

		function limpiar($datos)
	    {
	    	//print_r($datos);
	    	if(count($datos) > 0)
	    	{
		        foreach ($datos as $elemnto => $cadena)
		        {
		            #valida si es otro array. Para los detallados
		            if (is_array($cadena))
		            {
		                $datos[$elemnto]= limpiar($cadena);
		            }
		            else
		            {   
		                #limpia las cadenas de codigo html, php, elimina los espacios en blanco 
						#y agrega '/ en las comillas simples  y dobles
		                $cadena          = trim($cadena);		                
		                $cadena          = strip_tags($cadena);
		                $cadena          = addslashes($cadena);                
		                $datos[$elemnto] = $cadena;
		            }
		        }
		    }
	        return $datos;
	    }
	    
	    function hace($fecha)
		{
			$a = substr($fecha,0,4);
    		$m = substr($fecha,5,2);
    		$d = substr($fecha,8,2);
    		$h = substr($fecha,11,2);
    		$i = substr($fecha,14,2);
    		$s = substr($fecha,17,2);

			$fecha2 	= mktime($h, $i, $s, $m, $d, $a);
			$diferencia = time() - $fecha2 ;

			$segundos 	= $diferencia ;
			$minutos 	= round($diferencia / 60 );
			$horas 		= round($diferencia / 3600 );
			$dias 		= round($diferencia / 86400 );
			$semanas 	= round($diferencia / 604800 );
			$mes 		= round($diferencia / 2419200 );
			$anio 		= round($diferencia / 29030400 );

			$respuesta = '';

			if($segundos <= 60)
			{
				$respuesta = "hace $segundos segundos";
			}
			else if($minutos <=60)
			{
				if($minutos==1)
				{
					$respuesta = "hace un minuto";
				}
				else
				{
					$respuesta = "hace $minutos minutos";
				}
			}
			else if($horas <=24)
			{
				if($horas==1)
				{
					$respuesta = "hace una hora";
				}
				else
				{
					$respuesta = "hace $horas horas";
				}
			}
			else if($dias <= 7)
			{
				if($dias==1)
				{
					$respuesta = "hace un dia";
				}
				else
				{
					$respuesta = "hace $dias dias";
				}
			}
			else if($semanas <= 4)
			{
				if($semanas==1)
				{
					$respuesta = "hace una semana";
				}
				else
				{
					$respuesta = "hace $semanas semanas";
				}
			}
			else if($mes <=12)
			{
				if($mes==1)
				{
					$respuesta = "hace un mes";
				}
				else
				{
					$respuesta = "hace $mes meses";
				}
			}
			else
			{
				if($anio==1)
				{
					$respuesta = "hace un a&ntilde;o";
				}
				else
				{
					$respuesta = "hace $anio a&ntilde;os";
				}
			}
			return $respuesta ;
		}// fin 

		function hace_mini($fecha)
		{
			$a = substr($fecha,0,4);
    		$m = substr($fecha,5,2);
    		$d = substr($fecha,8,2);
    		$h = substr($fecha,11,2);
    		$i = substr($fecha,14,2);
    		$s = substr($fecha,17,2);

			$fecha2 	= mktime($h, $i, $s, $m, $d, $a);
			$diferencia = time() - $fecha2 ;

			$segundos 	= $diferencia ;
			$minutos 	= round($diferencia / 60 );
			$horas 		= round($diferencia / 3600 );
			$dias 		= round($diferencia / 86400 );
			$semanas 	= round($diferencia / 604800 );
			$mes 		= round($diferencia / 2419200 );
			$anio 		= round($diferencia / 29030400 );

			$respuesta = '';

			if($segundos <= 60)
			{
				$respuesta = "$segundos s";
			}
			else if($minutos <=60)
			{
				if($minutos==1)
				{
					$respuesta = "1 m";
				}
				else
				{
					$respuesta = "$minutos m";
				}
			}
			else if($horas <=24)
			{
				if($horas==1)
				{
					$respuesta = "una h";
				}
				else
				{
					$respuesta = "$horas hs";
				}
			}
			else if($dias <= 7)
			{
				if($dias==1)
				{
					$respuesta = "un d";
				}
				else
				{
					$respuesta = "$dias d";
				}
			}
			else if($semanas <= 4)
			{
				if($semanas==1)
				{
					$respuesta = "una sem";
				}
				else
				{
					$respuesta = " $semanas sem";
				}
			}
			else if($mes <=12)
			{
				if($mes==1)
				{
					$respuesta = "un mes";
				}
				else
				{
					$respuesta = "$mes meses";
				}
			}
			else
			{
				if($anio==1)
				{
					$respuesta = "un a&ntilde;o";
				}
				else
				{
					$respuesta = " $anio a&ntilde;os";
				}
			}
			return $respuesta ;
		}// fin 

		#funcion para obtener miniatura de youtube 
		function parse_youtube_url($url,$return='embed',$width='',$height='',$rel=0)
		{
		    $urls = parse_url($url);

		    if(substr($url,1,6)=='iframe')
		    {
		    	$id = 'codigo_embed';
		    	return $id;
		    }
		 
		    //url is http://youtu.be/xxxx
		    if($urls['host'] == 'youtu.be'){ 
		        $id = ltrim($urls['path'],'/');
		    }
		    //url is http://www.youtube.com/embed/xxxx
		    else if(strpos($urls['path'],'embed') == 1){ 
		        $id = end(explode('/',$urls['path']));
		    }
		     //url is xxxx only
		    else if(strpos($url,'/')===false){
		        $id = $url;
		    }
		    //http://www.youtube.com/watch?feature=player_embedded&v=m-t4pcO99gI
		    //url is http://www.youtube.com/watch?v=xxxx
		    else{
		        parse_str($urls['query']);
		        $id = $v;
		        if(!empty($feature)){
		            $id = end(explode('v=',$urls['query']));
		        }
		    }
		    //return embed iframe
		    if($return == 'embed'){
		        return '
		<iframe src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" width="'.($width?$width:560).'" height="'.($height?$height:349).'"></iframe>
		';
		    }
		    //return normal thumb
		    else if($return == 'thumb'){
		        return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
		    }
		    //return hqthumb
		    else if($return == 'hqthumb'){
		        return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';
		    }
		    // else return id
		    else{
		        return $id;
		    }
		}

		function saca_dominio($url)
		{
		    $protocolos = array('http://', 'https://', 'ftp://', 'www.');
		    $url = explode('/', str_replace($protocolos, '', $url));
		    return $url[0];
		}

		function listadoCatSexos()
		{
			$r = $this->listado_sexos();
			$r = $this->ConvertirResultMatriz($r);
			return $r;	
		}

		function actualizarInfoInicio($datos)
		{
			$valores['id_usuario']  = $_SESSION['s']['id_usuario'];
			$valores['id_sexo']		= $datos['sexo'];
			$valores['bio']			= utf8_decode($datos['bio']);
			$valores['ubicacion']	= utf8_decode($datos['ubi']);
			$valores['fecha_ult'] 	= date('Y-m-d H:i:s',time());

			$r = $this->actualizacion_informacion_inicio($valores);
		
			if($r->affectedRows() > 0)
			{
				$data['codigo']  = '000';
				$data['mensaje'] = 'Registro de nuevo genero';
			}
			else
			{
				$data['codigo']  = '001';
				$data['mensaje'] = 'Ocurrio un error al registrar genero';	
			}
	
			return $data;

		}

		function obtenerCatSexo()
		{
			$r = $this->listado_sexos_activos();
			$r = $this->ConvertirResultMatriz($r);
			return $r;
		}

      	function registrarSexo($datos)
		{
			$valores['nombre_sexo'] = $datos['txtnombre'];
			$valores['id_usuario']	= '1';
			$valores['fecha']		= date('Y-m-d',time());
			$valores['status']		= 'A';

			$r = $this->registrar_sexo($valores);

			if($r->affectedRows() > 0)
			{
				$data['codigo']  = '000';
				$data['mensaje'] = 'Registro de nuevo genero';
			}
			else
			{
				$data['codigo']  = '001';
				$data['mensaje'] = 'Ocurrio un error al registrar genero';	
			}

			return $data;
		}

	
		function obtenerCorreoIDUsuario($datos)
		{
			$valores['id_usuario'] = $datos['id_usuario'];

			$r = $this->obtener_correo_usuario($valores);
			$r = $this->ConvertirResultArray($r);

			return $r;
		}

	function cargarContenidoNotificacionsMensajes($datos)
	{
		$valores['fecha_p']		= date("Y-m-d H:i:s",time());
		$valores['id_usuario']	= $_SESSION['s']['id_usuario'];
		// ultimo id de contenido
		$valores['id_last_c'] 	= $datos['id_last_c'];
		// ultimo id de mensajes
		$valores['id_last'] 	= $datos['id_last_m'];
		// ultimo id de notificaciones
		$valores['id_last_n'] 	= $datos['id_last_n'];
		// ultimo id de inbox
		$valores['id_inbox'] 	= $datos['id_inbox_max'];


		//$valores['id_mensaje_g'] 	= $datos['id_mensaje_g'];

		//$r = $this->count_contenido_nuevo($valores);

		//$r1 = $this->ConvertirResultMatriz($r);

		//$r2 = $this->listadoNotificacionesUsuario($valores);
		$r2 = $this->listadoNotificacionGeneral($valores);

		//$r3 = $this->cargarMensajesPendientesAjax($valores);

		$r4 = $this->contarInboxSinLeer($valores);


		//print_r($r3);
		
		//$r4 = $this->buscarMensajesNuevos($valores);

		//$data['contenido']		= $r1;
		$data['notificaciones'] = $r2;
		//$data['mensajes'] 		= $r3;
		$data['mensajes_inbox']	= $r4;

		return $data;


	}

	function obtenerCorreoPendientes()
	{
		$r = $this->listado_correos_pendientes();
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	function actualizarCorreoEnviado($datos)
	{
		$valores['id_correo_p'] = $datos['id_correo_p'];
		$valores['status']		= 'E';
		$valores['fecha_e']		= date("Y-m-d H:i:s",time());

		$r = $this->actualizar_correo_enviado($valores);
		
		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro de nuevo genero';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar genero';	
		}

		return $data;


	}

	function correo_nuevo_seguidor($datos)
	{
		$valores['id_usuario_pri']	= $datos['id_usuario_pri'];
		$valores['id_usuario_seg']  = $datos['id_usuario_seg'];

		$r = $this->obtener_datos_correo_seguimiento($valores);
		$r = $this->ConvertirResultArray($r);

		$valores['from']			= 'contacto@redgalaxy.org';
		$valores['to']				= $r['correo_usuario_destino'];
		$valores['tipo']			= '1';
		$valores['plantilla']		= '1';	
		$valores['fecha_c']			= date("Y-m-d H:i:s",time());
		$valores['fecha_e']			= '0000-00-00 00:00:00';
		$valores['status']			= 'P';	
		$valores['asunto']			= $r['nombre_usuario'].' ha comenzado a seguirte en Red Galaxy';
		$valores['mensaje'] 		= '<p style="font-size:14px;">Hola, Tienes un nuevo seguidor ;)</p>
										<p style="text-align:center;font-size:18px;">
											<img src="'.$r['avatar'].'" style="width:48px" /><br>
									    	<a  style="color:#0099BB;" href="http://redgalaxy.org/u/'.$r['nombre_usuario'].'">@'.$r['nombre_usuario'].'</a><br>
									    	<span style="color:#999">'.$r['bio'].'</span>
									    </p>
									   <br>
									   <br>
									   <br>
									   Visitanos en <a href="http://redgalaxy.org">Red Galaxy</a>';
		$this->registrar_correo_pendiente($valores);

	}

	function correo_nuevo_mensaje($datos)
	{
		$valores['id_usuario_envia']	= $datos['id_usuario_envia'];
		$valores['id_usuario_recibe'] 	= $datos['id_usuario_recibe'];
		$valores['mensaje'] 			= $datos['mensaje'];
		$valores['fecha'] 				= $datos['fecha'];

		$r = $this->obtener_datos_correo_mensaje($valores);
		$r = $this->ConvertirResultArray($r);

		$valores['nombre_usuario'] 	= $r['nombre_usuario'];
		$valores['bio']				= $r['bio'];

		$valores['to']				= $r['correo_usuario_destino'];
		$valores['from']			= 'contacto@redgalaxy.org';
		$valores['asunto']			= $valores['nombre_usuario'].' te ha enviado un mensaje';
		$valores['mensaje'] 		= '<p><a href="http://redgalaxy.org/u/'.$valores['nombre_usuario'].'">@'.$valores['nombre_usuario'].'</a> : '.$valores['mensaje'].'</p>
									   <br>
									   <br>
									   <br>
									   Visitanos en <a href="http://redgalaxy.org">Mypack</a>';
		$valores['mensaje']			=  $this->generar_plantilla_correo($valores);


		//print_r($valores);

		$this->enviar_correo($valores);


	}

	function enviar_correo_nuevo_usuario($datos)
	{		
		$valores['fecha'] 			= $datos['fecha_ult'];
		$valores['nombre_usuario'] 	= $datos['nombre_usuario'];
		$valores['correo']			= $datos['correo'];

		$valores['to']				= 'diego.guerra00@gmail.com';
		$valores['from']			= 'contacto@redgalaxy.org';
		$valores['asunto']			= 'Nuevo Usuario Mypack!!';
		$valores['mensaje'] 		= '<p>Se ha registrado un nuevo usuario<a href="http://redgalaxy.org/u/'.$valores['nombre_usuario'].'">@'.$valores['nombre_usuario'].'</a><br>
										correo : '.$valores['correo'].'<br>
										fecha : '.$valores['fecha'].'<br>
										</p>
									   <br>
									   <br>
									   <br>
									   Visitanos en <a href="http://redgalaxy.org">Mypack</a>';
		$valores['mensaje']			=  $this->generar_plantilla_correo($valores);		

		$this->enviar_correo($valores);
	}

	function enviar_correo_nuevo_usuario2($datos)
	{		
		$valores['fecha'] 			= $datos['fecha_ult'];
		$valores['nombre_usuario'] 	= $datos['nombre_usuario'];
		$valores['correo']			= $datos['correo'];

		$valores['to']				= $valores['correo'];
		$valores['from']			= 'contacto@redgalaxy.org';
		$valores['asunto']			= 'Bienvenido a Mypack!!';
		$valores['mensaje'] 		= '<p>Muchas gracias por registrarte en mypack, espero que te la pases muy bien <br>

										Detalles de tu cuenta: <br><br>
										usuario  : '.$datos['nombre_usuario'].'	<br>
										password : '.$datos['pass'].'	<br>
									   </p>
									   <br>
									   <br>
									   <br>
									   Visitanos en <a href="http://redgalaxy.org">Mypack</a>';
		$valores['mensaje']			=  $this->generar_plantilla_correo($valores);		

		$this->enviar_correo($valores);
	}

	function correo_invitacion_fundador($datos)
	{
		$valores['from']		= 'contacto@redgalaxy.org';
		$valores['to']			= $datos['correo'];
		$valores['tipo']		= '1';
		$valores['plantilla']	= '1';	
		$valores['fecha_c']		= date("Y-m-d H:i:s",time());
		$valores['fecha_e']		= '0000-00-00 00:00:00';
		$valores['status']		= 'P';	
		$valores['asunto']		= 'Invitacion a mypack - Red social privada';
		$valores['mensaje'] 	=  '<p style="font-size:18px;">
										Hola, Has sido invitado a unirte a mypack ;)
									</p>

									<p style="text-align:center;font-size:16px;">
										Mypack es una red social enfocada al buen humor y al relax. Entra y divirtete con las 
										imagenes mas graciosas y la mejor comunidad en internet. S&iacute; te encuentras aburrido en el 
										trabajo o escuela, escapate 5 minutos con nosotros y rie con las ocurrencias de nuestros 
										usuarios. 
									</p>
									<br>
									<br>
									<br>
									Visitanos en <a href="http://redgalaxy.org/index.php?id_ref='.$datos['id_usuario'].'">Mypack - comparte lo que te gusta ;)</a>';
		$this->registrar_correo_pendiente($valores);

	}


	function enviar_correo_nuevo_like($datos)
	{
		$valores['id_usuario']			= $_SESSION['s']['id_usuario'];
		$valores['nombre_usuario']		= $_SESSION['s']['nombre_usuario'];
		$valores['id_contenido'] 		= $datos['id_contenido'];
		$valores['fecha'] 				= $datos['fecha'];
		
		//$rec = $this->obtenerContenidoGeneralMini($valores);		

		# si es un link
		if($rec['id_tipo_contenido']=='1')
		{
			$contenido  = ' tu link <a href="http://redgalaxy.org/post/='.$rec['id_contenido'].'">'.$rec['nombre'].'</a>';
		}
		#si es una imagen
		if($rec['id_tipo_contenido']=='2')
		{          
			$contenido  = 'tu foto <br><div style="text-align:center"><a href="http://redgalaxy.org/post/'.$rec['id_contenido'].'" style="text-decoration:none">
					  	<img src="http://redgalaxy.org/'.$rec['src'].'" class="" style="max-width: 400px;" /></div>
					  </a><br>'.
					  $rec['descripcion'];
		}
		#Si es un video
        if($rec['id_tipo_contenido']=='3')
		{
            $video      = $this->parse_youtube_url($rec['codigo'],'hqthumb');
            if($video=='codigo_embed')
            {
                $video      = 'img/mini_video.png';                
            }
            $contenido = 'tu video <img  src="'.$video.'" width="400" class="mini" /><span class="text-muted">&Prime; '.preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']).'&Prime;</span>';                
		}
		#si es un estado
        if($rec['id_tipo_contenido']=='6')
        {
            $contenido = ' tu estado <span class="text-primary">'.$rec['descripcion'].';</span>';
        }
		
		$valores['from']			= 'contacto@redgalaxy.org';
		$valores['to']				= $rec['correo'];
		$valores['tipo']			= '1';
		$valores['plantilla']		= '1';	
		$valores['fecha_c']			= date("Y-m-d H:i:s",time());
		$valores['fecha_e']			= '0000-00-00 00:00:00';
		$valores['status']			= 'P';	
		$valores['asunto']			= 'A @'.$valores['nombre_usuario'].' le gusto tu publicacion';
		$valores['mensaje'] 		        = '<p><a href="http://redgalaxy.org/u/'.$valores['nombre_usuario'].'">@'.$valores['nombre_usuario'].'</a>
									  le gust&oacute; 
									  '.$contenido.'</p>
									   <br>
									   <br>
									   Visitanos en <a href="http://redgalaxy.org">Mypack</a>';

		$this->registrar_correo_pendiente($valores);
		
	}

	function enviar_correo_nuevo_comentario($datos)
	{
		$valores['comentario'] 		= $datos['comentario'];
		$valores['id_usuario'] 		= $_SESSION['s']['id_usuario'];
		$valores['nombre_usuario']	= $_SESSION['s']['nombre_usuario'];
		$valores['id_contenido']	= $datos['id_ref'];	

		$valores['tipo']			= '1';
		$valores['plantilla']		= '1';	
		$valores['fecha_c']			= date("Y-m-d H:i:s",time());
		$valores['fecha_e']			= '0000-00-00 00:00:00';
		$valores['status']			= 'P';		



		$rec 			= $this->obtenerContenidoGeneral($valores);
		$usuario_recibe = $this->obtenerCorreoIDUsuario($rec);

		# si es un link
		if($rec['id_tipo_contenido']=='1')
		{
			$contenido  = ' tu link <a href="http://redgalaxy.org/post/='.$rec['id_contenido'].'">'.$rec['nombre'].'</a>';
		}
		#si es una imagen
		if($rec['id_tipo_contenido']=='2')
		{
			$contenido  = 'tu foto <a href="http://redgalaxy.org/post/'.$rec['id_contenido'].'" style="text-decoration:none">
					  	<img src="http://redgalaxy.org/'.$rec['src'].'" class="" style="max-width: 400px;" />
					  </a><br>'.
					  $rec['descripcion'];
		}
		#Si es un video
        if($rec['id_tipo_contenido']=='3')
		{
            $video      = $this->parse_youtube_url($rec['codigo'],'hqthumb');
            if($video=='codigo_embed')
            {
                $video      = 'img/mini_video.png';                
            }
            $contenido = 'tu video <img  src="'.$video.'" width="400" class="mini" /><span class="text-muted">&Prime; '.preg_replace("[\n|\n\r]",'<br>',$rec['descripcion']).'&Prime;</span>';                
		}
		#si es un estado
        if($rec['id_tipo_contenido']=='6')
        {
            $contenido = ' tu estado <span class="text-primary">'.$rec['descripcion'].';</span>';
        }



		$valores['to']				= $usuario_recibe['correo'];
		$valores['from']			= 'contacto@redgalaxy.org';
		$valores['asunto']			= '@'.$valores['nombre_usuario'].' comentó en tu publicación';

		if($valores['nombre_usuario']!='')
		{
			$valores['mensaje'] = '<p>El usuario <a href="http://redgalaxy.org/u/'.$valores['nombre_usuario'].'">@'.$valores['nombre_usuario'].'</a>
									coment&oacute; : '.$valores['comentario'].'<br>
									en '.$contenido.'<br>
									fecha : '.$valores['fecha'].'<br>
									</p>
									<br><br>Visitanos en <a href="http://redgalaxy.org">Mypack</a>';
		}
		else
		{
			$valores['mensaje'] = '<p>Un usuario <b>Anonimo</b>
									coment&oacute; : '.$valores['comentario'].'<br>
									en '.$contenido.'<br>
									fecha : '.$valores['fecha'].'<br>
									</p>
									<br><br>Visitanos en <a href="http://redgalaxy.org">Mypack</a>';
		}		
									   
									   
		//$valores['mensaje']			=  $this->generar_plantilla_correo($valores);


		

		//$this->enviar_correo($valores);
		$this->registrar_correo_pendiente($valores);
	}

	function registrarInvitacion($datos)
    {
        
        $valores['correo']  = $datos['txtcorreo'];

        $valores['to']      = $valores['correo'];
        $valores['from']    = 'contacto@redgalaxy.org';
        $valores['asunto']  = '@'.$_SESSION['s']['nombre_usuario'].' te ha invitado  a que te unas a MyPack ;)';
        $valores['mensaje'] = '<p><a href="http://redgalaxy.org/u/'.$_SESSION['s']['nombre_usuario'].'">@'.$_SESSION['s']['nombre_usuario'].'</a> 
                                   Te ha invitado a mypack
                                    
                                <br><br><br>
                                '.$datos['txtmensaje'].'<br><br>
                                 El mejor lugar para compartir lo que te gusta y conocer gente como tu, ven y diviertete en grande
                                
                                </p>
                                <br>
                                <br>
                                <br>
                                Visitanos en <a href="http://redgalaxy.org/index.php?src=email">Mypack</a>';
        $valores['mensaje'] =  $this->generar_plantilla_correo($valores);


        //print_r($valores);

        $this->enviar_correo($valores);
        $data['codigo'] = '000';
        return $data;

    }

    function registrarInvitacionAjax($datos)
    {

    	$valores['from']		= 'contacto@redgalaxy.org';
		$valores['to']			= $datos['correo'];
		$valores['tipo']		= '1';
		$valores['plantilla']	= '1';	
		$valores['fecha_c']		= date("Y-m-d H:i:s",time());
		$valores['fecha_e']		= '0000-00-00 00:00:00';
		$valores['status']		= 'P';	
		$valores['asunto']  	= '@'.$_SESSION['s']['nombre_usuario'].' te ha invitado  a que te unas a MyPack ;)';

        $valores['mensaje'] 	= '<p><a href="http://redgalaxy.org/u/'.$_SESSION['s']['nombre_usuario'].'">@'.$_SESSION['s']['nombre_usuario'].'</a> 
                                   Te ha invitado a mypack
                                    
	                                <br><br><br>                                
	                                El mejor lugar para compartir lo que te gusta y 
	                                conocer gente como tu, ven y diviertete en grande.
	                                
	                                </p>
	                                <br>
	                                <br>
	                                <br>
	                                Visitanos en <a href="http://redgalaxy.org/index.php?src=email">Mypack</a>';

		$this->registrar_correo_pendiente($valores);     
        $data['codigo'] = '000';
        return $data;
    }


	function EnviarCorreoRecuperacionPass($datos)
    {
        $valores['to']      = $datos['correo'];
        $valores['from']    = 'contacto@redgalaxy.org';
        $valores['asunto']  = 'Recuperación de contraseña [MYPACK];)';
        $valores['mensaje'] = '<p>
        						   	Para reestablecer tu contrase&ntilde;a  solo es necesario dar click a la liga siguiente. 
                                	<br>
                                	<br>
                                	<a href="http://redgalaxy.org/index.php?op=recpass&token='.$datos['token'].'">http://redgalaxy.org/index.php?op=recpass&token='.$datos['token'].'</a>
                                </p>
                                <br>
                                <br>
                                <br>
                                Visitanos en <a href="http://redgalaxy.org/index.php?src=email">Mypack</a>';
        $valores['mensaje'] =  $this->generar_plantilla_correo($valores);


        //print_r($valores);

        $this->enviar_correo($valores);
        $data['codigo'] = '000';
        return $data;

    }

	function enviar_correo($datos)
	{
		$headers  = "From: " . strip_tags($datos['from']) . "\r\n";			
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		mail($datos['to'], $datos['asunto'], $datos['mensaje'], $headers);	    

	}

	function enviar_correo2($datos)
	{
		$headers  = "From: " . strip_tags($datos['fromc']) . "\r\n";			
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		mail($datos['toc'], $datos['asunto'], $datos['mensaje'], $headers);	    
	}

	function generar_plantilla_correo($datos)
	{
		$mensaje  = $datos['mensaje'];
		$cuerpo_mensaje = '<div>
	<table bgcolor="#F2F2F2" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed; width: 100%;">
		<tbody>
			<tr>
				<td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 590px;">
					<tbody>
						<tr>
							<td>
							<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
								<tbody>
									<tr>
										<td height="40" valign="bottom"><img alt="curved top shadow" border="0" height="18" src="https://ci6.googleusercontent.com/proxy/to8x1RnvS1-qAifC_-Yb_J0P12INrYX7gDE2bcrBILCRz9FNa7ewtm8OJznqbsPZUSIKPh0NNqC5gRJrCNy6FcM1JoKPMDNHm-VVTXuSGjMf29m1UBibQGk=s0-d-e1-ft#http://get.treasuredata.com/rs/treasuredata/images/curv-top-sdw.png" style="display: block;" title="curved top shadow" width="589" /></td>
									</tr>
								</tbody>
							</table>

							<table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-bottom: 7px solid #0099FF; width: 100%;">
								<tbody>
									<tr>
										<td colspan="3" height="20" style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;">&nbsp;</td>
									</tr>
									<tr>
										<td style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;" width="40">&nbsp;</td>
										<td height="72">
										<div style="; text-align:center ">
										<h2 style="color:#000000;font-weight:bold;margin-bottom:0px;">MY <span style="color:#0099BB;">PACK</span></h2>
										<span style="color:#666666;text-align:center">Comparte lo que te gusta ;)</span></div>
										</td>
										<td style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;" width="15">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3" height="10" style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;">&nbsp;</td>
									</tr>
								</tbody>
							</table>

							<table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: #5e5d5d; width: 100%;">
								<tbody>
									<tr>
										<td colspan="3" height="25" style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;">&nbsp;</td>
									</tr>
									<tr>
										<td style="font-size: 1px;" width="40">&nbsp;</td>
										<td style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: #5e5d5d; line-height: 20px;" valign="top">
										<p>'.$mensaje.'</p>
										</td>
										<td style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;" width="40">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3" height="60" style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;">&nbsp;</td>
									</tr>
								</tbody>
							</table>

							<table border="0" cellpadding="0" cellspacing="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; color: #000000; text-align: center; width: 100%;">
								<tbody>
									<tr>
										<td height="40" valign="top"><img alt="curved bottom shadow" border="0" height="34" src="https://ci6.googleusercontent.com/proxy/M8A7mKIJFdPAErcTN4HSoXdLJ7hWtcKb41FLAtgm3KFiuCgFzjdiaAomZwxdZNE9bytgmaD0ykSUwTiDThHVST6p-grN1WQIAvjNXjH5R6tGlSUPCW_8uX8hkBE=s0-d-e1-ft#http://get.treasuredata.com/rs/treasuredata/images/curv-bottom-sdw.png" style="display: block;" title="curved bottom shadow" width="589" /></td>
									</tr>
									<tr>
										<td style="color: #5e5d5d;">
										<div>
											Olvidaste tu contrase&ntilde;a? Recibe instrucciones sobre c&oacute;mo restablecerla.
											Tambi&eacute;n puedes cancelar la suscripci&oacute;n a estos mensajes de correo electr&oacute;nico o cambiar tu configuraci&oacute;n de notificaciones. Necesitas ayuda?
											Si has recibido este mensaje por error y no est&aacute;s registrado en Mypack, haz clic en no es mi cuenta.
											<br>										
											<span style="font-weight: bold;">My Pack</span>,<br />
										<a href="http://redgalaxy.org" style="color: #5e5d5d; text-decoration: none;" target="_blank">Cont&aacute;ctenos</a></div>
										</td>
									</tr>
									<tr>
										<td height="30" style="font-size: 1px; border-collapse: collapse; margin: 0; padding: 0;">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							</td>
						</tr>
					</tbody>
				</table>
				</td>
			</tr>
		</tbody>
	</table>
	<img alt="" border="0" height="1" src="https://ci3.googleusercontent.com/proxy/rGir7m0wqiqBjh1Z44lU-rXpA7v9UQ7MOLVUJOt-YeyRIGlc-T9XqVEVroF93H8mrM08eMQBcU1HHe_i3u1RjoYHp6AyRGorJ3x3j8jXb2zKKAD6rfhUjHL7AihCfpu4clUadvC3tfvpzGErIZy3B6ebfZ0yzSwGy0DXOsDBqvzJiUektAy7xNOmP_NpbBZmFhLsVvX9ZZbG0w=s0-d-e1-ft#http://info.treasuredata.com/trk?t=1&amp;mid=NzE0LVhJSi00MDI6MzQ1OjExMTI6MTU0MDowOjEwMzc6NzoxMDQ0NDk4Om1tb25nZWNhc3Ryb0BnbWFpbC5jb20%3D" width="1" />
	<div style="font-family: Verdana; font-size: xx-small;">&nbsp;</div>
</div>';



		//echo $cuerpo_mensaje;
		return $cuerpo_mensaje;
	}

	function obtenerTags()
	{
		$r = $this->obtener_tags();
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	function BorrarTablaTags()
	{
		$r = $this->borrar_tags();
		if($r->affectedRows() > 0)
		{
			$data['codigo'] = '000';
			$data['mensaje']= 'Ok';
		}
		else
		{
			$data['codigo'] = '001';
			$data['mensaje']= 'Error';	
		}		
		return $data;
	}

	function RegistrarTagsCount($datos)
	{
		$valores['tags'] = $datos['tags'];
		$valores['valor'] = $datos['valor'];

		$r = $this->registrar_tag($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo'] = '000';
			$data['mensaje']= 'Ok';
		}
		else
		{
			$data['codigo'] = '001';
			$data['mensaje']= 'Error';	
		}		
		return $data;
	}

	function ObtenerNubeTags()
	{
	     $r =  $this->obtener_nube_tags();
	     $r = $this->ConvertirResultMatriz($r);
	     return $r;
	}

	function ObtenerNubeTagsComp()
	{
	     $r =  $this->obtener_nube_tags_comp();
	     $r = $this->ConvertirResultMatriz($r);
	     return $r;
	}

    function ObtenerVisitasHoy()
	{
	     $r =  $this->listado_visitas_general();
	     $r = $this->ConvertirResultArray($r);
	     return $r;
	}

	function ObtenerVisitasFecha($datos)
	{
		$valores['fecha'] = $datos['fecha'];
	    $r =  $this->listado_paginas_visitados($valores);
	    $r = $this->ConvertirResultMatriz($r);
	    return $r;
	}

	function permitirNSFW($datos)
	{
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['per_nsfw']	= $datos['v'];

		$r = $this->permitir_nsfw($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo'] = '000';
			$data['mensaje']= 'Ok';
			$_SESSION['s']['per_nsfw'] = $valores['per_nsfw'];
		}
		else
		{
			$data['codigo'] = '000';
			$data['mensaje']= 'Error';	
		}		
		return $data;

	}

	function obtenerFechaUltPublicacion()
	{
		$r = $this->obtener_fecha_ult_publicacion();
		$r = $this->ConvertirResultArray($r);
		return $r;
	}

       
       
       function obtenerDatosUsuarioID($datos)
       {
              $valores['id_usuario'] = $datos['txtusuario'];
              $resultado = $this->obtener_datos_usuario_ID($valores);
			if($resultado->size()>0)
			{
				$rec = $resultado->fetch();
				$_SESSION['s'] = array();
			    $_SESSION['s']['id_usuario']  		= $rec['id_usuario'];
			    $_SESSION['s']['nombre_usuario']            = $rec['nombre_usuario'];
			    $_SESSION['s']['bio']                       = $rec['bio'];
			    $_SESSION['s']['tema']   			= $rec['tema'];
			    $_SESSION['s']['tipo_usuario']   	        = $rec['tipo_usuario'];
			    $_SESSION['s']['avatar']			= $rec['avatar'];
			    $_SESSION['s']['id_last_n']			= $rec['id_ult_not'];
			    $_SESSION['s']['per_nsfw']			= $rec['per_nsfw'];

			    if($_SESSION['s']['id_last_n'] == '')
			    {
			    	$_SESSION['s']['id_last_n'] = 0;
			    }
			    if($_SESSION['s']['id_last_c'] == '')
			    {
			    	$_SESSION['s']['id_last_c'] = 0;
			    }

			    
		                $data['mensaje'] = 'Cambio de identidad exitoso!';
				$data['codigo']  = '000';
			}
			else
			{
				$data['mensaje'] = 'Ocurrio un error';
				$data['codigo'] = '001';
			}
			return $data;

       }

    function generar_tags($cadena)
    {
    	// se separa el texto por palabras

    	$cadena = $cadena;

    	$cadenas = explode(" ", $cadena);
    	$des 	 = '';

      	if(count($cadenas) > 0)
		{            
			for($i=0 ;$i <= count($cadenas) ;$i++)
			{
				// Se buscan las tags que inicien con # 
				$findme   = '#';
                $pos = strpos(trim($cadenas[$i]), $findme);

				if ($pos !== false) 
				{
					if($pos == 0)
					{
                        // se limpia el tags de simbolos ratos 
			            $cadena_ori     = $cadenas[$i];
		           		$cadenas[$i] 	=  ltrim($cadenas[$i]);
						$cadenas[$i]	=  str_replace(' ', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('"', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace("'", '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('/', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('.', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('*', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('-', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('$', '', $cadenas[$i]);
						//$cadenas[$i] 	=  str_replace('#', '', $cadenas[$i]);
						$cadenas[$i]	=  str_replace('%', '', $cadenas[$i]);
						$cadenas[$i]	=  str_replace('(', '', $cadenas[$i]);
						$cadenas[$i]	=  str_replace(')', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('|', '', $cadenas[$i]);
						//$cadenas[$i] 	=  str_replace('@', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace(',', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace(':', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace(';', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('{', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('}', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('=', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('~', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('^', '', $cadenas[$i]);

						$tags = substr($cadenas[$i], 1);
						$des .= '<a href="tags/'.$tags.'">'.$cadena_ori.' </a>';
					}
					else
					{
						$des .=  $cadenas[$i].' ';
					}

					continue;

				}

				//Se busca a los usuarios mencionados en el texto 
				$findme   = '@';
                $pos2 = strpos($cadenas[$i], $findme);

				if ($pos2 !== false) 
				{
					$user = '';
					if($pos2 == 0)
					{
						if($cadenas[$i]=='@')
						{
							$des .=  $cadenas[$i].' ';
							continue;
						}
                        // se limpia el tags de simbolos ratos 
			            $cadena_ori     = $cadenas[$i];
		           		$cadenas[$i] 	=  ltrim($cadenas[$i]);
						$cadenas[$i]	=  str_replace(' ', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('"', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace("'", '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('/', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('.', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('*', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('-', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('$', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('#', '', $cadenas[$i]);
						$cadenas[$i]	=  str_replace('%', '', $cadenas[$i]);
						$cadenas[$i]	=  str_replace('(', '', $cadenas[$i]);
						$cadenas[$i]	=  str_replace(')', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('|', '', $cadenas[$i]);
						//$cadenas[$i] 	=  str_replace('@', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace(',', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace(':', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace(';', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('{', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('}', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('=', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('~', '', $cadenas[$i]);
						$cadenas[$i] 	=  str_replace('^', '', $cadenas[$i]);

						$user = substr($cadenas[$i], 1);
						$des .= '<a href="u/'.$user.'">'.$cadena_ori.' </a>';
					}
					else
					{
						$des .=  $cadenas[$i].' ';
					}				    
				}
				else 
				{
					$des .=  $cadenas[$i].' ';					     
				}
				
			}
			return $des;
		}
    }




	//
	function registrarMemeAjax($datos,$file)
	{
		$valores['descripcion'] = $datos['txtdes'];		
		$valores['src']			= '';
		$valores['src_m']		= '';
		$valores['tags']		= $datos['txttags'];					
		$valores['fecha']		= date('Y-m-d',time());
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['status']		= 'A';


		# Se sube imagen de memes
		$img = $this->registrarImagenGeneralMemeAjax($file);
			
		if($img['codigo'] == '000')
		{
			$valores['src']			= $img['src'];
			$valores['src_m']		= $img['src_mini'];
			$valores['tipo_archivo']= $img['tipo_archivo'];
			$valores['tamanio']		= $img['tamanio'];
		}
		else
		{
			$data['codigo'] = $img['codigo'];
			$data['mensaje']= $img['mensaje'];
			return $data;
		}

	
		$data['codigo']  	= '000';
		$data['mensaje'] 	= 'Registro de meme Exitoso';
		$data['src'] 		= $valores['src'];
		$data['src_m']		= $valores['src_m'];


		return $data;
	}



function buscarUsuarioToken($datos)
{
	$valores['token'] = $datos['token'];

	$r = $this->obtener_usuario_token($valores);

	$r = $this->ConvertirResultArray($r);

	return $r;

}

function actualizarPasswordToken($datos)
{
	if($datos['txtnp']!= $datos['txtcp'])
	{
		$data['codigo'] = '001';
		$data['El password de confirmacion es diferente'];
		return $data;
	}

	$valores['id_usuario']  = $datos['txtid'];
	$valores['password']	= md5($datos['txtnp']);

	$r = $this->actualizar_password($valores);

	if($r->affectedRows() > 0)
	{
		$data['codigo']  = '000';
		$data['mensaje'] = 'Actualizacion Exitosa';
	}
	else
	{
		$data['codigo']  = '000';
	}

	return $data;
}
	

	function rankingUsuarios()
	{
		$r = $this->ranking_usuarios();
		$r = $this->ConvertirResultMatriz($r);

		return $r;
	}

	function urls_amigables($url) 
	{

		// Tranformamos todo a minusculas

		$url = strtolower($url);

		//Rememplazamos caracteres especiales latinos

		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

		$repl = array('a', 'e', 'i', 'o', 'u', 'n');

		$url = str_replace ($find, $repl, $url);

		// Añaadimos los guiones

		$find = array(' ', '&', '\r\n', '\n', '+'); 
		$url = str_replace ($find, '-', $url);

		// Eliminamos y Reemplazamos demás caracteres especiales

		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

		$repl = array('', '-', '');

		$url = preg_replace ($find, $repl, $url);

		return $url;

	}

	function registrarBusqueda($datos)
	{
		$valores['consulta'] 	= $datos['consulta'];
		$valores['nav']			= $_SERVER['HTTP_USER_AGENT'];
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['ip']			= $_SERVER['SERVER_ADDR'];
		$valores['fecha']		= date("Y-m-d H:i:s",time());

		$r = $this->registrar_busqueda($valores);

		if($r->affectedRows() > 0)
		{
			$data['codigo'] = '000';
		}
		else
		{
			$data['codigo'] = '001';
		}

		return $data;			
	}

	function obtenerFondoWeb($datos)
	{
		$valores['id_usuario'] = $datos['id_usuario'];
		$r = $this->obtenter_fondo_web($valores);
		$r = $this->ConvertirResultArray($r);
		return $r;
	}

	function registrarFondoWeb($datos,$file)
	{
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['eliminar']	= $datos['txtdel_img'];

		if($valores['eliminar'] == 'on')
		{
			$valores['fondo_web'] = '';
		}
		else
		{
			$img = $this->registrarArchivoFondoWeb($file);

				
			if($img['codigo'] == '000')
			{
				$valores['fondo_web']	= $img['src'];
				$valores['tipo_archivo']= $img['tipo_archivo'];
				$valores['tamanio']		= $img['tamanio'];
			}
			else
			{
				$data['codigo'] = $img['codigo'];
				$data['mensaje']= $img['mensaje'];
				return $data;
			}
		}

		

		$r = $this->registrar_fondo_web($valores);

		if($r->affectedRows() >0)
		{
			$_SESSION['s']['fondo_web'] = $valores['fondo_web'];
			$data['codigo'] = '000';
			$data['mensaje'] = 'Registro Exitoso';
		}
		else
		{
			$data['codigo'] = '001';
			$data['mensaje'] = 'Error al registrar fondo';
		}

		return $data;
	}

	function listadoComentariosGeneral($datos)
	{
		$valores['id_usuario'] = $datos['id_usuario'];
		$r = $this->listado_comentarios_general($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

    function registrarVistaPublicacion($datos)
    {
        $valores['id_contenido'] =  $datos['id_contenido'];

        $r = $this->obtener_veces_visto_publicacion($valores);
        $r = $this->ConvertirResultArray($r);

        $valores['veces_visto'] = $r['veces_visto'];
        $valores['veces_visto'] = $valores['veces_visto'] + 1;

        $result = $this->actualizar_veces_visto_publicacion($valores);
        if($result->affectedRows() > 0)
        {
            $data['codigo'] = '000';
            $data['mensaje'] = 'Ok';
            $data['veces_visto'] = $valores['veces_visto'];    
        }
        else
        {
            $data['codigo'] = '001';
            $data['mensaje'] = 'Error';
        }
        return $data;

    }

    

    function obtener_video_post($rec)
    {
    	$data = '';

    	if($rec['id_tipo_contenido']=='3')
        {
        	if($rec['tipo_archivo'] == 'mp4' || $rec['tipo_archivo'] == 'webm' || $rec['tipo_archivo'] == '3gp')
            {
                $sorce_video = "<source src='".$rec['src']."'  />";

                $data = '
                    <div class="text-center">
                        <video controls style="max-width:100%">
                           '.$sorce_video.'                                
                        </video>
                    </div>';
            }
            else
            {
                $video      = $this->parse_youtube_url($rec['codigo'],'hqthumb');

                if($video=='codigo_embed')
                {
                    $video      = 'img/mini_video.png';
                    $cod_video  = $rec['codigo'];
                }
                else
                {
                    $cod_video  = $this->parse_youtube_url($rec['codigo'],'embed',480);    
                }

                $data = '	<div id="vid_'.$rec['id_contenido'].'" class="video" style="max-width:100%">
		                        '.$cod_video.'
		                    </div> ';
            }
           
        }// fin tipo contenido

        return $data;
    }

    function obtener_imagen_post($rec)
    {
    	if($rec['id_tipo_contenido']=='2') # IMAGENES
        {
            $buscar = "mypack";
            $resultado = strpos($rec['src'], $buscar);            
            $extension = end( explode('.',$rec['src']) );

            $width_img = 'width:100%;max-width:100%;';
            if($extension=='gif')
            {
                $width_img = 'max-width:100%;';
            }

          	$img =  '<a href="post/'.$rec['id_contenido'].'/'.$this->urls_amigables($rec['nombre']).'" >';                      
           	$img .= '<img src="'.$rec['src'].'" class="marco" style="'.$width_img.'" alt="" />';                                  
            $img .= '</a>';    

            if($rec['multi_img']=='1')
            {
                $imgs = $this->obtenerImagenesPost($rec);

                if(count($imgs) > 0)
                {
                    foreach($imgs as $im)
                    {                                
                        $img .= '<a href="post/'.$rec['id_contenido'].'/'.$this->urls_amigables($rec['nombre']).'" >';                              
                        $img .= '<img src="'.$im['src'].'" class="marco" style="'.$width_img.'" alt="" />';                                  
                        $img .= '</a>';                                
                    }
                }
            }

            $img .='</a>';
         
        }// fin tipo 2

        return $img;

    }// fin funcion

    function obtener_mp3_post($rec)
    {
    	if($rec['id_tipo_contenido']=='9')
        {
            $mp3 = '';

            
            $sorce_mp3 = "<source src='".$rec['src']."' type='audio/mpeg' />";

            $mp3 = '<br><br><br><br>
                <div class="text-center">
                    <audio controls style="max-width:100%">
                       '.$sorce_mp3.'                                
                    </audio>
                </div><br><br><br><br>';
            
            $mp3 .= '<br>
                <div style="float:right">
                     <a href="'.$rec['src'].'">Descargar '.$rec['tipo_archivo'].'[<span class="text-danger">'.$rec['tamanio'].'</span>]</a>    
                </div>';
        }

        return $mp3;
    } 

    function obtenerBusquedas()
    {
    	$r = $this->obtener_busquedas();
    	$r = $this->ConvertirResultMatriz($r);
    	return $r;
    }

    function obtenerFrases()
    {
    	$r = $this->obtener_frases();
    	$r = $this->ConvertirResultMatriz($r);
    	return $r;
    }

    function registrarFraseAjax($datos)
    {
    	$valores['frase'] 		= utf8_decode($datos['frase']);
    	$valores['fecha'] 		= date('Y-m-d',time());
    	$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];    	
    	$valores['status'] 		= 'A';

    	$r = $this->registrar_frase($valores);
		if($r->affectedRows() > 0)
		{
			$data['id_frase'] = $r->insertID();
			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro de frase Exitoso';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al registrar';	
		}

		return $data;	
    }

    function actualizarFraseAjax($datos)
    {
    	$valores['id_frase'] 	= utf8_decode($datos['id']);
    	$valores['frase'] 		= utf8_decode($datos['frase']);
    	$valores['fecha'] 		= date('Y-m-d',time());
    	$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];    	    	

    	$r = $this->actualizar_frase($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Actualizacion de frase Exitoso';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al actualizar';	
		}

		return $data;
    }

    function eliminarFraseAjax($datos)
    {
    	$valores['id_frase'] 	= utf8_decode($datos['id']);
    	$valores['frase'] 		= utf8_decode($datos['frase']);
    	$valores['fecha'] 		= date('Y-m-d',time());    	

    	$r = $this->eliminar_frase($valores);
		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Eliminacion de frase Exitoso';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Ocurrio un error al elimininar';	
		}

		return $data;
    }

    function obtenerFraseRandom()
    {
    	$band = true;
    	while($band)
    	{
    		$r = $this->obtener_max_frases();
	    	$r = $this->ConvertirResultArray($r);
	    	
	    	if($r['max'] == '')
	    	{
	    		$band = false;
	    	}

	    	$num_max = $r['max'];

	    	$id_random = rand(1,$num_max);

    		$tmp = $this->obtener_frase_id($id_random);

    		if($tmp->size() > 0)
    		{
    			$band = false;
    		}
    	}

    	$data = $this->ConvertirResultArray($tmp);
    	return $data;
    }	

    function cambiarDashAjax($datos)
    {
    	$valores['id_usuario'] = $_SESSION['s']['id_usuario'];
    	$valores['tipo_dash']  = $datos['tipo'];

    	$r = $this->cambiar_dashboard($valores);
		if($r->affectedRows() > 0)
		{
			$_SESSION['s']['tipo_dash'] = $valores['tipo_dash'];
			$data['codigo']  = '000';
			$data['mensaje'] = 'Actualizacion de frase Exitoso';
		}
		else
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Ocurrio un error al actualizar';	
		}

		return $data;

    }


    function aumentar_estadisticas_usuario($datos)
    {
    	$valores['id_usuario'] 	= $datos['id_usuario'];
		$valores['tipo']		= $datos['tipo'];

		$r = $this->listado_datos_dashboard_usuario2($valores);
	    $r = $this->ConvertirResultArray($r);

	    switch ($valores['tipo']) 
	    {
	    	case 'mas_post': $r['links'] = $r['links'] + 1; break;
	    	case 'men_post': $r['links'] = $r['links'] - 1; break;

	    	case 'mas_like': $r['likes'] = $r['likes'] + 1; break;
	    	case 'men_like': $r['likes'] = $r['likes'] - 1; break;

	    	case 'mas_seg': $r['seguidores'] = $r['seguidores'] + 1; break;
	    	case 'men_seg': $r['seguidores'] = $r['seguidores'] - 1; break;

	    	case 'mas_sig': $r['siguiendo'] = $r['siguiendo'] + 1; break;
	    	case 'men_sig': $r['siguiendo'] = $r['siguiendo'] - 1; break;

	    }

	    $valores['num_post'] =  $r['links'];
	    $valores['num_like'] =  $r['likes'];
	    $valores['seguidores'] =  $r['seguidores'];
	    $valores['siguiendo'] =  $r['siguiendo'];	    


	    $this->actualizarEstadisticasUsuario($valores);
    }

    function aumentar_estadisticas_contenido($datos)
    {
    	$valores['id_contenido'] 	= $datos['id_contenido'];
		$valores['tipo']		= $datos['tipo'];

		$r = $this->obtener_estadisticas_contenido($valores);
	    $r = $this->ConvertirResultArray($r);

	    switch ($valores['tipo']) 
	    {
	    	case 'mas_vista': $r['veces_visto'] = $r['veces_visto'] + 1; break;
	    	case 'men_vista': $r['veces_visto'] = $r['veces_visto'] - 1; break;

	    	case 'mas_like': $r['num_likes'] = $r['num_likes'] + 1; break;
	    	case 'men_like': $r['num_likes'] = $r['num_likes'] - 1; break;

	    	case 'mas_com': $r['num_com'] = $r['num_com'] + 1; break;
	    	case 'men_com': $r['num_com'] = $r['num_com'] - 1; break;

	    	case 'mas_rt': $r['num_rt'] = $r['num_rt'] + 1; break;
	    	case 'men_rt': $r['num_rt'] = $r['num_rt'] - 1; break;

	    }

	    $valores['veces_visto'] =  $r['veces_visto'];
	    $valores['num_likes'] 	=  $r['num_likes'];
	    $valores['num_com'] 	=  $r['num_com'];
	    $valores['num_rt'] 		=  $r['num_rt'];	    


	    $this->actualizarEstadisticasContenido($valores);
    }

   


	function countCategorias()
	{
		$r = $this->count_categorias($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}
	

	########################################################################################################
	#
	# PUBLICIDAD 	
	#
	#########################################################################################################

	function obtenerPublicidadActiva()
	{
		$valores['fecha'] = date("Y-m-d",time());
		$valores['status']= 'A';

		$r = $this->obtener_publicidad($valores);
		$r = $this->ConvertirResultMatriz($r);

		return $r;
	}

	function registrarVisitaPublicidad($datos)
	{
		$valores['id_publicidad'] 	= $datos['id'];
		$valores['page_src'] 		= $datos['pagina'];
		$valores['ip'] 	 			= $_SERVER['SERVER_ADDR'];
		$valores['nav'] 			= $_SERVER['HTTP_USER_AGENT'];
		$valores['fecha'] 			= date("Y-m-d H:i:s",time());
		$valores['tipo_canal'] 		= $this->obtenerDispositivo();
		$valores['id_usuario']		= $_SESSION['s']['id_usuario'];

		$r = $this->registrar_visita_publicidad($valores);

		if($r->affectedRows() > 0)
		{
			$data['codigo'] = '000';
		}
		else
		{
			$data['codigo'] = '001';
		}

		return $data;
	}

	function listadoPublicidadGeneral()
	{
		$r = $this->obteneter_publicidad_general();
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	function obtenerPasatiemposUsuario($datos)
	{
		$valores['id_usuario'] = $datos['id_usuario'];
		$r = $this->obtener_pasatiempos_usuario($valores);
		$r = $this->ConvertirResultArray($r);
		return $r;	
	}

	function actualizarPasatiemposUsuario($datos)
	{
		$valores['peliculas'] 	= $datos['txtpeliculas'];
		$valores['musica'] 		= $datos['txtmusica'];
		$valores['libros'] 	 	= $datos['txtlibros'];
		$valores['videojuegos'] = $datos['txtvideojuegos'];
		$valores['otros'] 		= $datos['txtotros'];
		
		$valores['id_usuario']	= $_SESSION['s']['id_usuario'];

		$r = $this->actualizar_pasatiempos_usuario($valores);

		if($r->affectedRows() > 0)
		{
			$data['codigo'] = '000';
		}
		else
		{
			$data['codigo'] = '001';
		}

		return $data;
	}

	function obtenerSituacionesSentimentales()
	{
		$r = $this->obtener_situaciones_sentimentales();
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}


	function obtenerDispositivo()
	{
		$tablet_browser = 0;
		$mobile_browser = 0;
		$body_class = 'desktop';

		$dispositivo = '';
		 
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		    $tablet_browser++;
		    $body_class = "tablet";
		}
		 
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		    $mobile_browser++;
		    $body_class = "mobile";
		}
		 
		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		    $mobile_browser++;
		    $body_class = "mobile";
		}
		 
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
		$mobile_agents = array(
		    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		    'newt','noki','palm','pana','pant','phil','play','port','prox',
		    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		    'wapr','webc','winw','winw','xda ','xda-');
		 
		if (in_array($mobile_ua,$mobile_agents)) {
		    $mobile_browser++;
		}
		 
		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
		    $mobile_browser++;
		    //Check for tablets on opera mini alternative headers
		    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
		      $tablet_browser++;
		    }
		}
		$movil = false;
		if ($tablet_browser > 0) {
		// Si es tablet has lo que necesites
		   //print 'es tablet';
			$dispositivo = 'Tablet';
		}
		else if ($mobile_browser > 0) {
		// Si es dispositivo mobil has lo que necesites
		   //print 'es un mobil';
		//$movil = true;
		$dispositivo = 'Movil';
		}
		else {
			// Si es ordenador de escritorio has lo que necesites
		   //print 'es un ordenador de escritorio';
			$dispositivo = 'PC';
		} 


		return $dispositivo;
	}
	

	function listadoIpBloquedas($datos)
	{
		$r = $this->listado_ip_bloquedas();
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	function MarcarContenidoAdulto($datos)
	{
		$valores['id_contenido']	= $datos['contenido'];
		$valores['adulto']			= $datos['adulto'];

		$r = $this->marcar_contenido_adulto($valores);

		if($r->affectedRows() > 0)
		{
			$data['codigo']  = '000';
			$data['mensaje'] = '';			
		}	
		else
		{
			$data['codigo']	= '001';
			$data['mensaje']= 'Error';
		}

		return $data;
	}

	/***************************************************************************
	*
	*   S I S T E M A           D E           I N B O X 
	*
	****************************************************************************/

	function registrarInbox($datos,$files)
	{
		$valores['id_usuario_e'] 	= $_SESSION['s']['id_usuario'];
		$valores['id_usuario_r']	= $datos['usuario_destino'];
		$valores['mensaje'] 		= utf8_decode($datos['mensaje']);
		$valores['src'] 			= '';
		$valores['tamanio'] 		= '';
		$valores['tipo_archivo'] 	= '';
		$valores['fecha_envio'] 	= date("Y-m-d H:i:s",time());
		$valores['fecha_visto'] 	= '0000-00-00 00:00:00';
		$valores['fecha_mod'] 		= date("Y-m-d H:i:s",time());
		$valores['status_m'] 		= 'E';
		$valores['status'] 			= 'A';

		if( count($files) > 0)
			{
				$img = $this->registrarImagenGeneralMensajeInboxAjax($files);

				if($img['codigo'] == '000')
				{
					$valores['src']			= $img['src'];
					$valores['src_mini']	= $img['src_mini'];
					$valores['tipo_archivo']= $img['tipo_archivo'];
					$valores['tamanio']		= $img['tamanio'];
				}
				else
				{
					$data['codigo'] = $img['codigo'];
					$data['mensaje']= $img['mensaje'];
					return $data;
				}
			}

		$r = $this->registrar_inbox($valores);

		if($r->affectedRows() > 0 )
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Registro de Inbox exitosamente';
			$data['src'] 		= $valores['src'];
			$data['src_mini']	= $valores['src_mini'];
			
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Error al Registrar';
		}	

		return $data;
	}

	function listadoUsuariosInbox($datos)
	{
		//$valores['id_consultorio'] 	= $datos['id_consultorio'];
		$valores['id_usuario']		=  $_SESSION['s']['id_usuario'];		
		$r = $this->listado_usuarios_inbox($valores);	
		$r = $this->ConvertirResultMatriz($r);

		return $r;
	}

	function listadoInboxSinLeer($datos)
	{
		$valores['id_usuario_r'] = $datos['id_usuario'];	
		$valores['id_inbox_max'] = $datos['id_max'];

		if($valores['id_inbox_max'] == '')
		{
			$valores['id_inbox_max'] = 0 ;
		}
		$r = $this->listado_inbox_sin_leer_general($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;	
	}


	function eliminarInbox($datos)
	{
		$valores['id_inbox'] 		= $datos['id_inbox'];		
		$valores['fecha_mod'] 		= date("Y-m-d H:i:s",time());	
		$valores['status'] 			= 'B';

		$r = $this->eliminar_inbox($valores);

		if($r->affectedRows() > 0 )
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Inbox borrado exitosamente';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Error al eliminar';
		}	

		return $data;
	}

	/*function marcarVistoInbox($datos)
	{
		$valores['id_inbox'] 		= $datos['id_inbox'];		
		$valores['fecha_visto'] 	= date("Y-m-d H:i:s",time());			
		$valores['status_m'] 		= 'V';

		$r = $this->marcar_visto_inbox($valores);

		if($r->affectedRows() > 0 )
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Marca de Inbox visto exitosamente';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Error al Marcar';
		}	

		return $data;
	}*/

	function listadoInboxGeneral($datos)
	{
		$valores['id_usuario_r'] = $datos['id_usuario'];
		$valores['page']		 = $datos['page'];

		if($valores['page'] == '' ||  $valores['page'] <= 0)
		{
			$valores['page'] = 1;
		}		

		$valores['limit']	= ' LIMIT '.(10 * ($valores['page'] - 1)).',10';

		$r = $this->listado_inbox_general($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	function listadoInboxUsuario($datos)
	{
		$valores['id_usuario_r'] = $datos['id_usuario'];
		$valores['id_usuario_e'] = $datos['id_usuario_envia'];

		if($valores['page'] == '' ||  $valores['page'] <= 0)
		{
			$valores['page'] = 1;
		}		

		$valores['limit']	= ' LIMIT '.(10 * ($valores['page'] - 1)).',10';

		$r = $this->listado_inbox_general($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	function listadoInboxEnviadosGeneral($datos)
	{
		$valores['id_usuario_e'] = $datos['id_usuario'];
		$valores['page']		 = $datos['page'];

		if($valores['page'] == '' ||  $valores['page'] <= 0)
		{
			$valores['page'] = 1;
		}		

		$valores['limit']	= ' LIMIT '.(10 * ($valores['page'] - 1)).',10';

		$r = $this->listado_inbox_enviados_general($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	/*function listadoInboxSinLeer($datos)
	{
		$valores['id_usuario_r'] = $datos['id_usuario'];
		$r = $this->listado_inbox_general_sin_leer($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}*/

	function contarInboxSinLeer($datos)
	{
		$valores['id_usuario_r'] = $datos['id_usuario'];	
		$valores['id_inbox']	 = $datos['id_inbox'];
		$r = $this->count_inbox_general($valores);
		$r = $this->ConvertirResultArray($r);
		return $r;	
	}

	function obtenerInbox($datos)
	{
		$valores['id_usuario_r'] 	= $datos['id_usuario'];
		$valores['id_inbox']		= $datos['id_inbox'];
		$r = $this->obtener_inbox($valores);
		$r = $this->ConvertirResultArray($r);
		return $r;
	}

	function cargarConversacionAnteriorUsuario($datos)
	{
		$valores['id_usuario_e'] = $datos['id_usuario'];
		$valores['id_usuario_r'] = $_SESSION['s']['id_usuario'];
		$valores['page']		 = $datos['page'];

		if($valores['page'] == '' ||  $valores['page'] <= 0)
		{
			$valores['page'] = 1;
		}		

		$valores['limit']	= ' LIMIT '.(10 * ($valores['page'] - 1)).',10';

		$r = $this->listado_conversacion_anterior_usuario($valores);
		$r = $this->ConvertirResultMatriz($r);
		return $r;
	}

	function marcarVistoInbox($datos)
	{
		$valores['id_inbox'] 		= $datos['id_inbox'];		
		$valores['id_usuario_e']	= $datos['id_usuario'];
		$valores['fecha_visto'] 	= date("Y-m-d H:i:s",time());			
		$valores['status_m'] 		= 'V';

		$r = $this->marcar_visto_inbox($valores);

		if($r->affectedRows() > 0 )
		{
			$data['codigo']  = '000';
			$data['mensaje'] = 'Marca de Inbox visto exitosamente';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Error al Marcar';
		}	

		return $data;
	}

	function actualizarImgLike($datos)
	{
		$valores['id_usuario'] = $_SESSION['s']['id_usuario'];
		$valores['img_like']	= $datos['img'];

		$r = $this->actualizar_img_like($valores);

		if($r->affectedRows() > 0 )
		{
                        $_SESSION['s']['img_like'] =   $valores['img_like'];
			$data['codigo']  = '000';
			$data['mensaje'] = 'Marca de Inbox visto exitosamente';
		}
		else
		{
			$data['codigo']  = '001';
			$data['mensaje'] = 'Error al Marcar';
		}	

		return $data;

	}

	function registrarFondoWeb2($datos)
	{
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['fondo_web']	= $datos['fondo'];
		

		$r = $this->registrar_fondo_web($valores);

		if($r->affectedRows() >0)
		{
			$_SESSION['s']['fondo_web'] = $valores['fondo_web'];
			$data['codigo'] = '000';
			$data['mensaje'] = 'Registro Exitoso';
		}
		else
		{
			$data['codigo'] = '001';
			$data['mensaje'] = 'Error al registrar fondo';
		}

		return $data;
	}

	function actualizarAvatarPredeterminadoUsuario($datos)
	{
		$valores['id_usuario'] 	= $_SESSION['s']['id_usuario'];
		$valores['avatar']		= $datos['img'];
		

		$r = $this->actualizar_avatar_predeterminado_usuario($valores);

		if($r->affectedRows() >0)
		{
			$_SESSION['s']['avatar'] = $valores['avatar'].'?op='.rand();
			$data['codigo'] = '000';
			$data['mensaje'] = 'Exito';
		}
		else
		{
			$data['codigo'] = '001';
			$data['mensaje'] = 'Error';
		}

		return $data;
	}

	function obtenerCuentasUsuario($datos)
	{
		$datos = $this->limpiar($datos);

		$valores['id_usuario_prin'] = $datos['id_usuario_prin'];

		$r = $this->obtener_cuentas_usuario($valores);
		$r = $this->ConvertirResultMatriz($r);

		return $r;
	}

	function cambiarUsuarioSubCuentas($datos)
	{
		$datos = $this->limpiar($datos);

		$valores['id_usuario_prin'] = $datos['id_usuario_prin'];
		$valores['id_usuario_sec'] 	= $datos['id_usuario_sec'];
		$valores['id_usuario'] 	 	= $valores['id_usuario_sec'];

		// se valida que la cuenta primaria y la cuenta secundaria esten ligadas
		$valida_cuenta = $this->valida_cuenta_primaria_secuendaria($valores);

		if($valida_cuenta->size() > 0 || $valores['id_usuario_prin']== $valores['id_usuario_sec'])
		{
			$resultado = $this->obtener_datos_usuario_secundario($valores);
			if($resultado->size() > 0)
			{
				$rec = $resultado->fetch();
				unset($_SESSION['s']);

				$_SESSION['s'] = array();
			    $_SESSION['s']['id_usuario']  		= $rec['id_usuario'];
			    $_SESSION['s']['nombre_usuario']    = $rec['nombre_usuario'];
			    $_SESSION['s']['nombre']    		= $rec['nombre'];
			    $_SESSION['s']['bio']               = $rec['bio'];
			    $_SESSION['s']['tema']   			= $rec['tema'];
			    $_SESSION['s']['tipo_usuario']   	= $rec['tipo_usuario'];
			    $_SESSION['s']['avatar']			= $rec['avatar'];
			    $_SESSION['s']['id_last_n']			= $rec['id_ult_not'] ;
			    $_SESSION['s']['per_nsfw']			= $rec['per_nsfw'];
			    $_SESSION['s']['fondo_web']			= $rec['fondo_web'];
			    $_SESSION['s']['desp_inf']			= $rec['desp_inf'];
			    $_SESSION['s']['tipo_dash']			= $rec['tipo_dash'];
			    $_SESSION['s']['vis_def']			= $rec['visibilidad_default'];			    
			    $_SESSION['s']['id_usuario_prin']	= $valores['id_usuario_prin'];
			    		    
			    
			    if($datos['det']=='new')
			    {
			    	$_SESSION['s']['new'] 			= 'S';
			    }

			    if($_SESSION['s']['id_last_n'] == '')
			    {
			    	$_SESSION['s']['id_last_n'] = 0;
			    }
			    if($_SESSION['s']['id_last_c'] == '')
			    {
			    	$_SESSION['s']['id_last_c'] = 0;
			    }

			    

			    $tmp['id_usuario'] 		= $rec['id_usuario'];
			    $tmp['token_session']	= md5(uniqid(md5(time())));

			    $t = $this->actualizarSessionToken($tmp);

			    if($t['codigo'] == '000')
			    {
			    	$_SESSION['s']['token']	= $tmp['token_session'];
			    }
			    
		        $data['mensaje'] = 'Ingreso exitoso!';
				$data['codigo']  = '000';
				return $data;
			}
		}
		else
		{
			$data['codigo'] = '001';
			$data['mensaje'] = 'Error cuenta no valida';
			return $data;
		}

		
	}


	
		
	
}
?>