<?php
require('../../config/parameters.php');
require_once('../../config/autoloader.php');

use App\Class\Album;
use App\Controller\AlbumController;

if (isset($_GET['id'])) {
    $albumId = (int) $_GET['id'];
    $album = AlbumController::getAlbumById($albumId);

    if (!$album) {
        echo "Album non trouvé.";
        exit;
    }
} else {
    echo "ID de l'album manquant.";
    exit;
}

$erreur = [];
$erreurValueAlbum = null;
$expressionReguliere = '/[\d\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
if(empty($_POST) === false)
{
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $songNumber = $_POST['song_number']; 
    $editor = $_POST['editor'];

    if(empty($_POST['titre']))
    {
        $erreur['titre'] = "Veuillez saisir le titre de l'album";
    }

    if(empty($_POST['auteur']))
    {
        $erreur['auteur'] = "Veuillez saisir l'auteur de l'album";
    }

    if(empty($_POST['song_number']))
    {
        $erreur['song_number'] = "Veuillez saisir le nombre de la musique";
    }

    if(empty($_POST['editor']))
    {
        $erreur['editor'] = "Veuillez saisir l'éditeur de l'album";
    }

    if(empty($erreur))
    {
        $album = new Album($_GET['id'], $_POST["titre"], $_POST["auteur"], $_POST['disponible'], $_POST['song_number'], $_POST['editor']);
        $album->setId($_GET['id']);
        $album->setTitre($_POST['titre']);
        $album->setAuteur($_POST['auteur']);
        $album->setDisponible($_POST['disponible']);
        $album->setSongNumber($_POST['song_number']);
        $album->setEditor($_POST['editor']);

        $ajoutAlbum = AlbumController::edit($album);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un album</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="content_body">
        <ul class="nav">
            <li>
                <a href="addAlbum.php">Ajouter un album</a>
            </li>
            <li>
                <a href="../index.php">Voir tout les albums</a>
            </li>
        </ul>

        <div class="content_form">
            <h1 class="title_form">Modifier un album : </h1>

            <form class="form" action="#" method="POST">

                <div class="content_input">
                    <label class="label_form" for="titre">Titre : </label>
                    <div class="content_input_form_content_message_erreur">
                        <input class="input_form" type="text" name="titre" value="<?= $album->getTitre() ?>">
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
                        <input class="input_form" type="text" name="auteur" value="<?= $album->getAuteur() ?>">
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
                            <option value="1" <?php if ($album->getDisponible()) echo 'selected'; ?>>Disponible</option>
                            <option value="0" <?php if (!$album->getDisponible()) echo 'selected'; ?>>Non disponible</option>
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
                    <label class="label_form" for="song_number">Numéro de l'album : </label>
                    <div class="content_input_form_content_message_erreur">         
                        <input class="input_form" type="number" name="song_number" value="<?= $album->getSongNumber() ?>">                   
                        <?php
                            if(isset($erreur['song_number']))
                            {
                                ?><div class="content_message_erreur">
                                    <p class="message_erreur"><?php echo "<-- ".$erreur['song_number']; ?></p>
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
                    <label class="label_form" for="editor">Editeur : </label>
                    <div class="content_input_form_content_message_erreur">
                        <input class="input_form" type="text" name="editor" value="<?= $album->getEditor() ?>">
                        <?php
                            if(isset($erreur['editor']))
                            {
                                ?><div class="content_message_erreur">
                                    <p class="message_erreur"><?php echo "<-- ".$erreur['editor']; ?></p>
                                </div><?php
                            }
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                </div>

                <input class="submit_form" type="submit" value="Modifier l'album">
            </form>
        </div>
    </div>
</body>
</html>