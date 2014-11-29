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
					usuarios.nombre,
					usuarios.apellido,
					usuarios.nick,
					usuarios.clave,
					perfil.perfil,
					stusuarios.status
					FROM
					usuarios
					INNER JOIN perfil ON usuarios.perfil_id = perfil.id
					INNER JOIN stusuarios ON usuarios.stUsuarios_id = stusuarios.id		
					WHERE 
						usuarios.nick = "'.$user.'" 
					AND 
						usuarios.clave = "'.md5($pass).'"
					AND
						usuarios.stUsuarios_id = 1'
			);
			return $this->_query->fetch();
		}
		
	}
?>