<?php
	class View {
		
		private $_controller;
		private $_js;
		private $_css;
	
		
		public function __construct(Request $request) {
			$this->_controller = $request->getController();
			$this->_js = array();
			$this->_css = array();	
		}
	
		public function render($view, $menu = FALSE, $layout = FALSE) {
			
			$top_menu = array(
				array(
					'id'	=>'index',
					'title'	=>'INICIO',
					'link'	=> BASE_URL . 'index'					
				),
				array(
					'id'	=>'persons',
					'title'	=>'PERSONAS',
					'link'	=> BASE_URL . 'persons'
				)
					
			);

			$js 	= array();
			$css 	= array();
			
			if (count($this->_js)) {
				$js = $this->_js;
			}
			
			if (count($this->_css)) {
				$css = $this->_css;
			}
				
			$_view_params = array(
				'top_menu'=> $top_menu,
				'sidebar_menu' => $sidebar_menu,
				'js' => $js,
				'css' => $css,
					
			);				
			
			$view_route = ROOT.'protected'.DS.'views'.DS.$this->_controller.DS.$view.'.phtml';
			
			if(is_readable($view_route)) {
				
				switch ($layout) {
					
					case 'modal': 
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout/modal' . DS . 'statements.phtml';
						include_once $view_route;
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout/modal' . DS . 'footer.phtml';
					break;
							
					case 'login':
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout/login' . DS . 'statements.phtml';
						include_once $view_route;
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout/login' . DS . 'footer.phtml';
					break;
					
					case 'error': //error view
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout/error' . DS . 'statements.phtml';
						include_once $view_route;
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout/error' . DS . 'footer.phtml';
					break;
							
					default:
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout' . DS . 'statements.phtml';
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout' . DS . 'header.phtml';
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout' . DS . 'sidebar.phtml';
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout' . DS . 'page-header.phtml';
						include_once $view_route;
						include_once ROOT . 'protected' . DS . 'views' . DS . 'layout' . DS . 'footer.phtml';
					break;
				}
				
			}else{
				
				throw new Exception('LA VISTA: "'. $view_route .'" NO FUE ENCONTRADA.');
			}				
		}
		
		
		public function redirect($controller = FALSE, $view = FALSE) {
			if ($controller) {
				header('location:' . BASE_URL . $controller . DS . $view );
				exit();
			}else {
				header('location:' . BASE_URL );
				exit();
			};
		}
		
		public function setJs(array $js) {
			if (is_array($js) && count($js)) {
				for ($i = 0; $i < count($js); $i++) {
					$this->_js[] = BASE_URL . 'public/js/' . $js[$i] . '.js';
				}
			}else {
				throw new Exception('El archivo: '. $js . ' No fue encontrado');
			}
		}
		
		public function setCss(array $css) {
			if (is_array($css) && count($css)) {
				for ($i = 0; $i < count($css); $i++) {
					$this->_css[] = BASE_URL . 'public/css/' . $css[$i] . '.css';
				}
			}else {
				throw new Exception('El archivo: '. $css . ' No fue encontrado');
			}
		}
		
	}
?>
