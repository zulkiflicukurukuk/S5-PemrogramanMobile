<?php
namespace PemrogramanWeb\Classes;

use PemrogramanWeb\Abstracts\Film;
use PemrogramanWeb\Traits\FilmListTrait;

class GenreFilm extends Film {
    use FilmListTrait;

    protected $genre_film;

    public function __construct($nama_film, $rating_film, $genre_film) {
        parent::__construct($nama_film, $rating_film);
        $this->genre_film = $genre_film;
    }

    public function getDetail() {
        return "Film: {$this->nama_film}, Genre: {$this->genre_film}, Rating: {$this->rating_film}";
    }
}
