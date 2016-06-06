<?
    echo "";

    
    $nube_tags =  $c_sistema->ObtenerNubeTagsComp();

    //print_r($resultado);

    /*if(count($resultado) > 0)
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
                            $cadenas[$i]    =  ltrim($cadenas[$i]);
                            $cadenas[$i]    =  str_replace(' ', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('"', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace("'", '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('/', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('.', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('*', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('-', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('$', '', $cadenas[$i]);
                            //$cadenas[$i]  =  str_replace('#', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('%', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('(', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace(')', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('|', '', $cadenas[$i]);
                            //$cadenas[$i]  =  str_replace('@', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace(',', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace(':', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace(';', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('{', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('}', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('=', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('~', '', $cadenas[$i]);
                            $cadenas[$i]    =  str_replace('^', '', $cadenas[$i]);

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
        


        
        
    }*/
    // Se borra la tabla de tags
    //$c_sistema->BorrarTablaTags();
?>
    <div class="col-lg-6 col-lg-offset-3"  >  

        <h2 class="text-center">Tags Mypack</h2>
        
        <br>
        <br>
        <br>
<?
     shuffle($nube_tags);

    foreach($nube_tags as $rec)
    {
        if($rec['tags'] != '')
        {
            $link = 'tags/'.trim($rec['tags']);
        }

        if($rec['valor'] < 5)
        {
            $font = '14px';
        }
        else if($rec['valor'] > 5 & $rec['valor'] < 10)
        {
            $font = '16px';
        }
        else if($rec['valor'] > 10 & $rec['valor'] < 30)
        {
            $font = '26px';
        }
        else if ($rec['valor'] > 30)
        {
            $font = '48px';
        }

 
        echo '<a href="'.$link.'" style="font-size:'.$font.'" title="'.$rec['valor'].'" class="marco">#'.trim(ucwords($rec['tags'])).'('.$rec['valor'].')</a> ';

    }

    
?>


	
</div>

    