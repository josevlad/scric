<?php
	class configModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}	
		
		public function getReferenceData( $type ) {
						
			$cases = array(
				'agencias'			=> 	'agencias ORDER BY id',
				'claseVehiculo'		=> 	'claseVehiculo ORDER BY id',
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
				//===============================================
				'cobertura'			=> 	'cobertura INNER JOIN clasevehiculo ON cobertura.claseVehiculo_id = clasevehiculo.id',
				'tipoVehiculo'		=> 	'tipoVehiculo INNER JOIN clasevehiculo ON tipoVehiculo.claseVehiculo_id = clasevehiculo.id',
				'modelo'			=> 	'modelo INNER JOIN marca ON modelo.marca_id = marca.id',
				'municipio'			=> 	'municipio INNER JOIN estado ON municipio.estado_id = estado.id',
				'numPuesto'			=> 	'numpuesto 
											INNER JOIN tipovehiculo ON numpuesto.tipoVehiculo_id = tipovehiculo.id
											INNER JOIN clasevehiculo ON tipovehiculo.claseVehiculo_id = clasevehiculo.id',
				'parroquia'			=> 	'parroquia
											INNER JOIN municipio ON parroquia.municipio_id = municipio.id
											INNER JOIN estado ON municipio.estado_id = estado.id',
				'usoVehiculo'		=> 	'usoVehiculo
											INNER JOIN clasevehiculo ON usovehiculo.claseVehiculo_id = clasevehiculo.id',
				'precio'			=> 	'precio
											INNER JOIN cobertura ON precio.cobertura_id = cobertura.id
											INNER JOIN numpuesto ON precio.numPuesto_id = numpuesto.id
											INNER JOIN tipovehiculo ON numpuesto.tipoVehiculo_id = tipovehiculo.id
											INNER JOIN clasevehiculo ON cobertura.claseVehiculo_id = clasevehiculo.id AND tipovehiculo.claseVehiculo_id = clasevehiculo.id',
				
			);
			
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente (configModel-getReferenceData)');
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
				throw new Exception('Tipo de Solicitud no existente (configModel-saveReference)');
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
				'tipoTrans' 		=> 	'tipoTrans SET tipoTrans = :tipoTrans WHERE id ='.$id,
			);
				
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente (configModel-updateReference)');
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
		
		public function saveDependent($parameters, $type) {
			
			$cases = array(
				'cobertura' 		=> 	'cobertura ( cobertura, claseVehiculo_id ) VALUES ( :cobertura, :claseVehiculo_id )',
				'tipoVehiculo' 		=> 	'tipoVehiculo ( tipoVehiculo, claseVehiculo_id ) VALUES ( :tipoVehiculo, :claseVehiculo_id )',
				'modelo' 			=> 	'modelo ( modelo, marca_id ) VALUES ( :modelo, :marca_id )',
				'municipio' 		=> 	'municipio ( municipio, estado_id ) VALUES ( :municipio, :estado_id )',
				'numPuesto' 		=> 	'numPuesto ( numPuesto, tipoVehiculo_id ) VALUES ( :numPuesto, :tipoVehiculo_id )',
				'parroquia' 		=> 	'parroquia ( parroquia, municipio_id ) VALUES ( :parroquia, :municipio_id )',
				'usoVehiculo' 		=> 	'usoVehiculo ( usoVehiculo, claseVehiculo_id ) VALUES ( :usoVehiculo, :claseVehiculo_id )',				
			);
			
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente (configModel-saveDependent)');
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
		
		public function updateDependent($parameters, $type, $id) {
			
			$cases = array(
				'cobertura' 	=> 	'cobertura SET cobertura=:cobertura, claseVehiculo_id=:claseVehiculo_id WHERE cobertura.id='.$id,
				'tipoVehiculo' 	=> 	'tipoVehiculo SET tipoVehiculo=:tipoVehiculo, claseVehiculo_id=:claseVehiculo_id WHERE tipoVehiculo.id='.$id,
				'modelo' 		=> 	'modelo SET modelo=:modelo, marca_id=:marca_id WHERE modelo.id='.$id,
				'municipio'		=> 	'municipio SET municipio=:municipio, estado_id=:estado_id WHERE municipio.id='.$id,
				'numPuesto'		=> 	'numPuesto SET numPuesto=:numPuesto, tipoVehiculo_id=:tipoVehiculo_id WHERE numPuesto.id='.$id,
				'parroquia'		=> 	'parroquia SET parroquia=:parroquia, municipio_id=:municipio_id WHERE parroquia.id='.$id,
				'usoVehiculo'	=> 	'usoVehiculo SET usoVehiculo=:usoVehiculo, claseVehiculo_id=:claseVehiculo_id WHERE usoVehiculo.id='.$id,
			);
				
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente (configModel-updateDependent)');
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
		
		public function savePrecio($parameters) {
			
			$this->_query ='
				INSERT INTO precio(
					precio,
					numPuesto_id,
					cobertura_id
				) VALUES (
					:precio,
					:numPuesto_id,
					:cobertura_id
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
		
		public function updatePrecio($parameters) {
			
			$this->_query ='
				UPDATE precio SET 
					precio 			= :precio,
					numPuesto_id 	= :numPuesto_id,
					cobertura_id	= :cobertura_id 
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
