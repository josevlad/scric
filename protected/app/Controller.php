<?php
	abstract class Controller {
		
		Protected $_view;
		
		Public function __construct() {
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
