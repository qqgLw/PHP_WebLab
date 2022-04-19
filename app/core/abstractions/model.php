<?
  require 'app/models/validators/form_validation.php';
  
  class Model
  {
    public $validator;

    protected $validation_schema = [];
    public $bufferedFields = [];

    function __construct()
    {
      $this->validator = new FormValidation();
    }

    function validate($post_data)
    {
      //unset($post_data["submit"]);
      foreach ($post_data as $field => $content) {
        if (is_array($content)) foreach ($content as $inputContent) {
          $inputContent = $this->prepareInputContent($inputContent);
        } else $content = $this->prepareInputContent($content);
        $this->bufferedFields[$field]=$content;
      }
      $this->validator->validate($this->bufferedFields);
    }

    function prepareInputContent($input){
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
    }

    function setBufferedFieldsValuesToDefault()
    {
      foreach ($this->bufferedFields as $value) {
        $value ='';
      }
    }

    function applyValidationSchemaToValidator()
    {
        foreach ($this->validation_schema as $field => $fieldSchema) {
          
          $this->validator->setRule($field, $fieldSchema['rules']);
          $this->validator->errors[$field]=$fieldSchema['errorText'];
          $this->validator->validation_marks[$field]=['error'=>'','mark'=>''];

          $this->bufferedFields[$field]='';
        }
    }
  }