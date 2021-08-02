<?php

require 'autoloader.php';

$exportController = new ExportController();

if(isset($_GET['action'])) {
    if($_GET['action'] == 'export')
    $exportController->exportRecords();
}
else {
    require 'view/home.php';
}