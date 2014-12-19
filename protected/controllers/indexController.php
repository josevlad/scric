<?php
	class indexController extends Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		function index() {
			if (Session::get(AUTHENTICATED)) {
				
				switch (Session::get('level')) {
					case 'SUPER_U':
						$this->_view->redirect('config');
					break;
					
					case 'ASESOR':
						$this->_view->redirect('adviser/');
					break;
					
					case 'ADMIN_DB':
						$this->_view->redirect('config');
					break;
					
					default:
						$this->_view->redirect('login/close');
					break;
				}
				
			}else {
				$this->_view->redirect('login/signIn');
			}			
		}
	}
?>
