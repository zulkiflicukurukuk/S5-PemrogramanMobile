<?php
require_once 'Abstracts/Film.php';
require_once 'Traits/FilmListTrait.php';
require_once 'Classes/GenreFilm.php';

use PemrogramanWeb\Classes\GenreFilm;

// Buat objek GenreFilm
$film1 = new GenreFilm("Inception", 8.8, "Sci-Fi");
$film2 = new GenreFilm("The Matrix", 8.7, "Sci-Fi");
$film3 = new GenreFilm("Interstellar", 8.6, "Sci-Fi");

// Tambahkan film yang berbeda ke daftar tonton nanti
$film1->tontonNanti("The Matrix");


// Tambahkan film yang berbeda ke daftar film disukai
$film1->filmDisukai("Inception");


// Tampilkan detail setiap film
echo "Detail Film:\n";
echo $film1->getDetail() . "\n";
echo $film2->getDetail() . "\n";
echo $film3->getDetail() . "\n";

// Tampilkan daftar tonton nanti
echo "\nTonton Nanti:\n";
print_r($film1->getTontonNanti());

// Tampilkan daftar film disukai
echo "\nFilm Disukai:\n";
print_r($film1->getFilmDisukai());
