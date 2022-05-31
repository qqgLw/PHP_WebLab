<?
class StudyController extends Controller
{
    function index()
    {
      $this->view->render('study/index.php','Учеба');
    }
}