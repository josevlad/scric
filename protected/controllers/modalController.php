<?php
	class modalController extends Controller {
		
		private $_modal;
		
		public function __construct() {
			parent::__construct();
			$this->_modal = $this->loadModel('modal');
		}
		
		function index() {}
		
		public function marca() {
			//Session::accessRole(array('User'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$data = array(
					':marca'	=> $_POST['marca'] 
				);
				echo $this->_modal->saveMarca($data);
				
			}else{

				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
				
				$this->_view->setJs(array('modal/marca'));
				
				$this->_view->render('marca','','modal');
			} 			
		}
		
		public function modelo() {
			//Session::accessRole(array('User'));
				
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
				$data = array(
					':marca_id'	=> $_POST['marca_id'],
					':modelo'	=> $_POST['modelo'],
						
				);
				echo $this->_modal->saveModelo($data);
		
			}else{
		
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
		
				$this->_view->setJs(array('modal/modelo'));
		
				$this->_view->render('modelo','','modal');
			}
		}
		
		
	}
?>