<?php 

class ComentsController extends Controller {


      
    public function index(){
        $coment = new Coment;
        $coments=$coment->all();
        
        $this->view('index.html',['coments'=>$coments]); 

    }

    public function add(){
        if(isset($_SESSION['is_logged_in'])){
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
        }else{
            header('location:'. ROOT_PATH);
        }   
    }

    public function delete($id){

            if (isset($_SESSION['is_logged_in'])) {
                $coment = new Coment;
                $comentario = Coment::where('id',$id)->first();
                if($comentario->user_id == $_SESSION['user_data']['id']){//propietario
                    $coments = $coment->destroy($id);
                }elseif($_SESSION['user_data']['id']== 2){//admin
                    $coments = $coment->destroy($id);
                }

               header('location:'. ROOT_PATH."posts/read/".$comentario->post_id);


              }else{
                header('location:'. ROOT_PATH);
            
                $error = 'You are not logged';
                Messages::setMsg($error,'error');
            }
            
    }

    public function edit($id){
       

        if (isset($_SESSION['is_logged_in'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {                  
                $idcoment = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];
                $coment = Coment::where('id', $idcoment)->find($idcoment);
                $idPost = $coment->post_id;

                if($coment->user_id == $_SESSION['user_data']['id']){//propietario
                    $contenido = $_POST['contenido'];
                    $coment->update(['contenido'=> $contenido]);
                }else{
                    exit();
                }

                if($_SESSION['user_data']['id']== 2){
                    header('location:'. ROOT_PATH."admin/admin/".$idPost);
                }elseif($_SESSION['user_data']['id']== 1){
                    header('location:'. ROOT_PATH."escritor/escritor/".$idPost);
                }else{
                    header('location:'. ROOT_PATH."users/user/".$idPost);
                }
            }else{
                $coments = new Coment;
                $coment = $coments->where('id', $id)->find($id);
                $this->view('edit.html',['coment'=>$coment]);
            }
        }else{
            header('location:'. ROOT_PATH);
        }
    }

}
?>