<?php
	class indexController extends Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		function index() {
			if (Session::get(AUTHENTICATED)) {
				
				switch (Session::get('level')) {
					case 'ADMIN_DB':
						$this->_view->redirect('contracts','index');
					break;
					
					case 'ASESOR':
						$this->_view->redirect('contracts','index');
					break;
					
					case 'AUDITOR':
						$this->_view->redirect('contracts','index');
					break;
					
					default:
						$this->_view->redirect('login','close');
					break;
				}
				
			}else {
				$this->_view->redirect('login','signIn');
			}			
		}
	}
?>
