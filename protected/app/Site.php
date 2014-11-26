<?php
	class Site {
		
		Public static function run(Request $request) {
					
		    $controller = $request->getController() . "Controller";
		    $rout_controller = ROOT . 'protected' . DS . 'controllers' . DS . $controller . '.php';
		    $method = $request->getMethod();
			
		    $arguments = $request->getArguments();
			
		if(is_readable($rout_controller)) {
				
			require_once$rout_controller;
	
				$controller = new $controller;
	
				if(is_callable(array($controller, $method))) {
					$metodo = $request->getMethod();
				}else{
					$metodo = 'index';
				}
	
				if(isset($arguments)) {
	
					call_user_func_array(array($controller, $method), $arguments);
							
				}else{
					call_user_func($controller, $method);
				}
				
		    }else{
			
				throw new Exception('EL ARCHIVO: "'. $rout_controller .'" NO FUE ENCONTRADO');
		    }
		}
	}
?>
