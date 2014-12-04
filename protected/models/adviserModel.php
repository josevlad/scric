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
				$result = $data->fetchAll();
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
	}
?>
