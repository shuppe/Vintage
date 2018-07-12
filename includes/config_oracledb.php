<?php
if (isset($_GET['environment'])) {
    // username
    define('DB_LOGIN', '_hdadmin');
    
    // password
    define('DB_PASS', 'n1md4hda');
    
    // URL - Specific definitions no longer necessary when env. variable TNS_ADMIN has been
    // set to point to tnsnames.ora on server and you use connection descriptor name
    define('DB_URL', $_GET['environment']);
}

?>