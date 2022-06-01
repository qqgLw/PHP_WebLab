<?php

class AdminController extends Controller{
    function authenticate(){
        if (!isset($_SESSION['isAdmin'])) {
            header('Location:/admin/auth/index');
            exit;
        }
    }
}
   