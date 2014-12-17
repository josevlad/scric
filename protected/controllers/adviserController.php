<?php
	class adviserController extends Controller {

		protected $_menuSB;
		protected $_adviser;
		
		public function __construct() {
			parent::__construct();
			$this->_adviser = $this->loadModel('adviser');
			$this->_menuSB = $this->createMenu();
		}
		
		function index() {
			
			//Content page-hader
			$this->_view->icon_fa = 'fa-database';
			$this->_view->titleHead = 'Administracion de Base de datos';
			
			if (Session::get('print')) {
				$this->_view->msg = App::boxMessage('Registro exitoso', "El contrato fue creado con exito!", "success");
			}
			//Session::set('print', true);
			Session::destroy('print');
			
			$this->_view->render('index',$this->_menuSB);		
		}
		
		public function getPrecio() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
				$data = array();
				
				$cobertura_id = $_POST['cobertura_id'];
				$numPuesto_id = $_POST['numPuesto_id'];
		
				$result =  $this->_adviser->getPrecioData( $cobertura_id, $numPuesto_id ) ;
					
				echo json_encode( array_shift( $result ) );
		
			}
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
						':fecha_reg'=> utf8_encode( $fecha_reg ), 
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
				
				$this->_view->render('formatos',$this->_menuSB);
			}
		}
		
		public function contratos($dataForm = false) {
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				Session::set('dataForm', $_POST);
				
				$keys 		= array();
				$values		= array();
				
				$titular 	= array(); 
				$telefonos 	= array();
				$correos 	= array();
				$contrato 	= array();
				
				foreach ($_POST as $key => $value){
					if($key == 'fecha_exp'){
						array_push( $keys	, ':'.$key 		);
						array_push( $values	, App::saveDate($value) 	);
					}else {
						array_push( $keys	, ':'.$key 	);
						array_push( $values	,  $value	);
					}
				}
				
				for ($i = 0; $i < '8'; $i++) {
					$titular[$keys[$i]] = $values[$i];
				}
				
				unset($titular[':estado']);
				unset($titular[':municipio']);
				
				$to = ($_POST['aux'] * 2) + 9;
				
				for ($i = '8'; $i < $to; $i++) {
					$telefonos[] = $values[$i];
				}
				unset($telefonos['0']);
				
				$from 	= $to +1;
				$to2	= $_POST['aux2'] + $from;
				
				for ($i = $from; $i < $to2 ; $i++) {
					$correos[] = $values[$i];
				}
				
				$from2 = $from + $to2;
				
				for ($i = $to2; $i < count($_POST) ; $i++) {
					$contrato[$keys[$i]] = $values[$i];
				}
				unset($contrato[':marca']);
				unset($contrato[':claseVehiculo']);
				unset($contrato[':tipoVehiculo']);
				unset($contrato[':numPuesto']);
				unset($contrato[':cobertura']);
				
				$contrato[':fecha_ven'] 	= App::saveDate( App::oneYearMore($_POST['fecha_exp']) );
				$contrato[':hora_ven'] 		= $_POST['hora_exp'];
				$contrato[':statusCont_id'] = '1';
				
				$data[] = $titular;
				$data[] = $telefonos;
				$data[] = $correos;
				$data[] = $contrato;
				
				echo $this->_adviser->saveContract($data);
				//saveContract
				
			}else {
				//content page-hader
				$this->_view->icon_fa = 'fa-users';
				$this->_view->titleHead = 'Clientes y Contratos';
				
				//maskedinput
				$this->_view->setJs(array('plugins/maskedinput/maskedinput'));
				
				//printPage js
				$this->_view->setJs(array('plugins/bootbox/bootbox'));				
				
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
				
				//custom config js
				$this->_view->setJs(array('adviser/contratos'));

				$this->_view->stPlanillas = count( $this->_adviser->getPlanilla() );
				$this->_view->stFacturas  = count( $this->_adviser->getFactura() );
				
				$this->_view->countPlanillas = count( $this->_adviser->getPlanillas() );
				$this->_view->countFacturas  = count( $this->_adviser->getFacturas() );
				
				$this->_view->render('contratos',$this->_menuSB);
			}
		}
		
		public function reallocateForm() {
			
			$data = Session::get('data');
			
			for ($i = 0; $i < '3'; $i++) {
				array_shift($data);
			}
			
			$contrato = array_shift($data);
			
			unset($contrato[':tipoPago']);
			
			$resul = $this->_adviser->onlyContract($contrato);
			Session::destroy('printbtn');
			
			if ($resul == true) {
				echo '2';
			}else {
				echo $resul;
			}
		}
		
		public function reallocateForm2() {
											
			$resul = $this->_adviser->onlyContract(Session::get('contrato'));
			Session::destroy('printbtn');
				
			if ($resul == true) {
				echo '2';
			}else {
				echo $resul;
			}
		}
						
		public function procesoImp() {
			
			if (Session::get('print')) {
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					
					switch ($_POST['resulImp']) {
						case '1':
							$this->_adviser->updateStatusContrato('2',Session::get('lastContrato'));							
							echo '1';
							exit();
						break;
							
						case '2':
							$this->reallocateForm();
							exit();
						break;
						
						case '3':
							Session::destroy('printbtn');
							echo '3';
							exit();
						break;

						case '4':
							$res = $this->reimpresion();
							echo ($res=='4') ? '4' : $res;
							exit();
						break;

						case '5':
							$res = $this->reimpresion();
							echo ($res=='4') ? '5' : $res;
							exit();
						break;
														
					}
					
					
				}else {
					//content page-hader
					$this->_view->icon_fa = 'fa-print';
					$this->_view->titleHead = 'Impresi�n de Contrato';
										
					//pdf js
					$this->_view->setJs(array('plugins/pdf/pdfobject'));

					//printPage js
					$this->_view->setJs(array('plugins/printPage/printPage'));
					
					//printPage js
					$this->_view->setJs(array('plugins/bootbox/bootbox'));
					
					//custom config js
					$this->_view->setJs(array('adviser/procesoImp'));
					
					$this->_view->render('procesoImp',$this->_menuSB);
				}
			}else {
				$this->_view->redirect('index');
			}
			
		}
		
		public function procesoImp2() {
				
			if (Session::get('print')) {
		
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						
					switch ($_POST['resulImp']) {
						case '1':
							$this->_adviser->updateStatusContrato('2',Session::get('lastContrato'));
							echo '1';
							exit();
							break;
								
						case '2':
							$this->reallocateForm2();
							exit();
							break;
		
						case '3':
							Session::destroy('printbtn');
							echo '3';
							exit();
							break;
		
						case '4':
							$res = $this->reimpresion();
							echo ($res=='4') ? '4' : $res;
							exit();
							break;
		
						case '5':
							$res = $this->reimpresion();
							echo ($res=='4') ? '5' : $res;
							exit();
							break;
		
					}
						
						
				}else {
					//content page-hader
					$this->_view->icon_fa = 'fa-print';
					$this->_view->titleHead = 'Impresi�n de Contrato';
		
					//pdf js
					$this->_view->setJs(array('plugins/pdf/pdfobject'));
		
					//printPage js
					$this->_view->setJs(array('plugins/printPage/printPage'));
						
					//printPage js
					$this->_view->setJs(array('plugins/bootbox/bootbox'));
						
					//custom config js
					$this->_view->setJs(array('adviser/procesoImpTwo'));
						
					$this->_view->render('procesoImpTwo',$this->_menuSB);
				}
			}else {
				$this->_view->redirect('index');
			}
				
		}
		
		public function impFact() {
				
			if (Session::get('print')) {
		
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						
					switch ($_POST['resulImp2']) {
						case '1':
							$fecha = App::saveDate($this->_adviser->getFecha());
							$facturas_id = $this->_adviser->getFactura();
							
							$data = array(
								':fecah_em' 	=> $fecha,
								':facturas_id' 	=> $facturas_id[0]['id'],
								':contratos_id'	=> Session::get('lastContrato'),
								':tipoPago_id'	=> Session::get('tipoPago'),	
							);
							
							$this->_adviser->insertFat($data, $facturas_id[0]['id']);
							/*
							Session::destroy('data');
							Session::destroy('dataForm');
							Session::destroy('lastTitular');
							Session::destroy('lastContrato');
							Session::destroy('assignedFormat');
							Session::destroy('contadorImp');
							Session::destroy('tipoPago');
							Session::destroy('printbtn');
							*/
							echo '1';
						
							exit();
						break;
								
						case '2':
							$facturas_id = $this->_adviser->getFactura();
							$res = $this->_adviser->disableFat($facturas_id[0]['id']);
							if ($res == true) {
								echo $res;
							}else{
								echo '2	';
							}
							exit();
						break;
		
						case '3':
							Session::destroy('printbtn');
							echo '3';
							exit();
						break;
		
						case '4':
							Session::destroy('printbtn');
							echo '3';
							exit();
						break;
		
					}
						
						
				}else {

					Session::destroy('printbtn');
					//content page-hader
					$this->_view->icon_fa = 'fa-print';
					$this->_view->titleHead = 'Impresi�n de Factura';
		
					//pdf js
					$this->_view->setJs(array('plugins/pdf/pdfobject'));
		
					//printPage js
					$this->_view->setJs(array('plugins/printPage/printPage'));
						
					//printPage js
					$this->_view->setJs(array('plugins/bootbox/bootbox'));
						
					//custom config js
					$this->_view->setJs(array('adviser/impFact'));
					
					$this->_view->codFact = $this->_adviser->getFactura();
						
					$this->_view->render('impFact',$this->_menuSB);
				}
			}else {
				$this->_view->redirect('adviser');
			}
				
		}
		
		public function impCarnet() {
		
			if (Session::get('print')) {
		
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
					switch ($_POST['resulImp3']) {
						case '1':
							
							 Session::destroy('data');
							 Session::destroy('dataForm');
							 Session::destroy('lastTitular');
							 Session::destroy('lastContrato');
							 Session::destroy('assignedFormat');
							 Session::destroy('contadorImp');
							 Session::destroy('tipoPago');
							 Session::destroy('printbtn');
							
							echo '1';
		
							exit();
						break;
		
						case '2':
							Session::destroy('printbtn');
							echo '2	';
							exit();
						break;
		
						case '3':
							Session::destroy('printbtn');
							echo '3';
							exit();
						break;
		
						case '4':
							Session::destroy('printbtn');
							echo '3';
							exit();
						break;
		
					}
		
		
				}else {
		
					Session::destroy('printbtn');
					//content page-hader
					$this->_view->icon_fa = 'fa-print';
					$this->_view->titleHead = 'Impresi�n de Carnet';
		
					//pdf js
					$this->_view->setJs(array('plugins/pdf/pdfobject'));
		
					//printPage js
					$this->_view->setJs(array('plugins/printPage/printPage'));
		
					//printPage js
					$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
					//custom config js
					$this->_view->setJs(array('adviser/impCarnet'));
						
					$this->_view->render('impCarnet',$this->_menuSB);
				}
			}else {
				$this->_view->redirect('adviser');
			}
		
		}
		
		public function editContrato() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				Session::destroy('dataForm');
				Session::set('dataForm', $_POST);
				
				//App::varDump($_POST);
				
				$keys 		= array();
				$values		= array();
				
				$titular 	= array(); 
				$telefonos 	= array();
				$correos 	= array();
				$contrato 	= array();
				
				foreach ($_POST as $key => $value){
					if($key == 'fecha_exp'){
						array_push( $keys	, ':'.$key 		);
						array_push( $values	, App::saveDate($value) 	);
					}else {
						array_push( $keys	, ':'.$key 	);
						array_push( $values	,  $value	);
					}
				}
				
				for ($i = 0; $i < '8'; $i++) {
					$titular[$keys[$i]] = $values[$i];
				}
				
				unset($titular[':estado']);
				unset($titular[':municipio']);
				
				$to = ($_POST['aux'] * 2) + 9;
				
				for ($i = '8'; $i < $to; $i++) {
					$telefonos[] = $values[$i];
				}
				unset($telefonos['0']);
				
				$from 	= $to +1;
				$to2	= $_POST['aux2'] + $from;
				
				for ($i = $from; $i < $to2 ; $i++) {
					$correos[] = $values[$i];
				}
				
				$from2 = $from + $to2;
				
				for ($i = $to2; $i < count($_POST) ; $i++) {
					$contrato[$keys[$i]] = $values[$i];
				}
				unset($contrato[':marca']);
				unset($contrato[':claseVehiculo']);
				unset($contrato[':tipoVehiculo']);
				unset($contrato[':numPuesto']);
				unset($contrato[':cobertura']);
				
				$contrato[':fecha_ven'] 	= App::saveDate( App::oneYearMore($_POST['fecha_exp']) );
				$contrato[':hora_ven'] 		= $_POST['hora_exp'];
				$contrato[':statusCont_id'] = '1';
				
				$data[] = $titular;
				$data[] = $telefonos;
				$data[] = $correos;
				$data[] = $contrato;
				
				echo $this->_adviser->updateContract($data);
				//saveContract
				
			}else {
				//content page-hader
				$this->_view->icon_fa = 'fa-pencil-square-o';
				$this->_view->titleHead = 'Edici�n de Contrato';
				
				//maskedinput
				$this->_view->setJs(array('plugins/maskedinput/maskedinput'));
				
				//printPage js
				$this->_view->setJs(array('plugins/bootbox/bootbox'));
				
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
				
				//custom config js
				$this->_view->setJs(array('adviser/editContrato'));
				
				$this->_view->data = Session::get('dataForm');
				
				$this->_view->render('editContrato',$this->_menuSB);
			}
		}
		
		public function editarContrato() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
				Session::destroy('dataForm');
				Session::set('dataForm', $_POST);
				
				$keys 		= array();
				$values		= array();
		
				$titular 	= array();
				$telefonos 	= array();
				$correos 	= array();
				$contrato 	= array();
		
				foreach ($_POST as $key => $value){
					if($key == 'fecha_exp'){
						array_push( $keys	, ':'.$key 		);
						array_push( $values	, App::saveDate($value) 	);
					}else {
						array_push( $keys	, ':'.$key 	);
						array_push( $values	,  $value	);
					}
				}
		
				for ($i = 0; $i < '8'; $i++) {
					$titular[$keys[$i]] = $values[$i];
				}
		
				unset($titular[':estado']);
				unset($titular[':municipio']);
		
				$to = ($_POST['aux'] * 2) + 9;
		
				for ($i = '8'; $i < $to; $i++) {
					$telefonos[] = $values[$i];
				}
				unset($telefonos['0']);
		
				$from 	= $to +1;
				$to2	= $_POST['aux2'] + $from;
		
				for ($i = $from; $i < $to2 ; $i++) {
					$correos[] = $values[$i];
				}
		
				$from2 = $from + $to2;
		
				for ($i = $to2; $i < count($_POST) ; $i++) {
					$contrato[$keys[$i]] = $values[$i];
				}
				unset($contrato[':marca']);
				unset($contrato[':claseVehiculo']);
				unset($contrato[':tipoVehiculo']);
				unset($contrato[':numPuesto']);
				unset($contrato[':cobertura']);
		
				$contrato[':fecha_ven'] 	= App::saveDate( App::oneYearMore($_POST['fecha_exp']) );
				$contrato[':hora_ven'] 		= $_POST['hora_exp'];
				$contrato[':statusCont_id'] = '1';
		
				$data[] = $titular;
				$data[] = $telefonos;
				$data[] = $correos;
				$data[] = $contrato;
				
				//App::varDump($data);
				
				echo $this->_adviser->updateContract2($data);
				//saveContract
		
			}else {
				//content page-hader
				$this->_view->icon_fa = 'fa-pencil-square-o';
				$this->_view->titleHead = 'Edici�n de Contrato';
		
				//maskedinput
				$this->_view->setJs(array('plugins/maskedinput/maskedinput'));
		
				//printPage js
				$this->_view->setJs(array('plugins/bootbox/bootbox'));
		
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
		
				//custom config js
				$this->_view->setJs(array('adviser/editarContrato'));
		
				$this->_view->data = Session::get('dataForm');
				
				$this->_view->render('editarContrato',$this->_menuSB);
			}
		}
		
		public function createVariableSession() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$printbtn = $_POST['printbtn'];
				Session::set('printbtn', $printbtn);
		
			}
		}
		
		public function reimpresion() {
			
			if (Session::get('contadorImp')){
				
				if (Session::get('contadorImp') == '1') {
					echo 'Ha agotados las oportunidades de impresion';
					exit();
				}else{

					$aux = Session::get('contadorImp');
					Session::destroy('contadorImp');
					Session::destroy('printbtn');
					Session::set('contadorImp', $aux - 1);
					
					echo '4';
				}
			}else {
				Session::set('contadorImp', 3);
				Session::destroy('printbtn');
				echo '4';
			}
			
		}
		
		public function ajaxTitular() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$dni = $_POST['dni'];
				$result = $this->_adviser->getAjaxTitular($dni);				
				echo $result;
				
			}
		}
		
		public function asociarContrato($id = false) {
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {			
				
				$keys 		= array();
				$values		= array();
			
				$contrato 	= array();
				
				foreach ($_POST as $key => $value){
					if($key == 'fecha_exp'){
						array_push( $keys	, ':'.$key 		);
						array_push( $values	, App::saveDate($value) 	);
					}else {
						array_push( $keys	, ':'.$key 	);
						array_push( $values	,  $value	);
					}
				}
				
				for ($i = 0; $i < count($_POST) ; $i++) {
					$contrato[$keys[$i]] = $values[$i];
				}
				
				unset($contrato[':marca']);
				unset($contrato[':claseVehiculo']);
				unset($contrato[':tipoVehiculo']);
				unset($contrato[':numPuesto']);
				Session::set('tipoPago', $contrato[':tipoPago']);
				unset($contrato[':tipoPago']);
				unset($contrato[':cobertura']);
				
				$fecha_ven = App::oneYearMore( $_POST['fecha_exp'] ); 
				
				$contrato[':fecha_ven'] = App::saveDate($fecha_ven);
				$contrato[':hora_ven'] 	= $_POST['hora_exp'];
				$contrato[':statusCont_id'] = '1';
				
				//print_r($contrato);
				Session::set('contrato', $contrato);
				Session::set('dataForm', $_POST);
				echo $this->_adviser->assocContract($contrato);
				
			}else {
				//content page-hader
				$this->_view->icon_fa = 'fa-users';
				$this->_view->titleHead = 'Asociaci�n de Contrato Nuevo';
				
				//Alert js
				$this->_view->setJs(array('plugins/bootbox/bootbox'));
				
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
				
				//custom config js
				$this->_view->setJs(array('adviser/asociarContrato'));
				
				Session::set('lastTitular', $id);
				$this->_view->data = $this->_adviser->getTitular($id);
				
				$this->_view->stPlanillas = count( $this->_adviser->getPlanilla() );
				$this->_view->stFacturas  = count( $this->_adviser->getFactura() );
				
				$this->_view->countPlanillas = count( $this->_adviser->getPlanillas() );
				$this->_view->countFacturas  = count( $this->_adviser->getFacturas() );
				
				$this->_view->render('asociarContrato',$this->_menuSB);
			}
		}
		
		public function editAsoc() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				Session::destroy('contrato');
				
				$keys 		= array();
				$values		= array();
			
				$contrato 	= array();
				
				foreach ($_POST as $key => $value){
					if($key == 'fecha_exp'){
						array_push( $keys	, ':'.$key 		);
						array_push( $values	, App::saveDate($value) 	);
					}else {
						array_push( $keys	, ':'.$key 	);
						array_push( $values	,  $value	);
					}
				}
				
				for ($i = 0; $i < count($_POST) ; $i++) {
					$contrato[$keys[$i]] = $values[$i];
				}
				
				unset($contrato[':marca']);
				unset($contrato[':claseVehiculo']);
				unset($contrato[':tipoVehiculo']);
				unset($contrato[':numPuesto']);
				Session::set('tipoPago', $contrato[':tipoPago']);
				unset($contrato[':tipoPago']);
				unset($contrato[':cobertura']);
				
				$contrato[':fecha_ven'] = $_POST['fecha_exp'];
				$contrato[':hora_ven'] = $_POST['hora_exp'];
				$contrato[':statusCont_id'] = '1';
				
				//print_r($contrato);
				Session::set('contrato', $contrato);
				echo $this->_adviser->assocContract($contrato);
			
			}else {
				//content page-hader
				$this->_view->icon_fa = 'fa-pencil-square-o';
				$this->_view->titleHead = 'Edici�n de Contrato';
			
				//maskedinput
				$this->_view->setJs(array('plugins/maskedinput/maskedinput'));
			
				//printPage js
				$this->_view->setJs(array('plugins/bootbox/bootbox'));
			
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
			
				//custom config js
				$this->_view->setJs(array('adviser/editContrato'));
			
				$this->_view->data = Session::get('dataForm');
			
				$this->_view->render('editContrato',$this->_menuSB);
			}
		}
	}
?>
