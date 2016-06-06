<?
	echo "<h3>Estadisticas de tags</h3>";

	
	$resultado = $c_sistema->obtenerTags();

	if(count($resultado) > 0)
	{	
		// se crea un array para los  tags 
		$a_tags = array();

		foreach($resultado as $rec)
		{
			if($rec['tags'] != '')
		    {
		    	// se separan los tags 
		      	$tags = explode(',', $rec['tags']);

		      	$link_tags = '';
		      	// se recorre por cada uno de los tags
		      	for($i=0;$i < count($tags);$i++)
		      	{
		      		// Si el tags  exite en el array, se incrementa
		      		if (in_array($tags[$i], $a_tags)) 
		      		{
		      			$a_tags[$tags[$i]] = 1;
		      		}
		      		else
		      		{
		      			$a_tags[$tags[$i]] += 1;
		      		}			        
		      	}
		    }

		    $cadenas = explode(" ", $rec['descripcion']);
	    	

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

							$new_tags = substr($cadenas[$i], 1);
							if (in_array($new_tags, $a_tags)) 
				      		{
				      			$a_tags[$new_tags] = 1;
				      		}
				      		else
				      		{
				      			$a_tags[$new_tags] += 1;
				      		}
						}
					}
				}
			}	
		}
		


		
		
	}
	// Se borra la tabla de tags
	$c_sistema->BorrarTablaTags();

	foreach ($a_tags as $key => $value) 
	{
		$datos['tags'] 	= $key;
		$datos['valor']	= $value;
		$c_sistema->RegistrarTagsCount($datos);
		echo $key.' -> '.$value;
		echo '<br>';
	}

	
?>

