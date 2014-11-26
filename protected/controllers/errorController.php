<?php
	class errorController extends Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function index() {}
		
		public function access($code) {
			
			$this->_view->type_layout = 'error';
			$this->_view->errorNum = $code;
			$this->_view->message = $this->_getError($code);
			$this->_view->render('access', '', 'error');
		}
		
		private function _getError($code = null) {
			
			if ($code) {
				if (is_int($code)) {
					$code = $code;
				}
			}else {
				$code = 'default';
			}
			
			$error['default'] = 'Mensaje de Error por defecto';
			$error['5050'] = 'Acceso restringido';
			$error['8080'] = 'Tiempo de sesión agotado';
			
			if (array_key_exists($code, $error)) {
				return $error[$code];
			}else {
				return $error['default'];
			}
		}
		
	}
?>