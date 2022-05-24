<?php 
class UsersController extends Controller{
    public function register(){
        $user= new User;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(empty($user->where('correo',$post['correo'])->get())){
                header('Location:' . ROOT_PATH."users/register");
                exit();
            }
            $pwd = md5($post['password']);
            $post['password']=$pwd;

            $user->loadData($post);
            if($user->validate()){
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
                $file = new FileUser;
                $file->loadData($uploaddata);
                    if($file->validate()){
                                        $user->save();

                        $user->files()->save($file);
                    }else{
                        $error = 'There was an error while uploading the file';
                    }

                header('Location:' . ROOT_PATH);
            }
        }else{
            $this->view('register.html');

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
            if($_SESSION['user_data']['rol']== 2){
                header('location:'. ROOT_PATH."admin/admin");
            }else{
                header('location:'. ROOT_PATH."escritor/escritor");
            }
            header('location:'. ROOT_PATH."users/user");

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
        if(isset($_SESSION['is_logged_in'])){
        if( ($_SESSION['user_data']['id'] != array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0]) && ($_SESSION['user_data']['id'] != 2) ){// si no eres propietario ni admin
            //die("salho")
            header('Location:' . ROOT_PATH);
        }// else -> eres o admin o propietario
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $idUsuario = array_slice(explode('/', rtrim($_GET['url'], '/')), -1)[0];
                $user = User::where('id', $idUsuario)->find($idUsuario);
                $username = $_POST['username'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $user->correo;

                if($user->password != md5($_POST['password'])){
                    $password = $_POST['password'];
                }else{
                    $password = md5( $_POST['password']);
                }
                $_SESSION['user_data'] = array(
                    "id" =>$idUsuario,
                    "userName"=> $username,
                    "correo" => $correo,
                    "name" => $user->nombre,
                    "apellido" => $apellido,
                );
                if(!is_uploaded_file($_FILES['foto']['tmp_name'])){
                    $error = 'There was no file uploaded';
                                                    $user->update(['userName'=> $username, 'nombre'=> $nombre, 'apellido'=> $apellido, 'password'=> $password, 'correo'=> $correo]);

                if($_SESSION['user_data']['rol']== 2){
                    header('location:'. ROOT_PATH."admin/admin");
                }elseif($_SESSION['user_data']['rol']== 1){
                    header('location:'. ROOT_PATH."escritor/escritor");
                }else{
                    header('location:'. ROOT_PATH."users/user");
                }


                    return;
                }
                $uploadfile = $_FILES['foto']['tmp_name'];
                $uploaddata['filedata'] = file_get_contents($uploadfile);
                $uploaddata['filename'] = $_FILES['foto']['tmp_name'];
                $uploaddata['mimetype'] = $_FILES['foto']['tmp_name'];
                $file = new FileUser;
                //$file = $files->where('user_id',$idUsuario)->find($idUsuario);
                //die(print_r($uploaddata));
                        $user->files()->update(['filedata'=>$uploaddata['filedata'] ,'filename'=> $uploaddata['filename'],'mimetype'=> $uploaddata['mimetype']]);


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
                $this->view('edit.html',['user'=>$user]);
            }
        }else{
            header('location:'. ROOT_PATH."users/login");
        }
    }

    public function user(){
                if(isset($_SESSION['is_logged_in'])){

        $user = new User;
        $users = $user->find($_SESSION['user_data']['id']);

        $coment = new Coment;
        $coments=$coment->where('user_id',$_SESSION['user_data']['id'])->get();
        $this->view('user.html',['users'=>$users, 'coments'=>$coments]);
        
    }else{
                   header('location:'. ROOT_PATH."users/login");
 
    }
    }
}

?>