<?php

namespace App\Class;

use App\Enum\Genre;

class Movie extends Media{
    private float $duration;
    private Genre $genre;

    public function __construct($id, string $titre, string $auteur, bool $disponible, float $duration, Genre $genre) {
        parent::__construct($id, $titre, $auteur, $disponible);
        $this->duration = $duration;
        $this->genre = $genre;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function setDuration(float $newDuration){
        $this->duration = $newDuration;
    }

    public function getGenre(){
        return $this->genre->value;
    }

    public function setGenre(Genre $newGenre){
        $this->genre = $newGenre;
    }
}