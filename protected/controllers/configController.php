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
		
		/*
		 * Metodos para administrar las tablas dependientes
		 * de la base de datos
		 */
		
		//Administracion de la tabla cobertura
		public function cobertura() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'cobertura' );
		
			//custom config js
			$this->_view->setJs(array('config/cobertura'));
		
			$this->_view->render('cobertura');
		
		}
		
		//Administracion de la tabla tipoVehiculo
		public function tipoVehiculo() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoVehiculo' );
			
			//custom config js
			$this->_view->setJs(array('config/tipoVehiculo'));
		
			$this->_view->render('tipoVehiculo');
		
		}
		
		//Administracion de la tabla modelo
		public function modelo() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'modelo' );
				
			//custom config js
			$this->_view->setJs(array('config/modelo'));
		
			$this->_view->render('modelo');
		
		}
		
		//Administracion de la tabla municipio
		public function municipio() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'municipio' );
		
			//custom config js
			$this->_view->setJs(array('config/municipio'));
		
			$this->_view->render('municipio');
		
		}
		
		//Administracion de la tabla numPuesto
		public function numPuesto() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'numPuesto' );
		
			//custom config js
			$this->_view->setJs(array('config/numPuesto'));
		
			$this->_view->render('numPuesto');
		
		}
		
		//Administracion de la tabla parroquia
		public function parroquia() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'parroquia' );
		
			//custom config js
			$this->_view->setJs(array('config/parroquia'));
		
			$this->_view->render('parroquia');
		
		}

		//Administracion de la tabla usoVehiculo
		public function usoVehiculo() {
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'usoVehiculo' );
		
			//custom config js
			$this->_view->setJs(array('config/usoVehiculo'));
		
			$this->_view->render('usoVehiculo');
		
		}

		//Administracion de la tabla precio
		public function precio() {
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
				if ($_POST['tpAction'] == '0') {
						
					$bind_values = array(
							':precio'		=> strtoupper( $_POST['precio'] ),
							':numPuesto_id'	=> strtoupper( $_POST['numPuesto_id'] ),
							':cobertura_id'	=> strtoupper( $_POST['cobertura_id'] ),
					);
						
					$this->_config->savePrecio($bind_values);
				}else {
						
					$bind_values = array(
							':precio'		=> strtoupper( $_POST['precio'] ),
							':numPuesto_id'	=> strtoupper( $_POST['numPuesto_id'] ),
							':cobertura_id'	=> strtoupper( $_POST['cobertura_id'] ),
							':id'			=> $_POST['tpAction']
					);
						
					$this->_config->updatePrecio($bind_values);
				}
			}else {
		
				//Content page-hader
				$this->_view->icon_fa = 'fa-database';
				$this->_view->titleHead = 'Administracion de Base de datos';
			
				//dataTable
				$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
			
				//data de la tb tipo de persona
				$this->_view->data = $this->getReference( 'precio' );
			
				//custom config js
				$this->_view->setJs(array('config/precio'));
			
				$this->_view->render('precio');
			
			}
		
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
					'agencias'				=> 	':agencias',
					'claseVehiculo'			=> 	':claseVehiculo',
					'estado'				=> 	':estado',
					'marca'					=> 	':marca',
					'perfilUsuario'			=> 	':perfilUsuario',
					'pregunta'				=> 	':pregunta',
					'statusCont'			=> 	':statusCont',
					'statusFormat'			=> 	':statusFormat',
					'statusUsuarios'		=> 	':statusUsuarios',
					'tipoPago'				=> 	':tipoPago',
					'tipoPersona'			=> 	':tipoPersona',
					'tipoTelf'				=> 	':tipoTelf',
					'tipoTrans'				=> 	':tipoTrans',
					//===================================
					'cobertura'				=> 	':cobertura',
					'tipoVehiculo'			=> 	':tipoVehiculo',
					'modelo'				=> 	':modelo',
					'municipio'				=> 	':municipio',
					'numPuesto'				=> 	':numPuesto',
					'parroquia'				=> 	':parroquia',
					'usoVehiculo'			=> 	':usoVehiculo',
					'precio'				=> 	':precio',
			);
				
			if (!array_key_exists($type, $cases)) {
				throw new Exception('Tipo de Solicitud no existente (configController-getReference)');
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
					//===================================
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
				
				$type = $keys[count($keys)-1];
				$data = $values[count($keys)-1];
								
				$_idDependent 	= ':'.$keys[count($keys)-2];
				$idDependent 	= $values[count($keys)-2];
				
				$cases = array(
					'cobertura'				=> 	':cobertura',
					'tipoVehiculo'			=> 	':tipoVehiculo',
					'modelo'				=> 	':modelo',
					'municipio'				=> 	':municipio',
					'numPuesto'				=> 	':numPuesto',
					'parroquia'				=> 	':parroquia',
					'usoVehiculo'			=> 	':usoVehiculo',
				);	
				
				if (!array_key_exists($type, $cases)) {
					throw new Exception('Tipo de Solicitud no existente (configController-actionDependence)');
					exit();
				}
				
				$bind_values = array(
						$cases[$type]	=> $data,
						$_idDependent	=> $idDependent
				);
				
				if ($_POST['tpAction'] == '0') {
					$this->_config->saveDependent($bind_values, $type);
				}else {
					$this->_config->updateDependent($bind_values, $type, $_POST['tpAction']);
				}
			}
		}
		
	}
?>
