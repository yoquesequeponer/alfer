<?php 

class ComentsController extends Controller {


      
    public function index(){
        $coment = new Coment;
        $coments=$coment->all();
        
        $this->view('index.html',['coments'=>$coments]); 

    }

    public function add($id){
        //die($id);

       // if (isset($_SESSION['is_logged_in'])) {       
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $coment=new Coment;
                $coment->post_id = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];  
                $coment->user_id =  $_SESSION['user_data']['id'];
                
                $coment->loadData($post);
                //die(print_r($post));
                
                    if ($coment->validate()) { 
                        $coment->contenido = $_POST['contenido'];
                        $coment->save();
                        header('location:'. ROOT_PATH);
                        }
       
           } else {
              
               $model= new Coment;
               $coment = $model->all();
               $this->view('add.html');
           }    
    }

    public function delete(){
        //if (isset($_SESSION['is_logged_in'])) {       
            $coment = new coments;
            $coments = $coment->destroy($id);
           header('location:'. ROOT_PATH);
         // }else{
         //   header('location:'. ROOT_PATH);
         //
         //   $error = 'You are not logged';
         //   Messages::setMsg($error,'error');
         //   }
    
    }

    public function edit($id){
        $coment = new Coment;
        $coment = $coment->get($id);
        return $coment;
    }
}
?>