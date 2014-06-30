<?php 
    class ProductsController extends AppController{

		public $components = array('RequestHandler');
        public function index(){
            $products = $this->Product->find('all');
            $this->set(array(
                'products' => $products,
                '_serialize' => array('products')
            ));
        }
        public function view($id)
        {
            $products = $this->Product->findById($id); 
            $this->set(array(
                'products' => $products,
                '_serialize' => array('products')
             ));

        }
        public function add() {
            if ($this->request->is('post')) {
                //print_r($this->request->data);
                $message = "fail";  
                try
                {
                    $fileName = "";
                    if (isset($_FILES['file']))// file is name we can put whatever we want
                    {
                        //$fileName = explode('.', $_FILES['file']["name"]);// return as array
                        //$newFileName = uniqid().'.'.end($fileName);//uniqid() is random name of image
                        //move_uploaded_file($_FILES['file']["tmp_name"], WWW_ROOT.DS.'product'.DS.$newFileName);
                        move_uploaded_file($_FILES['file']["tmp_name"], WWW_ROOT.DS.'product'.DS.$this->request->data['image']);
                    }

                    $post_data = $this->request->data;
                    //$post_data['image'] = $newFileName;
                    $respondSave = $this->Product->save($post_data);

                    if ($respondSave) $message = "success";
                    $respond = array("status"=>$message, "data"=>$respondSave);

                    $this->set(array(
                        'respond' => $respond,
                        '_serialize' => array('respond')
                    ));
                }
                catch (Exception $e)
                {
                    $respond = array("status"=>$message, "data"=>$post_data);
                    $this->set(array(
                        'respond' => $respond,
                        '_serialize' => array('respond')
                    ));
                }
            }
        }
        public function delete($id)
        {
            if ($this->Product->delete($id)) {
                $message = 'Deleted';
                unlink(WWW_ROOT.'product'.DS.$this->data['image']);
                echo WWW_ROOT.'product'.DS.$this->data['image'];
            } else {
                $message = 'Error';
            }
            $this->set(array(
                'message' => $message,
                '_serialize' => array('message')
            ));
        }

        public function edit($id)
        {
            if ($this->request->is('post'))
            {
                $findId = '';
                if (isset($_FILES['file']))// file is name we can put whatever we want
                {
                    //print_r($this->request->data);
                    // $movefile = move_uploaded_file($_FILES['file']["tmp_name"], WWW_ROOT.DS.'product'.DS.$this->request->data['image']);
                    // if ($movefile) 
                    // {
                    //    unlink(WWW_ROOT.'product'.DS.$this->data['image']);
                    // }else
                    // {
                    // move_uploaded_file($_FILES['file']["tmp_name"], WWW_ROOT.DS.'product'.DS.$this->request->data['image']);
                    //   $message = 'success';   
                    // }
                    // $sql = "select image from products where id =".$id;
                    // $product = $this->Product->query($sql);
                    // print_r($product);

                    $product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$id), 'fields'=>array('Product.image')));
                    print_r($product);

                      unlink(WWW_ROOT.'product'.DS.$product['Product']['image']); 

                     move_uploaded_file($_FILES['file']["tmp_name"], WWW_ROOT.DS.'product'.DS.$this->request->data['image']);
                }
                $request = $this->request->data;
                $this->Product->id = $id;
                $this->Product->Save($request);
                $findId = $this->Product->findById($id);

                $this->set(array(
                        'message'=>$findId,
                        '_serialize'=>array('message')
                    ));
            }
            else if ($this->request->is('put'))
            {
                
                $message = 'Error';
            }
        }
    }