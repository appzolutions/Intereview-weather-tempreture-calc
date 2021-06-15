<?php
require '../vendor/autoload.php';
// load .env file
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// set the configurations
ini_set('display_errors', $_ENV['DEVELOPMENT_ENV']);
ini_set('display_startup_errors', $_ENV['DEVELOPMENT_ENV']);
error_reporting(E_ALL);

// define the templating engine
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Component\Templating\TemplateNameParser;


//*
// @param file name
//**/
function view($file_name,$array=[]) {
    $filesystemLoader = new FilesystemLoader(__DIR__.'/views/%name%');
    $templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);
    $templating->set(new SlotsHelper());
    echo $templating->render(__DIR__.'/views/'.$file_name.'.php', $array);
    exit();
}