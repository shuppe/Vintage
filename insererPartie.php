    <?php
    require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
    require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
    require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/functions.php");
    $phDB = new dbConnectMySQL();
    $phDB->connect();
    
    if (isset($_POST['datePartie'])) {
        
        $date_partie = ($_POST['datePartie'] !== '' ? $_POST['datePartie'] : 'null');

        $arena = $_POST['arena'];
        // $locaux = $_POST['frmPartieIdEquipeL'];
        // $visiteurs = $_POST['frmPartieIdEquipeV'];
        $getId = "SELECT MAX(`id`)+1 from `CompositionEquipe`";
        $nextIdQuery = $phDB->liendb->query($getId);

        if ($nextIdQuery !== FALSE) {

            $nextId = intval($nextIdQuery->fetch()[0]);
            
            // TODO: inserer equipe locale
            $insStmt = "INSERT INTO `CompositionEquipe` (`id`, `idEquipe`) VALUES ($nextId,1), (".($nextId+1).",2)";

            $ajoutEquipes = $phDB->liendb->query($insStmt);
            if ($ajoutEquipes !== FALSE) {
                $locaux = $nextId;
                $visiteurs = $nextId+1;
                
                $insStmt = "INSERT INTO `Partie` (`datePartie`, `Heure`, `idArena`, `idEquipeLocale`, `idEquipeVisite`) VALUES ('$date_partie','22:00',$arena,$locaux,$visiteurs)";
                
                $ajouterPartie = $phDB->liendb->query($insStmt);
                if ($ajouterPartie !== FALSE) {
                    $idPartie = $phDB->liendb->lastInsertId();
                    
                    ?>
                    <div class="alert alert-success fade in" id="success-alert">
                    	<button type="button" class="close" data-dismiss="alert">x</button>
                    	<strong>Succès!</strong> La partie #<?php echo $idPartie; ?> a été créée.<BR>
                    </div>
                    ---split---
                    <input type="hidden" id="frmPartieId" name="frmPartieId" value="<?php echo $idPartie ?>">
                    <input type="hidden" id="frmPartieIdEquipeL" name="frmPartieIdEquipeL" value="<?php echo $locaux ?>">
                    <input type="hidden" id="frmPartieIdEquipeV" name="frmPartieIdEquipeV" value="<?php echo $visiteurs ?>">
                <?php
                } else {
                    ?>
                    <div class="alert alert-danger fade in" id="success-alert">
                    	<button type="button" class="close" data-dismiss="alert">x</button>
                    	<strong>Erreur 1!<BR></strong>
                                        <?php   echo json_encode($phDB->liendb->errorInfo())."<BR>"; 
                                                echo $insStmt; ?>
                                </div>
                    <?php
                }
                
            } else {
                ?>
                <div class="alert alert-danger fade in" id="success-alert">
                		<button type="button" class="close" data-dismiss="alert">x</button>
                		<strong>Erreur 2!</strong>
                               <?php print_r($ajoutPartie->errorInfo()); ?>
                </div>
                <?php
            }
        } else {
                ?>
                <div class="alert alert-danger fade in" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>Erreur 3!</strong>
                               <?php print_r($phDB->liendb->errorInfo()); ?>
                </div>
                <?php
            }
   
    } else {
        ?>
        <div class="alert alert-danger fade in" id="success-alert">
        		<button type="button" class="close" data-dismiss="alert">x</button>
        		<strong>Erreur 4!<BR></strong>
        <?php
                print "Size: " . count($_POST) . "<BR>";
                foreach ($_POST as $key => $value) {
                    echo $key . " has the value " . $value . "<BR>";
                }
        echo "</div>";
    }
    $phDB->disconnect();
    ?>