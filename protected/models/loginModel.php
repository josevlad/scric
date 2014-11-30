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
					perfil.perfil,
					usuarios.nombre,
					usuarios.apellido,
					usuarios.nick,
					usuarios.clave,
					stusuarios.`status`,
					agencias.nombre_ag,
					agencias.identificador,
					agencias.id
				FROM
					usuarios
					INNER JOIN perfil ON usuarios.perfil_id = perfil.id
					INNER JOIN stusuarios ON usuarios.stUsuarios_id = stusuarios.id
					INNER JOIN agencias ON usuarios.agencias_id = agencias.id	
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