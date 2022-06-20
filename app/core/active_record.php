<?php
class BaseActiveRecord{
    public static $pdo;
    
    protected static $tablename;
    protected static $dbfields = array();
    
    public function __construct() 
    {
        if (!static::$tablename){
            return;
        }
        static::setupConnection();
        static::getFields();
    }
    public static function getFields()
    {
        $stmt = static::$pdo->query("SHOW FIELDS FROM ".static::$tablename);
        while ($row = $stmt->fetch()) {
        static::$dbfields[$row['Field']] = $row['Type'];
        }
    }
    public static function setupConnection() 
    {
        if (!isset(static::$pdo)) {
            $eror = false;
            try {
                static::$pdo = new PDO("mysql:dbname=sevgulab; host=sevgu; charset=utf8", "root", "");
            } catch (PDOException $ex) {
                die("Ошибка подключения к БД: $ex");
            }
        }
    }

    public static function find($id)
    {
        $sql = "SELECT * FROM ".static::$tablename." WHERE id=$id";
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

    public static function findAll() 
    { 
        $sql = "SELECT * FROM ".static::$tablename;
        $stmt = static::$pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public static function count() 
    { 
        $sql = "SELECT COUNT(*) FROM ".static::$tablename;
        $stmt = static::$pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return 0;
        }
        foreach ($row as $value) {
            return $value;
        }
    }

    public static function findPage($pageSize, $page) 
    { 
        $sql = "SELECT * FROM ".static::$tablename." LIMIT ".$pageSize." OFFSET ".$page*$pageSize;
        $stmt = static::$pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function save() 
    {
        $data = [];
        $sqlvalues = '';
        $sqlfields = '';
        foreach (static::$dbfields as $field => $type)
        {
            if ($field == 'id')
                continue;
                
            $data[$field] = $this->$field;
            if (strlen($sqlvalues) > 0)
            {
                $sqlvalues = $sqlvalues.', ';
                $sqlfields = $sqlfields.', ';
            }
            $sqlvalues = $sqlvalues.':'.$field;
            $sqlfields = $sqlfields.$field;
        }
        var_dump($sqlvalues);
        $sql = "INSERT INTO ".static::$tablename." (".$sqlfields.") VALUES (".$sqlvalues.")";
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute($data);
        if($stmt){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            print_r(static::$pdo->errorInfo());
        }
    }
    public function delete()
    {
        $sql = "DELETE FROM ".static::$tablename." WHERE ID=".$this->id;
        $stmt = static::$pdo->query($sql);
        if($stmt){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            print_r(static::$pdo->errorInfo());
        }
    }
} 