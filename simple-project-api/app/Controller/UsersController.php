<?php 
	class UsersController extends AppController{

		public $components = array('RequestHandler');

		public function index()
		{

			 $users = $this->User->find('all'); 
        	$this->set(array(
            	'users' => $users,
            	'_serialize' => array('users')
        	));
		}
		public function view($id)
		{
			$users = $this->User->findById($id); 
        	$this->set(array(
            	'users' => $users,
            	'_serialize' => array('users')
       		 ));

		}
	
	} 