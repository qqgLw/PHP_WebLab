<?
  class ContactModel extends Model 
  {
    protected $validation_schema = [
      'name' => [
        'rules' => ['isFullName'], 
        'errorText' => 'Введите ваши Фамилию, Имя и Отчество'
      ],
      'email' => [
        'rules' => ['isNotEmpty','isEmail'], 
        'errorText' => 'errorNo1'
      ],
      'phone' => [
        'rules' => ['isNotEmpty','isPhoneNumber'], 
        'errorText' => 'Номер должен начинаться на +7'
      ],
      'dateOfBirth' => [
        'rules' => ['isDate'], 
        'errorText' => 'Неверный ввод вашей даты рождения. Попробуте еще раз.'
      ],
      'gender' => [
        'rules' => ['isNotEmpty'], 
        'errorText' => 'Выберите один из вариантов.'
      ],
      'message' => [
        'rules' => ['isNotEmpty'],
        'errorText' => 'Введите сообщение.'
      ]
    ];

    function __construct()
    {
      parent::__construct();
      $this->applyValidationSchemaToValidator();
    }
  }