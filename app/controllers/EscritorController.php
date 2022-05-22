<?php 
class EscritorController extends UsersController{

    public function Escritor(){
        if($_SESSION['user_data']['rol'] == 0){
            header('location:'. ROOT_PATH);
        }
        $user = new User;
        $users = $user->find($_SESSION['user_data']['id']);

        $post = new Post;
        $posts = $post->where('user_id',$_SESSION['user_data']['id'])->get();

        $coment = new Coment;
        $coments=$coment->where('user_id',$_SESSION['user_data']['id'])->get();



        $this->view('escritor.html',['users'=>$users, 'posts'=> $posts, 'coments'=>$coments]);
        
    }

}
