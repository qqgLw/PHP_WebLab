<?
class InterestsController extends Controller
{
    function index()
    {
      $this->view->render('interests/index.php','Мои интересы',$this->model);
    }
}