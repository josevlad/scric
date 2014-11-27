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
			
			$data = array();
			$type = $_POST['type'];
			
			$cases = array(
				'tpPersona_id' 		=> 	'tpPersona',
				'estado'			=>	'estado',
				'tipoTelf_id'		=>	'tpTelf',
				'marca'				=>	'marca',
				'trans'				=>	'trans'
			);
				
			if (array_key_exists($type, $cases)) {
				$field = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente');
				exit();
			}
			
			$result = $this->_select->getReferences( $type );
			
			for ($i = 0; $i < count($result); $i++) {
				$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i][$field]);
			}
			
			echo  json_encode($data);
		}
		
		function loadSelectDepent() {
			
			$data 		= array();
			$id 		= $_POST['id'];
			$type	 	= $_POST['type'];
				
			$cases = array(
				'municipio'		=>	'municipio',
				'parroquias_id'	=>	'parroquia',
				'modelos_id'	=>	'modelo'
			);
			
			if (array_key_exists($type, $cases)) {
				$field = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente');
				exit();
			}

			$result = $this->_select->getReferences( $type , $id );
			
			for ($i = 0; $i < count($result); $i++) {
				$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i][$field]);
			}
				
			echo  json_encode($data);
			
		}
	}

?>