<?php 

class ComentsController extends Controller {


      
    public function index(){
        $coment = new Coment;
        $coments=$coment->all();
        
        $this->view('index.html',['coments'=>$coments]); 

    }

    public function add(){
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
                        header('location:'. ROOT_PATH."posts/read/".$coment->post_id);
                    }
       
           } else {
              
               $model= new Coment;
               $coment = $model->all();
               $this->view('add.html');
           }    
    }

    public function delete($id){

        if (isset($_SESSION['is_logged_in'])) {
            $coment = new Coment;
            $idUser = Coment::where('id',$id)->first();
            if($idUser->user_id == $_SESSION['user_data']['id']){
                $coments = $coment->destroy($id);
            }

           header('location:'. ROOT_PATH."posts/read/".$idUser->post_id);


          }else{
            header('location:'. ROOT_PATH);
         
            $error = 'You are not logged';
            Messages::setMsg($error,'error');
            }
    
    }

    public function edit($id){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            
            $idPost = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];
            $coment = Coment::where('id', $idPost)->find($idPost);
            $contenido = $_POST['contenido'];
            $coment->update(['contenido'=> $contenido]);
            header('location:'. ROOT_PATH."admin/admin/");
        }else{
            $coments = new Coment;
            $coment = $coments->where('id', $id)->find($id);
            $this->view('edit.html',['coment'=>$coment]);
        }
}

}
?>