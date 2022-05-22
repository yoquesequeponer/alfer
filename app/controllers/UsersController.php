<?php 
class UsersController extends Controller{
    public function register(){
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
                "userName"=> $user->userName,
                "correo" =>$user->correo,
                "name" => $user->nombre,
                "apellido" => $user->apellido,
                "rol"=> $user->rol
                
            );
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

    public function edit($id){
        if( ($_SESSION['user_data']['id'] != array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0]) && ($_SESSION['user_data']['id'] != 2) ){// si no eres propietario ni admin
            //die("salho")
            header('Location:' . ROOT_PATH);
        }// else -> eres o admin o propietario
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            //die("poS");
                $idUsuario = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];
                $user = User::where('id', $idUsuario)->find($idUsuario);
                $username = $_POST['username'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo =$_POST['correo'];
                if($user->password != md5($_POST['password'])){
                    $password = $_POST['password'];
                }else{
                    $password = md5( $_POST['password']);
                }
                $_SESSION['user_data'] = array(
                    "id" =>$idUsuario,
                    "userName"=> $username,
                    "correo" =>$user->correo,
                    "name" => $user->nombre,
                    "apellido" => $apellido,
                );
    
                $user->update(['userName'=> $username, 'nombre'=> $nombre, 'apellido'=> $apellido, 'password'=> $password, 'correo'=> $correo]);
                //die($user);
                if($_SESSION['user_data']['rol']== 2){
                    header('location:'. ROOT_PATH."admin/admin");
                }elseif($_SESSION['user_data']['rol']== 1){
                    header('location:'. ROOT_PATH."escritor/escritor");
                }else{
                    header('location:'. ROOT_PATH."users/user");
                }
            }else{
                $users = new User;
                $user = $users->where('id', $id)->find($id);
                //die($user);
                $this->view('edit.html',['user'=>$user]);
            }
    }

    public function user(){
        //if($_SESSION['user_data']['rol'] == 0){
        //    header('location:'. ROOT_PATH);
        //}
        $user = new User;
        $users = $user->find($_SESSION['user_data']['id']);

        $coment = new Coment;
        $coments=$coment->where('user_id',$_SESSION['user_data']['id'])->get();



        $this->view('user.html',['users'=>$users, 'coments'=>$coments]);
        
    }
}

?>