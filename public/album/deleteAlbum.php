<?php
require('../../config/parameters.php');
require_once('../../config/autoloader.php');

use App\Controller\AlbumController;

var_dump($_GET);

if(isset($_GET['id']))
{
    $albumId = (int) $_GET['id'];
    $deleteAlbum = AlbumController::delete($albumId);
    if ($deleteAlbum) {
        echo "Album supprimé avec succès";
    }
    else{
        echo "Erreur lors de la suppression";
    }
}
else{
    echo "Problème avec l'id de l'album";
}
?>