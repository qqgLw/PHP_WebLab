<?
  require 'app/models/validators/custom_form_validation.php';

  class ResultsVerification extends CustomFormValidation {

    const VERIFYING_RESULT_POS ='Вы ответили правильно';
    const VERIFYING_RESULT_NEG ='Вы ответили неправильно';

    protected $data_verifying_schema = [];

    protected $results = [];

    function isResultsRight()
    {
      $total = 0;
      foreach ($this->results as $value) {
        $total+=$value;
      }
      return $total==count($this->results);
    }

    function __construct($data_preparing_schema, $specified_schema)
    {
      parent::__construct($data_preparing_schema);
      if(isset($specified_schema))
        $this->data_verifying_schema=$specified_schema;
    }

    function verifyFormData($field, $value)
    {
      if (array_key_exists($field, $this->data_verifying_schema)){
        $isRightAwnser = ($this->data_verifying_schema[$field]===$value);
        if ($isRightAwnser)
          $this->validation_marks[$field]['mark']=self::VERIFYING_RESULT_POS;
        else  $this->validation_marks[$field]['mark']=self::VERIFYING_RESULT_NEG;
        $this->results[$field]=(int)$isRightAwnser;
      }
    }
  }