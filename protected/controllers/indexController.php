<?php
	class indexController extends Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		function index() {
			$this->_view->render('index');			
		}
	}
?>
