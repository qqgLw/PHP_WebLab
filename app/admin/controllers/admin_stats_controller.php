<?php
require 'app/entities/stats.php';
require 'app/core/admin_controller.php';
class AdminStatsController extends AdminController
{
    function index() 
    {
        $this->authenticate();
        $this->loadStats();
        $this->view->render("stats/index.php", "Статистика посещений", $this->model, "_admin_layout.php");
    }
    
    function loadStats() 
    {
        $statsRecord = new StatsRecord();
        $records = $statsRecord->findAll();
        
        if ($records != null)
        {
            foreach ($records as $record) {
                array_push($this->model->stats, $record);
            }
            usort($this->model->stats, function ($a, $b) {
                return strcmp($a->datetime, $b->datetime);
            });
        }
    }
}