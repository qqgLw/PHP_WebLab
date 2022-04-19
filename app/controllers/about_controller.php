<?
class AboutController extends Controller
{
    function index()
    {
      $this->view->render('about_view.php','Обо мне');
    }
}