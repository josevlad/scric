
<?php
	/**
	 * 
	 * Esta clase solo instancia la clase DataBase para abrir
	 * la conexión a la base de datos.
	 *
	 */
	class Model{
		protected $_db;
		
		public function __construct() {
			$this->_db = new DataBase();
			$this->_db->exec("SET NAMES 'utf8'"); 
		}
	}
?>
