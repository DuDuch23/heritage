<?php
require('../../config/parameters.php');
require_once('../../config/autoloader.php');

use App\Controller\MovieController;

var_dump($_GET);

if(isset($_GET['id']))
{
    $movieId = (int) $_GET['id'];
    $deleteMovie = MovieController::delete($movieId);
    if ($deleteMovie) {
        echo "Film supprimé avec succès";
    }
    else{
        echo "Erreur lors de la suppression";
    }
}
else{
    echo "Problème avec l'id du film";
}
?>