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
				'perfilUsuario'		=> 	'perfilUsuario ORDER BY id ASC',
				'agencias'			=> 	'agencias ORDER BY id ASC',
				'pregunta'			=> 	'pregunta ORDER BY id ASC',
				'statusUsuarios'	=> 	'statusUsuarios ORDER BY id ASC',
				'tipoPersona'		=> 	'tipoPersona ORDER BY id ASC',
				'tipoTelf'			=> 	'tipoTelf ORDER BY id ASC',
				'marca'				=> 	'marca ORDER BY id ASC',
				'tipoTrans'			=> 	'tipoTrans ORDER BY id ASC',
				'tipoPago'			=> 	'tipoPago ORDER BY id ASC',
				//================================================
				'municipio'			=> 	'municipio WHERE estado_id = '.$id,
				'parroquia'			=> 	'parroquia WHERE municipio_id = '.$id,
				'modelo'			=> 	'modelo WHERE marca_id = '.$id,
				'tipoVehiculo'		=> 	'tipoVehiculo WHERE claseVehiculo_id = '.$id,
				'numPuesto'			=> 	'numPuesto WHERE tipoVehiculo_id = '.$id,
				'cobertura'			=> 	'cobertura WHERE claseVehiculo_id = '.$id,
				'usoVehiculo'		=> 	'usoVehiculo WHERE claseVehiculo_id = '.$id,
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
		
	}
?>