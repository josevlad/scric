<?php
	class configController extends Controller {
		
		protected $_sidebar_menu;
		private $_config;
		
		public function __construct() {
			Session::accessRole(array('ADMIN_DB'));
			parent::__construct();
			$this->_config = $this->loadModel('config');
		}
		
		function index() {
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
			$this->_view->render('index');
		}
		
		/*
		 * Metodos para administrar las tablas referenciales
		 * de la base de datos
		 */
		
		//Administracion de la tabla Tipo de Personas
		public function newTipoPers() {
						
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
						
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
			
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tpPersona' );
			
			//custom config js
			$this->_view->setJs(array('config/newTipoPers'));
			
			$this->_view->render('newTipoPers');
			
		}
		
		//Administracion de la tabla Clase de Vehiculo
		public function newClassVehicle() {
				
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
				
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));

			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
				
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'claseVehiculo' );
				
			//custom config js
			$this->_view->setJs(array('config/newClassVehicle'));
				
			$this->_view->render('newClassVehicle');
				
		}
		
		//Administracion de la tabla Tipo de telefono
		public function newTpTelef() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoTelf' );
		
			//custom config js
			$this->_view->setJs(array('config/newTpTelef'));
		
			$this->_view->render('newTpTelef');
		
		}
		
		//Administracion de la tabla Trans
		public function newTrans() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'trans' );
		
			//custom config js
			$this->_view->setJs(array('config/newTrans'));
		
			$this->_view->render('newTrans');
		
		}
		
		//Administracion de la tabla Tipo de Pagos
		public function newTpPagos() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tpPago' );
		
			//custom config js
			$this->_view->setJs(array('config/newTpPagos'));
		
			$this->_view->render('newTpPagos');
		
		}
		
		//Administracion de la tabla Preguntas
		public function newPreguntas() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'pregunta' );
		
			//custom config js
			$this->_view->setJs(array('config/newPreguntas'));
		
			$this->_view->render('newPreguntas');
		
		}
		
		//Administracion de la tabla stUsuarios
		public function newStUsuarios() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'stUsuarios' );
		
			//custom config js
			$this->_view->setJs(array('config/newStUsuarios'));
		
			$this->_view->render('newStUsuarios');
		
		}
		
		//Administracion de la tabla Perfil
		public function newPerfil() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'perfil' );
		
			//custom config js
			$this->_view->setJs(array('config/newPerfil'));
		
			$this->_view->render('newPerfil');
		
		}
		
		//Administracion de la tabla stFormatos
		public function newStFormatos() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'stFormatos' );
		
			//custom config js
			$this->_view->setJs(array('config/newStFormatos'));
		
			$this->_view->render('newStFormatos');
		
		}
		
		//Administracion de la tabla estados
		public function newEstados() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'estados' );
		
			//custom config js
			$this->_view->setJs(array('config/newEstados'));
		
			$this->_view->render('newEstados');
		
		}
		
		//Administracion de la tabla statusCont
		public function newStatusCont() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'statusCont' );
		
			//custom config js
			$this->_view->setJs(array('config/newStatusCont'));
		
			$this->_view->render('newStatusCont');
		
		}
		
		//Administracion de la tabla Marcas
		public function newMarcas() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//bootbox
			$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'marcas' );
		
			//custom config js
			$this->_view->setJs(array('config/newMarcas'));
		
			$this->_view->render('newMarcas');
		
		}
		
		public function newReference() {
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$keys 		= array();
				$values		= array();
				
				foreach ($_POST as $key => $value){
					array_push(
						$keys,
						$key
					);
					array_push(
						$values,
						$value
					);
				}
				
				$type = $keys['0'];
				$data = $values['0'];
				
				$cases = array(
						'tpPersona' 		=> 	':tpPersona',
						'claseVehiculo' 	=> 	':claseVehiculo',
						'tipoTelf' 			=> 	':tipoTelf',
						'trans' 			=> 	':trans',
						'tpPago' 			=> 	':tpPago',
						'pregunta' 			=> 	':pregunta',
						'stUsuarios' 		=> 	':stUsuarios',
						'perfil' 			=> 	':perfil',
						'stFormatos' 		=> 	':stFormatos',
						'estados' 			=> 	':estados',
						'statusCont' 		=> 	':statusCont',
						'marcas' 			=> 	':marcas'
				);
				
				if (!array_key_exists($type, $cases)) {
					throw new Exception('Tipo de Solicitud no existente');
					exit();
				}
				
				$bind_values = array(
						$cases[$type]	=> $data
				);
				
				if ($_POST['tpAction'] == '0') {
					$this->_config->saveReference($bind_values, $type);
				}else {
					$this->_config->updateReference($bind_values, $type, $_POST['tpAction']);
				}
				
				
			}
		}
		
		public function newDependence() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
			}
		}
		
		public function getReference( $type ) {
		
			$data = array();
		
			$cases = array(
					'tpPersona' 		=> 	':tpPersona',
					'claseVehiculo' 	=> 	':claseVehiculo',
					'tipoTelf' 			=> 	':tipoTelf',
					'trans' 			=> 	':trans',
					'tpPago' 			=> 	':tpPago',
					'pregunta' 			=> 	':pregunta',
					'stUsuarios' 		=> 	':stUsuarios',
					'perfil' 			=> 	':perfil',
					'stFormatos' 		=> 	':stFormatos',
					'estados' 			=> 	':estados',
					'statusCont' 		=> 	':statusCont',
					'marcas' 			=> 	':marcas'
			);
			
			if (!array_key_exists($type, $cases)) {
				throw new Exception('Tipo de Solicitud no existente (gr controller)');
				exit();
			}
		
			$result = $this->_config->getReferenceData( $type );
			
			return $result;
		}
	}
?>
