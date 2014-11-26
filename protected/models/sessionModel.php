<?php

	class sessionModel extends Model {
	
		protected $_query;
	
		public function __construct() {
			parent::__construct();
		}
	
		public function __destruct() {
			;
		}
	
		public function getRole() {
				
			$this->_query = 'SELECT * FROM perfil';
			
			$roles = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $roles->fetchAll();
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