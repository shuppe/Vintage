<?php

use Base\Alignement as BaseAlignement;

/**
 * Skeleton subclass for representing a row from the 'Alignement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Alignement extends BaseAlignement
{
/**
     * Initializes internal state of Base\Alignement object.
     */
    public static function creer($equipeNo)
    {
        $alignement = new Alignement();
        $equipe = EquipeQuery::create()->findPk($equipeNo);
        if ($equipe != null) {
            $alignement->setEquipe($equipe);
        }
        $alignement->save();

        return $alignement;
    }

}
