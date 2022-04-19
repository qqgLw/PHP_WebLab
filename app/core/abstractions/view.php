<?
  class View
  {
    function render($content_view, $title, $model = NULL, $layout = 'layout.php')
    {
      include 'app/views/'.$layout;
    }
  }
