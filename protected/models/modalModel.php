<?php

class modalModel extends Model {

	protected 	$_query;

	public function __construct() {
		parent::__construct();
	}

	public function __destruct() {
		;
	}
	
	public function saveMarca($data) {
	
		$this->_query = "INSERT INTO marca( marca ) VALUES ( :marca )";
	
		try {
			$this->_db->beginTransaction();
			$this->_db->prepare($this->_query)->execute($data);
			$this->_db->commit();
		}
		catch (Exception $e) {
			$this->_db->rollBack();
			echo "Error :: ".$e->getMessage();
			exit();
		}
		echo true;
	}
	
	public function saveModelo($data) {
	
		$this->_query = "INSERT INTO modelo( modelo, marca_id ) VALUES ( :modelo, :marca_id )";
	
		try {
			$this->_db->beginTransaction();
			$this->_db->prepare($this->_query)->execute($data);
			$this->_db->commit();
		}
		catch (Exception $e) {
			$this->_db->rollBack();
			echo "Error :: ".$e->getMessage();
			exit();
		}
		echo true;
	}

	
}
?>