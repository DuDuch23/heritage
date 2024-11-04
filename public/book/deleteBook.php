<?php
require('../../config/parameters.php');
require_once('../../config/autoloader.php');

use App\Controller\BookController;

var_dump($_GET);

if(isset($_GET['id']))
{
    $bookId = (int) $_GET['id'];
    $deleteBook = BookController::delete($bookId);
    if ($deleteBook) {
        echo "Livre supprimé avec succès";
    }
    else{
        echo "Erreur lors de la suppression";
    }
}
else{
    echo "Problème avec l'id du livre";
}
?>