<?php 
class PostsController extends Controller{
    public function index(){
        $post = new Post;
        if (isset($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
        }else{
            $page = "1";
        }
        //$posts=$post->all();
        $perpage= 4;
        $numRows=$post->count();
        $numPages=ceil($numRows/$perpage);
        $offset = ($page-1)*$perpage;
        $categorias = Categorias::all();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sanitize = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $post->loadData($sanitize);
            $post->categoria_id = $_POST['category'];

            $posts=Post::where('categoria_id', $post->categoria_id)->offset($offset)->limit($perpage)->get();
            //die($posts);
            $this->view('index.html',['posts'=>$posts,'numpages'=>$numPages,'page'=>$page, 'categorias'=>$categorias]);

        }else{
            $posts=$post->offset($offset)->limit($perpage)->get();
            $this->view('index.html',['posts'=>$posts,'numpages'=>$numPages,'page'=>$page, 'categorias'=>$categorias]);

        }
    
    }
    public function read($id){
        $posts = Post::where('id', $id)->find($id);

        $coments = Coment::with('user')->where('post_id', $id)->get();
        $this->view('llread.html',['post'=>$posts, 'coments'=>$coments]); 
    
    }

    public function delete($id){
        if (isset($_SESSION['is_logged_in'])) {
                $post = new Post;
                $datosPost = $post->where('id', $id)->find($id);
                if(($_SESSION['user_data']['rol']== 2) || ($datosPost->user_id == $_SESSION['user_data']['id'])){//admin o propietario
                    $posts = $post->destroy($id);
                    if($_SESSION['user_data']['rol']== 2){
                        header('location:'. ROOT_PATH."admin/admin");
                    }else{
                        header('location:'. ROOT_PATH."escritor/escritor");
                    }
                }else{
                    header('location:'. ROOT_PATH);
                }
            }else{
                header('location:'. ROOT_PATH);

                $error = 'You are not logged';
                Messages::setMsg($error,'error');
            }

    }

    public function add() {
         if (isset($_SESSION['is_logged_in'])) { 
             if($_SESSION['user_data']['rol'] == 0){
                header('location:'. ROOT_PATH);
             }      
             if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                 $sanitize = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                 $post=new Post;

                 $post->loadData($sanitize);


                     if ($post->validate()) {
                         $post->categoria_id = $_POST['select']; 
                         $post->user_id = $_SESSION['user_data']['id'];           
                         $post->save();

                         if(!is_uploaded_file($_FILES['foto']['tmp_name'])){
                            $error = 'There was no file uploaded';
                        Messages::setMsg($error,'error');
                            $this->view('add.html');
                            return;
                        }
                        $uploadfile = $_FILES['foto']['tmp_name'];
                        $uploaddata['filedata'] = file_get_contents($uploadfile);
                        $uploaddata['filename'] = $_FILES['foto']['tmp_name'];
                        $uploaddata['mimetype'] = $_FILES['foto']['tmp_name'];
                        $file = new Files;
                        $file->loadData($uploaddata);
                            if($file->validate()){
                                $post->files()->save($file);
                            }else{
                                $error = 'There was an error while uploading the file';
                            }

                         if($_SESSION['user_data']['id']== 2){
                            header('location:'. ROOT_PATH."admin/admin");
                        }else{
                            header('location:'. ROOT_PATH."escritor/escritor");
                        }
                     }
             } else {
                 $categorias = Categorias::all();
                 $model= new Post;
                 $posts = $model->all();
                 $this->view('add.html',['categorias'=>$categorias]);
             }
        }else{
            header('location:'. ROOT_PATH);
        }
    }


public function edit($id){
   //if($_SESSION['user_data']['id'] != array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0]){
   //        header('Location:' . ROOT_PATH.$id);
   //}
   if (isset($_SESSION['is_logged_in'])) { //log

        if( ($_SESSION['user_data']['rol']!= 0)){// admin o escritor

        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $idPost = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];
                $post = Post::where('id', $idPost)->find($idPost);
                //die($post);
                $titulo = $_POST['titulo'];
                $contenido = $_POST['contenido'];
                $categoria = $_POST['categoria'];
                $post->update(['titulo'=> $titulo, 'contenido'=> $contenido, 'categoria'=>$categoria]);
                if($_SESSION['user_data']['rol']== 2){
                    header('location:'. ROOT_PATH."admin/admin");
                }else{
                    header('location:'. ROOT_PATH."escritor/escritor");
                }
            }else{
                $posts = new Post;
                $post = $posts->where('id', $id)->find($id);
                $categorias = Categorias::all();
                $this->view('edit.html',['post'=>$post, 'categorias'=>$categorias]);
            }
        }else{
            header('location:'. ROOT_PATH);
        }
    }else{
        header('location:'. ROOT_PATH);
    }
}

}
?>