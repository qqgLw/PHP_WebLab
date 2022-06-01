<?php
require 'app/core/admin_controller.php';
class AdminAuthController extends AdminController
{
    function index() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //$this->model->validate($_POST);
            //if ($this->model->validator->isTestValid())
            //{
            $this->authorize();//}
            
        }
        $this->view->render("auth/index.php", "Авторизация администратора", $this->model, "_admin_layout.php");
    }

    function authorize()
    {
        echo 'test';
        if (isset($this->model->bufferedFields['password']))
        {
            echo md5($this->model->bufferedFields['password']);
        }
        if (($this->model->bufferedFields['email']=='admin@gmail.com') &&
        (md5($this->model->bufferedFields['password'])=='21232f297a57a5a743894a0e4a801fc3')) 
        {
            $_SESSION['isAdmin']=1;
            header('Location:/admin/home/index');
            exit;
        }
        $_SESSION['isAdmin']=0;
    }
}