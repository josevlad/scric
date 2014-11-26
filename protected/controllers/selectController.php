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
				
				case 'edocivil':
					$result = $this->_select->getEdoCivil();
					$data = array();
					for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i]['edo_civil']);
					}
				break;
				
				case 'lugares':
					$result = $this->_select->getLugares();
					$data = array();
					for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i]['lugar']);
					}
				break;
				
				case 'tp_telf':
					$result = $this->_select->getTpPhone();
					$data = array();
					for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i]['tipo']);
					}
				break;
				
				case 'marca':
					$result = $this->_select->getMarcas();
					$data = array();
					for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array("id"=>$result[$i]['id'],"option"=>$result[$i]['marca']);
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
				case 'marca':
					$result = $this->_select->getModelos($_POST["id"]);
					$data = array();
						
					for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array("id"=>$result[$i]["id"],"option"=>$result[$i]["modelo"]);
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