<?php

namespace App\Controller;

use App\Database\MySql;
use App\Class\Movie;
use App\Enum\Genre;
use PDO;

final class MovieController
{

    public static function getLastId(): int
    {
        $connexion = MySql::connect();
        return $connexion->lastInsertId();
    }

    public static function getAll(): array
    {
        $connexion = MySql::connect();
        $request = $connexion->prepare("SELECT * from movie");

        $request->execute();
        return $request->fetchAll();
    }

    public static function add(Movie $movie){
        $connexion = MySql::connect();
        $add = $connexion->prepare("INSERT INTO movie (titre, auteur, disponible, duration, genre)
            VALUES (:titre, :auteur, :disponible, :duration, :genre)");

        $titre = $movie->getTitre();
        $auteur = $movie->getAuteur();

        $disponible = $movie->getDisponible();

        // Convertir en entier si nécessaire
        if ($disponible !== null && $disponible !== '') {
            $disponible = (int)$disponible; // Convertir en entier
        } else {
            $disponible = 0; // Défaut à 0 si nul ou vide
        }

        $duration = $movie->getDuration();
        $genre = $movie->getGenre();

        $add->bindParam('titre', $titre);
        $add->bindParam('auteur', $auteur);
        $add->bindParam('disponible', $disponible, PDO::PARAM_INT);
        $add->bindParam('duration', $duration);
        $add->bindParam('genre', $genre);

        return $add->execute();
    }

    public static function edit(Movie $movie) : bool {
        $connexion = MySql::connect();
        $edit = $connexion->prepare("UPDATE movie SET titre = :titre, auteur = :auteur, disponible = :disponible,
            duration = :duration, genre = :genre
            WHERE movie.id = :id");
        
        $titre = $movie->getTitre();
        $auteur = $movie->getAuteur();
        
        // S'assurer que c'est un nombre entier
        $disponible = $movie->getDisponible();
        
        // Convertir en entier si nécessaire
        if ($disponible !== null && $disponible !== '') {
            $disponible = (int)$disponible; // Convertir en entier
        } else {
            $disponible = 0; // Défaut à 0 si nul ou vide
        }
    
        $duration = $movie->getDuration();
        $genre = $movie->getGenre();
        $id = $movie->getId();
    
        $edit->bindValue(":titre", $titre);
        $edit->bindValue(":auteur", $auteur);
        $edit->bindValue(":disponible", $disponible, PDO::PARAM_INT); // S'assurer que c'est un nombre entier
        $edit->bindValue(":duration", $duration);
        $edit->bindValue(":genre", $genre);
        $edit->bindValue(":id", $id);
    
        return $edit->execute();
    }

    public static function getMovieId($id) {
        $connexion = MySql::connect();
        $query = $connexion->prepare("SELECT * FROM movie WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    
        $movieData = $query->fetch(PDO::FETCH_ASSOC);
        if ($movieData) {
            $genre = Genre::from($movieData['genre']);
            return new Movie(
                $movieData['id'],
                $movieData['titre'],
                $movieData['auteur'],
                (bool) $movieData['disponible'], // convertir en booléen
                (float) $movieData['duration'], // convertir en float
                $genre
            );
        }
        return null;
    }

    public static function delete($id){
        $connexion = MySql::connect();
        $delete = $connexion->prepare("DELETE FROM movie WHERE movie.id = :id");

        $delete->bindParam(':id', $id, PDO::PARAM_INT);

        return $delete->execute();
    }
}