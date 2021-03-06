<?php
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . './includes/Manager.php';

session_start();
// si l'utilisateur n'est pas connecté ou sinon s'il n'est pas amdinistrateur
if (!array_key_exists("user", $_SESSION) or $_SESSION['user'] !== 'admin@adm.adm') {
    // renvoi à la page d'accueil
    header('Location: index.php');
    exit;
}

// variable qui sert à conditionner l'affichage du formulaire
$isItACreation = false;

// si la méthode de formulaire est la méthode POST
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === "POST") {

    // on "sainifie" les entrées
    $sanEntries = filter_input_array(INPUT_POST, ['backToList' => FILTER_DEFAULT,
        'cinemaID' => FILTER_SANITIZE_NUMBER_INT,
        'adresse' => FILTER_SANITIZE_STRING,
        'denomination' => FILTER_SANITIZE_STRING,
        'modificationInProgress' => FILTER_SANITIZE_STRING]);

    // si l'action demandée est retour en arrière
    if ($sanEntries['backToList'] !== NULL) {
        // on redirige vers la page des cinémas
        header('Location: index.php?action=cinemasList');
        exit;
    }
    // sinon (l'action demandée est la sauvegarde d'un cinéma)
    else {

        // et que nous ne sommes pas en train de modifier un cinéma
        if ($sanEntries['modificationInProgress'] == NULL) {
            // on ajoute le cinéma
            $managers['cinema']->insertNewCinema($sanEntries['denomination'], $sanEntries['adresse']);
        }
        // sinon, nous sommes dans le cas d'une modification
        else {
            // mise à jour du cinéma
            $managers['cinema']->updateCinema($sanEntries['cinemaID'], $sanEntries['denomination'], $sanEntries['adresse']);
        }
        // on revient à la liste des cinémas
        header('Location: index.php?action=cinemasList');
        exit;
    }
}// si la page est chargée avec $_GET
elseif (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === "GET") {
    // on "sainifie" les entrées
    $sanEntries = filter_input_array(INPUT_GET, ['cinemaID' => FILTER_SANITIZE_NUMBER_INT]);
    if ($sanEntries && $sanEntries['cinemaID'] !== NULL && $sanEntries['cinemaID'] !== '') {
        // on récupère les informations manquantes 
        $cinema = $managers['cinema']->getCinemaInformationsByID($sanEntries['cinemaID']);
    }
    // sinon, c'est une création
    else {
        $isItACreation = true;
        $cinema = [
            'CINEMAID' => '',
            'DENOMINATION' => '',
            'ADRESSE' => ''
        ];
    }
}

require_once __DIR__ .'/views/viewEditCinema.php';
?>
