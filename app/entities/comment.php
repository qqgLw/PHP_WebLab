<?php
class CommentRecord extends BaseActiveRecord
{
    protected static $tablename = 'comments';
    protected static $dbfields = array();

    public $id;
    public $created = '';
    public $author_id = '';
    public $blog_id = '';
    public $text = '';

    public function __construct() 
    {
        parent::__construct();
    }

    public static function blogComments($blog_id = false)
    {
        if ($blog_id===false) return null;
        $tablename = static::$tablename;
        $blog_prepare = ":__blog_id";
        $prepare = static::$pdo->prepare("SELECT * FROM `$tablename` WHERE `blog_id` = $blog_prepare");
        $prepare->bindValue($blog_prepare, $blog_id);

        if ($prepare->execute()) {
            $rows = $prepare->fetchAll(\PDO::FETCH_ASSOC);
            if (!$rows) {
                return null;
            }
            $result = [];
            foreach ($rows as $row)
            {
                $ar_obj = new static();
                foreach ($row as $key => $value) {
                    $ar_obj->$key = $value;
                }
                array_push($result, $ar_obj);
            }
            
            return $result;
        }
        else {
            return null;
        }
    }
}
