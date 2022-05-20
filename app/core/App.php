<?php
class App
{
    protected $controller = 'Posts';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        $url[0] = isset($url[0]) ? ucfirst($url[0]) : 'Posts';

        if (file_exists('app/controllers/' . $url[0] . 'Controller.php')) {
            $name = $url[0];
            $this->controller = $url[0] . 'Controller';
            //die($name.'xxx'.$this->controller); //--> PostsxxxPostsController
            $this->controller = new $this->controller($name);
            unset($url[0]);
        }

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        if (isset($_POST) && !empty($_POST)) {
            $this->params = $_POST;
        }

         //die($this->controller." XX ". $this->method. " XX ".array_values($this->params)); //->> Posts XX index XX Array
        call_user_func_array([$this->controller, $this->method], array_values($this->params));
    }
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return $url;
        }
    }
}
