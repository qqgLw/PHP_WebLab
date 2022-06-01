<?php
class AuthModel extends Model
{
    protected $validation_schema = [
        'fio' => [
          'rules' => ['idle'], 
          'errorText' => 'Введите ваши Фамилию, Имя и Отчество'
        ],
        'email' => [
          'rules' => ['idle'], 
          'errorText' => 'errorNo1'
        ],
        'login' => [
          'rules' => ['isNotEmpty'], 
          'errorText' => 'err3'
        ],
        'password' => [
          'rules' => ['isNotEmpty'], 
          'errorText' => 'err4.'
        ]
      ];
  
      function __construct()
      {
        parent::__construct();
        $this->applyValidationSchemaToValidator();
      }
}