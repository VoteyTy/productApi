<?php 
	class CategoriesController extends AppController
    {
		public $components = array('RequestHandler');

		public function index()
		{
			$categories = $this->Category->find('all'); 
        	$this->set(array(
            	'categories' => $categories,
            	'_serialize' => array('categories')
        	));
		}
	} 