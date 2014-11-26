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
			
			switch ($_POST['type']) {
				
				case 'tpPersona_id':
					//$result = $this->_select->getModelos($_POST["id"]);
					$data = array();						
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;
				
				case 'estado':
					$data = array();						
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break; 

				case 'tipoTelf_id':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;
				
				case 'marca':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;
				
				case 'trans':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case 'clase':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case '':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case '':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;
				
				case '':
					$result = $this->_select->getEdoCivil();
					$data = array();
					for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i]['edo_civil']);
					}
				break;
				
				
				//=====================================================================================
				default:
					throw new Exception('Atributo nombre no encontrado');
				break;
			}
			
			echo  json_encode($data);
		}
		
		function loadSelectDepent() {
			
			switch ($_POST['name']) {
				
				case 'marca2':
					$result = $this->_select->getModelos($_POST["id"]);
					$data = array();
						
					for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array("id"=>$result[$i]["id"],"option"=>$result[$i]["modelo"]);
					}
				break;
				
				case 'estado':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case 'municipio':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case 'marca':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;
				
				case 'clase':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case 'tpVehiculo':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case '':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case '':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;

				case '':
					$data = array();
					for ($i = 0; $i < '3'; $i++) {
						$j = $i + 1;
						$data[$i] = array("id"=>$j,"option"=>'Option_'.$j);
					}
				break;
				
				default:
					throw new Exception('Atributo nombre no encontrado');
				break;
			}
						
			echo json_encode($data);
		}
	}

?>