<?php

namespace App\Controller;

use App\Database\MySql;
use App\Class\Album;
use PDO;

final class AlbumController
{

    public static function getLastId(): int
    {
        $connexion = MySql::connect();
        return $connexion->lastInsertId();
    }

    public static function getAll(): array
    {
        $connexion = MySql::connect();
        $request = $connexion->prepare("SELECT * from album");

        $request->execute();
        return $request->fetchAll();
    }

    public static function add(Album $album){
        $connexion = MySql::connect();
        $add = $connexion->prepare("INSERT INTO album (titre, auteur, disponible, song_number, editor)
            VALUES (:titre, :auteur, :disponible, :song_number, :editor)");

        $titre = $album->getTitre();
        $auteur = $album->getAuteur();

        $disponible = $album->getDisponible();

        // Convertir en entier si nécessaire
        if ($disponible !== null && $disponible !== '') {
            $disponible = (int)$disponible; // Convertir en entier
        } else {
            $disponible = 0; // Défaut à 0 si nul ou vide
        }

        $songNumber = $album->getSongNumber();
        $editor = $album->getEditor();

        $add->bindParam('titre', $titre);
        $add->bindParam('auteur', $auteur);
        $add->bindParam('disponible', $disponible, PDO::PARAM_INT);
        $add->bindParam('song_number', $songNumber);
        $add->bindParam('editor', $editor);

        return $add->execute();
    }

    public static function edit(Album $album) : bool {
        $connexion = MySql::connect();
        $edit = $connexion->prepare("UPDATE album SET titre = :titre, auteur = :auteur, disponible = :disponible,
            song_number = :song_number, editor = :editor
            WHERE album.id = :id");
        
        $titre = $album->getTitre();
        $auteur = $album->getAuteur();
        
        // Assurez-vous que 'disponible' soit bien un entier
        $disponible = $album->getDisponible();
        
        // Convertir en entier si nécessaire
        if ($disponible !== null && $disponible !== '') {
            $disponible = (int)$disponible; // Convertir en entier
        } else {
            $disponible = 0; // Défaut à 0 si nul ou vide
        }
    
        $songNumber = $album->getSongNumber();
        $editor = $album->getEditor();
        $id = $album->getId();
    
        $edit->bindValue(":titre", $titre);
        $edit->bindValue(":auteur", $auteur);
        $edit->bindValue(":disponible", $disponible, PDO::PARAM_INT); // Assurez-vous que c'est bien un entier
        $edit->bindValue(":song_number", $songNumber);
        $edit->bindValue(":editor", $editor);
        $edit->bindValue(":id", $id);
    
        return $edit->execute();
    }

    public static function getAlbumById($id) {
        $connexion = MySql::connect();
        $query = $connexion->prepare("SELECT * FROM album WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    
        $albumData = $query->fetch(PDO::FETCH_ASSOC);
        if ($albumData) {
            return new Album(
                $albumData['id'],
                $albumData['titre'],
                $albumData['auteur'],
                $albumData['disponible'],
                $albumData['song_number'],
                $albumData['editor']
            );
        }
        return null;
    }

    public static function delete($id){
        $connexion = MySql::connect();
        $delete = $connexion->prepare("DELETE FROM album WHERE album.id = :id");

        $delete->bindParam(':id', $id, PDO::PARAM_INT);

        return $delete->execute();
    }
}