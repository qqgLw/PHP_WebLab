<?
  class CustomFormValidation extends FormValidation {

    protected $data_preparing_schema = [];

    function __construct($specified_schema)
    {
      if(isset($specified_schema))
        $this->data_preparing_schema=$specified_schema;
    }

    function isTestValid()
    {
      foreach ($this->validation_marks as $key => $value) {
        if ($this->isNotEmpty($value['error']))
          return false;
      }
      return true;
    }

    function hasMoreThanThreeElements($data)
    {
      return (count($data)>=3);
    }

    function specialValidation($data){
      return $this->isNotEmpty($data) and $this->hasMoreThanThreeElements($data);
    }

    function prepareFormData(& $form_data)
    {
      foreach ($this->data_preparing_schema as $element) {
        $containerFieldName = $element['mapTo'];
        $form_data[$containerFieldName] = [];
        foreach ($element['consistsOf'] as $value) {
          if (array_key_exists($value, $form_data))
            array_push($form_data[$containerFieldName], $form_data[$value]);
        }
      }
    }
  }