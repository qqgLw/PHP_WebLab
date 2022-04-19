<?
class TestController extends Controller
{
    function index()
    {
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $this->model->validate($_POST);
      }
      $this->view->render('test_view.php','Тест по МИО', $this->model);
    }
}