<?php

class _404Controller extends Controller
{
	
	function index()
	{
		$this->view->render('404_view.php', 'template_view.php');
	}

}
