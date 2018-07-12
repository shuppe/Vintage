<?php

/*
 * Inline DJ - 2007
 *
 * Created on 2007-02-12
 *
 * This class contains all methods related to DB.
 *
 */
class dbConnectMySQL
{

    var $liendb;

    var $erreur;

    function __construct()
    {
        $this->liendb = 0;
        $this->erreurdb = 0;
    }

    /*
     * Fonction : connect()
     * Cette fonction permet de se connecter � la base de donn�e.
     * Elle retourne le lien vers la BD.
     */
    function connect()
    {
        $this->liendb = new PDO('mysql:host=' . DB_MYSQL_HOST . ';dbname=' . DB_MYSQL_DB . ';charset=utf8', DB_MYSQL_LOGIN, DB_MYSQL_PASS);
        return $this->liendb;
    }

    /*
     * Fonction : disconnect()
     * Cette fonction permet de se d�connecter � la base de donn�e.
     */
    function disconnect()
    {
        if ($this->liendb)
            $this->liendb = null;
    }

    /*
     * Fonction : checkError()
     * Cette fonction permet de savoir si une erreur est survenu.
     * Elle renverra 0 si tout est ok. Sinon, elle renvoie l'erreur.
     */
    function checkError()
    {
        $this->erreurdb = 0;
        if (isset($this->liendb) && mysql_errno($this->liendb) != 0)
            $this->erreurdb = mysql_error($this->liendb);
        return $this->erreurdb;
    }
}

?>
