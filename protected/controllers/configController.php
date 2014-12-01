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
		
		//Administracion de la tabla agencias
		public function agencias() {
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				if ($_POST['tpAction'] == '0') {
					
					$bind_values = array(
							':nombre_ag'		=> strtoupper( $_POST['nombre_ag'] ),
							':identificador'	=> strtoupper( $_POST['identificador'] )
					);
					
					$this->_config->saveAgencia($bind_values);
				}else {
					
					$bind_values = array(
							':nombre_ag'		=> strtoupper( $_POST['nombre_ag'] ),
							':identificador'	=> strtoupper( $_POST['identificador'] ),
							':id'				=> $_POST['tpAction']
					);
					
					$this->_config->updateAgencia($bind_values);
				}
				
			}else {
				//Content page-hader
				$this->_view->icon_fa = 'fa-database';
				$this->_view->titleHead = 'Administracion de Base de datos';
				
				//dataTable
				$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
				
				//data de la tb tipo de persona
				$this->_view->data = $this->getReference( 'agencias' );
				
				//custom config js
				$this->_view->setJs(array('config/agencias'));
				
				$this->_view->render('agencias');
				
			}		
		}
		
		//Administracion de la tabla claseVehiculo
		public function claseVehiculo() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'claseVehiculo' );
		
			//custom config js
			$this->_view->setJs(array('config/claseVehiculo'));
		
			$this->_view->render('claseVehiculo');
		
		}
		
		//Administracion de la tabla estado
		public function estado() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'estado' );
		
			//custom config js
			$this->_view->setJs(array('config/estado'));
		
			$this->_view->render('estado');
		
		}
		
		//Administracion de la tabla marca
		public function marca() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'marca' );
		
			//custom config js
			$this->_view->setJs(array('config/marca'));
		
			$this->_view->render('marca');
		
		}
		
		//Administracion de la tabla perfilUsuario
		public function perfilUsuario() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'perfilUsuario' );
		
			//custom config js
			$this->_view->setJs(array('config/perfilUsuario'));
		
			$this->_view->render('perfilUsuario');
		
		}
		
		//Administracion de la tabla pregunta
		public function pregunta() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'pregunta' );
		
			//custom config js
			$this->_view->setJs(array('config/pregunta'));
		
			$this->_view->render('pregunta');
		
		}
		
		//Administracion de la tabla statusCont
		public function statusCont() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'statusCont' );
		
			//custom config js
			$this->_view->setJs(array('config/statusCont'));
		
			$this->_view->render('statusCont');
		
		}
		
		//Administracion de la tabla statusFormat
		public function statusFormat() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'statusFormat' );
		
			//custom config js
			$this->_view->setJs(array('config/statusFormat'));
		
			$this->_view->render('statusFormat');
		
		}
		
		//Administracion de la tabla statusUsuarios
		public function statusUsuarios() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'statusUsuarios' );
		
			//custom config js
			$this->_view->setJs(array('config/statusUsuarios'));
		
			$this->_view->render('statusUsuarios');
		
		}
				
		//Administracion de la tabla tipoPago
		public function tipoPago() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoPago' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoPago'));
		
			$this->_view->render('tipoPago');
		
		}
		
		//Administracion de la tabla tipoPersona
		public function tipoPersona() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoPersona' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoPersona'));
		
			$this->_view->render('tipoPersona');
		
		}
		
		//Administracion de la tabla tipoTelf
		public function tipoTelf() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoTelf' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoTelf'));
		
			$this->_view->render('tipoTelf');
		
		}
		
		//Administracion de la tabla tipoTrans
		public function tipoTrans() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoTrans' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoTrans'));
		
			$this->_view->render('tipoTrans');
		
		}
		
		//Administracion de la tabla name
		public function name() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'name' );
		
			//custom config js
			$this->_view->setJs(array('config/name'));
		
			$this->_view->render('name');
		
		}
		
		public function getReference( $type ) {
		
			$data = array();
		
			$cases = array(
					'agencias'			=> 	':agencias',
					'estado'			=> 	':estado',
					'marca'				=> 	':marca',
					'perfilUsuario'		=> 	':perfilUsuario',
					'pregunta'			=> 	':pregunta',
					'statusCont'		=> 	':statusCont',
					'statusFormat'		=> 	':statusFormat',
					'statusUsuarios'	=> 	':statusUsuarios',
					'tipoPago'			=> 	':tipoPago',
					'tipoPersona'		=> 	':tipoPersona',
					'tipoTelf'			=> 	':tipoTelf',
					'tipoTrans'			=> 	':tipoTrans',
			);
				
			if (!array_key_exists($type, $cases)) {
				throw new Exception('Tipo de Solicitud no existente (gr controller)');
				exit();
			}
		
			$result = $this->_config->getReferenceData( $type );
				
			return $result;
		}
		
		public function actionReference() {
			
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
					'claseVehiculo' 		=> 	':claseVehiculo',
					'estado' 				=> 	':estado',
					'marca' 				=> 	':marca',
					'perfilUsuario' 		=> 	':perfilUsuario',
					'pregunta'				=> 	':pregunta',
					'statusCont'			=> 	':statusCont',
					'statusFormat'			=> 	':statusFormat',
					'statusUsuarios'		=> 	':statusUsuarios',
					'tipoPago'				=> 	':tipoPago',
					'tipoPersona'			=> 	':tipoPersona',
					'tipoTelf'				=> 	':tipoTelf',
					'tipoTrans'				=> 	':tipoTrans',
				);	
				
				if (!array_key_exists($type, $cases)) {
					throw new Exception('Tipo de Solicitud no existente (actRef)');
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
		
		public function actionDependence() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
			}
		}
		
	}
?>
