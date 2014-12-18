<?php
	class selectController extends Controller {
		
		private $_select;
	
		public function __construct() {
				
			parent::__construct();
			$this->_select = $this->loadModel('select');
				
		}
	
		function index() {
			$this->_view->render('index');
		}
		
		public function loadSelect() {
			
			$data 	= array();
			$table 	= $_POST['table'];
			
			$cases = array(
				'claseVehiculo'			=>	'claseVehiculo',
				'marca'					=>	'marca',
				'estado'				=>	'estado',
				'perfilUsuario'			=>	'perfilUsuario',
				'agencias'				=>	'nombre_ag',
				'pregunta'				=>	'pregunta',
				'statusUsuarios'		=>	'statusUsuarios',
				'tipoPersona'			=>	'tipoPersona',
				'tipoTelf'				=>	'tipoTelf',
				'marca'					=>	'marca',
				'modelo'				=>	'modelo',
				'tipoTrans'				=>	'tipoTrans',
				'tipoPago'				=>	'tipoPago',
				
			);
				
			if (array_key_exists($table, $cases)) {
				$field = $cases[$table];
			}else {
				throw new Exception('Tipo de Solicitud no existente');
				exit();
			}
			
			$result =  $this->_select->getReferences( $table ) ;
			
			for ($i = 0; $i < count($result); $i++) {
				$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i][$field]);
			}
			
			echo  json_encode( $data );
		}
		
		function loadSelectDepent() {
			
			$data 	= array();
			$id		= $_POST['id'];
			$table 	= $_POST['table'];
			
			$cases = array(
				'modelo'				=>	'modelo',
				'municipio'				=>	'municipio',
				'parroquia'				=>	'parroquia',
				'tipoVehiculo'			=>	'tipoVehiculo',
				'cobertura'				=>	'cobertura',
				'numPuesto'				=>	'numPuesto',
				'usoVehiculo'			=>	'usoVehiculo',
			);
				
			if (array_key_exists($table, $cases)) {
				$field = $cases[$table];
			}else {
				throw new Exception('Tipo de Solicitud no existente (selectController-loadSelectDepent)');
				exit();
			}
			
			$result = $this->_select->getReferences( $table, $id );
			
			for ($i = 0; $i < count($result); $i++) {
				$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i][$field]);
			}
			
			echo  json_encode($data);
			
		}
		
		public function remote() {
			
			if (isset($_GET['placa'])) {
				$result = $this->_select->getRemote($_GET['placa'],'placa');
				if ( count($result) == true ) {
					$valid = 'false'; //valor para activar el mensaje de error en validate jquery
				}else{
					$valid = 'true';
				}
				echo $valid;
			}elseif (isset($_GET['serial_c'])) {
				$result = $this->_select->getRemote($_GET['serial_c'],'serial_c');
				if ( count($result) == true ) {
					$valid = 'false'; //valor para activar el mensaje de error en validate jquery
				}else{
					$valid = 'true';
				}
				echo $valid;
			}elseif (isset($_GET['serial_m'])) {
				$result = $this->_select->getRemote($_GET['serial_m'],'serial_m');
				if ( count($result) == true ) {
					$valid = 'false'; //valor para activar el mensaje de error en validate jquery
				}else{
					$valid = 'true';
				}
				echo $valid;
			}
			
		}
		
		public function remote2() {
				
			if (isset($_GET['placa'])) {
				$result = $this->_select->getRemote($_GET['placa'],'placa');
				if ( count($result) == true ) {
					if ($_GET['placa'] == $result[0]['placa']) {
						$valid = 'true';
					}else{
						$valid = 'false';
					}
				}else{
					$valid = 'true';
				}
				echo $valid;
			}elseif (isset($_GET['serial_c'])) {
				$result = $this->_select->getRemote($_GET['serial_c'],'serial_c');
				if ( count($result) == true ) {
					if ($result[0]['serial_c'] == $_GET['serial_c']) {
						$valid = 'true';
					}else{
						$valid = 'false';
					}
				}else{
					$valid = 'true';
				}
				echo $valid;
			}elseif (isset($_GET['serial_m'])) {
				$result = $this->_select->getRemote($_GET['serial_m'],'serial_m');
				if ( count($result) == true ) {
					if ($result[0]['serial_m'] == $_GET['serial_m']) {
						$valid = 'true';
					}else{
						$valid = 'false';
					}
				}else{
					$valid = 'true';
				}
				echo $valid;
			}
				
		}
		
	}

?>