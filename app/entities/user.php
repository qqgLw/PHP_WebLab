<?php
require_once __DIR__.'/../core/active_record.php';

class UserRecord extends BaseActiveRecord {
    protected static $tablename = 'users';
    protected static $dbfields = array();

    public $id;
    public $fio;
    public $login;
    public $password;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public static function findByLogin($login=false)
    {
        if ($login===false) return null;
        $tablename = static::$tablename;
        $login_prepare = ":__login";
        $prepare = static::$pdo->prepare("SELECT * FROM `$tablename` WHERE `login` = $login_prepare");
        $prepare->bindValue($login_prepare, $login);

        if ($prepare->execute()) 
        {
            $row = $prepare->fetch(\PDO::FETCH_ASSOC);
            if ($row === false) 
                return null;
            $ar_obj = new static();
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