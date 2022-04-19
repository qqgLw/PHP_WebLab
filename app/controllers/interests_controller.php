<?
class InterestsController extends Controller
{
    function index()
    {
      $this->view->render('interests_view.php','Мои интересы',$this->model);
    }
}