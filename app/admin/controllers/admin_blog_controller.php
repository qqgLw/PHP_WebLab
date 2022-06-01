<?php
require 'app/core/admin_controller.php';
require 'app/entities/blog.php';
class AdminBlogController extends AdminController
{
    protected static $imagesPath = 'app/stored/images/';
    
    function index() 
    {        
        $this->authenticate();

        $this->loadBlog();
        $this->view->render("blog/index.php", "Мой блог", $this->model, "_admin_layout.php");
    }
    function add()
    {
        $this->authenticate();

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $this->model->validate($_POST);
            if ($this->model->validator->isTestValid())
            {
                $this->addNewMessage();
            }
        }
        $this->loadBlog();
        $this->view->render("blog/add.php", "Редактор блога", $this->model, "_admin_layout.php");
    }

    function load()
    {
        $this->authenticate();

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $this->loadNewMessagesFile();
        }
        $this->view->render("blog/load.php", "Загрузка сообщений блога", $this->model, "_admin_layout.php");
    }
    
    function loadBlog() 
    {
        $blogRecord = new BlogRecord();
        $page = 0;
        $pageSize = 5;
        if (isset($_GET['page']) && isset($_GET['page_size']))
        {
            $page = $_GET['page'];
            $pageSize = $_GET['page_size'];
            $records = $blogRecord->findPage($pageSize,$page);
        }
        else 
        {
            $records = $blogRecord->findPage(5,0);
        }
        
        if ($records != null)
        {
            foreach ($records as $record) {
                array_push($this->model->blogs, $record);
            }
            usort($this->model->blogs, function ($a, $b) {
                return strcmp($a->date, $b->date);
            });
            $this->model->page = $page;
            $this->model->pageSize = $pageSize;
            $this->model->maxPages = intdiv($blogRecord->count() - 1, $pageSize) + 1;
        }
    }

    function addNewMessage()
    {
        $model = $this->model;
        $imgPath = '';
        if (strlen($_FILES["image"]["tmp_name"]) > 0)
        {
            $imgGuid = $this->getGUID();
            $imgPath = static::$imagesPath.$imgGuid.'.png';
            $source = $_FILES["image"]["tmp_name"];
            if (!move_uploaded_file($source, $imgPath)) 
            { 
                echo $_FILES["image"]["tmp_name"];
                echo("Ошибка загрузки файла!");
            }
        }
        $record = new BlogRecord();
        $record->author = $model->bufferedFields['author'];
        $record->date = date("Y/m/d h:i:sa");
        if (isset($imgPath))
            $record->imageGUID = $imgPath;
        $record->message = $model->bufferedFields['message'];
        $record->subject = $model->bufferedFields['subject'];
        $record->save();
    }

    function loadNewMessagesFile()
    {
        $source = $_FILES["messages"]["tmp_name"];
        $dest = '';
        $lines = file($source);
        if ($lines)
        {
            foreach ($lines as $line)
            {
                $record = new BlogRecord();
                $explodedLine = explode(",", $line);
                if (!empty($explodedLine[0]))
                {
                    $record->subject = $explodedLine[0];
                }
                if (!empty($explodedLine[1]))
                {
                    $record->message = $explodedLine[1];
                }
                if (!empty($explodedLine[2]))
                {
                    $record->author = $explodedLine[2];
                }
                if (!empty($explodedLine[3]))
                {
                    $record->date = $explodedLine[3];
                }
               $record->save();
            }
        }
    }

    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }
        else {
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid =
                 substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
            return $uuid;
        }
    }
}