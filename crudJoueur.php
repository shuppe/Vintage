    <?php
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
    include "generated-conf/config.php";
    
    if (isset($_POST['nom'])) {

        if (isset($_POST['id'])) {
            $joueur = JoueurQuery::create()->findPk($_POST['id']);
        }
        else {
            $joueur = new Joueur();
        }
        
        $joueur->setNom(htmlspecialchars($_POST['nom']));
        $joueur->setPrenom(htmlspecialchars($_POST['prenom']));
        $joueur->setCourriel(htmlspecialchars($_POST['email']));
        $joueur->setTelephone(htmlspecialchars($_POST['phone']));
        $joueur->setStatut($_POST['statut']);
        $joueur->save();

        $positions = $_POST['positions'];
            
        foreach ($_POST['positions'] as $pos) {
            $position = PositionQuery::create()->findPk($pos);

            $posJoueur = new Positionjoueur();
            $posJoueur->setPosition($position);
            $posJoueur->setJoueur($joueur);
            $posJoueur->save();
        }

        ?>
        <div id="nouveauJoueur" class="panel panel-primary">
        	<div class="panel-heading">
        		<h3 class="panel-title">Ajout de joueur</h3>
        	</div>
        	<div class="panel-body">
                  		<?php
                    print $joueur->getPrenom() . " " . $joueur->getNom() . " a été ajouté avec l'ID: \"" . $joueur->getId() . "\"<BR><BR><BR>";
                    ?>
                		</div>
        </div>
        <div class="alert alert-success fade in" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Succès!</strong> Le joueur a été ajouté.
        </div>
        <?php
            // } else {
            //     echo "Erreur:" . $phDB->liendb->errorInfo();
            // }
        } else {
            
            print "Size: " . count($_POST);
            foreach ($_POST as $key => $$value) {
                echo $key . " has the value" . $value;
            }
        }
    ?>