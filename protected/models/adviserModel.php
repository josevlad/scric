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
				return true;
				
			} catch (PDOException $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
		}
	}
?>
