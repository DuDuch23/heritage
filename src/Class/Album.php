<?php

namespace App\Class;

class Album extends Media{
    private int $songNumber;
    private string $editor;

    public function __construct($id, string $titre, string $auteur, bool $disponible, int $songNumber, string $editor) {
        parent::__construct($id, $titre, $auteur, $disponible);
        $this->songNumber = $songNumber;
        $this->editor = $editor;
    }

    public function getSongNumber(): int{
        return $this->songNumber;
    }

    public function setSongNumber(int $newSongNumber): void
    {
        $this->songNumber = $newSongNumber;
    }

    public function getEditor(): string{
        return $this->editor;
    }

    public function setEditor(string $newEditor): void
    {
        $this->editor = $newEditor;
    }
}