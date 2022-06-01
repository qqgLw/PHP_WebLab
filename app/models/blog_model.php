<?php
class BlogModel extends Model
{
    public $maxPages = 1;
    public $page = 0;
    public $pageSize = 5;

    public $blogs = [];

    protected $validation_schema = [
        'author' => [
          'rules' => ['isFullName'], 
          'errorText' => 'Введите ваши Фамилию, Имя и Отчество'
        ],
        'subject' => [
          'rules' => ['isNotEmpty'], 
          'errorText' => 'errorNo1'
        ],
        'message' => [
          'rules' => ['isNotEmpty'], 
          'errorText' => 'errorNo2'
        ]
    ];

    function __construct()
    {
      parent::__construct();
      $this->applyValidationSchemaToValidator();
    }
}