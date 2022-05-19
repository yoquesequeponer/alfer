<?php 
class UsersController extends Controller{
    public function register(){
        // Controlar que las dos contraseñas son iguales
        $user= new User;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $pwd = md5($post['password']);
            $post['password']=$pwd;

            $user->loadData($post);
            if($user->validate()){
                $user->save();
                header('Location:' . ROOT_PATH);
            }
        }else{
            Messages::setMsg('Incorrect Register', 'error');
            $this->view('register.html', ['user' => $user]);

        }
    }
    public function login(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $user= new User;
            $post['password']= md5($post['password']);
            $user=$user->where('correo','=',$post['correo'])->first();

            
            if ($user['password']==$post['password']){
                
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                "id" =>$user->id,
                "name"=> $user->userName,
                "correo" =>$user->correo,);
                header('Location:' . ROOT_PATH);
            }else{
                Messages::setMsg('Incorrect Login', 'error');

                $this->view('login.html', ['user' => $user]);

            }
        }else{
            $user= new User;
            $this->view('login.html', ['user' => $user]);
        }

    }
    public function logout(){
        unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_data']);
		session_destroy();
        header('Location:' . ROOT_PATH);
    }
}

?>