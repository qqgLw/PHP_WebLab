<?php
require 'app/core/admin_controller.php';
class AdminHomeController extends AdminController
{
    function index() 
    {
        $this->authenticate();
        $this->view->render("home/index.php", "Главная", $this->model, "_admin_layout.php");
    }

    function logout() {
        unset($_SESSION['isAdmin']);
        header('Location:/admin/auth/index');
        exit;
    }
}