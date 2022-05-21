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
        $perpage= 10;
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

        $coments = Coment::with('user')->where('post_id', $id)->get() ;
        $this->view('read.html',['post'=>$posts, 'coments'=>$coments]); 
    
    }

    public function delete($id){
        //if (isset($_SESSION['is_logged_in'])) {
        $post = new Post;
        $posts = $post->destroy($id);
       header('location:'. ROOT_PATH);
    //}else{
    //    header('location:'. ROOT_PATH);
//
    //    $error = 'You are not logged';
    //    Messages::setMsg($error,'error');
    //}
  
    }

    public function add() {
    //if (isset($_SESSION['is_logged_in'])) {       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sanitize = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $post=new Post;
            
            $post->loadData($sanitize);
            
            
                if ($post->validate()) {
                    $post->categoria_id = $_POST['select']; 
                    $post-> $_SESSION['user_data']['id'];           
                    $post->save();
                    header('location:'. ROOT_PATH);
                }
                
        } else {
            $categorias = Categorias::all();
            $model= new Post;
            $posts = $model->all();
            $this->view('add.html',['categorias'=>$categorias]);
        }
   //}else{
   //    header('location:'. ROOT_PATH);

   //    $error = 'You are not logged';
   //    Messages::setMsg($error,'error');
   //}
}

public function edit($id){
   // if($_SESSION['user_data']['id'] != array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0]){
   //         header('Location:' . ROOT_PATH.$id);
   // }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idPost = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];
            $post = Post::where('id', $idPost)->find($idPost);
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $categoria = $_POST['categoria'];
            //die($post);
            //die($titulo."XXX".$contenido."XXX".$categoria);
            $post->update(['titulo'=> $titulo]);
            //die($post->update(['titulo'=> $titulo, 'contenido'=> $contenido, 'categoria_id'=> $categoria]));
            header('location:'. ROOT_PATH."admin/admin/");
        }else{
            $posts = new Post;
            $post = $posts->where('id', $id)->find($id);
            $categorias = Categorias::all();
            $this->view('edit.html',['post'=>$post, 'categorias'=>$categorias]);
        }
}

}
?>