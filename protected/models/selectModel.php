<?php
	class selectModel extends Model {
	
		protected 	$_query;
	
		public function __construct() {
			parent::__construct();
		}
	
		public function __destruct() {
			;
		}
		
		public function getReferences($table, $id = FALSE) {
			
			$cases = array(
				'claseVehiculo'		=> 	'claseVehiculo ORDER BY id',
				'marca'				=> 	'marca ORDER BY id',
				'estado'			=> 	'estado ORDER BY id ASC',
				//================================================
				'tipoVehiculo'		=> 	'tipoVehiculo WHERE claseVehiculo_id = '.$id,
				'municipio'			=> 	'municipio WHERE estado_id = '.$id,
				'cobertura'			=> 	'cobertura WHERE claseVehiculo_id = '.$id,
				'numPuesto'			=> 	'numPuesto WHERE tipoVehiculo_id = '.$id,
			);
			
			if (array_key_exists($table, $cases)) {
				$query = $cases[$table];
			}else {
				throw new Exception('Tipo de Solicitud no existente (selecModel-getReferences)');
				exit();
			}
			
			$this->_query = 'SELECT * FROM '.$query;
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
		
	}
?>