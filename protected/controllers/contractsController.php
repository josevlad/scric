<?php
	class contractsController extends Controller {
		
		/**
		 * En esta clase existe 2 atributos
		 * uno esta destinado para ser un array() que contendrá los links de acciones (sidebar)
		 * El otro esta destinada para ser un objeto de tipo modelo y a través de el acceder a los
		 * Métodos para el manejo de la base de datos.
		 */
		
		protected $_sidebar_menu;
		private $_contract;
		
		public function __construct() {			
			parent::__construct();
			$this->_contract = $this->loadModel('contracts');
			/*
			$this->_sidebar_menu = array(
					array(
							'id'	=>'insert_new',
							'title'	=>'Nuevo Registro',
							'link'	=> BASE_URL . 'persons' . DS . 'insert'
					),
					array(
							'id'	=>'records_list',
							'title'	=>'Listado de Personas',
							'link'	=> BASE_URL . 'persons' . DS . 'listed'
					)
			);
			*/
				
		}		
//=================================================================================================		
		
		function index() {
			$this->_view->render('index',$this->_sidebar_menu);
		}
		
//=================================================================================================		
		public function newContract() {

			Session::accessRole(array('Admin'));
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				App::varDump($_REQUEST);
				
			}else{
								
				//maskedinput
				$this->_view->setJs(array('plugins/maskedinput/maskedinput'));
				
				//validate
				$this->_view->setJs(array('plugins/validate/validate'));
				
				//custom config js 
				$this->_view->setJs(array('contracts/newContract'));
				
				$this->_view->render('newContract'/*,$this->_sidebar_menu*/);
			
			}			
		}
		
		/**
		 * Este metodo es para hacer una consulta a la tabla persons
		 * ya sea de todos los datos o de la búsqueda por un criterio
		 * 
		 * Ejemplo: SELECT * FROM persons 
		 * 		O
		 * 		SELECT * FROM persons WHERER id = CRITERIAL
		 * 		O
		 * 		SELECT * FROM persons WHERER (name LIKE %CRITERIAL% OR last_name LIKE %CRITERIAL%)
		 * 
		 * Ya que se puede hacer un filtro de la búsqueda por cedula, nombres o apellidos.
		 * si se realiza una búsqueda, se recibe los datos enviados por un formulario por
		 * el método $_POST con la variable llamada 'criterial'
		 * 
		 * una vez que se hace la consulta de los datos se envía a la vista con la variable:
		 * data y se redireciona a la vistas listed.phtml 
		 * 
		 */
		function listed() {
				
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$criterial = $_POST['criterial'];
		
				$this->_view->data = $this->_person->getPersons($criterial);
		
				$this->_view->render('listed',$this->_sidebar_menu);
		
			}else{
		
				$list_person = $this->loadModel('persons');
		
				$this->_view->data = $this->_person->getPersons();
		
				$this->_view->render('listed',$this->_sidebar_menu);
				
			}
		
		}

		/**
		 * Este método es para actualizar un registro de la tabla persons
		 *
		 * Ejemplo: UPDATE * FROM persons
		 *	SET id = :di, name = :name, last_name = :last_name
		 *	WHERE id_person = :id_person
		 *
		 * pero este método no solo manda a actualizar un registro, verifica si por la url
		 * existe un argumento, si es asi, lo toma, hace una búsqueda a la tabla con
		 *	ese argumento y construye un formulario para la edición del registro.
		 *
		 * una vez que se hace la consulta de los datos se envia a la vista con la variable:
		 *	list_persons y se redirecionar a la vistas listing.phtml
		 *
		 *	@param string $id
		 */
		
		function update($id = FALSE) {
		
			if (isset($id) && !empty($id)) {
		
				$this->_view->registre = $this->_person->getRegister($id);
				$this->_view->render('update',$this->_sidebar_menu);
		
			}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
				$bind_values = array(
						':id' 			=>	$_POST['id'],
						':dni'			=>	$_POST['dni'],
						':name'			=>	$_POST['name'],
						':last_name' 	=> $_POST['last_name']
				);
		
				$this->_person->updatePerson($bind_values);
		
				$this->redirect('persons','listed');
		
			}else{
		
				$this->_view->render('index',$this->_sidebar_menu);
				exit();
		
			}
		
		}
		
		
		/**
		 * 
		 * Este metodo es para eliminar un registro de la tabla persons
		 * 
		 * Este metodo tiene un condicional estructurado de la siguiente manera:
		 * 
		 * si (existe "id" y no esta vacio "id")
		 * 
		 * 		-busca el registro por el id y lo envia a la vista;
		 * 		-creauna pregunta: "¿Esta usted seguro de borrar el sigiente registro?"
		 * 		 y la envia a la vista;
		 * 		-redireciona a la vista "delete"
		 * 
		 * sino, si (exite "$_POST de id_persons" y no esta vacio "$_POST de id_persons")
		 * 		
		 * 		se crea un arreglo con el id_persons
		 * 		se invoca a al metodo deletePersons(array) para ejecutar el query;
		 * 		redireciona a la vista "listing".
		 * 
		 */
		function delete($id = FALSE) {
				
			if (isset($id) && !empty($id)) {
				
				$this->_view->message = 'Esta usted seguro de borrar el sigiente registro?';
				
				$this->_view->registre = $this->_person->getRegister($id);
		
				$this->_view->render('delete',$this->_sidebar_menu);
		
			}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
					
				$bind_values = array(
						':id'	=> $_POST['id']
				);					
					
				$this->_person->deletePerson($bind_values);
					
				$this->redirect('persons','listed');
					
			}else {
				$this->redirect('persons','listed');
			}
		
		}

		
		/**
		 * 
		 * Este metodo es para Visualizar los detalles un registro de la tabla persons
		 * 
		 * este metodo recive por parametro en id del regisgtro,
		 * hace una consulta a la base de datos fitrado por
		 * ese registro y redirecciona a la vista details
		 * pasandole los datos del registro encontado.
		 * 
		 */
		function details($id = FALSE) {
		
			if (isset($id) && !empty($id)) {
						
				$this->_view->registre = $this->_person->getRegister($id);
		
				$this->_view->render('details',$this->_sidebar_menu);
		
			}else{
				$this->_view->render('index',$this->_sidebar_menu);
				exit();
			}
		
		}
		
	}
?>
