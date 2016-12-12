<?php
require_once'./models/Utilisateur.php';
require_once'./models/Film.php';
require_once'./models/Cinema.php';
require_once'./models/Prefere.php';
require_once'./models/Seance.php';
use Semeformation\Mvc\Cinema_crud\includes\DBFunctions;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Création du logger
$logger = new Logger("Functions");
$logger->pushHandler(new StreamHandler(dirname(__DIR__) . './logs/functions.log'));
$utilisateursMgr = new Utilisateur($logger);
$cinema = new Cinema();
$film1 = new Film();
$seance1 = new Seance();
$prefere = new Prefere();



//$fctManager = new DBFunctions($logger);

