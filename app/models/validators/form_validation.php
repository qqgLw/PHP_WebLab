<?
  class FormValidation
  {

    protected $rules = [];
    
    public $errors = [];
    public $validation_marks = [];

    function setRule(string $field, array $rulesList)
    {
        if (isset($rulesList)) {
          $this->rules[$field]=$rulesList;
        }
    }
    function idle($data){return true;}
    function isNotEmpty($data)
    {
      return isset($data) and !empty($data);
    }

    function isInteger($data)
    {
      return is_numeric($data);
    }

    function isLess($data, $value)
    {
      if ($this->isInteger($data)){
        return $data < $value;
      }
    }

    function isGreater($data, $value)
    {
      if ($this->isInteger($data)){
        return $data > $value;
      }
    }

    function isEmail($data)
    {
      return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    function isFullName($data)
    {
      return preg_match('/^(?:[A-Za-zА-Яа-я]+ ){2}[A-Za-zА-Яа-я]+$/',$data)===1;
    }

    function isPhoneNumber($data)
    {
      return preg_match('/^\+(7)[0-9]{8,10}$/',$data)===1;
    }

    //TODO: actual date validation with passed string
    function isDate($data)
    {
      //return preg_match('/^(?:[A-Za-zА-Яа-я]+)( [0-9]+){2}$/',$data)>=1;
      return $this->isNotEmpty($data);
    }

    function prepareFormData(& $form_data){}

    function verifyFormData($field, $value){}

    function validate($form_data)
    {
      $this->prepareFormData($form_data);
      foreach ($this->rules as $field => $rulesList) {
        if (array_key_exists($field, $form_data)){
          foreach ($rulesList as $RuleValidationMethod) {
            if (method_exists($this, $RuleValidationMethod)){
              if($this->$RuleValidationMethod($form_data[$field])===false){
                $this->validation_marks[$field]['error'] = $this->errors[$field];
                break;
              }
              $this->verifyFormData($field, $form_data[$field]);
            } else break;
          }
        }
      }
      return $form_data;
    }
    function isTestValid()
    {
      foreach ($this->validation_marks as $key => $value) {
        if ($this->isNotEmpty($value['error']))
          return false;
      }
      return true;
    }
  }