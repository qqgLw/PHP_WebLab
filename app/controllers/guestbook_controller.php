<?php
class GuestbookController extends Controller
{
    protected static $filePath = "app/stored/messages.inc"; 
    function index() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $this->model->validate($_POST);
            if ($this->model->validator->isTestValid())
            {
                $this->addNewMessage();
            }
        }
        $this->loadGuestsMessages();
        $this->view->render("guestbook/index.php", "Гостевая книга", $this->model);
    }
    
    function loadGuestsMessages() 
    {
        $lines = file(static::$filePath);
        if ($lines)
        {
            $messages = [];
            foreach ($lines as $line)
            {
                $message = [];
                $explodedLine = explode(";", $line);
                if (!empty($explodedLine[0]))
                {
                    $message["date"] = $explodedLine[0];
                }
                if (!empty($explodedLine[1]))
                {
                    $message["name"] = $explodedLine[1];
                }
                if (!empty($explodedLine[2]))
                {
                    $message["email"] = $explodedLine[2];
                }
                if (!empty($explodedLine[3]))
                {
                    $message["message"] = $explodedLine[3];
                }
                array_push($messages, $message);
            }
            usort($messages, function ($a, $b) {
                return strcmp($a["date"], $b["date"]);
            });
            $this->model->messages = $messages;
        }
    }

    function addNewMessage()
    {
        $model = $this->model;
        $file = fopen(static::$filePath,"a");
        $text = '';
        if (filesize(static::$filePath) != 0)
        {
            $text = PHP_EOL;
        }
        $message = str_replace(array("\r", "\n", ';'), '', $model->bufferedFields['message']);
        $text = $text.date("Y/m/d h:i:sa").';'.$model->bufferedFields['name'].';'.$model->bufferedFields['email'].';'.$message;
        if (!fwrite($file, $text)) {
            echo "Ошибка записи в файл!";
        }
        fclose($file);
    }
}