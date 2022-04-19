<?
class AlbumController extends Controller
{
  function index()
  {
    $this->view->render('album_view.php','Альбом', $this->model);
  }
}