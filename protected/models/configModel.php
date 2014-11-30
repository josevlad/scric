<?php
	class configModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}
		
		public function saveTpPers($parameters) {
			
			$this->_query = "
				INSERT INTO tpPersona(
					tpPersona
				) VALUES (
					:tpPersona
				)
			"; 
			
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
		
		public function saveReference($parameters, $type) {
			
			$cases = array(
				'tpPersona' 		=> 	'tpPersona ( tpPersona ) VALUES ( :tpPersona )',
				'claseVehiculo' 	=> 	'claseVehiculo ( clase ) VALUES ( :claseVehiculo )',
				'tipoTelf' 			=> 	'tipoTelf ( tpTelf ) VALUES ( :tipoTelf )',
				'trans' 			=> 	'trans ( trans ) VALUES ( :trans )',
				'estado'			=>	'estados ( estado ) VALUES ( :estado )',
				'tpPago' 			=> 	'tpPago ( tpPago ) VALUES ( :tpPago )',
				'pregunta' 			=> 	'preguntas ( pregunta ) VALUES ( :pregunta )',
				'stUsuarios' 		=> 	'stUsuarios ( status ) VALUES ( :stUsuarios )',
				'perfil' 			=> 	'perfil ( perfil ) VALUES ( :perfil )',
				'stFormatos' 		=> 	'stFormatos ( status ) VALUES ( :stFormatos )',
				'estados' 			=> 	'estados ( estado ) VALUES ( :estados )',
				'statusCont' 		=> 	'statusCont ( status ) VALUES ( :statusCont )',
				'marcas' 			=> 	'marcas ( marca ) VALUES ( :marcas )',		
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
					'tpPersona' 		=> 	'tppersona SET tpPersona = :tpPersona WHERE id ='.$id,
					'claseVehiculo' 	=> 	'claseVehiculo SET clase = :claseVehiculo WHERE id ='.$id,
					'tipoTelf' 			=> 	'tipoTelf SET tpTelf = :tipoTelf WHERE id ='.$id,
					'trans' 			=> 	'trans SET trans = :trans WHERE id ='.$id,
					'tpPago' 			=> 	'tpPago SET tpPago = :tpPago WHERE id ='.$id,
					'pregunta' 			=> 	'preguntas SET pregunta = :pregunta WHERE id ='.$id,
					'stUsuarios' 		=> 	'stUsuarios SET status = :stUsuarios WHERE id ='.$id,
					'perfil' 			=> 	'perfil SET perfil = :perfil WHERE id ='.$id,
					'stFormatos' 		=> 	'stFormatos SET status = :stFormatos WHERE id ='.$id,
					'estados' 			=> 	'estados SET estado = :estados WHERE id ='.$id,
					'statusCont' 		=> 	'statusCont SET status = :statusCont WHERE id ='.$id,
					'marcas' 			=> 	'marcas SET marca = :marcas WHERE id ='.$id,
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
				'tpPersona' 		=> 	'tpPersona ORDER BY id',
				'claseVehiculo'		=>	'claseVehiculo ORDER BY id',
				'tipoTelf'			=>	'tipotelf ORDER BY id',
				'tipoTelf_id'		=>	'tipotelf ORDER BY id',
				'trans'				=>	'trans ORDER BY id',
				'tpPago'			=>	'tpPago ORDER BY id',
				'pregunta'			=>	'preguntas ORDER BY id',
				'stUsuarios'		=>	'stUsuarios ORDER BY id',
				'perfil'			=>	'perfil ORDER BY id',
				'stFormatos'		=>	'stFormatos ORDER BY id',
				'estados'			=>	'estados ORDER BY id',
				'statusCont'		=>	'statusCont ORDER BY id',
				'marcas'			=>	'marcas ORDER BY id',
				'municipio'			=>	'municipios WHERE estados_id ='.$id,
				'parroquias_id'		=>	'parroquias WHERE municipios_id ='.$id,
				'modelos_id'		=>	'modelos WHERE marcas_id ='.$id,				
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
