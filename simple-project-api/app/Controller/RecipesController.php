<?php
class RecipesController extends AppController {

    public $components = array('RequestHandler');

    public function index() {
        $recipes = $this->Recipe->find('all'); // view all data From DB
        $this->set(array(
            'recipes' => $recipes,
            '_serialize' => array('recipes')
        ));
    }

    public function view($id) {
        $recipe = $this->Recipe->findById($id); // view data only ID that input from DB
        $this->set(array(
            'recipe' => $recipe,
            '_serialize' => array('recipe')
        ));
    }

    public function edit($id){

        $requests = $this->request->data; 
        

        $this->Recipe->id = $id;
        $this->Recipe->save($requests); 
        
        $findID = $this->Recipe->findById($id);
        
    	$this->set(
                array(
                    'message'=>$findID,
            		'_serialize'=>array('message')
                )
    		);
    }

    public function delete($id){

    	//$RecipeSave = $this->Recipe->save;

    	if ($this->Recipe->delete($id)) 
    	{
    		$message = 'Delete Successfully';
    	}else
    	{
    		$message = 'Error';
    	}

    	$this->set(array
    		('message'=>$message,
    		'_serialize'=>array('message'))
    		);
    }

    public function add(){

        $requests = $this->request->data ;

        if ($this->Recipe->save($requests)) {

            $id = $this->Recipe->getInsertID();
            //$message = "Successfully";
            $message= $this->Recipe->findById($id);
            
        }else $message= 'Error';

        $this->set(array
            ('message'=>$message,
            '_serialize'=>array('message'))
            );

    }

}
?>