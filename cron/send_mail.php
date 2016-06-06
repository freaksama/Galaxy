<?
  session_start();     

  include('../conexion/MySQL.php');       
  include('../clases/classSistema.php');    
  include('../controladores/controlador_sistema.php');  
  
  $db           = new MySQL();  
  $c_sistema    = new sistema_controlador($db);  

  $correos = $c_sistema->obtenerCorreoPendientes();

    if(count($correos) > 0)
    {
        foreach($correos as $c)
        {

            if($c['per_enviar_correo']=='S')
            {
                if($c['plantilla']=='1')
                {

                    $c['mensaje']  =  $c_sistema->generar_plantilla_correo($c);  
                    print_r($c);  
                }
                //$tmp = $c_sistema->enviar_correo2($c);  
            }

            $r = $c_sistema->actualizarCorreoEnviado($c);            
        }
    }

?>