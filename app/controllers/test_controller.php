<?
require 'app/entities/test.php';
class TestController extends Controller
{
    function index()
    {
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $this->model->validate($_POST);
        if ($this->model->validator->isTestValid())
        {
          $this->addNewResult();
        }
      }
      $this->loadResults();
      $this->view->render('test/index.php','Тест по МИО', $this->model);
    }
    function loadResults()
    {
        $testRecord = new TestRecord();
        $records = $testRecord->findall();
        if ($records != null)
        {
            foreach ($records as $record) {
                array_push($this->model->testResults, $record);
            }
            usort($this->model->testResults, function ($a, $b) {
                return strcmp($a->date, $b->date);
            });
        }
    }

    function addNewResult()
    {
      $model = $this->model;
      $record = new TestRecord();
      $record->date = date("Y/m/d h:i:sa");
      $record->name = $model->bufferedFields['name'];
      $record->ngroup = $model->bufferedFields['group'];
      $record->ans_1 = implode('',[$model->bufferedFields['awnser1']]);
      $record->ans_2 = is_array($model->bufferedFields['awnser2']) ? implode('',$model->bufferedFields['awnser2']) : 'N/A';
      $record->ans_3 = is_array($model->bufferedFields['awnser3']) ? implode('',$model->bufferedFields['awnser3']) : 'N/A';
      $record->iscorrect = (int)$model->validator->isResultsRight();
      $record->save();
    }
}