<?php
	class selectModel extends Model {
	
		protected 	$_query;
	
		public function __construct() {
			parent::__construct();
		}
	
		public function __destruct() {
			;
		}
	
		public function getEdoCivil() {
			$this->_query = " SELECT * FROM edocivil";
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
		
		public function getLugares() {
			$this->_query = " SELECT * FROM lugares ";
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
		
		public function getTpPhone() {
			
			$this->_query = 'SELECT * FROM tipoTlef ORDER BY id';
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
		
		public function getMarcas() {
				
			$this->_query = 'SELECT * FROM marcas ORDER BY marca';
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
		
		public function getReferences($type, $id = FALSE) {
			
			$cases = array(
				'tpPersona_id' 		=> 	'tpPersona ORDER BY id',
				'estado'			=>	'estados ORDER BY id',
				'municipio'			=>	'municipios WHERE estados_id ='.$id,
				'parroquias_id'		=>	'parroquias WHERE municipios_id ='.$id,
				'tipoTelf_id'		=>	'tipotelf ORDER BY id',
				'marca'				=>	'marcas ORDER BY id',
				'modelos_id'		=>	'modelos WHERE marcas_id ='.$id,
				'trans'				=>	'trans ORDER BY id'				
			);
			
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente');
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
		
		public function getModelos($id) {
		
			$this->_query = 'SELECT * FROM modelos WHERE marcas_id ='.$id.' ORDER BY modelo';
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
		
		
		//===================================================
		public function getSex() {
			$this->_query = " SELECT * FROM sexo";
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
		
		public function getCountry() {
			$this->_query = " SELECT * FROM paises";
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
		
		public function getInstitute() {
			$this->_query = " SELECT * FROM planteles ORDER BY plantel";
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
		
		public function getCondition() {
			$this->_query = "SELECT * FROM cond_matricula";
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
		
		public function getNexo() {
			$this->_query = "SELECT * FROM nexo_familiar";
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