<?php
	class loginController extends Controller {
		private $_login;
		public function __construct() {
			parent::__construct();
			$this->_login = $this->loadModel('login');
		}
		
		function index() {
					
			if (Session::get(AUTHENTICATED)) {
				$this->_view->render('index');
			}else {
				$this->_view->redirect('login/signIn');
			}
			
		}
		
		public function signIn() {
						
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				if ((empty($_POST['user_name'])) or (empty($_POST['password']))) {
					$this->_view->_error = App::boxMessage(
							'Campos requeridos', 
							'Debe suministrar un nombre de usuario y una contraseña validos para el acceso.',
							'danger panel'
					);
					$this->_view->render('signin', '', 'login');
					exit();
				}
				
				$data = $this->_login->getUser($_POST['user_name'], $_POST['password']);
				
				if (!$data) {
					$this->_view->_error = App::boxMessage(
							'Usuario no Existente', 
							'Los datos suministrados no existen en la base de datos, por favor verifique la informacion.',
							'danger panel'
					);
					$this->_view->render('signin', '', 'login');
					exit();
				}
				
				App::varDump($data);
				
				Session::set(AUTHENTICATED, true);
				Session::set('level', $data['perfilUsuario']);
				Session::set('name', $data['nombre']);
				Session::set('last_name', $data['apellido']);
				Session::set('nombre_ag', $data['nombre_ag']);
				Session::set('identificador', $data['identificador']);
				Session::set('idAgencia', $data['id']);
				
				Session::set('time', time());
				
				$this->_view->redirect('index');
				
			}else {
				$this->_view->render('signin', '', 'login');
			}
		}
			
		public function close() {
			Session::destroy();
			$this->_view->redirect('login');
		}
	}
?>