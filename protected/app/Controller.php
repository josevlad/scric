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
		
		/**
		 * metodo para redirecionar despues de una ejecución.
		 * Recibe por parametro el modulo y el nombre de la vista
		 * @param string $module
		 * @param string $view
		 */
		protected function redirect($controller = FALSE,$view = FALSE) {
			if ($controller) {
				header('location:' . BASE_URL . $controller . DS . $view );
				exit();
			}else {
				header('location:' . BASE_URL );
				exit();
			};
		}
		
				
	}
?>
