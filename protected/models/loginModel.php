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
					perfilusuario.perfilUsuario,
					usuarios.nombre,
					usuarios.apellido,
					usuarios.nick,
					usuarios.clave,
					agencias.id,
					agencias.nombre_ag,
					agencias.identificador,
					usuarios.statusUsuarios_id
				FROM
					perfilusuario
				INNER JOIN usuarios ON usuarios.perfilUsuario_id = perfilusuario.id
				INNER JOIN agencias ON usuarios.agencias_id = agencias.id
				
				WHERE 
					usuarios.nick = "'.$user.'" 
				AND 
					usuarios.clave = "'.md5($pass).'"
				AND
					usuarios.statusUsuarios_id = 1'
			);
			return $this->_query->fetch();
		}
		
	}
?>