<?php
/*
 * Sylvain Huppé
 *
 * Created on 10 mars 2009
 * File : config_MySQL.inc.php
 *
 * Description : Fichier de configuration pour la connexion Database sur MySQL
 *
 */

// Define connection parameters
if (strpos($_SERVER["SERVER_NAME"], "localhost") !== FALSE) {
    define('DB_MYSQL_LOGIN', 'poolAdm'); // username
} else {
    define('DB_MYSQL_LOGIN', 'z3csh562_vintage'); // username
}
define('DB_MYSQL_HOST', '127.0.0.1'); // url du serveur
define('DB_MYSQL_PASS', 'G0Hab5G0'); // password
define('DB_MYSQL_DB', 'z3csh562_vhl'); // base de donnees

?>