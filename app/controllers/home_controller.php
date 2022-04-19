<?
class HomeController extends Controller
{
    function index()
    {
      $this->view->render('home_view.php','Главная страница');
    }
}