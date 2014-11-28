<?php
	class loginController extends Controller {
		private $_login;
		public function __construct() {
			parent::__construct();
			$this->_login = $this->loadModel('login');
		}
		
		function index() {
					
			if (Session::get(AUTHENTICATED)) {
				$this->_view->redirect('');
			}else {
				$this->_view->render('signin','','login');
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
							'danger'
					);
					$this->_view->render('signin', '', 'login');
					exit();
				}
				
				Session::set(AUTHENTICATED, true);
				Session::set('level', $data['perfil']);
				Session::set('nivel_est', $data['nivel_estudios_id']);
				
				Session::set('time', time());
				
				switch ($data['perfil']) {
					case 'Admin':
						Session::set('user', 'Sr(a). '.$data['nombres'].', '.$data['apellidos']);
						$this->_view->redirect('index');
					break;
					
					default:
						Session::set('user', $data['nombres'].', '.$data['apellidos']);
						$this->_view->redirect();
					break;
				}
			}else {
				$this->_view->render('signin', '', 'login');
			}
		}
			
		public function close($param) {
			Session::destroy();
			$this->_view->redirect('login');
		}
	}
?>