<?php
require('../../config/parameters.php');
require_once('../../config/autoloader.php');

use App\Class\Movie;
use App\Controller\MovieController;
use App\Enum\Genre;

if (isset($_GET['id'])) {
    $movieId = (int) $_GET['id'];
    $movie = MovieController::getMovieId($movieId);

    if (!$movie) {
        echo "Film non trouvé.";
        exit;
    }
} else {
    echo "ID du film manquant.";
    exit;
}

$erreur = [];
$erreurValueMovie = null;
$expressionReguliere = '/[\d\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
if(empty($_POST) === false)
{
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $duration = $_POST['duration']; 
    $genreInput = $_POST['genre'];

    if(empty($_POST['titre']))
    {
        $erreur['titre'] = "Veuillez saisir le titre de l'album";
    }

    if(empty($_POST['auteur']))
    {
        $erreur['auteur'] = "Veuillez saisir l'auteur de l'album";
    }

    if(empty($_POST['duration']))
    {
        $erreur['duration'] = "Veuillez saisir la durée du film (dans ce format : 1.5)";
    }

    if(empty($_POST['genre']))
    {
        $erreur['genre'] = "Veuillez saisir le genre du film";
    }

    if (empty($erreur)) {
        // Assurez-vous que le genre est une instance de Genre
        $genreInput = $_POST['genre']; // Ensure this variable is assigned before usage
        try {
            $genre = Genre::from($genreInput);
        } catch (\ValueError $e) {
            $erreur['genre'] = "Genre invalide";
        }
    
        // Créer une instance de Movie avec l'énumération Genre
        $movie = new Movie(
            (int) $_GET['id'], 
            $titre, 
            $auteur, 
            (bool) $_POST['disponible'], 
            (float) $duration, 
            $genre // Assurez-vous que c'est un objet Genre ici
        );
    
        // Optionnel, vous pouvez appeler des setters si vous souhaitez modifier davantage
        $movie->setDisponible((bool) $_POST['disponible']);
        
        // Appel de la méthode de mise à jour de votre contrôleur
        $ajoutMovie = MovieController::edit($movie);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un film</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="content_body">
        <ul class="nav">
            <li>
                <a href="../movie/addMovie.php">Ajouter un film</a>
            </li>
            <li>
                <a href="../index.php">Voir tout les films</a>
            </li>
        </ul>

        <div class="content_form">
            <h1 class="title_form">Modifier un film : </h1>

            <form class="form" action="#" method="POST">

                <div class="content_input">
                    <label class="label_form" for="titre">Titre : </label>
                    <div class="content_input_form_content_message_erreur">
                        <input class="input_form" type="text" name="titre" value="<?= $movie->getTitre() ?>">
                        <?php
                            if(isset($erreur['titre']))
                            {
                                ?><div class="content_message_erreur">
                                    <p class="message_erreur"><?php echo "<-- ".$erreur['titre']; ?></p>
                                </div><?php
                            }
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                </div>

                <div class="content_input">
                    <label class="label_form" for="auteur">Auteur : </label>
                    <div class="content_input_form_content_message_erreur">
                        <input class="input_form" type="text" name="auteur" value="<?= $movie->getAuteur() ?>">
                        <?php
                            if(isset($erreur['auteur']))
                            {
                                ?><div class="content_message_erreur">
                                    <p class="message_erreur"><?php echo "<-- ".$erreur['auteur']; ?></p>
                                </div><?php
                            }
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                </div>

                <div class="content_input">
                    <label class="label_form" for="disponible">Disponibilité : </label>
                    <div class="content_input_form_content_message_erreur">
                        <select name="disponible">
                            <option value="1" <?php if ($movie->getDisponible()) echo 'selected'; ?>>Disponible</option>
                            <option value="0" <?php if (!$movie->getDisponible()) echo 'selected'; ?>>Non disponible</option>
                        </select>
                        <?php
                            if(isset($erreur['date']))
                            {
                                ?><div class="content_message_erreur">
                                    <p class="message_erreur"><?php echo "<-- ".$erreur['disponible']; ?></p>
                                </div><?php
                            }
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                </div>

                <div class="content_input">
                    <label class="label_form" for="duration">Numéro de la durée du film : </label>
                    <div class="content_input_form_content_message_erreur">         
                        <input class="input_form" type="number" name="duration" value="<?= $movie->getDuration() ?>">                   
                        <?php
                            if(isset($erreur['duration']))
                            {
                                ?><div class="content_message_erreur">
                                    <p class="message_erreur"><?php echo "<-- ".$erreur['duration']; ?></p>
                                </div><?php
                            }
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                </div>

                <div class="content_input">
                    <label class="label_form" for="genre">Genre : </label>
                    <div class="content_input_form_content_message_erreur">
                        <select name="genre" id="genre">
                            <?php
                            // Parcourir chaque cas de l'énumération Genre
                            foreach (Genre::cases() as $genreCase) {
                                // Récupérer la valeur de l'énumération
                                $value = $genreCase->value;
                                // Déterminer si l'option doit être sélectionnée
                                $selected = ($value === $movie->getGenre()) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$value</option>";
                            }
                            ?>
                        </select>
                        <?php
                            if(isset($erreur['genre']))
                            {
                                ?><div class="content_message_erreur">
                                    <p class="message_erreur"><?php echo "<-- ".$erreur['genre']; ?></p>
                                </div><?php
                            }
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                </div>

                <input class="submit_form" type="submit" value="Modifier le film">
            </form>
        </div>
    </div>
</body>
</html>