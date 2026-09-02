<?php
Use App\Repository\Database;
define('ROOT_PATH', dirname(__DIR__));
require_once dirname(__DIR__)."/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();
$connexion = Database::getConnection();
var_dump(ROOT_PATH);
die;
