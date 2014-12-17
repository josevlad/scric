<?php
	class adviserModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}
		
		public function getPrecioData( $cobertura_id, $numPuesto_id ) {
			
			$this->_query = 'SELECT id,precio FROM precio 
					WHERE 
						cobertura_id = '.$cobertura_id.' 
					AND 
						numPuesto_id = '.$numPuesto_id;
			
			$data = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
							
			return $result;
		}
		
		public function saveFormato($parameters, $table) {
			
			$tables = array(
				'1' => 'planillas(codigo, fecha_reg, agencias_id, statusFormat_id) VALUES (:codigo, :fecha_reg, :agencias_id, :statusFormat_id)',
				'2' => 'facturas(codigo, fecha_reg, statusFormat_id, agencias_id) VALUES (:codigo, :fecha_reg, :statusFormat_id, :agencias_id)'
				
			);
			
			if (!array_key_exists($table, $tables)) {
				throw new Exception('Tipo de Solicitud no existente (saveFormato - adviserModel )', $code, $previous);
				exit();
			}
			
			$this->_query = 'INSERT INTO '.$tables[$table];
				
			try {
				$this->_db->beginTransaction();
				$this->_db->prepare($this->_query)->execute($parameters);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
				
			return true;
			
		}
		
		public function getPlanilla() {
			$this->_query = 'SELECT id,codigo FROM planillas WHERE statusFormat_id =  "1" AND agencias_id = "'.Session::get('idAgencia').'" LIMIT 0 , 1';
			$data = $this->_db->query($this->_query);
			
			try {
				$this->_db->beginTransaction();
					$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
			
			return $result;
		}
		
		public function getPlanillas() {
			$this->_query = 'SELECT id,codigo FROM planillas WHERE statusFormat_id =  "1" AND agencias_id = "'.Session::get('idAgencia').'"';
			$data = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
				
			return $result;
		}
		
		public function getFactura() {
			$this->_query = 'SELECT id,codigo FROM facturas WHERE statusFormat_id =  "1" AND agencias_id = "'.Session::get('idAgencia').'" LIMIT 0 , 1';
			$data = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
				
			return $result;
		}
		
		public function getFacturas() {
			$this->_query = 'SELECT id,codigo FROM facturas WHERE statusFormat_id =  "1" AND agencias_id = "'.Session::get('idAgencia').'"';
			$data = $this->_db->query($this->_query);
		
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		
			return $result;
		}
		
		public function saveContract($dataContract) {
			
			$data = $dataContract;
			Session::set('data', $dataContract);
						
			$titular 	= array_shift($data);
			$telefonos 	= array_shift($data);
			$correos 	= array_shift($data);
			$contrato 	= array_shift($data);
			$planilla = $this->getPlanilla();

			Session::set('print',true);
			
			Session::set('assignedFormat', $planilla[0]['codigo']);
			$contrato[':planillas_id'] = $planilla[0]['id']; 
			
			Session::set('tipoPago', $contrato[':tipoPago']);
			
			//$tipoPago = $contrato[':tipoPago']; //convertirla a variable se session para la impresion de factura
			unset($contrato[':tipoPago']);
			
			$this->_db->beginTransaction();
			
			try {
				
			// tabla titular =========================================
			
				$this->_query = '
					INSERT INTO 
						titulares(	
							tipoPersona_id,		dni,				
							nombres,			apellidos,
							parroquia_id,		direccion
						) VALUES (
							:tipoPersona_id,	:dni,				
							:nombres,			:apellidos,
							:parroquia_id,		:direccion
					)';
				
				$result = $this->_db->prepare($this->_query);
				foreach( $titular as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
				$lastTitular = $this->_db->lastInsertId('titulares');
			// end tabla personas ==========================================
			
			// tabla contratos ==========================================
				$contrato[':titulares_id'] = $lastTitular;
				
				//print_r($contrato);
				//exit();
				
				$this->_query = '
					INSERT INTO 
						contratos(
							modelo_id,			tipoTrans_id,	
							anio,				color,
							placa,				serial_c,
							serial_m,			precio_id,
							usoVehiculo_id,		peso,
							fecha_exp,			hora_exp,
							fecha_ven,			hora_ven,
							statusCont_id,		planillas_id,
							titulares_id					
						) VALUES (
							:modelo_id,			:tipoTrans_id,	
							:anio,				:color,
							:placa,				:serial_c,
							:serial_m,			:precio_id,
							:usoVehiculo_id,	:peso,
							:fecha_exp,			:hora_exp,
							:fecha_ven,			:hora_ven,
							:statusCont_id,		:planillas_id,
							:titulares_id				
					)';
				
				$result = $this->_db->prepare($this->_query);
				foreach( $contrato as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
				$lastContrato = $this->_db->lastInsertId('contratos');
			
			// end tabla contratos ==========================================
			
			// tabla telefonos array =======================================
				$this->_query = '
					INSERT INTO 
						telefonos(
							tipoTelf_id, 	numTelf, 	titulares_id
						) VALUES (
							:tipoTelf_id, 	:numTelf, 	:titulares_id 
					)';
				
				$result = $this->_db->prepare($this->_query);
				
				$i = 1;
				while ($i < count($telefonos)):
					$result->bindValue(':tipoTelf_id', 	$telefonos[$i], 	PDO::PARAM_INT);
					$result->bindValue(':numTelf', 		$telefonos[$i+1], 	PDO::PARAM_STR);
					$result->bindValue(':titulares_id', $lastTitular, 		PDO::PARAM_INT);
					$result->execute();				
					$i++;
					$i++;
				endwhile;
				
			// end tabla telefonos array =======================================

			// tabla correos array =======================================
				$this->_query = '
					INSERT INTO 
						correos(
							correo, 	titulares_id
						) VALUES (
							:correo, 	:titulares_id
					)';
				
				$result = $this->_db->prepare($this->_query);
				
				
				for ($i = 0; $i < count($correos); $i++) {
					$result->bindValue(':correo', 		$correos[$i], PDO::PARAM_STR);
					$result->bindValue(':titulares_id', $lastTitular, PDO::PARAM_INT);
					$result->execute();
				}
			// tabla correos array =======================================
			
			//cambio de estatus planilla =======================================
			
				$this->_query = 'UPDATE planillas SET statusFormat_id = "2" WHERE id = '.$planilla[0]['id'];				
				$this->_db->prepare($this->_query)->execute();				
				
			//cambio de estatus planilla =======================================

				Session::set('lastTitular', $lastTitular);
				Session::set('lastContrato', $lastContrato);
				
				
				$this->_db->commit();
				return true;
				
			} catch (PDOException $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function updateContract($dataContract) {
			
			$data = $dataContract;
			Session::destroy('data');
			Session::set('data', $dataContract);
		
			$titular 	= array_shift($data);
			$telefonos 	= array_shift($data);
			$correos 	= array_shift($data);
			$contrato 	= array_shift($data);
			$planilla = $this->getPlanilla();
			//App::varDump($dataContract);
			//exit();
			Session::destroy('assignedFormat');
			
			Session::set('assignedFormat', $planilla[0]['codigo']);
			$contrato[':planillas_id'] = $planilla[0]['id'];
				
			Session::set('tipoPago', $contrato[':tipoPago']);
			unset($contrato[':tipoPago']);
				
			$this->_db->beginTransaction();
				
			try {
		
				// tabla titular =========================================
					
				$this->_query = '
					UPDATE 
						titulares 
					SET 
						dni				=	:dni,
						nombres			=	:nombres,
						apellidos		=	:apellidos,
						direccion		=	:direccion,
						tipoPersona_id	=	:tipoPersona_id,
						parroquia_id	=	:parroquia_id 
					WHERE 
						titulares.id ='.Session::get('lastTitular');
		
				$result = $this->_db->prepare($this->_query);
				foreach( $titular as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
				$lastTitular = Session::get('lastTitular');
				// end tabla personas ==========================================
					
				// tabla contratos ==========================================
				$contrato[':titulares_id'] = $lastTitular;
		
				//print_r($contrato);
				//exit();
		
				$this->_query = '
					INSERT INTO
						contratos(
							modelo_id,			tipoTrans_id,
							anio,				color,
							placa,				serial_c,
							serial_m,			precio_id,
							usoVehiculo_id,		peso,
							fecha_exp,			hora_exp,
							fecha_ven,			hora_ven,
							statusCont_id,		planillas_id,
							titulares_id
						) VALUES (
							:modelo_id,			:tipoTrans_id,
							:anio,				:color,
							:placa,				:serial_c,
							:serial_m,			:precio_id,
							:usoVehiculo_id,	:peso,
							:fecha_exp,			:hora_exp,
							:fecha_ven,			:hora_ven,
							:statusCont_id,		:planillas_id,
							:titulares_id
					)';
		
				$result = $this->_db->prepare($this->_query);
				foreach( $contrato as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
				$lastContrato = $this->_db->lastInsertId('contratos');
					
				// end tabla contratos ==========================================
				
				// Delete Telf ==========================================
				$this->_query = '
						DELETE FROM 
							telefonos 
						WHERE 
							titulares_id ='.$lastTitular;
					
				$this->_db->prepare($this->_query)->execute();
				
				// Delete Telf ==========================================
				
				// tabla telefonos array =======================================
				$this->_query = '
					INSERT INTO
						telefonos(
							tipoTelf_id, 	numTelf, 	titulares_id
						) VALUES (
							:tipoTelf_id, 	:numTelf, 	:titulares_id
					)';
		
				$result = $this->_db->prepare($this->_query);
		
				$i = 1;
				while ($i < count($telefonos)):
					$result->bindValue(':tipoTelf_id', 	$telefonos[$i], 	PDO::PARAM_INT);
					$result->bindValue(':numTelf', 		$telefonos[$i+1], 	PDO::PARAM_STR);
					$result->bindValue(':titulares_id', $lastTitular, 		PDO::PARAM_INT);
					$result->execute();
					$i++;
					$i++;
				endwhile;
		
				// end tabla telefonos array =======================================
				
				// Delete Telf ==========================================
				$this->_query = '
						DELETE FROM 
							correos 
						WHERE 
							titulares_id ='.$lastTitular;
					
				$this->_db->prepare($this->_query)->execute();
				
				// Delete Telf ==========================================
				
				// tabla correos array =======================================
				$this->_query = '
					INSERT INTO
						correos(
							correo, 	titulares_id
						) VALUES (
							:correo, 	:titulares_id
					)';
		
				$result = $this->_db->prepare($this->_query);
		
		
				for ($i = 0; $i < count($correos); $i++) {
					$result->bindValue(':correo', 		$correos[$i], PDO::PARAM_STR);
					$result->bindValue(':titulares_id', $lastTitular, PDO::PARAM_INT);
					$result->execute();
				}
				// tabla correos array =======================================
					
				//cambio de estatus planilla =======================================
					
				$this->_query = 'UPDATE planillas SET statusFormat_id = "2" WHERE id = '.$planilla[0]['id'];
				$this->_db->prepare($this->_query)->execute();
		
				//cambio de estatus planilla =======================================
				
				$this->_query = '
					UPDATE
						contratos
					SET
						statusCont_id = 4
					WHERE
						contratos.id ='.Session::get('lastContrato');
				$this->_db->prepare($this->_query)->execute();
				
				//$this->updateStatusContrato('4',Session::get('lastContrato'));
				Session::destroy('lastContrato');
				Session::set('lastTitular', $lastTitular);
				Session::set('lastContrato', $lastContrato);
		
		
				$this->_db->commit();
				return true;
		
			} catch (PDOException $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function updateContract2($dataContract) {
			
			//App::varDump($dataContract);
			//exit();
			$data = $dataContract;
			Session::destroy('data');
			Session::set('data', $dataContract);
		
			$titular 	= array_shift($data);
			$telefonos 	= array_shift($data);
			$correos 	= array_shift($data);
			$contrato 	= array_shift($data);
			
			Session::set('tipoPago', $contrato[':tipoPago']);
			
			Session::set('tipoPago', $contrato[':tipoPago']);
			unset($contrato[':tipoPago']);
			unset($contrato[':statusCont_id']);
			
			//App::varDump($contrato);
			
			$this->_db->beginTransaction();
		
			try {
		
				// tabla titular =========================================
					
				$this->_query = '
					UPDATE
						titulares
					SET
						dni				=	:dni,
						nombres			=	:nombres,
						apellidos		=	:apellidos,
						direccion		=	:direccion,
						tipoPersona_id	=	:tipoPersona_id,
						parroquia_id	=	:parroquia_id
					WHERE
						titulares.id ='.Session::get('lastTitular');
		
				$result = $this->_db->prepare($this->_query);
				foreach( $titular as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
				$lastTitular = Session::get('lastTitular');
				// end tabla personas ==========================================
					
				// tabla contratos ==========================================
						
				//print_r($contrato);
				//exit();
				
				$this->_query = '
					UPDATE 
						contratos 
					SET 
						modelo_id 			= 	:modelo_id,
						tipoTrans_id		=	:tipoTrans_id,
						anio 				= 	:anio,
						color 				= 	:color,
						placa 				=	:placa,
						serial_c 			= 	:serial_c,
						serial_m 			= 	:serial_m,
						precio_id 			= 	:precio_id,
						usoVehiculo_id 		= 	:usoVehiculo_id,
						peso 				= 	:peso,
						fecha_exp 			= 	:fecha_exp,
						hora_exp 			= 	:hora_exp,
						fecha_ven 			= 	:fecha_ven,
						hora_ven 			= 	:hora_ven
					WHERE
						contratos.id ='.Session::get('lastContrato');
		
				$result = $this->_db->prepare($this->_query);
				foreach( $contrato as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
					
				// end tabla contratos ==========================================
		
				// Delete Telf ==========================================
				$this->_query = '
						DELETE FROM
							telefonos
						WHERE
							titulares_id ='.$lastTitular;
					
				$this->_db->prepare($this->_query)->execute();
		
				// Delete Telf ==========================================
		
				// tabla telefonos array =======================================
				$this->_query = '
					INSERT INTO
						telefonos(
							tipoTelf_id, 	numTelf, 	titulares_id
						) VALUES (
							:tipoTelf_id, 	:numTelf, 	:titulares_id
					)';
		
				$result = $this->_db->prepare($this->_query);
		
				$i = 1;
				while ($i < count($telefonos)):
					$result->bindValue(':tipoTelf_id', 	$telefonos[$i], 	PDO::PARAM_INT);
					$result->bindValue(':numTelf', 		$telefonos[$i+1], 	PDO::PARAM_STR);
					$result->bindValue(':titulares_id', $lastTitular, 		PDO::PARAM_INT);
					$result->execute();
					$i++;
					$i++;
				endwhile;
		
				// end tabla telefonos array =======================================
		
				// Delete Correos ==========================================
				$this->_query = '
						DELETE FROM
							correos
						WHERE
							titulares_id ='.$lastTitular;
					
				$this->_db->prepare($this->_query)->execute();
		
				// Delete Correos ==========================================
		
				// tabla correos array =======================================
				$this->_query = '
					INSERT INTO
						correos(
							correo, 	titulares_id
						) VALUES (
							:correo, 	:titulares_id
					)';
		
				$result = $this->_db->prepare($this->_query);
		
		
				for ($i = 0; $i < count($correos); $i++) {
					$result->bindValue(':correo', 		$correos[$i], PDO::PARAM_STR);
					$result->bindValue(':titulares_id', $lastTitular, PDO::PARAM_INT);
					$result->execute();
				}
				// tabla correos array =======================================
						
				$this->_db->commit();
				return true;
		
			} catch (PDOException $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function onlyContract($contrato) {

			Session::destroy('assignedFormat');
			
			$planilla = $this->getPlanilla();
			Session::set('assignedFormat', $planilla[0]['codigo']);
			$contrato[':planillas_id'] = $planilla[0]['id']; 
			$contrato[':titulares_id'] = Session::get('lastTitular');
			
			
			$this->_db->beginTransaction();
			
			try {
				
				// tabla contratos ==========================================
				
				$this->_query = '
					INSERT INTO 
						contratos(
							modelo_id,			tipoTrans_id,	
							anio,				color,
							placa,				serial_c,
							serial_m,			precio_id,
							usoVehiculo_id,		peso,
							fecha_exp,			hora_exp,
							fecha_ven,			hora_ven,
							statusCont_id,		planillas_id,
							titulares_id					
						) VALUES (
							:modelo_id,			:tipoTrans_id,	
							:anio,				:color,
							:placa,				:serial_c,
							:serial_m,			:precio_id,
							:usoVehiculo_id,	:peso,
							:fecha_exp,			:hora_exp,
							:fecha_ven,			:hora_ven,
							:statusCont_id,		:planillas_id,
							:titulares_id				
					)';
				
				$result = $this->_db->prepare($this->_query);
				foreach( $contrato as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
				$lastContrato = $this->_db->lastInsertId('contratos');
			
			// end tabla contratos ==========================================
			
			//cambio de estatus planilla =======================================
				
			$this->_query = 'UPDATE contratos SET statusCont_id = "4" WHERE  id ='.Session::get('lastContrato');
			$this->_db->prepare($this->_query)->execute();
			
			//cambio de estatus planilla =======================================
			
			
			//cambio de estatus planilla =======================================
			
				$this->_query = 'UPDATE planillas SET statusFormat_id = "2" WHERE id = '.$planilla[0]['id'];				
				$this->_db->prepare($this->_query)->execute();				
				
			//cambio de estatus planilla =======================================
				
				Session::destroy('lastContrato');
				Session::set('lastContrato', $lastContrato);
				
				$this->_db->commit();
				return true;
				
			} catch (PDOException $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function getContrato($id, $st = '1') {
			
			
			$this->_query = '
				SELECT
					titulares.dni,
					titulares.nombres,				titulares.apellidos,
					titulares.direccion,			numpuesto.numPuesto,
					parroquia.parroquia,			municipio.municipio,
					estado.estado,					contratos.placa,
					contratos.anio,					contratos.color,
					contratos.serial_c,				contratos.serial_m,
					contratos.peso,					contratos.fecha_exp,
					contratos.hora_ven,				contratos.fecha_ven,
					contratos.hora_exp,				contratos.statusCont_id,
					contratos.id,					precio.precio,
					usovehiculo.usoVehiculo,		cobertura.cobertura,
					clasevehiculo.claseVehiculo,	tipovehiculo.tipoVehiculo,
					modelo.modelo,					marca.marca,
					concepto.gastosMedicos1,		concepto.invalidez1,
					concepto.muerte1,				concepto.gastosMedicos2,
					concepto.invalidez2,			concepto.muerte2,
					concepto.daniosPropiedad,		concepto.grua,
					concepto.estacionamiento,		concepto.indemnizacionSem,
					concepto.asistenciaLegal
				FROM
					titulares
					INNER JOIN contratos ON contratos.titulares_id = titulares.id
					INNER JOIN precio ON contratos.precio_id = precio.id
					INNER JOIN usovehiculo ON contratos.usoVehiculo_id = usovehiculo.id
					INNER JOIN cobertura ON precio.cobertura_id = cobertura.id
					INNER JOIN clasevehiculo ON usovehiculo.claseVehiculo_id = clasevehiculo.id AND cobertura.claseVehiculo_id = clasevehiculo.id
					INNER JOIN tipovehiculo ON tipovehiculo.claseVehiculo_id = clasevehiculo.id
					INNER JOIN numpuesto ON numpuesto.tipoVehiculo_id = tipovehiculo.id AND precio.numPuesto_id = numpuesto.id
					INNER JOIN parroquia ON titulares.parroquia_id = parroquia.id
					INNER JOIN municipio ON parroquia.municipio_id = municipio.id
					INNER JOIN estado ON municipio.estado_id = estado.id
					INNER JOIN modelo ON contratos.modelo_id = modelo.id
					INNER JOIN marca ON modelo.marca_id = marca.id
					INNER JOIN concepto ON concepto.cobertura_id = cobertura.id
				WHERE
					statusCont_id = '.$st.'
				AND
					contratos.id = '.$id;
			
			$data = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
							
			return array_shift( $result );
		}
		
		public function getTelefonos($id) {
			
			$this->_query = '
				SELECT
					telefonos.numTelf
				FROM
					telefonos
				WHERE 
					titulares_id ='.$id;
			
			$data = $this->_db->query($this->_query);
			
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
			
			$telf = '';
			
			for ($i = 0; $i < count($result); $i++) {
				$telf .= $result[$i]['numTelf'].'&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			
			return $telf;
			
		}
		
		public function getCorreos($id) {
				
			$this->_query = '
				SELECT
					correos.correo
				FROM
					correos
				WHERE
					titulares_id ='.$id;
				
			$data = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
			
			if (count($result) > 0) {
				$correo = $result[0]['correo'];
			}else {
				$correo = '<i>SIN CORREO ELECTRÓNICO</i>';
			}
				
			return $correo;
				
		}
		
		public function getFecha() {
		
			$this->_query = 'SELECT CURDATE() as fecha';		
			$data = $this->_db->query($this->_query);
		
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
			
			$fecha = App::showDate($result[0]['fecha']);
			return $fecha;
		
		}
		
		public function getHora() {
		
			$this->_query = 'SELECT CURTIME() as hora';		
			$data = $this->_db->query($this->_query);
		
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
			
			$hora = App::format12Hours($result[0]['hora']);
			return $hora;
		
		}
		
		public function updateStatusContrato($ts,$id) {
		
			$this->_query = '
				UPDATE 
					contratos 
				SET 
					statusCont_id = '.$ts.' 
				WHERE 
					contratos.id ='.$id;
		
			try {
				$this->_db->beginTransaction();
				$this->_db->prepare($this->_query)->execute();
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		
		}
		
		public function formaPago($id) {
			$this->_query = '
				SELECT tipoPago FROM tipopago WHERE id ='.$id;
				
			$data = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
			
			if (count($result) > 0) {
				$tp = $result[0]['tipoPago'];
			}else {
				$tp = '<i>Tipo de pago no definido</i>';
			}
				
			return $tp;
		}
		
		public function insertFat($data, $id) {
			
			$this->_db->beginTransaction();
			
			try {
				$this->_query ='
					INSERT INTO
						factemitidas(
							fecah_em, 		facturas_id,
							contratos_id, 	tipoPago_id
					) VALUES (
							:fecah_em, 		:facturas_id,
							:contratos_id, 	:tipoPago_id
				)';
				$this->_db->prepare($this->_query)->execute($data);
				
				
				$this->_query = 'UPDATE facturas SET statusFormat_id = "2" WHERE id = '.$id;
				$this->_db->prepare($this->_query)->execute();
				
				
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function disableFat( $id ) {
				
			$this->_db->beginTransaction();
				
			try {
				
				$this->_query = 'UPDATE facturas SET statusFormat_id = "3" WHERE id = '.$id;
				$this->_db->prepare($this->_query)->execute();
		
		
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function getAjaxTitular($dni) {
			$this->_query = '
				SELECT * FROM titulares WHERE dni = "'.$dni.'"';
				
			$data = $this->_db->query($this->_query);
		
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
				
			return json_encode( $result );
		}
		
		public function assocContract($contrato) {
			
			
			
			$planilla = $this->getPlanilla();
			Session::set('assignedFormat', $planilla[0]['codigo']);
			$contrato[':planillas_id'] = $planilla[0]['id'];
			$contrato[':titulares_id'] = Session::get('lastTitular');
			$this->_db->beginTransaction();
				
			try {
		
				// tabla contratos ==========================================
		
				$this->_query = '
					INSERT INTO
						contratos(
							modelo_id,			tipoTrans_id,
							anio,				color,
							placa,				serial_c,
							serial_m,			precio_id,
							usoVehiculo_id,		peso,
							fecha_exp,			hora_exp,
							fecha_ven,			hora_ven,
							statusCont_id,		planillas_id,
							titulares_id
						) VALUES (
							:modelo_id,			:tipoTrans_id,
							:anio,				:color,
							:placa,				:serial_c,
							:serial_m,			:precio_id,
							:usoVehiculo_id,	:peso,
							:fecha_exp,			:hora_exp,
							:fecha_ven,			:hora_ven,
							:statusCont_id,		:planillas_id,
							:titulares_id
					)';
		
				$result = $this->_db->prepare($this->_query);
				foreach( $contrato as $key => $value){
					$result->bindValue($key, $value, PDO::PARAM_STR);
				}
				$result->execute();
				$lastContrato = $this->_db->lastInsertId('contratos');
					
				// end tabla contratos ==========================================
					
				//cambio de estatus planilla =======================================
					
				$this->_query = 'UPDATE planillas SET statusFormat_id = "2" WHERE id = '.$planilla[0]['id'];
				$this->_db->prepare($this->_query)->execute();
		
				//cambio de estatus planilla =======================================
				
				Session::set('lastContrato', $lastContrato);
				Session::set('print',true);
		
				$this->_db->commit();
				return true;
		
			} catch (PDOException $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function getTitular($id) {
				
			$this->_query = '
				SELECT
					titulares.id,
					titulares.dni,
					titulares.nombres,
					titulares.apellidos,
					titulares.direccion,
					tipopersona.tipoPersona,
					parroquia.parroquia,
					municipio.municipio,
					estado.estado
				FROM
					titulares
					INNER JOIN tipopersona ON titulares.tipoPersona_id = tipopersona.id
					INNER JOIN parroquia ON titulares.parroquia_id = parroquia.id
					INNER JOIN municipio ON parroquia.municipio_id = municipio.id
					INNER JOIN estado ON municipio.estado_id = estado.id
				WHERE
					titulares.id = '.$id;
				
			$data = $this->_db->query($this->_query);
		
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
				
			return array_shift( $result );
		}
		
		
	}
?>
