<?php

use Base\Joueur as BaseJoueur;

/**
 * Skeleton subclass for representing a row from the 'Joueur' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Joueur extends BaseJoueur
{

    public function getNomStatut()
    {
    	$nomStatut = 'Indéterminé';
    	switch ($this->statut) {
    		case 'R':
    			$nomStatut = 'Régulier';
    			break;
    		case 'S':
    			$nomStatut = 'Réserviste';
    			break;
    	}
        return $nomStatut;
    }

}
