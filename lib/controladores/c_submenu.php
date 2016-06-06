<?		
	if($_SESSION['s']['id_usuario']!= '')
	{
		if($_SESSION['s']['tipo_usuario']=='1' ||  $_SESSION['s']['tipo_usuario']=='3' || $_SESSION['s']['tipo_usuario']=='4')
		{
			include ('lib/menus/menu_comun.php'); 
		}
		if($_SESSION['s']['tipo_usuario']=='2')
		{
			include ('lib/menus/menu_admin.php');
		}
	}
	else
	{
		include ('lib/menus/menu_vacio.php');
	}
	
?>