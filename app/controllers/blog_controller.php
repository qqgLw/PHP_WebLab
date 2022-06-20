<?php
require __DIR__.'/../core/active_record.php';
require 'app/entities/blog.php';
require 'app/entities/comment.php';
require 'app/entities/user.php';

class BlogController extends Controller
{
    protected static $imagesPath = 'app/stored/images/';
    
    function index() 
    {
        $this->loadBlog();
        $this->view->render("blog/index.php", "Мой блог", $this->model, "layout.php");
    }
    function add()
    {
        if (!isset($_SESSION['isAdmin'])) {
            header('Location:/admin/auth/index');
            exit;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $this->model->validate($_POST);
            if ($this->model->validator->isTestValid())
            {
                $this->addNewMessage();
            }
        }
        $this->loadBlog();
        $this->view->render("blog/add.php", "Редактор блога", $this->model, "layout.php");
    }

    function load()
    {
        if (!isset($_SESSION['isAdmin'])) {
            header('Location:/admin/auth/index');
            exit;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $this->loadNewMessagesFile();
        }
        $this->view->render("blog/load.php", "Загрузка сообщений блога", $this->model, "layout.php");
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
            $this->model->comments = $this->getAllBlogComments();
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

    function getAllBlogComments(){
        $result = [];
        $messages = $this->model->blogs;
        if (!empty($messages)){
            foreach ($messages as $message) {
                $blogComments = [];
                $comments = CommentRecord::blogComments($message->id);
                if ($comments) {
                    foreach ($comments as $comment) {
                        //$author = UserRecord::find($comment->author_id);
                        //$comment['author'] = $author->fio;
                        $blogComments[] = $comment;
                    }
                    $result[$message->id] = $blogComments;
                }
            }
        }
        return $result;
    }

    function loadComment()
    {
        session_start();
        $valid = (isset($_POST["commentText"]) && isset($_POST["publicationId"]) && isset($_POST["publicationId"]) && isset($_SESSION["userId"]));
        if (!$valid) {
            http_response_code(400);
        } else {
            $commentText = $_POST["commentText"];
            $publicationId = $_POST["publicationId"];
            $userId = $_SESSION["userId"];

            $comment = new CommentRecord();
            $comment->blog_id = (int)$publicationId;
            $comment->author_id = (int)$userId;
            $comment->text = $commentText;
            $comment->created = date("Y/m/d h:i:sa");
            $comment->save();

            $author = $_SESSION['FIO'];
            $respose = "<p><small style=\"color: #ffa113;\">
            <b>$author</b></small></p>
            <p>$comment->text</p>
            <p>$comment->created</p>
            <hr>";

            header('Content-Type: text/html; charset=UTF-8');
            echo $respose;
            http_response_code(200);
        }
        exit;
    }

    function addCommentToBlog(){

    }

    function getPublicationInfo()
    {
        $id = $_POST['blogId'];
        if(!isset($id))
            http_response_code(400);
        $blog = BlogRecord::findById($id);
        $blog = BlogRecord::recordToArray($blog);
        echo (json_encode($blog));
    }

    function editBlog()
    {
        if (!isset($_SESSION['isAdmin'])) {
            header('Location:/admin/auth/index');
            exit;
        }
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            if (is_array($decoded)) {
                if(!(isset($decoded['id'])&&isset($decoded['title'])&&isset($decoded['message']))){
                    http_response_code(400);
                    error_log("Вы не отправили все необходимые данные");
                    exit;
                }
                
                $id = $decoded['id'];
                $title = $decoded['title'];
                $message = $decoded['message'];
                $blog = BlogRecord::findById($id);
                if($blog==null){
                    http_response_code(422);
                    error_log("Отправлен неккоректный id публикации");
                    exit;
                }

                if(gettype($blog) == 'object'){
                    $blog->subject = $title;
                    $blog->message = $message;
                    $result = $blog->save();
                    if($result){
                        http_response_code(200);
                        echo(json_encode(BlogRecord::recordToArray($blog)));
                        exit;
                    }else{
                        var_dump($result);
                        http_response_code(400);
                        error_log("Не получилось сохранить изменения");
                        exit;
                    }
                    
                }
            } else {
                http_response_code(418);
                error_log("Вы отправили неправильный json");
            }
        }
    }
}