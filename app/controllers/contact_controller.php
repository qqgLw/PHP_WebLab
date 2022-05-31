<?
class ContactController extends Controller
{
    function index()
    {
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $this->model->validate($_POST);
      }
      $this->view->render('contact/index.php','Контакт-форма', $this->model);
    }
}