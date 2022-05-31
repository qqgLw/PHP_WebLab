<?php

class ErrorController extends Controller
{
	
	function index()
	{
		$this->view->render('errors/error404.php', 'template_view.php');
	}

}
