<?php 
class AdminController extends UsersController{

    public function admin(){
        if($_SESSION['user_data']['rol'] != 2){
            header('location:'. ROOT_PATH);
        }
        $user = new User;
        $users = $user->all();
        $usuario = $user->find($_SESSION['user_data']['id']);

        $post = new Post;
        $posts = $post->all();

        $coment = new Coment;
        $coments=$coment->all();

        $categorias = Categorias::all();
        

        $this->view('admin.html',['users'=>$users, 'posts'=> $posts, 'coments'=>$coments, 'categorias'=>$categorias, 'usuario'=> $usuario]);
    }




    public function rol($id){
        if($_SESSION['user_data']['rol'] != 2){
            header('location:'. ROOT_PATH);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sanitize = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $idUsuario = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];
            $users = new User;
            $user = $users->where('id', $idUsuario)->update(['rol'=>$_POST['select']]);
            header('location:'. ROOT_PATH."admin/admin/");
        }else{
            $users = new User;
            $user = $users->where('id', $id)->find($id);
            $this->view('rol.html',['user'=>$user]);
        }
    }

    public function addCategory(){
        if($_SESSION['user_data']['rol'] != 2){
            header('location:'. ROOT_PATH);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sanitize = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $category = new Categorias;            
            
                    $category->descripcion = $_POST['descripcion'];
                    $category->save();
                    header('location:'. ROOT_PATH."admin/admin/");
   
       } else {
           $this->view('categoria.html');
       }    

    }

    public function mod($id){
        if($_SESSION['user_data']['rol'] != 2){
            header('location:'. ROOT_PATH);
        }
        $user = new User;
        $user->edit($id);
    }

}
