<?php
require 'app/entities/user.php';
class AuthController extends Controller
{
    function index() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $this->model->validate($_POST);
            if ($this->model->validator->isTestValid())
            {
                $this->login();
            }
        }
        else 
        {
            unset($_SESSION['LastError']);
        }
        $this->view->render("auth/index.php", "Авторизация пользователя", $this->model);
    }
    
    function register() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $this->model->validate($_POST);
            if ($this->model->validator->isTestValid())
            {
                $this->createUser();
                header('Location:/auth/index');
                exit;
            }
        }
        $this->view->render("auth/register.php", "Регистрация пользователя", $this->model);
    }

    function logout()
    {
        if (isset($_SESSION['Logged']))
        {
            unset($_SESSION['Logged']);
            unset($_SESSION['FIO']);
        }
        session_destroy();
        header('Location:/auth/index');
        exit;
    }

    function login()
    {
        if (isset($_SESSION['Logged']))
        {
            header('Location:/home/index');
            exit;
        }
        $user = new UserRecord();
        print_r($this->model->bufferedFields);
        $user = UserRecord::findByLogin($this->model->bufferedFields['login']);
        if ($user != NULL)
        {
            if (md5($this->model->bufferedFields['password']) == $user->password)
            {
                $_SESSION['Logged'] = 1;
                $_SESSION['FIO'] = $user->fio;
                unset($_SESSION['LastError']);
                header('Location:/home/index');
                exit;
            }
            else 
            {
                $_SESSION['LastError'] = 'WrongPass';
                return;
            }
        }
        else
        {
            $_SESSION['LastError'] = 'WrongUser';
            return;
        }
    }

    function createUser()
    {
        $model = $this->model;
        $user = new UserRecord();
        $otherUser = UserRecord::findByLogin($model->login);
        if ($otherUser != NULL)
        {
            header('Location:/auth/register');
            header('Error:UserExists');
            exit;
        }
        $user->fio = $model->bufferedFields['fio'];
        $user->password = md5($model->bufferedFields['password']);
        $user->email = $model->bufferedFields['email'];
        $user->login = $model->bufferedFields['login'];
        $user->save();
    }
}