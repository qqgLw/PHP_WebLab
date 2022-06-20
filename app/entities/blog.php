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
} 