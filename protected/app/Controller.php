<?php
	abstract class Controller {
		
		protected $_view;
		
		Public function __construct() {
			//sentencias para eliminar cache del navegador
			header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
			header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
			header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
			header ("Pragma: no-cache");	
			
			//objeto de tipo vista
			$this->_view = new View(new Request);
		}
	
		abstract public function index();
	
		protected function loadModel($model) {
						
			$model = $model .'Model';
			$model_route = ROOT .'protected' .DS .'models' .DS . $model .'.php';
						
			if(is_readable($model_route)) {
				
				require_once $model_route;
				$model = new $model;
				return $model;
				
			}else{
				
				throw new Exception('EL ARCHIVO: "'. $model_route .'" NO ENCONTRADO.');
				
			}
		}
		
		protected function getLibrary($library) {
			$library_route = ROOT . 'libs' . DS . $library . '.php';
				
			if (is_readable($library_route)) {
				require_once $library_route;
			}else {
				throw new Exception('Libreria'.$library_route.' no exixtente');
			}
		}
				
	}
?>
