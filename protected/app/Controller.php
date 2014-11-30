<?php
	abstract class Controller {
		
		Protected $_view;
		
		Public function __construct() {
			//sentencias para eliminar cache del navegador
			header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			
			//objeto de tipo vista
			$this->_view = new View(new Request);
		}
	
		abstract public function index();
	
		protected function loadModel($model) {
						
			$model = $model .'Model';
			$model_route = ROOT .'protected' .DS .'models' .DS . $model .'.php';
						
			if(is_readable($model_route)) {
				
				require_once$model_route;
				$model = new $model;
				return$model;
				
			}else{
				
				throw new Exception('EL ARCHIVO: "'. $model_route .'" NO ENCONTRADO.');
				
			}
		}
				
	}
?>
