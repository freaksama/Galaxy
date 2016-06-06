<? 
	header("Content-Type: application/xml; charset=ISO-8859-1"); 
	include('config/conexion.php');       
	include('lib/clases/classSistema.php');  	
	include('lib/controladores/c_sistema.php');  
	  
	$db           = new MySQL();  
	$c_sistema    = new sistema_controlador($db);

    $datos['tags']        = $_GET['tag'];
    $datos['page']        = $_GET['page'];
    $datos['consulta']    = $_GET['q'];    
    $datos['cat']         = $_GET['cat'];
    $datos['rss']         = 'S';

    //print_r($datos);
    include('config/config.php');

    $config['url_sitio']= 'http://redgalaxy.org/'; 

    if($datos['id_categoria'] == '' & $datos['consulta'] == '')
    {
        $datos['mejor'] = 'S';    
    }

    if($_GET['op']=='mas')
    {
        $datos['mas_visto'] = 'S';
    }
    
    $result  = $c_sistema->listadoContenidoGeneral($datos);    
    $resultado = $result['datos'];

    if(count($resultado)>0)
    {
    	$data = '<?xml version="1.0" encoding="ISO-8859-1"?>
    				<rss xmlns:a10="http://www.w3.org/2005/Atom" version="2.0">					
					<channel>
						<title>Red Galaxy </title>
						<description>Red Galaxy - Comparte lo que te gusta ;)</description>
						<lastBuildDate>Sun, 05 Jul 2015 19:00:05</lastBuildDate>
						<managingEditor>contacto@redgalaxy.org</managingEditor>
						<link>http://'.$config['url_sitio'].'/dashboard</link>';
      	foreach($resultado as $rec)
      	{	

      		$pubDate = date("D, d M Y H:i:s T", strtotime($rec['fecha_p']));

      		$data .= '<item>
						<guid isPermaLink="false">'.$config['url_sitio'].'post/'.$rec['id_contenido'].'/'.$c_sistema->urls_amigables($rec['nombre']).'</guid>
						<title>'.$rec['nombre'].'</title>
						<author>@'.$rec['nombre_usuario'].'</author>
						<description type="html">&lt;a href="'.$config['url_sitio'].'post/'.$rec['id_contenido'].'/'.$c_sistema->urls_amigables($rec['nombre']).'"&gt; &lt;img src="'.$config['url_sitio'].''.$rec['src'].'" /&gt;&lt;/a&gt;</description>
						<link>'.$config['url_sitio'].'post/'.$rec['id_contenido'].'/'.$c_sistema->urls_amigables($rec['nombre']).'</link>
						<pubDate>'.$pubDate.'</pubDate>
					</item>';
      	}

      	$data .= '</channel>
				</rss>';
    }

    echo $data;

?> 

