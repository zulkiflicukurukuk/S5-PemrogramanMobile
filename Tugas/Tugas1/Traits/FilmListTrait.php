<?php
namespace PemrogramanWeb\Traits;

trait FilmListTrait {
    private $tonton_nanti = [];
    private $film_disukai = [];

    public function tontonNanti($film) {
        if (count($this->tonton_nanti) < 3) {
            $this->tonton_nanti[] = $film;
        }
    }

    public function filmDisukai($film) {
        if (count($this->film_disukai) < 3) {
            $this->film_disukai[] = $film;
        }
    }

    public function getTontonNanti() {
        return $this->tonton_nanti;
    }

    public function getFilmDisukai() {
        return $this->film_disukai;
    }
}
