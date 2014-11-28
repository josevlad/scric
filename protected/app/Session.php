<?php
	class Session{
		
		public static function init() {
			session_start();			
		}
		
		public static function destroy($key = NULL) {
			if ($key) {
				if (is_array($key)) {
					for ($i = 0; $i < count($key); $i++) {
						if (isset($_SESSION[$key[$i]])) {
							unset($_SESSION[$key[$i]]);
						}
					};
				}else {
					if (isset($_SESSION[$key])) {
						unset($_SESSION[$key]);
					};
				};
			}else{
				session_destroy();
			}
		}
		
		public static function set($key, $value) {
			if (!empty($key))
				$_SESSION[$key] = $value;
			
		}
		
		public static function get($key) {
			if (isset($_SESSION[$key]))
				return $_SESSION[$key];
			
		}
		
		public static function accessLevel($level) {
			if (!Session::get(AUTHENTICATED)) {
				header('location:' . BASE_URL . 'error/access/5050');
				exit();
			};
			
			if (Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
				header('location:' . BASE_URL . 'error/access/5050');
				exit();
			}
		}
		
		public static function accessViewLevel($level) {
			if (!Session::get(AUTHENTICATED)) {
				return false;
			};
			
			if (Session::getLevel($leve) > Session::getLevel(Session::get('level'))) {
				return false;
			}
			
			return true;
		}
		
		public static function getLevel($level) {
			$data = Controller::modelSession()->getRole();
			
			for ($i = 0; $i < count($data); $i++) {
				$role[$data[$i]['perfil']] = $data[$i]['id'];
			}
			
			if (!array_key_exists($level, $role)) {
				throw new Exception('Variable de session no existente');
			}else {
				return $role[$level];
			}
		}
		
		public static function accessRole(array $level, $noAdmin = false) {
			if (!Session::get(AUTHENTICATED)) {
				header('location:' . BASE_URL . 'login/');
				exit();
			}
			
			Session::time();
			/*
			if($noAdmin == false){
				if(Session::get('level') == 'Admin'){
					return; 
				}
			}
			*/
			if (!empty($level)) {
				if (in_array(Session::get('level'), $level)) {
					return;
				}
			}
			header('location:' . BASE_URL . 'error/access/5050');
		}
		
		public static function accessViewRole(array $level, $noAdmin = FALSE) {
			if (!Session::get(AUTHENTICATED)) {
				return false;
			}
			if($noAdmin == false){
				if(Session::get('level') == 'Administrador'){
					return true;
				}
			}
			if (count($level)) {
				if (in_array(Session::get('level'), $level)) {
					return true;
				};
			}
			return false;
		}
		
		public static function time() {
			if (!Session::get('time') || !defined('SESSION_TIME')) {
				throw new Exception('Tiempo de Session no definido');
			}			
			if (SESSION_TIME == 0) {
				return;
			}
			if (time()-Session::get('time') > (SESSION_TIME * 60)) {
				Session::destroy();
				header('location:' . BASE_URL . 'error/access/8080');
				exit();
			}else{
				Session::set('time', time());
			}
			
			
		}
		
	}
	
?>