<?php
	class indexController extends Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		function index() {
			if (Session::get(AUTHENTICATED)) {
				$this->_view->render('index');
			}else {
				$this->_view->redirect('login','signIn');
			}			
		}
	}
?>
