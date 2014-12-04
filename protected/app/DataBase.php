<?php
	/**
	 * 
	 * Esta clase es para crea un objeto para conexión a la Base de datos
	 * usando la clese PDO de php 5.
	 * 
	 * para ello se crea un arreglo con los parametros de la conexión
	 * y la configuración realizada en al archivo Config.php
	 * 
	 * y se usa el metodo magico __construct() para que al crear
	 * el objeto ya realiza la conexión de forma automatica.
	 * 
	 *
	 */
	class DataBase extends PDO {
		
		public function __construct() {
			$options = array(
							PDO::ATTR_PERSISTENT => TRUE,
							PDO::ATTR_ERRMODE 	 => PDO::ERRMODE_EXCEPTION,
    						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
					  );
			
			parent::__construct(
					'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, 
					DB_USER, 
					DB_PASS, 
					$options
			);
		}
	}	
?>
