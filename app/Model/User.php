<?php 
	class User extends AppModel{

		public function login($email, $password) {
			$params = array(
					"conditions" => array(
									"email" => $email,
									"password" => $password
									) 
				);
			$result = $this->find('first', $params);
			return $result;
		}

	
	}
?>