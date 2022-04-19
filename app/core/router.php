<?
class Router
{
  static function route()
  {
    $parced_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $received_url = explode('/', $parced_url);
    //Получаем имя контроллера или "page" по умолчанию
    $controller_name = !empty($received_url[1]) ? $received_url[1] : 'home';
    $controller_name = basename($controller_name, '.php');
    //Получаем имя экшена или "index" по умолчанию
    $action_name = !empty($received_url[2]) ? $received_url[2] : 'index';
    //Путь и имя файла контроллера
    $controller_file = 'app/controllers/'.$controller_name.'_controller.php';
    //Проверяем наличие файла контроллера и завершаем работу в случае его отсутствия
    if(file_exists($controller_file)){
        include $controller_file;
    } else {
        Router::ErrorPage404();
        die("ОШИБКА! Файл контроллера $controller_file не найден!");
    }
    //Создаем экземпляр контроллера
    $controller_name = is_numeric($controller_name) ? '_'.$controller_name : $controller_name;
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
		header('Location:'.$host.'404');
    }
}