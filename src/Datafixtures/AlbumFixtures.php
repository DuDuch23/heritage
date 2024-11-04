<?php

use App\Database\MySql;

try {
    $connexion = MySql::connect();
    $query = "
        INSERT INTO `album` (`id`, `titre`, `auteur`, `disponible`, `song_number`, `editor`) VALUES 
        (NULL, 'Thriller', 'Michael Jackson', '1', '9', 'Pop'),
        (NULL, 'Back in Black', 'AC/DC', '1', '10', 'Rock'),
        (NULL, 'The Dark Side of the Moon', 'Pink Floyd', '1', '10', 'Rock'),
        (NULL, 'The Wall', 'Pink Floyd', '0', '26', 'Rock'),
        (NULL, 'Abbey Road', 'The Beatles', '1', '17', 'Rock'),
        (NULL, 'Hotel California', 'Eagles', '1', '9', 'Rock'),
        (NULL, '1989', 'Taylor Swift', '0', '13', 'Pop'),
        (NULL, 'Rumours', 'Fleetwood Mac', '1', '11', 'Rock'),
        (NULL, 'Led Zeppelin IV', 'Led Zeppelin', '1', '8', 'Rock'),
        (NULL, 'Purple Rain', 'Prince', '1', '9', 'Pop'),
        (NULL, 'Born to Die', 'Lana Del Rey', '1', '12', 'Indie Pop'),
        (NULL, 'Nevermind', 'Nirvana', '0', '12', 'Grunge'),
        (NULL, 'Hounds of Love', 'Kate Bush', '1', '12', 'Alternative'),
        (NULL, 'Random Access Memories', 'Daft Punk', '1', '13', 'Electronic'),
        (NULL, '25', 'Adele', '1', '11', 'Pop'),
        (NULL, 'OK Computer', 'Radiohead', '1', '12', 'Alternative'),
        (NULL, 'In the Aeroplane Over the Sea', 'Neutral Milk Hotel', '0', '11', 'Indie'),
        (NULL, 'American Idiot', 'Green Day', '1', '13', 'Punk Rock'),
        (NULL, 'Born This Way', 'Lady Gaga', '1', '14', 'Pop'),
        (NULL, 'Songs in the Key of Life', 'Stevie Wonder', '1', '21', 'Soul');
    ";

    $connexion->exec($query);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}