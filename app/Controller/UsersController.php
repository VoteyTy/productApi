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

		 public function login()
        {
        	$data = array();
        	$check = $this->User->login($this->request->data["email"], $this->request->data["password"]);
        	if ($check)
        	{
                $data = $check;
            // $token = $this->AppController->addUserToken($data["User"]["id"], $_SERVER['HTTP_USER_AGENT']);
            // $data["User"]["token"] = $token;
            }
            else $data = array("status"=>"error", "message"=>"incorrect yourname and password");
            	 
        	$this->set(array(
                	'users' => $data,
                	'_serialize' => array('users')
            	));
        }

         public function add(){

            $requests = $this->request->data ;

            if ($this->User->save($requests)) {

                $id = $this->User->getInsertID();
            //$message = "Successfully";
                $message= $this->User->findById($id);
            
            }else $message= 'Error';

            $this->set(array
            ('message'=>$message,
            '_serialize'=>array('message'))
            );

        }
        public function edit($id){

            $request = $this->request->data;

            $this->User->id = $id;
            $this->User->Save($request);

            $findId = $this->User->findById($id);

            $this->set(array(
                    'message'=>$findId,
                    '_serialize'=>array('message')
                ));


        }
	
	} 