<?
  require 'app/models/validators/results_verification.php';

  class TestModel extends Model 
  {
    function __construct()
    {
      parent::__construct();
      $this->validator = new ResultsVerification($this->data_preparing_schema, $this->data_verifying_schema);
      $this->applyValidationSchemaToValidator();
    }

    public $positiveValidMes = 'Данные введены корректно';
    public $negativeValidMes = 'Форма содержит не валидные данные';

    public $positiveVerifMes = 'Тест пройден';
    public $negativeVerifMes = 'Тест не пройден';

    public $testResults = [];

    protected $data_preparing_schema = [
      [
        'type' => 'CheckBox',
        'consistsOf' => ['awnser21','awnser22','awnser23','awnser24'],
        'mapTo' => 'awnser2'
      ]
    ];

    protected $validation_schema = [
      'name' => [
        'rules' => ['isFullName'], 
        'errorText' => 'Ошибка ввода ФИО'
      ],
      'group' => [
        'rules' => ['isNotEmpty'], 
        'errorText' => 'Не введена группа'
      ],
      'awnser1' => [
        'rules' => ['isNotEmpty'], 
        'errorText' => 'Не ответили на вопрос №1'
      ],
      'awnser2' => [
        'rules' => ['isNotEmpty'], 
        'errorText' => 'Не ответили на вопрос №2'
      ],
      'awnser3' => [
        'rules' => ['specialValidation'], 
        'errorText' => 'Не ответили на вопрос №3'
      ],
    ];

    protected $data_verifying_schema = [
      'awnser1'=>'Ответ',
      'awnser2'=>['1','2','3'],
      'awnser3'=>['2','3','4']
    ];
  }