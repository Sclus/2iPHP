<?php

namespace App\Interfaces;
use App\Abstract\ItemBibliotheque;

interface Recherchable {

    /**
     * @return ItemBibliotheque[]
     */
    public function rechercher(string $motCle): array;
}
