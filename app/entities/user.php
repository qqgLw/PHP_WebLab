<?php
require __DIR__.'/../core/active_record.php';

class UserRecord extends BaseActiveRecord {
    protected static $tablename = 'users';
    protected static $dbfields = array();

    public $id;
    public $fio;
    public $email;
    public $login;
    public $password;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public static function findByLogin($login)
    {
        $sql = "SELECT * FROM ".static::$tablename." WHERE login='$login'";
        $stmt = static::$pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $ar_obj = new static();
        foreach ($row as $key => $value) {
            $ar_obj ->$key = $value;
        }
        return $ar_obj;
    }
} 