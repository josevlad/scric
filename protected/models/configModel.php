<?php
	class configModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}

		public function getRemote( $field, $data ) {
			
			$fields = array(
					'nick' 		=> 	'usuarios.nick FROM usuarios WHERE nick = "'.$data.'"',
					'placa'		=> 	'contratos.placa FROM contratos WHERE placa = "'.$data.'"',
					'serial_c'	=>	'contratos.serial_c FROM contratos WHERE serial_c = "'.$data.'"',
					'serial_m'	=>	'contratos.serial_m FROM contratos WHERE serial_m = "'.$data.'"',
			);

			if (!key_exists($field, $fields)) {
				throw new Exception('Tipo de solicitud no existente (getRemote - getRemote)');
			}
			
			$this->_query = 'SELECT '.$fields[$field];
			
			$data = $this->_db->query($this->_query);
		
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				echo "Error :: ".$e->getMessage();
				exit();
			}
		
			return $result;
		}
		
		public function getReferenceData( $type ) {
						
			$cases = array(
				'agencias'			=> 	'* FROM agencias ORDER BY id',
				'claseVehiculo'		=> 	'* FROM claseVehiculo ORDER BY id',
				'estado'			=> 	'* FROM estado ORDER BY id',
				'marca'				=> 	'* FROM marca ORDER BY id',
				'perfilUsuario'		=> 	'* FROM perfilUsuario WHERE id > 1 ORDER BY id',
				'pregunta'			=> 	'* FROM pregunta ORDER BY id',	
				'statusCont'		=> 	'* FROM statusCont ORDER BY id',
				'statusFormat'		=> 	'* FROM statusFormat ORDER BY id',
				'statusUsuarios'	=> 	'* FROM statusUsuarios ORDER BY id',
				'tipoPago'			=> 	'* FROM tipoPago ORDER BY id',
				'tipoPersona'		=> 	'* FROM tipoPersona ORDER BY id',
				'tipoTelf'			=> 	'* FROM tipoTelf ORDER BY id',
				'tipoTrans'			=> 	'* FROM tipoTrans ORDER BY id',
				//===============================================
				'cobertura'			=> 	'cobertura.id, cobertura.cobertura, cobertura.claseVehiculo_id, claseVehiculo	 
											FROM cobertura INNER JOIN clasevehiculo ON cobertura.claseVehiculo_id = clasevehiculo.id ORDER BY cobertura.claseVehiculo_id ASC',
					
				'tipoVehiculo'		=> 	'tipoVehiculo.id, tipoVehiculo.tipoVehiculo, tipoVehiculo.claseVehiculo_id, claseVehiculo	 
											FROM tipoVehiculo INNER JOIN clasevehiculo ON tipoVehiculo.claseVehiculo_id = clasevehiculo.id',
					
				 'modelo'			=> 	'modelo.id, modelo.modelo, modelo.marca_id, marca.marca 
											FROM modelo INNER JOIN marca ON modelo.marca_id = marca.id',
					
				'municipio'			=> 	'municipio.id, municipio.municipio, municipio.estado_id, estado.estado
										 	FROM municipio INNER JOIN estado ON municipio.estado_id = estado.id',
					
				'numPuesto'			=> 	'numpuesto.id, numpuesto.numPuesto, numpuesto.tipoVehiculo_id, tipovehiculo.tipoVehiculo, tipovehiculo.claseVehiculo_id, clasevehiculo.claseVehiculo 
											FROM numpuesto 
											INNER JOIN tipovehiculo ON numpuesto.tipoVehiculo_id = tipovehiculo.id
											INNER JOIN clasevehiculo ON tipovehiculo.claseVehiculo_id = clasevehiculo.id',
					
				'parroquia'			=> 	'* FROM parroquia
											INNER JOIN municipio ON parroquia.municipio_id = municipio.id
											INNER JOIN estado ON municipio.estado_id = estado.id',
					
				'usoVehiculo'		=> 	'usovehiculo.id, usovehiculo.usoVehiculo, usovehiculo.claseVehiculo_id, clasevehiculo.claseVehiculo 
											FROM usoVehiculo
											INNER JOIN clasevehiculo ON usovehiculo.claseVehiculo_id = clasevehiculo.id',
					
				'precio'			=> 	'* FROM precio
											INNER JOIN cobertura ON precio.cobertura_id = cobertura.id
											INNER JOIN numpuesto ON precio.numPuesto_id = numpuesto.id
											INNER JOIN tipovehiculo ON numpuesto.tipoVehiculo_id = tipovehiculo.id
											INNER JOIN clasevehiculo ON cobertura.claseVehiculo_id = clasevehiculo.id AND tipovehiculo.claseVehiculo_id = clasevehiculo.id',
					
				'usuarios'			=> 	'usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.nick, usuarios.clave, usuarios.respuesta, usuarios.agencias_id, usuarios.perfilUsuario_id, 
										 usuarios.pregunta_id, usuarios.statusUsuarios_id, statususuarios.statusUsuarios, pregunta.pregunta, perfilusuario.perfilUsuario, agencias.nombre_ag 
											FROM usuarios
											INNER JOIN agencias ON usuarios.agencias_id = agencias.id
											INNER JOIN perfilusuario ON usuarios.perfilUsuario_id = perfilusuario.id
											INNER JOIN statususuarios ON usuarios.statusUsuarios_id = statususuarios.id
											INNER JOIN pregunta ON usuarios.pregunta_id = pregunta.id',	
				
			);
			
			if (array_key_exists($type, $cases)) {
				$query = $cases[$type];
			}else {
				throw new Exception('Tipo de Solicitud no existente (configModel-getReferenceData)');
				exit();
			}
			
			$this->_query = 'SELECT '.$query;
			$data = $this->_db->query($this->_query);
			
			try {
				$this->_db->beginTransaction();
					$result = $data->fetchAll(PDO::FETCH_ASSOC);
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
				'cobertura' 		=> 	'cobertura ( cobertura, claseVehiculo_id, statusCobert_id ) VALUES ( :cobertura, :claseVehiculo_id, "1" )',
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
		
		public function saveUsuarios($parameters) {
			$this->_query ='
				INSERT INTO usuarios(
					nombre, 
					apellido, 
					nick, 
					clave, 
					respuesta, 
					agencias_id, 
					perfilUsuario_id, 
					pregunta_id, 
					statusUsuarios_id
				) VALUES (
					:nombre, 
					:apellido, 
					:nick, 
					:clave, 
					:respuesta, 
					:agencias_id, 
					:perfilUsuario_id, 
					:pregunta_id, 
					:statusUsuarios_id
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
		
		public function updateUsuarios($parameters, $id) {
			$this->_query ='
				UPDATE usuarios SET 
					nombre = :nombre, 
					apellido = :apellido,  
					agencias_id = :agencias_id, 
					perfilUsuario_id = :perfilUsuario_id, 
					statusUsuarios_id = :statusUsuarios_id  
				WHERE 
					id = '.$id.'
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

		public function getUsuario($id) {
			
			$this->_query = '
				SELECT * FROM usuarios
					INNER JOIN agencias ON usuarios.agencias_id = agencias.id
					INNER JOIN perfilusuario ON usuarios.perfilUsuario_id = perfilusuario.id
					INNER JOIN statususuarios ON usuarios.statusUsuarios_id = statususuarios.id
					INNER JOIN pregunta ON usuarios.pregunta_id = pregunta.id
				WHERE
					usuarios.id = '.$id;
			
			$data = $this->_db->query($this->_query);
				
			try {
				$this->_db->beginTransaction();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				$this->_db->commit();
			}
			catch (Exception $e) {
				$this->_db->rollBack();
				echo "Error :: ".$e->getMessage();
				exit();
			}
							
			return $result;
		}
	}
?>
