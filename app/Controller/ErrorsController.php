<?php
class ErrorsController extends AppController {

    public $components = array('RequestHandler');

    public function index() {
        $message = array("status" => "error", "message" => "You don't have permission to access.");
		$this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

}

?>