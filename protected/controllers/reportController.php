<?php
	class reportController extends Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		function index() {}
		
		private function header() {
			$header= '
			    <page_header>
					<div style="height: 10%; width: 100%; border: 0px solid #ccc; margin: 0px 0px 0px 0px; padding: 0px 0px 0px 4px;">
						
					</div>
			    </page_header>
		     ';
			return $header;
		}
		
		private function header2() {
			$header= '
			    <page_header>
					<div style="height: 5%; width: 100%; border: 0px solid #ccc; margin: 0px 0px 0px 0px; padding: 0px 0px 0px 4px;">
		
					</div>
			    </page_header>
		     ';
			return $header;
		}
		
		private function footer() {
			$footer = '
				<page_footer>
			        <div style="height: 16%; width: 100%; border: 0px solid #ccc; margin: 0px; font-size:12px;">
						<div style="text-align: justify;">'.utf8_encode('							
							El presente anexo hace constar que contrariamente a la cláusula primera del contrato de Responsabilidad Civil Extra-Contractual de daños por
							Vehículos (R.C.V.), LA COBERTURA EXTRATERRITORIAL se extiende hasta el DEPARTANEMTO NORTE DE SANTANDER Y DEPARTAMENTO DE ARAUCA DE LA REPÚBLICA
							DE COLOMBIA, área donde es permitido el libre transito de vehículos con Matricula Venezolana, establecida según disposiciones del Gobierno Colombiano.							  
						').
						'</div>
						<br>
						<div style="text-align: center;">'.utf8_encode('							
							<strong>Oficina:</strong> Av. Sur 4, Entre Esq.	Angelito a Quebrados, Parcela 034, Nro. S/N San Juan, Z.P. 1010, Caracas<br>
							Telfs.: (0212) 481.94.07 - (0212) 416.29.22 						  
						').
						'</div>
					</div> 
			    </page_footer>
			';
			return $footer;
		}
		
		private function footer2() {
			$footer = '
				<page_footer>
			        <div style="height: 0%; width: 100%; border: 0px solid #ccc; margin: 0px; font-size:12px;">
						
					</div>
			    </page_footer>
			';
			return $footer;
		}
		
		public function pdfReport() {
			$content ='
			<div style="height: 98.9%; width: 100%; border: 1px solid #ccc; margin: 0px;">
			Page Content
			</div>';
			$this->doPDF($content, 'pdf');
		}
		
		public function doPDF($content, $pdf_name) {
			//ob_start();
			echo '
				<page backleft="0mm" backtop="65mm" backright="0mm" backbottom="27mm">'
            			.$this->header()
            			.$this->footer()
            			.$content.'
            	</page>
			';
				
			$this->getLibrary('html2pdf/html2pdf.class');
			$this->_pdf = new HTML2PDF(SHEET_ORIENTATION,SIZE_PAPER,LANGUAJE_PDF,TRUE,CHARSET_PDF);
			$this->_pdf->writeHTML(ob_get_clean());
				
			$this->_pdf->Output($pdf_name.'.pdf'); // mostrar agregandole la extenciÃ³n .pdf
			//$pdf->Output('ejemplo.pdf', 'D');  //forzar descarga
		}
		
		public function doPDF2($content, $pdf_name) {
			//ob_start();
			echo '
				<page backleft="0mm" backtop="32mm" backright="0mm" backbottom="0mm">'
					.$this->header2()
					.$this->footer2()
					.$content.'<div style="margin:130px 0px"></div>'.$content.'
            	</page>
			';
		
			$this->getLibrary('html2pdf/html2pdf.class');
			$this->_pdf = new HTML2PDF(SHEET_ORIENTATION,'Letter',LANGUAJE_PDF,TRUE,CHARSET_PDF);
			$this->_pdf->writeHTML(ob_get_clean());
		
			$this->_pdf->Output($pdf_name.'.pdf'); // mostrar agregandole la extenciÃ³n .pdf
			//$pdf->Output('ejemplo.pdf', 'D');  //forzar descarga
		}
		
		public function facturaPdf() {
				
			$model 	= $this->loadModel('adviser');
			$data 	= $model->getContrato(Session::get('lastContrato'), '2');			
			$telf 	= $model->getTelefonos(Session::get('lastTitular'));
			$correo = $model->getCorreos(Session::get('lastTitular'));
			$fecha	= $model->getFecha();
			$hora	= $model->getHora();
			$fp 	= $model->formaPago(Session::get('tipoPago')); 
		
			//App::varDump($data);
				
			$factura = '
				<style type="text/css">				
					.tg  {border-collapse:collapse;border-spacing:0; style="width: 100%;"}
					.tg td{font-family:Arial, sans-serif;font-size:12px;padding:5px 0px 5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:0px;border-bottom-width:px;}
					.tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 0px 5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:0px;border-bottom-width:px;}
						
					.tg2  {border-collapse:collapse;border-spacing:0; width: 100%;}
					.tg2 td{font-family:Arial, sans-serif;font-size:12px;padding:5px 0px 5px 5px;border-style:solid;border-width:0px;}
					.tg2 th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}

					.tg3  {border-collapse:collapse;border-spacing:0;border:none;}
					.tg3 td{font-family:Arial, sans-serif;font-size:12px;padding:2px 2px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;text-align:center;}
					.tg3 th{font-family:Arial, sans-serif;font-size:12px;font-weight:bold;padding:2px 2px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;text-align:center;}
					
					h1,h2,h3,h4,h5{text-align: center; margin-bottom: 10px;}
					.p1{font-family:Arial, sans-serif; font-size:12px; margin-top: 10px;}
					.box{border-style:solid;border-width:1px; margin-top: 2px;}
					.head-table{font-weight: bold; margin-top: 8px; color: #404040}
					.tab{padding: 4px -25px 4px 20px !important; font-family:Arial, sans-serif; font-size:10px; color: #cccc }
					.tab2{padding: 4px 15px 4px -15px !important; font-family:Arial, sans-serif; font-size:10px; color: #cccc; text-align: right; }
					.pie{ padding: 6px 5px 6px 0px; font-size:12px;}
					.left-text{padding-left: 535px;}
										
				</style>

				<table class="tg">
				  <tr>
				    <td style="width: 50%;">
						<strong>OFICINA:</strong> '.Session::get('nombre_ag').'
					</td>
				    <td style="width: 50%; text-align: right;">
						<strong>RECIBO No.</strong> '.Session::get('identificador').'-'.$data['id'].'&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>FECHA:</strong> '.$fecha.'
					</td>
				  </tr>
				</table>
				
				<div class="box">  			
					<table class="tg2">				  
					  <tr>
					    <td style="width: 50%;"><strong>'.utf8_encode('CLIENTE:').'</strong> '.$data['nombres'].', '.$data['apellidos'].'</td>
					    <td style="width: 50%;"><strong>'.utf8_encode('TELÉFONOS:').'</strong> '.$telf.'</td>
					  </tr>					  
					  <tr>
					    <td><strong>RIF/C.I.</strong>&nbsp;&nbsp;'.$data['dni'].'</td>					    
					    <td style="width: 50%;"><strong>'.utf8_encode('E-MAIL:').'</strong> '.$correo.'</td>
					  </tr>
					  <tr>
					    <td colspan="2"><strong>'.utf8_encode('DIRECCIÓN:').'</strong> '.$data['direccion'].', '.$data['estado'].', '.$data['municipio'].', '.$data['parroquia'].'</td>					   
					  </tr>
					</table>
				</div>
				<br>
				<div class="box">
					<table class="tg3">
					  <tr>
					    <th style="width: 15%; border-bottom:1px solid;">'.utf8_encode('CANTIDAD').'</th>
					    <th style="width: 30%; border-bottom:1px solid;">'.utf8_encode('DESCRIPCIÓN O CONCEPTO').'</th>
					    <th style="width: 15%; border-bottom:1px solid;">'.utf8_encode('No. CONTRATO').'</th>
					    <th style="width: 15%; border-bottom:1px solid;"></th>
					    <th style="width: 5%; border-bottom:1px solid;"></th>
					    <th style="width: 20%; border-bottom:1px solid;">'.utf8_encode('TOTAL').'</th>
					  </tr>
					  <tr>
					    <td>'.utf8_encode('1').'</td>
					    <td>'.utf8_encode('PAGO DE CONTRATO R.C.V.').'</td>
					    <td>'.$data['id'].'</td>
					    <td></td>
					    <td style="text-align:right;">Bs.F</td>
					    <td style="text-align:right; padding-right:20px;">'.number_format( $data['precio'],2,",","." ).'</td>
					  </tr>
					  <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					  </tr>
					  <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					  </tr>
					  <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td>Sub-Total:</td>
					    <td style="text-align:right;">Bs.F</td>
					    <td style="text-align:right; padding-right:20px;">'.number_format( $data['precio'],2,",","." ).'</td>
					  </tr>
					  <tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td>Total a Pagar:</td>
					    <td style="text-align:right;">Bs.F</td>
					    <td style="text-align:right; padding-right:20px;"><strong>'.number_format( $data['precio'],2,",","." ).'</strong></td>
					  </tr>
					</table>
				</div>
				<div class="pie">'.utf8_encode('ESTE RECIBO DE PAGO VA SIN TACHADURAS NI ENMIENDAS').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Asesor:</strong> '.Session::get('name').' '.Session::get('last_name').'</div>
				<div class="pie">'.utf8_encode('Forma de pago: ').$fp.'</div>	
				<div class="pie">'.utf8_encode('RECIBO CONFORME: ______________________________________').'</div>
			
			';
				
			$this->doPDF2($factura, 'Factura');
				
		}
		
		public function contratoPdf() {
			
			$model 	= $this->loadModel('adviser');
			$data 	= $model->getContrato(Session::get('lastContrato'));
			//$data 	= $model->getContrato('1');
			$telf 	= $model->getTelefonos(Session::get('lastTitular'));			
			$correo = $model->getCorreos(Session::get('lastTitular'));
			$fecha	= $model->getFecha();
			$hora	= $model->getHora();
						
			//App::varDump($data);
			
			$contrato = '
			
				<style type="text/css">				
					.tg  {border-collapse:collapse;border-spacing:0; style="width: 100%;"}
					.tg td{font-family:Arial, sans-serif;font-size:12px;padding:5px 0px 5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:0px;border-bottom-width:px;}
					.tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 0px 5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:0px;border-bottom-width:px;}
						
					.tg2  {border-collapse:collapse;border-spacing:0; width: 100%;}
					.tg2 td{font-family:Arial, sans-serif;font-size:12px;padding:5px 0px 5px 5px;border-style:solid;border-width:0px;}
					.tg2 th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
										
					.tg3  {border-collapse:collapse;border-spacing:0;}
					.tg3 td{font-family:Arial, sans-serif;font-size:12px;padding:4px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
					.tg3 th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
					
					.tg4  {border-collapse:collapse;border-spacing:0;border:none;}
					.tg4 td{font-family:Arial, sans-serif;font-size:12px;padding:5px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
					.tg4 th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
					
					.tg5  {border-collapse:collapse;border-spacing:0;border:none;}
					.tg5 td{font-family:Arial, sans-serif;font-size:12px;padding:4px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
					.tg5 th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
										
					h1,h2,h3,h4,h5{text-align: center; margin-bottom: 10px;}
					.p1{font-family:Arial, sans-serif; font-size:12px; margin-top: 10px;}
					.box{border-style:solid;border-width:1px; margin-top: 2px;}
					.head-table{font-weight: bold; margin-top: 8px; color: #404040}
					.tab{padding: 4px -25px 4px 20px !important; font-family:Arial, sans-serif; font-size:10px; color: #cccc }
					.tab2{padding: 4px 15px 4px -15px !important; font-family:Arial, sans-serif; font-size:10px; color: #cccc; text-align: right; }
					#hora{text-align: right; padding: 6px 5px 6px 0px; font-size:12px;}
					.left-text{padding-left: 535px;}
										
				</style>
	
				
				<h4><strong>'.utf8_encode('CONTRATO DE RESPONSABILIDAD CIVIL EXTRACONTRACTUAL <br> DE DAÑOS POR VEHICULOS (R.C.V)').'</strong></h4>
				
				<div><strong>'.utf8_encode('Partes').'</strong></div>
				<p class="p1">'.utf8_encode('<strong>LA COMPAÑIA:</strong> Inversora Internacional de Compromiso M&M C.A. /<strong>R.I.F. J-29810090-7</strong> inscrita por ante la oficina de Registro Mercantil Cuarto de la Circunscripción Judicial del Distrito Capital, en fecha 31 de Agosto del año 2009, bajo el N° 25, Tomo 129 - A Cto.').'</p>
				
				<table class="tg">
				  <tr>
				    <td style="width: 50%;">
						<strong>OFICINA:</strong> '.Session::get('nombre_ag').'
					</td>
				    <td style="width: 50%; text-align: right;">
						<strong>COD. CONTRATO:</strong> '.Session::get('identificador').'-'.$data['id'].'
					</td>
				  </tr>
				</table>
					    		
					
				<div class="head-table">'.utf8_encode('DATOS DEL CLIENTE').'</div>
				<div class="box">  			
				<table class="tg2">
				  
				  <tr>
				    <td style="width: 50%;"><strong>'.utf8_encode('EL AFILIADO:').'</strong> '.$data['nombres'].', '.$data['apellidos'].'</td>
				    <td><strong>RIF/C.I.</strong>&nbsp;&nbsp;'.$data['dni'].'</td>
				  </tr>
				  <tr>
				    <td colspan="2"><strong>'.utf8_encode('DIRECCIÓN:').'</strong> '.$data['direccion'].', '.$data['estado'].', '.$data['municipio'].', '.$data['parroquia'].'</td>
				   
				  </tr>
				  <tr>
				    <td style="width: 50%;"><strong>'.utf8_encode('E-MAIL:').'</strong> '.$correo.'</td>
				    <td style="width: 50%;"><strong>'.utf8_encode('TELÉFONOS:').'</strong> '.$telf.'</td>
				  </tr>
				</table>
				</div>
				    		
				<div class="head-table">'.utf8_encode('DATOS DEL CONTRATO').'</div>
				<div class="box">  			
				<table class="tg3">
				  <tr>
				    <td style="width: 35%;"><strong>'.utf8_encode('VIGENCIA DEL CONTRATO').'</strong></td>
				    <td style="width: 35%;"><strong>'.utf8_encode('DESDE:').'</strong> '.App::showDate($data['fecha_exp']).', '.$data['hora_exp'].'</td>
				    <td style="width: 30%;"><strong>'.utf8_encode('HASTA:').'</strong> '.App::showDate($data['fecha_ven']).', '.$data['hora_ven'].'</td>
				  </tr>
				  <tr>
				    <td style="width: 35%;"><strong>'.utf8_encode('MONTO DE LA AFILIACIÓN R.C.V. Bs.F.').'</strong></td>
				    <td style="width: 35%;">'.number_format( $data['precio'],2,",","." ).'</td>
				    <td style="width: 30%;"><strong>'.utf8_encode('TOTAL: ').'</strong> Bs.F '.number_format( $data['precio'],2,",","." ).'</td>
				  </tr>
				</table>
				</div>

				<div class="head-table">'.utf8_encode('DATOS DEL VEHÍCULO').'</div>
				<div class="box"> 
				<table class="tg4">
				  <tr>
				    <td style="width: 10%;"><strong>'.utf8_encode('MARCA:').'</strong></td>
				    <td style="width: 40%;">'.$data['marca'].'</td>
				    <td style="width: 10%;"><strong>'.utf8_encode('MODELO:').'</strong></td>
				    <td style="width: 40%;">'.$data['modelo'].'</td>
				  </tr>
				  <tr>
				    <td><strong>'.utf8_encode('CLASE:').'</strong></td>
				    <td>'.$data['claseVehiculo'].'</td>
				    <td><strong>'.utf8_encode('TIPO:').'</strong></td>
				    <td>'.$data['tipoVehiculo'].'</td>
				  </tr>
				  <tr>
				    <td><strong>'.utf8_encode('COLOR:').'</strong></td>
				    <td>'.$data['color'].'</td>
				    <td><strong>'.utf8_encode('USO:').'</strong></td>
				    <td>'.$data['usoVehiculo'].'</td>
				  </tr>
				  <tr>
				    <td><strong>'.utf8_encode('S./CARROC:').'</strong></td>
				    <td>'.$data['serial_c'].'</td>
				    <td><strong>'.utf8_encode('S./MOTOR:').'</strong></td>
				    <td>'.$data['serial_m'].'</td>
				  </tr>
				  <tr>
				    <td><strong>'.utf8_encode('PLACA:').'</strong></td>
				    <td>'.$data['placa'].'</td>
				    <td><strong>'.utf8_encode('AÑO:').'</strong></td>
				    <td>'.$data['anio'].'</td>
				  </tr>
				  <tr>
				    <td><strong>'.utf8_encode('PUESTOS:').'</strong></td>
				    <td>'.$data['numPuesto'].'</td>
				    <td><strong>'.utf8_encode('PESO:').'</strong></td>
				    <td>'.$data['peso'].'</td>
				  </tr>
				</table>
				</div>

				<div class="head-table">'.utf8_encode('CONCEPTO').' <div class="left-text">'.utf8_encode('APORTES MAXIMOS Bs.F.').'</div></div>
				<div class="box"  style="padding-bottom: 5px;"> 
				<table class="tg5">
				  <tr>
				    <td colspan="2"><strong>'.utf8_encode('Daños a Personas Víctimas del Accidente de Tránsito').'</strong></td>
				  </tr>
				  <tr>
				    <td class="tab" style="width: 90%;">'.utf8_encode('GASTOS MEDICOS .....................................................................................................................................................................................................................').'</td>
				    <td class="tab2" style="width: 10%;">'.number_format( $data['gastosMedicos1'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab">'.utf8_encode('INVALIDEZ ....................................................................................................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['invalidez1'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab" >'.utf8_encode('MUERTE .......................................................................................................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['muerte1'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td colspan="2"><strong>'.utf8_encode('Daños a Personas Ocupantes del Vehículo Antes Descrito:').'</strong></td>
				  </tr>
				  <tr>
				    <td class="tab" style="width: 90%;">'.utf8_encode('GASTOS MEDICOS .....................................................................................................................................................................................................................').'</td>
				    <td class="tab2" style="width: 10%;">'.number_format( $data['gastosMedicos2'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab">'.utf8_encode('INVALIDEZ ....................................................................................................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['invalidez2'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab" >'.utf8_encode('MUERTE .......................................................................................................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['muerte2'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td colspan="2"><strong>'.utf8_encode('Otros').'</strong></td>
				  </tr>
				  <tr>
				    <td class="tab">'.utf8_encode('DAÑOS A LA PROPIEDAD ..........................................................................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['daniosPropiedad'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab" >'.utf8_encode('GRUA <i>(Solo procede en caso de choque)</i> ...................................................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['grua'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab">'.utf8_encode('ESTACIONAMIENTO <i>(Solo procede en caso de choque)</i> ...........................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['estacionamiento'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab" >'.utf8_encode('INDEMNIZACIÓN SEMANAL <i>(MAXIMO 3 SEMANAS)</i> ...............................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['indemnizacionSem'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab">'.utf8_encode('ASISTENCIA LEGAL ...................................................................................................................................................................................................................').'</td>
				    <td class="tab2">'.number_format( $data['asistenciaLegal'] ,2,",",".").'</td>
				  </tr>
				  <tr>
				    <td class="tab">'.utf8_encode('<strong>TOTAL APORTE</strong> .........................................................................................................................................................................................................................').'</td>
				    <td class="tab2" style="border-top: 1px solid;"><strong>'.number_format( $data['cobertura'] ,2,",",".").'</strong></td>
				  </tr>
				</table>
				</div>
					<div id="hora">'
						.utf8_encode('Fecha y Hora de Impresión: ').$fecha.' --- '.$hora.' 
					</div>
			';
			
			$this->doPDF($contrato, 'Contrato');
			
			
		}
		
		public function carnetPdf() {
			
			$model 	= $this->loadModel('adviser');
			$data 	= $model->getContrato(Session::get('lastContrato'), '2');
			$telf 	= $model->getTelefonos(Session::get('lastTitular'));			
			$correo = $model->getCorreos(Session::get('lastTitular'));
			$fecha	= $model->getFecha();
			$hora	= $model->getHora();
			
			$header= '
			    <page_header>
					<div style="height: 0%; width: 100%; border: 0px solid #ccc; margin: 0px 0px 0px 0px; padding: 0px 0px 0px 4px;">
					</div>
			    </page_header>
		     ';
			
			$content ='
				<link href="'.PUBLIC_URL.'css/report.css" rel="stylesheet" type="text/css">
						
				<div style="height: 99.8%; width: 100%; border: 0px solid #ccc; margin: 0px;">
					<table>
					  <tr>
					    <th>
							<div class="box">		
								<table class="tg_carnet">
								  <tr>
								    <th class="boxLogo"><img src="'.PUBLIC_URL.'img/logo.png" class="logo1"></th>
								    <th class="boxLogo2" colspan="3">
								    		<img src="'.PUBLIC_URL.'img/M&M2.jpg" class="logo2"><br>
								    		<p class="">INTERNACIONAL DE COMPROMISO M&M c.a. <br> <span class="rif">RIF. J-29810090-7</span></p>
								    </th>
								  </tr>
								  <tr>
								    <td colspan="4" class="title">
								    	<strong>'.utf8_encode('RESPONSABILIDAD CIVIL DE VEHÍCULOS (R.C.V.)').'</strong>
								    	<br>'.utf8_encode('COD. CARNET: <strong>').Session::get('identificador').'-'.$data['id'].'</strong>
								    </td>
								  </tr>
								  <tr>
								    <td colspan="2">
								    	<strong>'.utf8_encode('VIGENCIA DESDE:').'</strong> '.App::showDate($data['fecha_exp']).'
								    </td>
								    <td colspan="2">
								    	<strong>'.utf8_encode('HASTA:').'</strong> '.App::showDate($data['fecha_ven']).'
								    </td>					    
								  </tr>
								  <tr>
								    <td colspan="3"><strong>'.utf8_encode('AFILIADO:').'</strong> '.$data['nombres'].', '.$data['apellidos'].'</td>
								    <td><strong>RIF/C.I.</strong>&nbsp;&nbsp;'.$data['dni'].'</td>
								  </tr>
								  <tr>
								    <td colspan="4"><strong>'.utf8_encode('DIRECCIÓN:').'</strong> '.$data['direccion'].',<br>'.$data['estado'].', '.$data['municipio'].', '.$data['parroquia'].'</td>
								  </tr>
								  <tr>
								    <td class="txt1"><strong>'.utf8_encode('MARCA:').'</strong></td>
								    <td>'.$data['marca'].'</td>
								    <td class="txt1"><strong>'.utf8_encode('MODELO:').'</strong></td>
								    <td>'.$data['modelo'].'</td>
								  </tr>
								  <tr>
								    <td class="txt1"><strong>'.utf8_encode('CLASE:').'</strong></td>
								    <td>'.$data['claseVehiculo'].'</td>
								    <td class="txt1"><strong>'.utf8_encode('TIPO:').'</strong></td>
								    <td>'.$data['tipoVehiculo'].'</td>
								  </tr>
								  <tr>
								    <td class="txt1"><strong>'.utf8_encode('COLOR:').'</strong></td>
								    <td>'.$data['color'].'</td>
								    <td class="txt1"><strong>'.utf8_encode('USO:').'</strong></td>
								    <td>'.$data['usoVehiculo'].'</td>
								  </tr>
								  <tr>
								    <td class="txt1"><strong>'.utf8_encode('S./CARROC:').'</strong></td>
								    <td>'.$data['serial_c'].'</td>
								    <td class="txt1"><strong>'.utf8_encode('S./MOTOR:').'</strong></td>
								    <td>'.$data['serial_m'].'</td>
								  </tr>
								  <tr>
								    <td class="txt1"><strong>'.utf8_encode('PLACA:').'</strong></td>
								    <td>'.$data['placa'].'</td>
								    <td class="txt1"><strong>'.utf8_encode('AÑO:').'</strong></td>
								    <td>'.$data['anio'].'</td>
								  </tr>
								  <tr>
								    <td class="txt1"><strong>'.utf8_encode('PUESTOS:').'</strong></td>
								    <td>'.$data['numPuesto'].'</td>
								    <td class="txt1"><strong>'.utf8_encode('PESO:').'</strong></td>
								    <td>'.$data['peso'].'</td>
								  </tr>
								  <tr>
								    <td colspan="4" class="tg_footer">'.utf8_encode('ESTE CARNET ES VALIDO SI PRESENTA EL SELLO DE LA COMPAÑIA Y FIRMA AUTORIZADA').'</td>
								  </tr>
								</table>
							</div>
						</th>
								    		
					    <th>
							<div class="box">		
								<table class="tg_carnet">
								  <tr>
								    <th></th>
								    <th></th>
								    <th></th>
								    <th></th>
								  </tr>
								  <tr>
								    <td colspan="4" class="titleBack">
								    	<strong>'.utf8_encode('RESPONSABILIDAD CIVIL DE VEHÍCULOS (R.C.V.)').'</strong>								    	
								    </td>
								  </tr>
								  <tr>
								    <td colspan="4" class="borde-none">
								    	<div class="txt2"><br>
								    		MONTO DE LA AFILIACION RCV <strong>Bs.F '.number_format( $data['precio'],2,",","." ).'</strong><br>
								    		COBERTURA <strong>Bs.F '.number_format( $data['cobertura'] ,2,",",".").'</strong>
								    		SEGUN CONTRATO: <strong>'.Session::get('identificador').'-'.$data['id'].'</strong><br><br>
								    		<strong>'.utf8_encode('
								    			Daños a Personas Víctimas de Accidente de Tránsito. 
								    			Daños a Personas Ocupantes del Vehículo. 
								    			Daños a Propiedad. 
								    			Grúa y Estacionamiento (<i>Solo Procederá en Caso de Choque</i>). 
								    			Indemnización Semanal (<i>Máximo 3 Semanas</i>). 
								    			Asistencia Legal.
								    		').'</strong>
								    	</div>								    	
								    </td>
								  </tr>
								   
								  <tr>
								    <td colspan="2" class="txt3">___________________________</td>
								    <td colspan="2" class="txt3">___________________________</td>
								  </tr>
								  
								  <tr>
								    <td colspan="2" class="txt3">'.utf8_encode('POR LA COMPAÑIA').'</td>
								    <td colspan="2" class="txt3">'.utf8_encode('AFILIADO').'</td>
								  </tr>
								  
								  <tr>
								    <td colspan="2" class="txt3"></td>
								    <td colspan="2" class="txt3"></td>
								  </tr>
								  
								  <tr>
								    <td colspan="4" class="tg_footer">'.utf8_encode('							
											<strong>Oficina:</strong> Av. Sur 4, Entre Esq.	Angelito a Quebrados, Parcela 034, Nro. S/N San Juan, Z.P. 1010, Caracas<br>
											Telfs.: (0212) 481.94.07 - (0212) 416.29.22 						  
										').'</td>
								  </tr>
								</table>
							</div>
						</th>
								    		
					  </tr>
					</table>
						
						
						
						    		
				</div>
			';
			
			$footer = '
				<page_footer>
			        <div style="height: 0%; width: 100%; border: 0px solid #ccc; margin: 0px; font-size:12px;">
					</div>
			    </page_footer>
			';
			
			//ob_start();
			echo '
				<page backleft="0mm" backtop="0mm" backright="0mm" backbottom="0mm">'
					.$header
					.$footer
					.$content.'
            	</page>
			';
			
			$this->getLibrary('html2pdf/html2pdf.class');
			$this->_pdf = new HTML2PDF(SHEET_ORIENTATION,'Letter',LANGUAJE_PDF,TRUE,CHARSET_PDF);
			$this->_pdf->writeHTML(ob_get_clean());
			
			$this->_pdf->Output('carnet'.'.pdf'); // mostrar agregandole la extenciÃ³n .pdf
			//$pdf->Output('ejemplo.pdf', 'D');  //forzar descarga
			
			
		}
	}
?>
