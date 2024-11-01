<?php
namespace PemrogramanWeb\Abstracts;

abstract class Film {
    protected $nama_film;
    protected $rating_film;

    public function __construct($nama_film, $rating_film) {
        $this->nama_film = $nama_film;
        $this->rating_film = $rating_film;
    }

    abstract public function getDetail();
}
