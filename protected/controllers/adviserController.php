<?php
	class adviserController extends Controller {
		
		protected $_adviser;
		
		public function __construct() {
			parent::__construct();
			$this->_adviser = $this->loadModel('adviser');
		}
		
		function index() {
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
			
			$this->_view->render('index');		
		}
		
		public function formatos() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$fecha_reg 	= App::saveDate( $_POST['fecha_reg'] );
				$table 		= $_POST['type'];
				$result 	= 'false';
				$desde 		= $_POST['desde'];
				$hasta 		= $_POST['hasta'];
				
				for ($i = $desde; $i <= $hasta; $i++) {
						
					$bind_values = array(
						':codigo'=> $i, 
						':fecha_reg'=> $fecha_reg, 
						'statusFormat_id'=> '1', 
						'agencias_id'=> Session::get('idAgencia')
					);
					
					$res = $this->_adviser->saveFormato( $bind_values, $table );
					
					$result = $res;					
				}
				
				
				echo $result;
				
			}else {
				
				//Content page-hader
				$this->_view->icon_fa = 'fa-file-text-o';
				$this->_view->titleHead = 'Planillas y Facturas';
				
				//data planillas disponibles
				//$this->_view->pla = $this->_adviser->getPercent('1');
				//$this->_view->data = $this->_adviser->getPercent('1');

				//custom adviser js
				$this->_view->setJs(array('plugins/easy-pie-chart/js/jquery.easypiechart'));
				
				//custom adviser js
				$this->_view->setJs(array('adviser/formatos'));
				
				$this->_view->render('formatos');
			}
		}
		
		public function contratos() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				;
			}else {
				//content page-hader
				$this->_view->icon_fa = 'fa-users';
				$this->_view->titleHead = 'Clientes y Contratos';
				
				//maskedinput
				$this->_view->setJs(array('plugins/maskedinput/maskedinput'));
				
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
				
				//custom config js
				$this->_view->setJs(array('adviser/contratos'));
				
				$this->_view->render('contratos'/*,$this->_sidebar_menu*/);
			}
		}
	}
?>
