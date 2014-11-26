<?php
	/**
	 * Esta clase gestiona las consulta (SQL) a la Base de Datos
	 * cada método realiza las consultas según lo que se necesite.
	 * según se necesite, puede existir métodos que reciban los parámetros 
	 * algunos de ellos puede ser un conjunto de datos (un array).
	 * 
	 * insertar, buscar, editar, borrar
	 * 
	 * Para ellos se una la clase PDO de php 5 de la siguiente menera:
	 * 
	 * en una variable se crea el query, ejemplo: 
	 * $query = INSERT INTO persons(di,name) VALUES (:di :name)
	 * 
	 * luego se prepara la consulta con el metodo prepare de la clase PDO y
	 * se ejecuta el Query con el método execute de la clase PDO, ejemplo:
	 * 
	 * db->prepare($query)->execute(array); donde el array contiene los datos de di y name.
	 *
	 */
	class personsModel extends Model {
		
		protected 	$_query;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function __destruct() {
			;
		}
		
		public function savePerson($parameters) {
			
			$this->_query = "
				INSERT INTO persons(
					dni, 
					name, 
					last_name
				) 
				VALUES (
					:dni,
					:name,
					:last_name 
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
