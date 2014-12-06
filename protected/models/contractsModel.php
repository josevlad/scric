<?php

	class contractsModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}
		
		public function saveContract($parameters) {
			
			$this->_query = ""; 
			
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
		}
		
		public function getContracts($criterial = FALSE) {
			
			if (is_numeric($criterial)){
				$search_criteria = "WHERE dni = " . $criterial;
			}else{
				$search_criteria = "WHERE (name LIKE '%" . $criterial . "%' or last_name LIKE '%" . $criterial . "%')";
			}
			
			$this->_query = " SELECT * FROM table $search_criteria ORDER BY field ASC";
			
			try {
				$this->_db->beginTransaction();
				$result = $this->_db->query($this->_query)->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}			
			
			return $result;
		}

		
		public function updatePerson($parameters) {

			$this->_query = "		
				UPDATE persons SET
					dni			= :dni,
					name		= :name,
					last_name	= :last_name		
				WHERE
					id	= :id"; 
			
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
			
		
		}	

		
		public function getRegister($criterial) { 
			
			if (is_numeric($criterial)){

				$search_criteria = "WHERE id = $criterial "; 
				$this->_query = " SELECT * FROM persons $search_criteria";
				
				try {
					$this->_db->beginTransaction();
					$result = $this->_db->query($this->_query)->fetchAll(PDO::FETCH_ASSOC);
					$this->_db->commit();
				}
				catch (Exception $e) {
					$this->_db->rollBack();
					echo "Error :: ".$e->getMessage();
					exit();
				}				
				
				return array_shift($result);
			
			}else{			
				return 'error en argumento';
			}			
		}
				
		public function deleteContract($id) {
		
			$this->_query = "
				DELETE FROM 
					persons 
				WHERE
					id 	= :id
			";
		
			$this->_db->prepare($this->_query)->execute($id);
		
		
		}
		
	}
?>
