<?php 
namespace Vl\App\engine;

class Autoload  
{
	function loadClass ($className) {

		// v.1  src\Module\Controller
		if (file_exists($includeFile = str_replace( ["Vl\\App\\","\\"],[ ROOT.DS.'src'.DS, DS], $className) . ".php")) {
			include $includeFile;
		}
	}
	
	function autoClass( $class ) {
		
		// Cut preffix [Vl\App\]
		$directories = explode( '\\', $class );
		if (reset( array: $directories ) == 'Vl') { 
			array_shift( $directories );
			if (reset( array: $directories ) == 'App') { 
				array_shift( $directories );
			}
		}
		
		//
		//print_r($directories); 

		// v.2.1 src\Module_Controller & src\Module\Controller
		$className = &$directories[array_key_last($directories)];
		$className = str_replace( '_', DS, $className  );
		
		// v.2.2 src\Module_Controller & src\Module\Controller
		//$className = array_key_last($directories);
		//$directories[$className] = str_replace( '_', DS, $directories[$className] );
		
		// v.2.3 src\Module_Controller & src\Module\Controller
		//$className = str_replace( '_', DS, end( array: $directories ) );
		//$directories[array_key_last($directories)] = $className;

		// v.2.4 src\Module_Controller & src\Module\Controller
		//$className = str_replace( '_', DS, $className = &$directories[array_key_last($directories)] );

		//
		//print_r($directories);

		$requiredFile = sprintF( '%s'.DS.'%s.php', ROOT, 'src' . DS . implode( DS, $directories));
		
		// v.2.5 src\Module_Controller & src\Module\Controller
		//$className = str_replace( '_', DS, array_pop( array: $directories ) );
		//$requiredFile = sprintF( '%s\\%s.php', ROOT, 'src' . DS . implode( '\\', array_merge( $directories, [$className] )));
		
		//
		//print_r($requiredFile); br(2);

		if ( file_exists( $requiredFile ) ) {
			require $requiredFile;
		}

	}
}
