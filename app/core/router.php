<?
class Router
{
  static function route()
  {
    $controller_name = isset($_REQUEST["controller"]) ? $_REQUEST["controller"] : "home";

    $action_name = isset($_REQUEST['action']) ? $_REQUEST['action'] : "index";

    $controller_file = "app/controllers/".$controller_name.'_controller.php';
    //Проверяем наличие файла контроллера и завершаем работу в случае его отсутствия
    if(file_exists($controller_file)){
        include $controller_file;
    } else {
        Router::ErrorPage404();
        die("ОШИБКА! Файл контроллера $controller_file не найден!");
    }
    //Создаем экземпляр контроллера
    $controller_class_name = ucfirst($controller_name).'Controller';
    $controller = new $controller_class_name;
    //Получаем имя модели и имя файла модели
    $model_name = $controller_name.'_model';
    $model_file = 'app/models/'.$model_name.'.php';
    //Проверяем наличие файла модели и завершаем работу в случае его отсутствия
    if(file_exists($model_file)) {
        include $model_file;
        //Создаем экземпляр модели
        $model_class_name = ucfirst($controller_name).'Model';
        $model = new $model_class_name;
        //Присваиваем экземпляр модели соответствующему полю контроллера
        $controller->model = $model;
    }
    //Вызываем экшн конроллера
    if(method_exists($controller, $action_name)) {
        $controller->$action_name();
    } else {
        Router::ErrorPage404();
        die("ОШИБКА! Отсутствует метод $action_name контроллера $controller_class_name");
    }
  }

  static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'error');
    }
}