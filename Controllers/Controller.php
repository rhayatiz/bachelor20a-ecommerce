<?php
class Controller{

    protected $viewPath = './views/';

    public function render($view, $data = []){
        // DEBUGGING
        // echo "opening ".$this->viewPath . str_replace('.', '/', $view). '.php';
        // die();
        ob_start();
        extract($data);
        require($this->viewPath . str_replace('.', '/', $view). '.php');
    }

}