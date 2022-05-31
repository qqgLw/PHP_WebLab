<?
class AlbumController extends Controller
{
  function index()
  {
    $this->view->render('album/index.php','Альбом', $this->model);
  }
}