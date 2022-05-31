<?
class HistoryController extends Controller
{
    function index()
    {
      $this->view->render('history/index.php','История посещений');
    }
}