<?php

namespace App\Controller;

use App\Database\MySql;
use App\Class\Book;
use PDO;

final class BookController
{

    public static function getLastId(): int
    {
        $connexion = MySql::connect();
        return $connexion->lastInsertId();
    }

    public static function getAll(): array
    {
        $connexion = MySql::connect();
        $request = $connexion->prepare("SELECT * from book");

        $request->execute();
        return $request->fetchAll();
    }

    public static function add(Book $book){
        $connexion = MySql::connect();
        $add = $connexion->prepare("INSERT INTO book (titre, auteur, disponible, page_number)
            VALUES (:titre, :auteur, :disponible, :page_number)");

        $titre = $book->getTitre();
        $auteur = $book->getAuteur();

        $disponible = $book->getDisponible();

        // Convertir en entier si nécessaire
        if ($disponible !== null && $disponible !== '') {
            $disponible = (int)$disponible; // Convertir en entier
        } else {
            $disponible = 0; // Défaut à 0 si nul ou vide
        }

        $pageNumber = $book->getPageNumber();

        $add->bindParam('titre', $titre);
        $add->bindParam('auteur', $auteur);
        $add->bindParam('disponible', $disponible, PDO::PARAM_INT);
        $add->bindParam('page_number', $pageNumber);

        return $add->execute();
    }

    public static function edit(Book $book) : bool {
        $connexion = MySql::connect();
        $edit = $connexion->prepare("UPDATE book SET titre = :titre, auteur = :auteur, disponible = :disponible,
            page_number = :page_number
            WHERE book.id = :id");
        
        $titre = $book->getTitre();
        $auteur = $book->getAuteur();
        
        // S'assurer que c'est un nombre entier
        $disponible = $book->getDisponible();
        
        // Convertir en entier si nécessaire
        if ($disponible !== null && $disponible !== '') {
            $disponible = (int)$disponible; // Convertir en entier
        } else {
            $disponible = 0; // Défaut à 0 si nul ou vide
        }
    
        $pageNumber = $book->getPageNumber();
        $id = $book->getId();
    
        $edit->bindValue(":titre", $titre);
        $edit->bindValue(":auteur", $auteur);
        $edit->bindValue(":disponible", $disponible, PDO::PARAM_INT); // S'assurer que c'est un nombre entier
        $edit->bindValue(":page_number", $pageNumber);
        $edit->bindValue(":id", $id);
    
        return $edit->execute();
    }

    public static function getBookId($id) {
        $connexion = MySql::connect();
        $query = $connexion->prepare("SELECT * FROM book WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    
        $bookData = $query->fetch(PDO::FETCH_ASSOC);
        if ($bookData) {
            return new Book(
                $bookData['id'],
                $bookData['titre'],
                $bookData['auteur'],
                (bool) $bookData['disponible'], // convertir en booléen
                (int) $bookData['page_number'], // convertir en float
            );
        }
        return null;
    }

    public static function delete($id){
        $connexion = MySql::connect();
        $delete = $connexion->prepare("DELETE FROM book WHERE book.id = :id");

        $delete->bindParam(':id', $id, PDO::PARAM_INT);

        return $delete->execute();
    }
}