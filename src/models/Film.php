<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Film extends Semeformation\Mvc\Cinema_crud\includes\DBFunctions{
     /**
     * Méthode qui renvoie la liste des films
     * @return array[][]
     */
    public function getMoviesList() {
        $requete = "SELECT * FROM film";
        // on retourne le résultat
        return $this->extraireNxN($requete, null, false);
    }

    /**
     * 
     * @param type $titre
     * @param type $titreOriginal
     */
    public function insertNewMovie($titre, $titreOriginal = null) {
        // construction
        $requete = "INSERT INTO film (titre, titreOriginal) VALUES ("
                . ":titre"
                . ", :titreOriginal)";
        // exécution
        $this->executeQuery($requete,
                ['titre' => $titre,
            'titreOriginal' => $titreOriginal]);
        // log
        if ($this->logger) {
            $this->logger->info('Movie ' . $titre . ' successfully added.');
        }
    }
    
     /**
     * 
     * @param type $movieID
     */
    public function deleteMovie($movieID) {
        $this->executeQuery("DELETE FROM film WHERE filmID = "
                . $movieID);

        if ($this->logger) {
            $this->logger->info('Movie ' . $movieID . ' successfully deleted.');
        }
    }
    
    
     /**
     * Méthode qui renvoie la liste des films
     * @return array[][]
     */
    public function getMoviesList() {
        $requete = "SELECT * FROM film";
        // on retourne le résultat
        return $this->extraireNxN($requete, null, false);
    }

    /**
     * 
     * @param type $titre
     * @param type $titreOriginal
     */
    public function insertNewMovie($titre, $titreOriginal = null) {
        // construction
        $requete = "INSERT INTO film (titre, titreOriginal) VALUES ("
                . ":titre"
                . ", :titreOriginal)";
        // exécution
        $this->executeQuery($requete,
                ['titre' => $titre,
            'titreOriginal' => $titreOriginal]);
        // log
        if ($this->logger) {
            $this->logger->info('Movie ' . $titre . ' successfully added.');
        }
    }
    
    
    /**
     * 
     * @param type $filmID
     * @param type $titre
     * @param type $titreOriginal
     */
    public function updateMovie($filmID, $titre, $titreOriginal) {
        // on construit la requête d'insertion
        $requete = "UPDATE film SET "
                . "titre = "
                . "'" . $titre . "'"
                . ", titreOriginal = "
                . "'" . $titreOriginal . "'"
                . " WHERE filmID = "
                . $filmID;
        // exécution de la requête
        $this->executeQuery($requete);
    }

    /**
     * 
     * @param type $movieID
     */
    public function deleteMovie($movieID) {
        $this->executeQuery("DELETE FROM film WHERE filmID = "
                . $movieID);

        if ($this->logger) {
            $this->logger->info('Movie ' . $movieID . ' successfully deleted.');
        }
    }

    /**
     * Méthode qui ne renvoie que les titres et ID de films non encore marqués
     * comme favoris par l'utilisateur passé en paramètre
     * @param int $userID Identifiant de l'utilisateur
     * @return array[][] Titres et ID des films présents dans la base
     */
    public function getMoviesNonAlreadyMarkedAsFavorite($userID) {
        // requête de récupération des titres et des identifiants des films
        // qui n'ont pas encore été marqués comme favoris par l'utilisateur
        $requete = "SELECT f.filmID, f.titre "
                . "FROM film f"
                . " WHERE f.filmID NOT IN ("
                . "SELECT filmID"
                . " FROM prefere"
                . " WHERE userID = :id"
                . ")";
        // extraction de résultat
        $resultat = $this->extraireNxN($requete, ['id' => $userID], false);
        // retour du résultat
        return $resultat;
    }

    /**
     * Renvoie une liste de films pas encore programmés pour un cinema donné
     * @param integer $cinemaID
     * @return array
     */
    public function getNonPlannedMovies($cinemaID) {
        // requête de récupération des titres et des identifiants des films
        // qui n'ont pas encore été programmés dans ce cinéma
        $requete = "SELECT f.filmID, f.titre "
                . "FROM film f"
                . " WHERE f.filmID NOT IN ("
                . "SELECT filmID"
                . " FROM seance"
                . " WHERE cinemaID = :id"
                . ")";
        // extraction de résultat
        $resultat = $this->extraireNxN($requete, ['id' => $cinemaID], false);
        // retour du résultat
        return $resultat;
    }
    
    /**
     * 
     * @param type $filmID
     * @return type
     */
    public function getMovieInformationsByID($filmID) {
        $requete = "SELECT * FROM film WHERE filmID = "
                . $filmID;
        $resultat = $this->extraire1xN($requete);
        // on retourne le résultat extrait
        return $resultat;
    }
    
     /**
     * 
     * @param type $cinemaID
     * @return type
     */
    public function getCinemaMoviesByCinemaID($cinemaID) {
        // requête qui nous permet de récupérer la liste des films pour un cinéma donné
        $requete = "SELECT DISTINCT f.* FROM film f"
                . " INNER JOIN seance s ON f.filmID = s.filmID"
                . " AND s.cinemaID = " . $cinemaID;
        // on extrait les résultats
        $resultat = $this->extraireNxN($requete);
        // on retourne le résultat
        return $resultat;
    }


}


