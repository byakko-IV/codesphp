<?php
# Divido la URI utilizando como separador la barra diagonal
	$peticiones = explode('/', $_SERVER['REQUEST_URI']);
	//echo $peticiones;
	//print_r($peticiones);
	# Cuento las peticiones, para saber si hay o no argumentos
	$cantidad = count($peticiones);
	//echo $cantidad;
	# Obtengo el módulo, modelo, recurso (y argumentos, si existen)
	//echo $peticiones[0];
	if($cantidad == 3) {
		list($nulo, $sitio, $pagina) = $peticiones;
		//echo $pagina;
	} elseif($cantidad == 6) {
		list($nulo, $sitio, $modulo, $modelo, $recurso, $arg) = $peticiones;
		//echo "nulo: $nulo, sitio: $sitio, modulo: $modulo, modelo: $modelo, recurso: $recurso, argumento: $arg";
	}
	
	# Obtengo el nombre del controlador
    //$controller_name = ucwords($modelo) . "Controller";
    
    # Para poder importar el controlador, debo agregar el path de la aplicación
	ini_set('include_path', str_replace('frontcontroller.php', '', $_SERVER['SCRIPT_FILENAME']));
	
	# Importo el módulo del controlador
	require("vista/$pagina.html");
	
	# Instancio al controlador y le envío el recurso y argumentos
	//$controller = new $controller_name($recurso, $arg);
?>
