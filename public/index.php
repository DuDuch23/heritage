<?php
// Chemin vers le fichier parameters.php
if (file_exists(__DIR__ . '/../config/parameters.php')) {
    require(__DIR__ . '/../config/parameters.php');
    echo "Fichier parameters inclus avec succès.";
} else {
    echo "Le fichier parameters.php est introuvable.";
}

// Chemin vers le fichier autoloader.php
if (file_exists(__DIR__ . '/../config/autoloader.php')) {
    require(__DIR__ . '/../config/autoloader.php');
    echo "Fichier autoloader inclus avec succès.";
} else {
    echo "Le fichier autoloader.php est introuvable.";
}

use App\Class\Album;
use App\Class\Book;
use App\Class\Movie;
use App\Router\Router;
use App\Controller\AlbumController;
use App\Controller\BookController;
use App\Controller\MovieController;
use App\Enum\Genre;

$allAlbums = AlbumController::getAll();
$allAlbumsClass = [];
foreach ($allAlbums as $album)
{
    $albumInst = new Album($album['id'], $album['titre'], $album['auteur'], $album['disponible'], $album['song_number'], $album['editor']);
    $albumInst->setId($album['id']);
    $albumInst->setTitre($album['titre']);
    $albumInst->setAuteur($album['auteur']);
    $albumInst->setDisponible($album['disponible']);
    $albumInst->setSongNumber($album['song_number']);
    $albumInst->setEditor($album['editor']);
    array_push($allAlbumsClass, $albumInst);
}

$allMovies = MovieController::getAll();
$allMoviesClass = [];
foreach($allMovies as $movie)
{
    $genre = Genre::from($movie['genre']);

    $movieInst = new Movie($movie['id'], $movie['titre'], $movie['auteur'], $movie['disponible'], $movie['duration'], $genre);
    $movieInst->setId($movie['id']);
    $movieInst->setTitre($movie['titre']);
    $movieInst->setAuteur($movie['auteur']);
    $movieInst->setDisponible($movie['disponible']);
    $movieInst->setDuration($movie['duration']);
    $movieInst->setGenre($genre);
    array_push($allMoviesClass, $movieInst);
}

$allBooks = BookController::getAll();
$allBooksClass = [];
foreach($allBooks as $book)
{

    $bookInst = new Book($book['id'], $book['titre'], $book['auteur'], $book['disponible'], $book['page_number']);
    $bookInst->setId($book['id']);
    $bookInst->setTitre($book['titre']);
    $bookInst->setAuteur($book['auteur']);
    $bookInst->setDisponible($book['disponible']);
    $bookInst->setPageNumber($book['page_number']);
    array_push($allBooksClass, $bookInst);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-btn">
        <div class="buttons">
            <div class="container-btn">
                <button id="btn-album" class="btn">
                    Afficher albums
                </button>
                <form action="./album/addAlbum.php" method="get">
                    <input id="btn-add-album" class="btn" type="submit" value="Ajouter un album">
                </form>
                <form action="../src/Datafixtures/AlbumFixtures.php" method="get">
                    <input id="btn-add-fixtures-album" class="btn" type="submit" value="Fixtures album">
                </form>
            </div>
            <div class="container-btn">
                <button id="btn-film" class="btn">
                    Afficher films
                </button>
                <form action="./movie/addMovie.php" method="get">
                    <input id="btn-add-movie" class="btn" type="submit" value="Ajouter un film">
                </form>
            </div>
            <div class="container-btn">
                <button id="btn-livre" class="btn">
                    Afficher livres
                </button>
                <form action="./book/addBook.php" method="get">
                    <input id="btn-add-book" class="btn" type="submit" value="Ajouter un livre">
                </form>
            </div>
        </div>
    </div>
    <div class="container-array">
        <div class="array">
            <table id="album">
                <h2>Albums</h2>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Disponibilité</th>
                        <th>Song number</th>
                        <th>Editeur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($allAlbumsClass as $itemAlbum)
                    {
                    ?>
                    <tr class="data-album" data-id="<?= $itemAlbum->getId(); ?>">
                        <td><?= $itemAlbum->getTitre(); ?></td>
                        <td><?= $itemAlbum->getAuteur(); ?></td>
                        <td><?= $itemAlbum->getDisponible() ? "Disponible" : "Non disponible"; ?></td>
                        <td><?= $itemAlbum->getSongNumber(); ?></td>
                        <td><?= $itemAlbum->getEditor(); ?></td>
                        <td class="action">
                            <form action="./album/editAlbum.php" method="get">
                                <input type="hidden" name="id" value="<?= $itemAlbum->getId(); ?>">
                                <input type="submit" value="Modifier">
                            </form>
                            <form class="delete-form" method="GET">
                                <input type="hidden" name="id" value="<?= $itemAlbum->getId() ?>">
                                <button type="button" class="btn-delete btn-delete-album">Supprimer</button>
                            </form>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            <table id="film">
                <h2>Films</h2>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Disponibilité</th>
                        <th>Durée</th>
                        <th>Genre</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($allMoviesClass as $itemMovie)
                    {
                    ?>
                    <tr class="data-movie" data-id="<?= $itemMovie->getId(); ?>">
                        <td><?= $itemMovie->getTitre(); ?></td>
                        <td><?= $itemMovie->getAuteur(); ?></td>
                        <td><?= $itemMovie->getDisponible() ? "Disponible" : "Non disponible"; ?></td>
                        <td><?= $itemMovie->getDuration(); ?></td>
                        <td><?= $itemMovie->getGenre(); ?></td>
                        <td class="action">
                            <form action="./movie/editMovie.php" method="get">
                                <input type="hidden" name="id" value="<?= $itemMovie->getId(); ?>">
                                <input type="submit" value="Modifier">
                            </form>
                            <form class="delete-form" method="GET">
                                <input type="hidden" name="id" value="<?= $itemMovie->getId() ?>">
                                <button type="button" class="btn-delete btn-delete-movie">Supprimer</button>
                            </form>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            <table id="livre">
                <h2>Livres</h2>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Disponibilité</th>
                        <th>Nombre de page</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($allBooksClass as $itemBook)
                        {
                        ?>
                        <tr class="data-book" data-id="<?= $itemBook->getId(); ?>">
                            <td><?= $itemBook->getTitre(); ?></td>
                            <td><?= $itemBook->getAuteur(); ?></td>
                            <td><?= $itemBook->getDisponible() ? "Disponible" : "Non disponible"; ?></td>
                            <td><?= $itemBook->getPageNumber(); ?></td>
                            <td class="action">
                            <form action="./book/editBook.php" method="get">
                                <input type="hidden" name="id" value="<?= $itemBook->getId(); ?>">
                                <input type="submit" value="Modifier">
                            </form>
                            <form class="delete-form" method="GET">
                                <input type="hidden" name="id" value="<?= $itemBook->getId() ?>">
                                <button type="button" class="btn-delete btn-delete-book">Supprimer</button>
                            </form>
                        </td>
                        </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./script.js"></script>
</body>
</html>