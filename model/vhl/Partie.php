<?php

use Base\Partie as BasePartie;

/**
 * Skeleton subclass for representing a row from the 'Partie' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Partie extends BasePartie
{
    /**
     * Initializes internal state of Base\Partie object.
     */
    public static function creerPartieConnue($datePartie, $heure = '22:00', $eqLocale, $eqVisite)
    {
        $partie = new Partie();
        $partie->setDatepartie($datePartie);
        $partie->setHeure($heure);
        $partie->setEquipelocale($eqLocale->getId());
        $partie->setEquipevisite($eqVisite->getId());
        $partie->setPtsequipelocale(0);
        $partie->setPtsequipevisite(0);

        return $partie;
    }

}
