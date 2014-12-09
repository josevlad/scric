<?php
	class App {
		
		public static function varDump($data) {
			echo '<pre>';
			print_r($data);
			echo '</pre>';
		}
		
		public static function saveDate($date) {
			$result = date("Y-m-d", strtotime($date) );
			return $result;
		}
		
		public static function showDate($date) {
			$result = date("d-m-Y", strtotime($date) );
			return $result;
		}
		
		public static function boxMessage($title, $content, $type) {
			$messeger = '
				<div class="alert alert-'.$type.' ">
					<a class="close" data-dismiss="alert" href="ui_elements.html#"><i class="fa fa-close"></i></a>
						<h4> <i class="icon-remove-sign"></i>
							'.$title.'
                        </h4>
						'.$content.'
				</div>';
			return $messeger;
		}
		
		public static function showAge( $date ) {
			list($Y,$m,$d) = explode("-",$date);
			return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
		}
		
		public static function oneYearMore($date) {
			$date = date('d-m-Y');
			$new_date = strtotime ( '+1 year' , strtotime ( $date ) ) ;
			$result = date ( 'd-m-Y' , $new_date );			
			return $result;
		}
		
		public static function edithDNI($dni){
			$sig[]='.';
			$sig[]=',';
			return str_replace($sig,'',$dni);
		}
		
		public static function format12Hours($hours) {
			return date('h:i:s a', strtotime($hours));
		}
		
		
	}	


?>