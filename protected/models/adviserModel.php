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
		
		public function getIdPlanilla() {
			$this->_query = 'SELECT id FROM planillas WHERE statusFormat_id =  "1" AND agencias_id = "'.Session::get('idAgencia').'" LIMIT 0 , 1';
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
			
			$id = array_shift($result);
			$id = array_shift($id);
			
			return $id;
		}
		
		public function saveContract($data) {
			
			$titular 	= array_shift($data);
			$telefonos 	= array_shift($data);
			$correos 	= array_shift($data);
			$contrato 	= array_shift($data);
			$idPlanilla = $this->getIdPlanilla();
			$contrato[':planillas_id'] = $idPlanilla; 
			
			$tipoPago = $contrato[':tipoPago'];
			unset($contrato[':tipoPago']);
			
			//print_r($contrato);
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
				$lastId = $this->_db->lastInsertId('titulares');
			// end tabla personas ==========================================
			
			// tabla contratos ==========================================
				$contrato[':titulares_id'] = $lastId;
				
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
					$result->bindValue(':titulares_id', $lastId, 			PDO::PARAM_INT);
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
					$result->bindValue(':titulares_id', $lastId, 		PDO::PARAM_INT);
					$result->execute();
				}
			// tabla correos array =======================================
			
			//cambio de estatus planilla =======================================
			
				$this->_query = 'UPDATE planillas SET statusFormat_id = "2" WHERE id = '.$idPlanilla;
				
				$this->_db->prepare($this->_query)->execute();
				
				
			//cambio de estatus planilla =======================================
			
				$this->_db->commit();
				Session::set('data', $data);
				Session::set('lastId', $lastId);
				return true;
				
			} catch (PDOException $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
		
		public function getContrato($id) {
			
			$this->_query = '
				SELECT
					titulares.id,					titulares.dni,
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
		
		public function getTelefonos($id) {
			
			$this->_query = '
				SELECT
					telefonos.numTelf,
					tipotelf.tipoTelf
				FROM
					telefonos
				INNER JOIN 
					tipotelf ON telefonos.tipoTelf_id = tipotelf.id
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
				$telf .= $result[$i]['numTelf'].' ';
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
			return $hora;;
		
		}
	}
?>
