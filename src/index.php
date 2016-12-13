<?php

require_once __DIR__ . '/vendor/autoload.php';
//fdgfdgfdfgd
require_once __DIR__ . './includes/Manager.php';

// initialisation de l'application
require_once __DIR__ . './init.php';


// appel au contrôleur serviteur 
require __DIR__ . './controllers/controleur.php';

// on "sainifie" les entrées
$sanitizedEntries = filter_input_array(INPUT_GET, ['action' => FILTER_SANITIZE_STRING]);
if ($sanitizedEntries && $sanitizedEntries['action'] !== '') { // si l'action demandée est la liste des cinémas
    if ($sanitizedEntries['action'] == "cinemasList") {
        // Activation de la route cinemasList 
        cinemasList($managers);
    } else {

        if ($sanitizedEntries['action'] == "moviesList") {
            // Activation de la route listFilm
            filmList($managers);
        } else {
            if ($sanitizedEntries['action'] == "editFavoriteMoviesList") {
                filmPrefere($managers);
            } else
            // Activation de la route par défaut (page d'accueil)
                home($managers);
        }
    }
}
else {
    // Activation de la route par défaut (page d'accueil)
    home($managers);
}
?>

