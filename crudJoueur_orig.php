    <?php
    require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
    require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
    require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/functions.php");
    $phDB = new dbConnectMySQL();
    $cdBD = $phDB->connect();
    
    if (isset($_POST['nom'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $phone = $_POST['phone'];
        
        $positions = $_POST['positions'];
        $statut = $_POST['statut'];
        // $POSITIONS=$_POST['POSITIONS'];
        
        $query = "INSERT INTO `Joueur`
         (`nom`,`prenom`,`courriel`,`telephone`)
         VALUES
         ('$nom','$prenom','$email','$phone');";
        
        if ($phDB->liendb->query($query)) {
            $last_id = $phDB->liendb->lastInsertId();
            
            $pos_query = "" . $pos_query;
            foreach ($_POST['positions'] as $pos) {
                $pos_parms .= " ($last_id, '$pos'),";
            }
            if ($pos_parms !== '') {
                $pos_query = "Insert INTO `PositionJoueur` (`idJoueur`,`position`) values " . substr($pos_parms, 0, - 1) . ";";
                $phDB->liendb->query($pos_query);
            }
            ?>
<div class="alert alert-success fade in" id="success-alert">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<strong>Succès!</strong> Le joueur a été ajouté.
</div>
<div id="nouveauJoueur" class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Ajout de joueur</h3>
	</div>
	<div class="panel-body">
          		<?php
            print "Le joueur" . $prenom . " " . $nom . " a été ajouté avec l'ID: \"" . $last_id . "\"<BR><BR><BR>";
            ?>
        		</div>
</div>
<?php
        } else {
            echo "Erreur:" . $phDB->liendb->errorInfo();
        }
    } else {
        
        print "Size: " . count($_POST);
        foreach ($_POST as $key => $$value) {
            echo $key . " has the value" . $value;
        }
    }
    $phDB->disconnect();
    ?>