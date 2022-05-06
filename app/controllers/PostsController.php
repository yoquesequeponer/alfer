<?php 

class PostsController extends Controller{
    public function index(){
        $post = new posts;
        if (isset($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
        }else{
            $page = "1";
        }
        //$posts=$post->all();
        $perpage= 2;
        $numRows=$post->count();
        $numPages=ceil($numRows/$perpage);
        $offset = ($page-1)*$perpage;
        $posts=$post->offset($offset)->limit($perpage)->get();
        
        $this->view('index.html',['posts'=>$posts,'numpages'=>$numPages,'page'=>$page]); 
    }
    public function read($id){
      
        $model = new posts;
        $posts = $model->find($id);
       
        $this->view('read.html',['posts'=>$posts]); 
    }

    public function delete($id){
        if (isset($_SESSION['is_logged_in'])) {       
        $post = new posts;
        $posts = $post->destroy($id);
       header('location:'. ROOT_PATH);
    }else{
        header('location:'. ROOT_PATH);

        $error = 'You are not logged';
        Messages::setMsg($error,'error');
    }
  
    }

    public function add() {
    if (isset($_SESSION['is_logged_in'])) {       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $post=new posts;
            
            $post->loadData($post);
            
                if ($post->validate()) {               
                    $post->save();
                    if(!is_uploaded_file($_FILES['cover']['tmp_name'])){
                        $error = 'There was no file uploaded';
                    Messages::setMsg($error,'error');
                        $this->view('add.html');
                        return;
                    }
                    $uploadfile = $_FILES['cover']['tmp_name'];
                    $uploaddata['filedata'] = file_get_contents($uploadfile);
                    $uploaddata['filename'] = $_FILES['cover']['tmp_name'];
                    $uploaddata['mimetype'] = $_FILES['cover']['tmp_name'];
                    $file = new Files;
                    $file->loadData($uploaddata);
                        if($file->validate()){
                            $post->files()->save($file);
                        }else{
                            $error = 'There was an error while uploading the file';
                        }
                    header('location:'. ROOT_PATH);
                    }
                
        } else {
            $model= new posts;
            $posts = $model->all();
            $this->view('add.html');
        }
    }else{
        header('location:'. ROOT_PATH);

        $error = 'You are not logged';
        Messages::setMsg($error,'error');
    }
}

}
?>