<?
class AboutController extends Controller
{
    function index()
    {
      $this->view->render('about/index.php','Обо мне');
    }
}