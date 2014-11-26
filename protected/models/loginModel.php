<?php
	
	class loginModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}
		
		public function getUser($user, $pass) {
			$this->_query = $this->_db->query(
				'SELECT
					personas.nombres,
					personas.apellidos,
					usuarios.user,
					usuarios.password,
					perfil.perfil
					FROM
					personas
					INNER JOIN usuarios ON usuarios.personas_id = personas.id
					INNER JOIN perfil ON usuarios.perfil_id = perfil.id
					WHERE 
						usuarios.user = "'.$user.'" 
					AND 
						usuarios.password = "'.md5($pass).'"'
			);
			return $this->_query->fetch();
		}
		
	}
?>