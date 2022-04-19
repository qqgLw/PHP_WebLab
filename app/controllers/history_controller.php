<?
class HistoryController extends Controller
{
    function index()
    {
      $this->view->render('history_view.php','История посещений');
    }
}