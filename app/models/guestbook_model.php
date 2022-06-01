<?php
class GuestbookModel extends Model
{
    public $messages = '';

    protected $validation_schema = [
        'name' => [
          'rules' => ['isFullName'], 
          'errorText' => 'Введите ваши Фамилию, Имя и Отчество'
        ],
        'email' => [
          'rules' => ['isNotEmpty','isEmail'], 
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