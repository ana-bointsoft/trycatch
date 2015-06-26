<?php
// Ejecutamos la lógica de arranque de la app, o lógica de bootstrap
include_once('autoloader.php');
use \Javiers\Agenda\csvmanager;
// Lets cruD deleting contact
csvmanager::getInstance(__DIR__ . "/../address/example.csv")
->delete($_POST['id'])
->write();
    // Redirect back to home
    header('Location: /csvmanager/list.php');
    exit;