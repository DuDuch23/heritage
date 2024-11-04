<?php
// require('../config/parameters.php');
// require_once('../config/autoloader.php');

// use App\Class\Album;
// use App\Router\Router;
// use App\Controller\AlbumController;

// $allAlbums = AlbumController::getAll();
// $allAlbumsClass = [];
// foreach ($allAlbums as $album)
// {
//     $albumInst = new Album($album['id'], $album['titre'], $album['auteur'], $album['disponible'], $album['song_number'], $album['editor']);
//     $albumInst->setId($album['id']);
//     $albumInst->setTitre($album['titre']);
//     $albumInst->setAuteur($album['auteur']);
//     $albumInst->setDisponible($album['disponible']);
//     $albumInst->setSongNumber($album['song_number']);
//     $albumInst->setEditor($album['editor']);
//     array_push($allAlbumsClass, $albumInst);
// }