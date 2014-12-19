<?php
	class configController extends Controller {
		
		protected $_menuSB;
		private $_config;
		
		public function __construct() {
			parent::__construct();
			$this->_config = $this->loadModel('config');
			$this->_menuSB = $this->createMenu();
		}
		
		function index() {
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
			$this->_view->render('index',$this->_menuSB);
		}
		
		public function remote() {

			Session::accessRole(array('SUPER_U','ADMIN_DB','ASESOR'));
			
			foreach ($_GET as $key => $value){
				$field 	= $key;
				$data	= $value;
			}
			
			$result = $this->_config->getRemote( $field, $data );
			
			if ( count($result) == true ) {
				$valid = 'false'; //valor para activar el mensaje de error en validate jquery
			}else{
				$valid = 'true';
			}
			
			echo $valid;
						
		}
		
		/*
		 * Metodos para administrar las tablas referenciales
		 * de la base de datos
		 */
		
		//Administracion de la tabla agencias
		public function agencias() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				if ($_POST['tpAction'] == '0') {
					
					$bind_values = array(
							':nombre_ag'		=> utf8_encode( $_POST['nombre_ag'] ),
							':identificador'	=> utf8_encode( $_POST['identificador'] )
					);
					
					$this->_config->saveAgencia($bind_values);
				}else {
					
					$bind_values = array(
							':nombre_ag'		=> utf8_encode( $_POST['nombre_ag'] ),
							':identificador'	=> utf8_encode( $_POST['identificador'] ),
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
				
				$this->_view->render('agencias',$this->_menuSB);
				
			}		
		}
		
		//Administracion de la tabla claseVehiculo
		public function claseVehiculo() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'claseVehiculo' );
		
			//custom config js
			$this->_view->setJs(array('config/claseVehiculo'));
		
			$this->_view->render('claseVehiculo',$this->_menuSB);
		
		}
		
		//Administracion de la tabla estado
		public function estado() {
			
			Session::accessRole(array('SUPER_U'));
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'estado' );
		
			//custom config js
			$this->_view->setJs(array('config/estado'));
		
			$this->_view->render('estado',$this->_menuSB);
		
		}
		
		//Administracion de la tabla marca
		public function marca() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB','ASESOR'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'marca' );
		
			//custom config js
			$this->_view->setJs(array('config/marca'));
		
			$this->_view->render('marca',$this->_menuSB);
		
		}
		
		//Administracion de la tabla perfilUsuario
		public function perfilUsuario() {
			
			Session::accessRole(array('SUPER_U'));
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'perfilUsuario' );
		
			//custom config js
			$this->_view->setJs(array('config/perfilUsuario'));
		
			$this->_view->render('perfilUsuario',$this->_menuSB);
		
		}
		
		//Administracion de la tabla pregunta
		public function pregunta() {
			
			Session::accessRole(array('SUPER_U'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'pregunta' );
		
			//custom config js
			$this->_view->setJs(array('config/pregunta'));
		
			$this->_view->render('pregunta',$this->_menuSB);
		
		}
		
		//Administracion de la tabla statusCont
		public function statusCont() {
			
			Session::accessRole(array('SUPER_U'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'statusCont' );
		
			//custom config js
			$this->_view->setJs(array('config/statusCont'));
		
			$this->_view->render('statusCont',$this->_menuSB);
		
		}
		
		//Administracion de la tabla statusFormat
		public function statusFormat() {
			
			Session::accessRole(array('SUPER_U'));
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'statusFormat' );
		
			//custom config js
			$this->_view->setJs(array('config/statusFormat'));
		
			$this->_view->render('statusFormat',$this->_menuSB);
		
		}
		
		//Administracion de la tabla statusUsuarios
		public function statusUsuarios() {
			
			Session::accessRole(array('SUPER_U'));
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'statusUsuarios' );
		
			//custom config js
			$this->_view->setJs(array('config/statusUsuarios'));
		
			$this->_view->render('statusUsuarios',$this->_menuSB);
		
		}
				
		//Administracion de la tabla tipoPago
		public function tipoPago() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoPago' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoPago'));
		
			$this->_view->render('tipoPago',$this->_menuSB);
		
		}
		
		//Administracion de la tabla tipoPersona
		public function tipoPersona() {
			
			Session::accessRole(array('SUPER_U'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoPersona' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoPersona'));
		
			$this->_view->render('tipoPersona',$this->_menuSB);
		
		}
		
		//Administracion de la tabla tipoTelf
		public function tipoTelf() {
			
			Session::accessRole(array('SUPER_U'));
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoTelf' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoTelf'));
		
			$this->_view->render('tipoTelf',$this->_menuSB);
		
		}
		
		//Administracion de la tabla tipoTrans
		public function tipoTrans() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoTrans' );
		
			//custom config js
			$this->_view->setJs(array('config/tipoTrans'));
		
			$this->_view->render('tipoTrans',$this->_menuSB);
		
		}
		
		/*
		 * Metodos para administrar las tablas dependientes
		 * de la base de datos
		 */
		
		//Administracion de la tabla cobertura
		public function cobertura() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'cobertura' );
		
			//custom config js
			$this->_view->setJs(array('config/cobertura'));
		
			$this->_view->render('cobertura',$this->_menuSB);
		
		}
		
		//Administracion de la tabla tipoVehiculo
		public function tipoVehiculo() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'tipoVehiculo' );
			
			//custom config js
			$this->_view->setJs(array('config/tipoVehiculo'));
		
			$this->_view->render('tipoVehiculo',$this->_menuSB);
		
		}
		
		//Administracion de la tabla modelo
		public function modelo() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB','ASESOR'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'modelo' );
				
			//custom config js
			$this->_view->setJs(array('config/modelo'));
		
			$this->_view->render('modelo',$this->_menuSB);
		
		}
		
		//Administracion de la tabla municipio
		public function municipio() {
			
			Session::accessRole(array('SUPER_U'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'municipio' );
		
			//custom config js
			$this->_view->setJs(array('config/municipio'));
		
			$this->_view->render('municipio',$this->_menuSB);
		
		}
		
		//Administracion de la tabla numPuesto
		public function numPuesto() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'numPuesto' );
		
			//custom config js
			$this->_view->setJs(array('config/numPuesto'));
		
			$this->_view->render('numPuesto',$this->_menuSB);
		
		}
		
		//Administracion de la tabla parroquia
		public function parroquia() {
			
			Session::accessRole(array('SUPER_U'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'parroquia' );
		
			//custom config js
			$this->_view->setJs(array('config/parroquia'));
		
			$this->_view->render('parroquia',$this->_menuSB);
		
		}

		//Administracion de la tabla usoVehiculo
		public function usoVehiculo() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
		
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
		
			//dataTable
			$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
		
			//data de la tb tipo de persona
			$this->_view->data = $this->getReference( 'usoVehiculo' );
		
			//custom config js
			$this->_view->setJs(array('config/usoVehiculo'));
		
			$this->_view->render('usoVehiculo',$this->_menuSB);
		
		}

		//Administracion de la tabla precio
		public function edithPrecio() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				print_r($_POST);
				
				/*
				if ($_POST['tpAction'] == '0') {
						
					$bind_values = array(
							':precio'		=> $_POST['precio'],
							':numPuesto_id'	=> $_POST['numPuesto_id'],
							':cobertura_id'	=> $_POST['cobertura_id'],
					);
						
					$this->_config->savePrecio($bind_values);
				}else {
						
					$bind_values = array(
							':precio'		=> $_POST['precio'],
							':numPuesto_id'	=> $_POST['numPuesto_id'],
							':cobertura_id'	=> $_POST['cobertura_id'],
							':id'			=> $_POST['tpAction']
					);
						
					$this->_config->updatePrecio($bind_values);
				}
				*/
			}else {
		
				//Content page-hader
				$this->_view->icon_fa = 'fa-database';
				$this->_view->titleHead = 'Administracion de Base de datos';
			
				//dataTable
				$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
			
				//data de la tb tipo de persona
				$this->_view->np = $this->getReference( 'numPuesto' );
				$this->_view->data = $this->getReference( 'precio' );
			
				//custom config js
				$this->_view->setJs(array('config/precio'));
			
				$this->_view->render('precio',$this->_menuSB);
			
			}
		
		}
		
		public function asignarPrecio() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				//print_r($_POST);
				unset($_POST['claseVehiculo']);
				unset($_POST['np_length']);
				
				$keys 		= array();
				$values		= array();
				
				foreach ($_POST as $key => $value){
					array_push(	$keys, $key );
					array_push( $values, $value );
				}
				
				$cobertura_id 	= array_shift($values);
				$precio  		= array_shift($values);
				$ids 			= array_shift($values);
				
				for ($i = 0; $i < count($ids); $i++) {
					$bind_values = array(
							':precio'		=> $precio,
							':numPuesto_id'	=> $ids[$i],
							':cobertura_id'	=> $cobertura_id,
					);
					$this->_config->savePrecio($bind_values);
				}
				
			}else {
		
				//Content page-hader
				$this->_view->icon_fa = 'fa-database';
				$this->_view->titleHead = 'Administracion de Base de datos';
			
				//dataTable
				$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
			
				//data de la tb tipo de persona
				$this->_view->np = $this->getReference( 'numPuesto' );
				$this->_view->data = $this->getReference( 'precio' );
			
				//custom config js
				$this->_view->setJs(array('config/asignarPrecio'));
			
				$this->_view->render('asignarPrecio',$this->_menuSB);
			
			}
		}
				
		//Administracion de la tabla usuarios
		public function usuarios() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				if ($_POST['tpAction'] == '0') {
					
					$bind_values = array(
							':nick'					=> $_POST['nick'],
							':clave'				=> md5( $_POST['clave'] ),
							':nombre'				=> $_POST['nombre'],
							':apellido'				=> $_POST['apellido'],
							':perfilUsuario_id'		=> $_POST['perfilUsuario_id'] ,
							':agencias_id'			=> $_POST['agencias_id'] ,
							':pregunta_id'			=> $_POST['pregunta_id'] ,
							':respuesta'			=> $_POST['respuesta'],
							':statusUsuarios_id'	=> '1',
					);					
					$this->_config->saveUsuarios($bind_values);
					
				}else {
					
					$bind_values = array(
							':nombre'				=> $_POST['nombre'],
							':apellido'				=> $_POST['apellido'],
							':perfilUsuario_id'		=> $_POST['perfilUsuario_id'],
							':agencias_id'			=> $_POST['agencias_id'],
							':statusUsuarios_id'	=> $_POST['statusUsuarios_id']
					);
					
					$this->_config->updateUsuarios($bind_values, $_POST['tpAction']);
					
				}
			}else {
				//Content page-hader
				$this->_view->icon_fa = 'fa-users';
				$this->_view->titleHead = 'Administración de Usuarios';

				//dataTable
				$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
				
				//data de la tb tipo de persona
				$this->_view->data = $this->getReference( 'usuarios' );
			
				//custom config js
				$this->_view->setJs(array('config/usuarios'));
			
				$this->_view->render('usuarios',$this->_menuSB);
			}
		
		}

		public function getRegistro() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$id = $_POST['id'];
				$result = $this->_config->getUsuario( $id );
				
				echo json_encode( array_shift( $result ) );
				
			};
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
		
			$this->_view->render('name',$this->_menuSB);
		
		}
		
		//Administracion de la tabla asignarConcepto
		public function asignarConcepto() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
		
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				unset($_POST['np_length']);
				
				$gastosMedicos1 	= array_shift($_POST);
				$invalidez1			= array_shift($_POST);
				$muerte1			= array_shift($_POST);
				$gastosMedicos2		= array_shift($_POST);
				$invalidez2			= array_shift($_POST);
				$muerte2			= array_shift($_POST);
				$daniosPropiedad	= array_shift($_POST);
				$grua				= array_shift($_POST);
				$estacionamiento	= array_shift($_POST);
				$indemnizacionSem	= array_shift($_POST);
				$asistenciaLegal	= array_shift($_POST);
				$ids				= array_shift($_POST);
				
				$result = '';
				
				for ($i = 0; $i < count($ids); $i++) {
					$bind_values = array(
							':cobertura_id'		=> $ids[$i],
							':gastosMedicos1'	=> $gastosMedicos1,
							':invalidez1'		=> $invalidez1,
							':muerte1'			=> $muerte1,
							':gastosMedicos2'	=> $gastosMedicos2,
							':invalidez2'		=> $invalidez2,
							':muerte2'			=> $muerte2,
							':daniosPropiedad'	=> $daniosPropiedad,
							':grua'				=> $grua,
							':estacionamiento'	=> $estacionamiento,
							':indemnizacionSem'	=> $indemnizacionSem,
							':asistenciaLegal'	=> $asistenciaLegal,
					);
					$result = $this->_config->saveConcepto($bind_values);
				}
				
				echo $result;
				
			}else {
		
				//Content page-hader
				$this->_view->icon_fa = 'fa-database';
				$this->_view->titleHead = 'Administracion de Base de datos';
			
				//dataTable
				$this->_view->setJs(array('plugins/datatables/jquery.dataTables.min'));
			
				//data de la tb tipo de persona
				$this->_view->cb = $this->getReference( 'cobertura' );
				$this->_view->data = $this->getReference( 'concepto' );
			
				//custom config js
				$this->_view->setJs(array('config/asignarConcepto'));
			
				$this->_view->render('asignarConcepto',$this->_menuSB);
			
			}
		
		}
		
		public function getReference( $type ) {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB','ASESOR'));
			
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
					'usuarios'				=> 	':usuarios',
					'concepto'				=> 	':concepto',
			);
				
			if (!array_key_exists($type, $cases)) {
				throw new Exception('Tipo de Solicitud no existente (configController-getReference)');
				exit();
			}
		
			$result = $this->_config->getReferenceData( $type );
				
			return $result;
		}
		
		public function actionReference() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB','ASESOR'));
			
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
					 	utf8_decode( $value )
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
						$cases[$type]	=> utf8_encode( $data )
				);
				
				if ($_POST['tpAction'] == '0') {
					$this->_config->saveReference($bind_values, $type);
				}else {
					$this->_config->updateReference($bind_values, $type, $_POST['tpAction']);
				}
			}
		}
		
		public function actionDependence() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				
				if (isset($_POST['aux'])) {
					$dif = $_POST['aux'];
					
					for ($i = 0; $i < $dif; $i++) {
						array_shift($_POST);
					}
				}
				
				//echo count($_POST);
				//printf("\n");
				//print_r($_POST);
				
				//exit();
				
				$keys 		= array();
				$values		= array();
				
				foreach ($_POST as $key => $value){
					array_push( 	$keys	, $key 		);
					array_push( 	$values	, $value 	);
				}
				
				//print_r($_POST);
				//print_r($keys);
				//print_r($values);
				
				$type 		= array_shift($keys);
				$type_value = array_shift($values);//no se usa, pero hay que extraerlo del array general
				
				$cases = array(
					'cobertura'				=> 	':cobertura',//
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
				
				//echo 'existe';
				
				$action 	  = array_shift($keys);
				$action_value = array_shift($values);
								
				$dependence_id 		 = ':'.array_shift($keys);
				$dependence_id_value = array_shift($values);
				
				//print_r($keys);
				//print_r($values);
				
				for ($i = 0; $i < count($keys); $i++) {
					$bind_values = array(
							$cases[$type]	=> $values[$i],
							$dependence_id	=> $dependence_id_value
					);
					
					if ($action_value == '0') {
						$this->_config->saveDependent($bind_values, $type);
					}else {
						$this->_config->updateDependent($bind_values, $type, $action_value);
					}
					
				}
				
				echo true;
				
			}
		}
		
		public function actionNumPuesto() {
			
			Session::accessRole(array('SUPER_U','ADMIN_DB'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {				
				
				$keys 		= array();
				$values 	= array();
				$to 		= array_shift($_POST);
				$tpAction 	=  array_shift($_POST);
				
				foreach ($_POST as $key => $value){
					if (substr($key,0,3) != 'cv_') {
						array_push( 	$keys	, $key 		);
						array_push( 	$values	, $value 	);
					}
				}
				
				$i = 0;
				while ($i < count($values)):
					
					$bind_values = array(
							':tipoVehiculo_id'	=> $values[$i],
							':numPuesto'		=> $values[$i+1]
					);

					if ($tpAction == '0') {
						$v = $this->_config->saveDependent($bind_values, 'numPuesto');
					}else {
						$v = $this->_config->updateDependent($bind_values, 'numPuesto', $tpAction);
					}
					
					$i++;
					$i++;
				endwhile;
								
			}
			
		}
		
	}
?>
