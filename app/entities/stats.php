<?php
require __DIR__.'/../core/active_record.php';

class StatsRecord extends BaseActiveRecord {
    protected static $tablename = 'stats';
    protected static $dbfields = array();

    public $id;
    public $datetime;
    public $link;
    public $ip;
    public $hostname;
    public $browser;
    
    public function __construct() 
    {
        parent::__construct();
    }

    function saveStats($page){
        $this->datetime = date("Y/m/d h:i:sa");
        $this->link = $page;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $this->browser = $_SERVER['HTTP_USER_AGENT'];
        $this->save();
    }
} 