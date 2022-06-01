<?php
require __DIR__.'/../core/active_record.php';
class TestRecord extends BaseActiveRecord {
    protected static $tablename = 'test_results';
    protected static $dbfields = array();

    public $id = 0;
    public $date = '';
    public $name = '';
    public $ngroup = '';
    public $ans_1 = '';
    public $ans_2 = '';
    public $ans_3 = '';
    public $iscorrect = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
} 