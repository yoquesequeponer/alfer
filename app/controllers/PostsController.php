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
        $post = new Posts;
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
            die($post);
            
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

}
?>