<?
class HomeController extends Controller
{
    function index()
    {
      $this->view->render('home/index.php','Главная страница');
    }
}