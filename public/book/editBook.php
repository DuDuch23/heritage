<?php
require('../../config/parameters.php');
require_once('../../config/autoloader.php');

use App\Class\Book;
use App\Controller\BookController;

if (isset($_GET['id'])) {
    $bookId = (int) $_GET['id'];
    $book = BookController::getBookId($bookId);

    if (!$book) {
        echo "Livre non trouvé.";
        exit;
    }
} else {
    echo "ID du livre manquant.";
    exit;
}

$erreur = [];
$erreurValueBook = null;
$expressionReguliere = '/[\d\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
if(empty($_POST) === false)
{
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $pageNumber = $_POST['page_number']; 

    if(empty($_POST['titre']))
    {
        $erreur['titre'] = "Veuillez saisir le titre de l'album";
    }

    if(empty($_POST['auteur']))
    {
        $erreur['auteur'] = "Veuillez saisir l'auteur de l'album";
    }

    if(empty($_POST['page_number']))
    {
        $erreur['page_number'] = "Veuillez saisir le nombre de page";
    }

    if(empty($erreur))
    {
        $book = new Book($_GET['id'], $_POST["titre"], $_POST["auteur"], $_POST['disponible'], $_POST['page_number']);
        $book->setId($_GET['id']);
        $book->setTitre($_POST['titre']);
        $book->setAuteur($_POST['auteur']);
        $book->setDisponible($_POST['disponible']);
        $book->setPageNumber($_POST['page_number']);

        $ajoutBook = BookController::edit($book);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un livre</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="content_body">
    <ul class="nav">
        <li>
            <a href="./addBook.php">Ajouter un livre</a>
        </li>
        <li>
            <a href="../index.php">Voir tout les livres</a>
        </li>
    </ul>

    <div class="content_form">
        <h1 class="title_form">Modifier un livre : </h1>

        <form class="form" action="#" method="POST">

            <div class="content_input">
                <label class="label_form" for="titre">Titre : </label>
                <div class="content_input_form_content_message_erreur">
                    <input class="input_form" type="text" name="titre" value="<?= $book->getTitre() ?>">
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
                    <input class="input_form" type="text" name="auteur" value="<?= $book->getAuteur() ?>">
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
                        <option value="1" <?php if ($book->getDisponible()) echo 'selected'; ?>>Disponible</option>
                        <option value="0" <?php if (!$book->getDisponible()) echo 'selected'; ?>>Non disponible</option>
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
                <label class="label_form" for="page_number">Page du livre : </label>
                <div class="content_input_form_content_message_erreur">         
                    <input class="input_form" type="number" name="page_number" value="<?= $book->getPageNumber() ?>">                   
                    <?php
                        if(isset($erreur['page_number']))
                        {
                            ?><div class="content_message_erreur">
                                <p class="message_erreur"><?php echo "<-- ".$erreur['page_number']; ?></p>
                            </div><?php
                        }
                        else
                        {
                            echo "";
                        }
                    ?>
                </div>
            </div>

            <input class="submit_form" type="submit" value="Modifier le livre">
        </form>
    </div>
</div>
</body>
</html>