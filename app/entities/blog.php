<?php
class BlogRecord extends BaseActiveRecord {
    protected static $tablename = 'blogs';
    protected static $dbfields = array();

    public $id = 0;
    public $date = '';
    public $author = '';
    public $imageGUID = '';
    public $subject = '';
    public $message = '';
    
    public function __construct() 
    {
        parent::__construct();
    }

    public static function recordToArray($blog)
    {
        $b = [];
        foreach(self::$dbfields as $field=>$type){
            $b[$field] = $blog->$field;
        }
        return $b;
    }

    public static function findById($id=false)
    {
        if ($id===false) return null;
        $tablename = static::$tablename;
        $id_prepare = ":__id";
        $ar_obj = new static();
        $prepare = $ar_obj::$pdo->prepare("SELECT * FROM `$tablename` WHERE `id` = $id_prepare");
        $prepare->bindValue($id_prepare, $id);

        if ($prepare->execute()) 
        {
            $row = $prepare->fetch(\PDO::FETCH_ASSOC);
            if ($row === false) 
                return null;
            foreach ($row as $key => $value) {
                $ar_obj ->$key = $value;
            }
            return $ar_obj;
        }
        else {
            return null;
        }
    }
} 