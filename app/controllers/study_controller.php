<?
class StudyController extends Controller
{
    function index()
    {
      $this->view->render('study_view.php','Учеба');
    }
}