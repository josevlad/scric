<?php
	class configModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}
		
		public function saveReference($parameters, $type) {
			
			$cases = array(
				'claseVehiculo' 	=> 	'claseVehiculo ( claseVehiculo ) VALUES ( :claseVehiculo )',
				'estado' 			=> 	'estado ( estado ) VALUES ( :estado )',
				'marca' 			=> 	'marca ( marca ) VALUES ( :marca )',
				'perfilUsuario' 	=> 	'perfilUsuario ( perfilUsuario ) VALUES ( :perfilUsuario )',
				'pregunta' 			=> 	'pregunta ( pregunta ) VALUES ( :pregunta )',
				'statusCont' 		=> 	'statusCont ( statusCont ) VALUES ( :statusCont )',
				'statusFormat' 		=> 	'statusFormat ( statusFormat ) VALUES ( :statusFormat )',
				'statusUsuarios' 	=> 	'statusUsuarios ( statusUsuarios ) VALUES ( :statusUsuarios )',
				'tipoPago' 			=> 	'tipoPago ( tipoPago ) VALUES ( :tipoPago )',
				'tipoPersona' 		=> 	'tipoPersona ( tipoPersona ) VALUES ( :tipoPersona )',
				'tipoTelf' 			=> 	'tipoTelf ( tipoTelf ) VALUES ( :tipoTelf )',
				'tipoTrans' 		=> 	'tipoTrans ( tipoTrans ) VALUES ( :tipoTrans )',
			);
			
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente');
				exit();
			}
			
			$this->_query = 'INSERT INTO '.$query;
			
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
			
			echo true;
		}
		
		public function updateReference($parameters, $type, $id) {
				
			$cases = array(
				'claseVehiculo' 	=> 	'claseVehiculo SET claseVehiculo = :claseVehiculo WHERE id ='.$id,
				'estado' 			=> 	'estado SET estado = :estado WHERE id ='.$id,
				'marca' 			=> 	'marca SET marca = :marca WHERE id ='.$id,
				'perfilUsuario' 	=> 	'perfilUsuario SET perfilUsuario = :perfilUsuario WHERE id ='.$id,
				'pregunta' 			=> 	'pregunta SET pregunta = :pregunta WHERE id ='.$id,
				'statusCont' 		=> 	'statusCont SET statusCont = :statusCont WHERE id ='.$id,
				'statusFormat' 		=> 	'statusFormat SET statusFormat = :statusFormat WHERE id ='.$id,
				'statusUsuarios' 	=> 	'statusUsuarios SET statusUsuarios = :statusUsuarios WHERE id ='.$id,
				'tipoPago' 			=> 	'tipoPago SET tipoPago = :tipoPago WHERE id ='.$id,
				'tipoPersona' 		=> 	'tipoPersona SET tipoPersona = :tipoPersona WHERE id ='.$id,
				'tipoTelf' 		 	=> 	'tipoTelf SET tipoTelf = :tipoTelf WHERE id ='.$id,
				'tipoTrans' 		 => 	'tipoTrans SET tipoTrans = :tipoTrans WHERE id ='.$id,
			);
				
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente');
				exit();
			}
				
			$this->_query = 'UPDATE '.$query;
				
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
				
			echo true;
		}
		
		public function getReferenceData($type, $id = FALSE, $id2 = FALSE) {
			
			$cases = array(
				'agencias'			=> 	'agencias ORDER BY id',
				'estado'			=> 	'estado ORDER BY id',
				'marca'				=> 	'marca ORDER BY id',
				'perfilUsuario'		=> 	'perfilUsuario ORDER BY id',
				'pregunta'			=> 	'pregunta ORDER BY id',	
				'statusCont'		=> 	'statusCont ORDER BY id',
				'statusFormat'		=> 	'statusFormat ORDER BY id',
				'statusUsuarios'	=> 	'statusUsuarios ORDER BY id',
				'tipoPago'			=> 	'tipoPago ORDER BY id',
				'tipoPersona'		=> 	'tipoPersona ORDER BY id',
				'tipoTelf'			=> 	'tipoTelf ORDER BY id',
				'tipoTrans'			=> 	'tipoTrans ORDER BY id',
			);
			
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente (grd moldel)');
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
		
		public function saveAgencia($parameters) {
			$this->_query ='
				INSERT INTO agencias(
					nombre_ag,
					identificador
				) VALUES (
					:nombre_ag,
					:identificador				
			)';
			
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
			
			echo true;
		}
		
		public function updateAgencia($parameters) {
			$this->_query ='
				UPDATE agencias 
				SET 
					nombre_ag = :nombre_ag,
					identificador = :identificador 
				WHERE 
					id = :id
			';
				
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
				
			echo true;
		}
		
		
//==================================================================================================		
		public function getTpPers($criterial = FALSE) {
				
			if (is_numeric($criterial)){
				$search_criteria = "WHERE id = " . $criterial;
			}else{
				$search_criteria = "";
			}
				
			$this->_query = " SELECT * FROM tpPersona $search_criteria ORDER BY id ASC";
				
			try {
				$this->_db->beginTransaction();
				$result = $this->_db->query($this->_query)->fetchAll();
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
				
			return $result;
		}
		
		
		
		/**
		 * El SQL de este método puede realizar una consulta total o filtras los datos 
		 * A través de una criterio de búsqueda
		 * Lo especial de este método es que te reconoce el contenido de la búsqueda, 
		 * si es por cedula o nombre o apellido solo evaluando el contenido del filtro
		 * 
		 * @param string $criterial
		 */
		public function getPersons($criterial = FALSE) {
			
			if (is_numeric($criterial)){
				$search_criteria = "WHERE dni = " . $criterial;
			}else{
				$search_criteria = "WHERE (name LIKE '%" . $criterial . "%' or last_name LIKE '%" . $criterial . "%')";
			}
			
			$this->_query = " SELECT * FROM persons $search_criteria ORDER BY dni ASC";
			
			try {
				$this->_db->beginTransaction();
				$result = $this->_db->query($this->_query)->fetchAll();
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
					$result = $this->_db->query($this->_query)->fetchAll();
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
				
		public function deletePerson($parameters) {
		
			$this->_query = "
				DELETE FROM 
					persons 
				WHERE
					id 	= :id
			";
		
			$this->_db->prepare($this->_query)->execute($parameters);
		
		
		}
		
	}
?>
