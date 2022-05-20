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
        $posts=$post->offset($offset)->limit($perpage)->get();
        
        $this->view('index.html',['posts'=>$posts,'numpages'=>$numPages,'page'=>$page]);
    }
    public function read($id){
        //$posts = Post::with('coments')->where('id',$id)->get();
        //die($posts);
        $posts = Post::where('id',$id)->find(1);
        

        $coments = Coment::with('user')->where('post_id', $id)->get() ;
        //$user = User::all();
        //die($coments);
        //print_r($posts);
        //die($posts);
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
            
                if ($post->validate()) {
                    $post->categoria_id = $_POST['select'];                    
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