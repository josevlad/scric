<?php
	abstract class Controller {
		
		protected $_view;
		protected $_menu;
		
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
		
		protected function redirect($view = FALSE) {
			if ($view) {
				header('location:' . BASE_URL . $view);
				exit();
			}else {
				header('location:' . BASE_URL );
				exit();
			};
		}
		
		protected function getLibrary($library) {
			$library_route = ROOT . 'libs' . DS . $library . '.php';
				
			if (is_readable($library_route)) {
				require_once $library_route;
			}else {
				throw new Exception('Libreria'.$library_route.' no exixtente');
			}
		}
		
		protected function createMenu() {
			
			$level = Session::get('level');
			
			switch ($level) {
				case 'SUPER_U':
					$this->_menu = array(
						array(
							'id'	=>'index',
							'title'	=>'Inicio',
							'link'	=> BASE_URL.'config',
							'icon'	=> 'fa-home'
						),
						array(
							'id'	=>'contracts',
							'title'	=>'Contratos',
							'link'	=> '#',
							'icon'	=> 'fa-folder-open-o',
							'sub'	=> 	array(
											array(
												'id'	=>'newContract',
												'title'	=>'Nuevo Contrato',
												'link'	=> BASE_URL.'adviser/contratos'
											),/*
											array(
												'id'	=>'renewContract',
												'title'	=>'Renovar Contrato',
												'link'	=> BASE_URL.'adviser/renovarContrato'
											),*/
											array(
												'id'	=>'cancelContract',
												'title'	=>'Anular Contrato',
												'link'	=> BASE_URL.'adviser/anularContrato'
											),
										)
						),
						array(
							'id'	=>'forms',
							'title'	=>'Formatos',
							'link'	=> '#',
							'icon'	=> 'fa-file-text-o',
							'sub'	=> 	array(
											array(
												'id'	=>'formatos',
												'title'	=>'Registrar Formatos',
												'link'	=> BASE_URL.'adviser/formatos'
											)
										)
						),
						array(
							'id'	=>'adminDB',
							'title'	=>'Adm. del Sistema',
							'link'	=> '#',
							'icon'	=> 'fa-database',
							'sub'	=> 	array(
											array(
												'id'	=>'claseVehiculo',
												'title'	=>'Clases de Vehiculo',
												'link'	=> BASE_URL.'config/claseVehiculo'
											),
											array(
												'id'	=>'usoVehiculo',
												'title'	=>'Uso de Vehiculo',
												'link'	=> BASE_URL.'config/usoVehiculo'
											),
											array(
												'id'	=>'tipoVehiculo',
												'title'	=>utf8_encode('Tipos de Vehículos'),
												'link'	=> BASE_URL.'config/tipoVehiculo'
											),
											array(
												'id'	=>'numPuesto',
												'title'	=>utf8_encode('Número de Puestos'),
												'link'	=> BASE_URL.'config/numPuesto'
											)
										)
						),
						array(
							'id'	=>'adminDB',
							'title'	=>'Precios y Coberturas',
							'link'	=> '#',
							'icon'	=> 'fa-money',
							'sub'	=> 	array(
											array(
												'id'	=>'cobertura',
												'title'	=>utf8_encode('Coberturas'),
												'link'	=> BASE_URL.'config/cobertura'
											),
											array(
												'id'	=>'asignarConcepto',
												'title'	=>utf8_encode('Conceptos de Poliza'),
												'link'	=> BASE_URL.'config/asignarConcepto'
											),
											array(
												'id'	=>'asignarPrecio',
												'title'	=>utf8_encode('Asignación de Precios'),
												'link'	=> BASE_URL.'config/asignarPrecio'
											)
										)
						),
						array(
							'id'	=>'user',
							'title'	=>'Adm. de Usuarios',
							'link'	=> '#',
							'icon'	=> 'fa-users',
							'sub'	=> 	array(
											array(
												'id'	=>'agencias',
												'title'	=>'Agencias',
												'link'	=> BASE_URL.'config/agencias'
											),
											array(
												'id'	=>'usuarios',
												'title'	=>'Usuarios',
												'link'	=> BASE_URL.'config/usuarios'
											)
										)
						)				
					);										
				break;
				
				case 'ASESOR':
					$this->_menu = array(
						array(
							'id'	=>'index',
							'title'	=>'Inicio',
							'link'	=> BASE_URL.'adviser',
							'icon'	=> 'fa-home'
						),
						array(
							'id'	=>'contracts',
							'title'	=>'Contratos',
							'link'	=> '#',
							'icon'	=> 'fa-folder-open-o',
							'sub'	=> 	array(
											array(
												'id'	=>'newContract',
												'title'	=>'Nuevo Contrato',
												'link'	=> BASE_URL.'adviser/contratos'
											),/*
											array(
												'id'	=>'renewContract',
												'title'	=>'Renovar Contrato',
												'link'	=> BASE_URL.'adviser/renovarContrato'
											),*/
											array(
												'id'	=>'cancelContract',
												'title'	=>'Anular Contrato',
												'link'	=> BASE_URL.'adviser/anularContrato'
											),
										)
						),
						array(
							'id'	=>'forms',
							'title'	=>'Formatos',
							'link'	=> '#',
							'icon'	=> 'fa-file-text-o',
							'sub'	=> 	array(
											array(
												'id'	=>'formatos',
												'title'	=>'Registrar Formatos',
												'link'	=> BASE_URL.'adviser/formatos'
											)
										)
						),
						array(
							'id'	=>'report',
							'title'	=>'Reportes',
							'link'	=> '#',
							'icon'	=> 'fa-print',
							'sub'	=> 	array(
											array(
												'id'	=>'ventas',
												'title'	=>'Relacion de Ventas',
												'link'	=> BASE_URL.'adviser/ventasAsesor'
											)
										)
						)				
					);											
				break;

				case 'ADMIN_DB':
					$this->_menu = array(
						array(
							'id'	=>'index',
							'title'	=>'Inicio',
							'link'	=> BASE_URL.'config',
							'icon'	=> 'fa-home'
						),
						array(
							'id'	=>'contracts',
							'title'	=>'Contratos',
							'link'	=> '#',
							'icon'	=> 'fa-folder-open-o',
							'sub'	=> 	array(
											array(
												'id'	=>'newContract',
												'title'	=>'Nuevo Contrato',
												'link'	=> BASE_URL.'adviser/contratos'
											),
											array(
												'id'	=>'renewContract',
												'title'	=>'Renovar Contrato',
												'link'	=> BASE_URL.'adviser/renovarContrato'
											),
											array(
												'id'	=>'cancelContract',
												'title'	=>'Anular Contrato',
												'link'	=> BASE_URL.'adviser/anularContrato'
											),
										)
						),
						array(
							'id'	=>'forms',
							'title'	=>'Formatos',
							'link'	=> '#',
							'icon'	=> 'fa-file-text-o',
							'sub'	=> 	array(
											array(
												'id'	=>'formatos',
												'title'	=>'Registrar Formatos',
												'link'	=> BASE_URL.'adviser/formatos'
											)
										)
						),
						array(
							'id'	=>'adminDB',
							'title'	=>'Adm. del Sistema',
							'link'	=> '#',
							'icon'	=> 'fa-database',
							'sub'	=> 	array(
											array(
												'id'	=>'claseVehiculo',
												'title'	=>'Clases de Vehiculo',
												'link'	=> BASE_URL.'config/claseVehiculo'
											),
											array(
												'id'	=>'usoVehiculo',
												'title'	=>'Uso de Vehiculo',
												'link'	=> BASE_URL.'config/usoVehiculo'
											),
											array(
												'id'	=>'tipoVehiculo',
												'title'	=>utf8_encode('Tipos de Vehículos'),
												'link'	=> BASE_URL.'config/tipoVehiculo'
											),
											array(
												'id'	=>'numPuesto',
												'title'	=>utf8_encode('Número de Puestos'),
												'link'	=> BASE_URL.'config/numPuesto'
											)
										)
						),
						array(
							'id'	=>'adminDB',
							'title'	=>'Precios y Coberturas',
							'link'	=> '#',
							'icon'	=> 'fa-money',
							'sub'	=> 	array(
											array(
												'id'	=>'cobertura',
												'title'	=>utf8_encode('Coberturas'),
												'link'	=> BASE_URL.'config/cobertura'
											),
											array(
												'id'	=>'asignarConcepto',
												'title'	=>utf8_encode('Conceptos de Poliza'),
												'link'	=> BASE_URL.'config/asignarConcepto'
											),
											array(
												'id'	=>'asignarPrecio',
												'title'	=>utf8_encode('Asignación de Precios'),
												'link'	=> BASE_URL.'config/asignarPrecio'
											)
										)
						),
						array(
							'id'	=>'user',
							'title'	=>'Adm. de Usuarios',
							'link'	=> '#',
							'icon'	=> 'fa-users',
							'sub'	=> 	array(
											array(
												'id'	=>'agencias',
												'title'	=>'Agencias',
												'link'	=> BASE_URL.'config/agencias'
											),
											array(
												'id'	=>'usuarios',
												'title'	=>'Usuarios',
												'link'	=> BASE_URL.'config/usuarios'
											)
										)
						),
						array(
							'id'	=>'report',
							'title'	=>'Reportes',
							'link'	=> '#',
							'icon'	=> 'fa-print',
							'sub'	=> 	array(
											array(
												'id'	=>'ventas',
												'title'	=>'Relacion de Ventas',
												'link'	=> BASE_URL.'adviser/ventasAsesor'
											)
										)
						)				
					);											
				break;
			}
			
			return $this->_menu;
			
		}
				
	}
?>
