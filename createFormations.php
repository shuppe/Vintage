<?php
	header('Content-type: text/html; charset=utf-8');
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
	use Propel\Runtime\Map\TableMap;
	use Propel\Runtime\ActiveQuery\Criteria;
    include "generated-conf/config.php";
    include "includes/functions.php";

	$nouvellePartie = false;

	if (JoueurQuery::create()->count() > 10) {

		if (isset($_POST['datePartie'])) {
			$partie = PartieQuery::create()->findOneByDatepartie($_POST['datePartie']);
			if ($partie == null) {
				$nouvellePartie = true;
				$datePartie = $_POST['datePartie'];
			}
		} else {
			$nouvellePartie = true;
			$datePartie = date("Y-m-d");
		}

		if ($nouvellePartie) {
			$partie = Partie::creerPartieConnue($datePartie, '22:00', Alignement::creer(1), Alignement::creer(2));
			?>
				<script> $('#confCreationModal').modal('show');</script>
			<?php
		}

		$equipeLocale = $partie->getEquipelocale();
		$equipeVisite = $partie->getEquipevisite();
	
		$f1 = FormationQuery::create()->innerJoinWithJoueur()->findByAlignementid($equipeLocale);
		$f2 = FormationQuery::create()->innerJoinWithJoueur()->findByAlignementid($equipeVisite);

		$listePresent = array();

		foreach ($f1->toArray() as $formation) {
			array_push($listePresent,$formation['Joueur']['Id']);
		}

		foreach ($f2->toArray() as $formation) {
			array_push($listePresent,$formation['Joueur']['Id']);
		}

		$jr = 	JoueurQuery::create()
			->filterById($listePresent, Criteria::NOT_IN)
			->orderByNom()->find();

	?>
		<div class="row partie-grp-j">
			<div class="col">
				<div class="card">      
			  		<div class="card-header">
			    		Réguliers
			  		</div>
			  		<div class="card-body partieDiv drop-zone-res" id="jDispo">
			  				<?php
			  					
								foreach ($jr as $joueur) {
									if ($joueur->getStatut() == 'R') { 
						                print "<span class=\"badge bg-vintage text-white nom-joueur\" id=\"j".$joueur->getId()."\">".htmlspecialchars($joueur->getPrenom()." ".$joueur->getNom())."</span>";
					               }
			            		}
			        		?>

			  		</div>
		  		</div>
		  	</div>
	  	</div>
			<div class="row partie-grp-j">
		  	<div class="col">
				<div class="card">
			  		<div class="card-header">
			    		Réservistes
			  		</div>
			  		<div class="card-body partieDiv drop-zone-res" id="jDispo">
			  				<?php
								foreach ($jr as $joueur) {
									if ($joueur->getStatut() != 'R') { 
						                print "<span class=\"badge bg-vintage text-white nom-joueur\" id=\"j".$joueur->getId()."\">".htmlspecialchars($joueur->getPrenom()." ".$joueur->getNom())."</span>";
									}						               
			            		}
			        		?>

			  		</div>
		  		</div>
			</div>
		</div>
		<div class="row partie-grp-eq">
			<div class="col partie-eq formation" data-eq="<?php print $equipeVisite ?>">
				<div class="card">
					<div class="card-header text-white bg-vintage">
						<div class="row">
							<div class="col col-10">
								<h3 class="card-title" align="center">Foncés</h3>
							</div>
							<div class="col col-2">
								<input class="form-control form-control-lg score" type="text" value="<?php print $partie->getPtsequipevisite(); ?>" data-eq="2">
							</div>
						</div>
					</div> 
					<div class="card-body">
						<div class="row partie-grp-j data-liste-pos-j="G">
							<div class="col">
								<div class="card">
							  		<div class="card-header">
							    		Gardien
							  		</div>
							  		<div class="card-body partieDiv drop-zone-eq" id="E1gardien">
						  				<?php
											foreach ($f2 as $fj) {
												if ($fj->getPosabbr()=='G') {
													print "<span class=\"badge bg-vintage text-white nom-joueur\" data-pos=\"G\" data-formation=\"".$fj->getAlignementId()."\" id=\"j".$fj->getJoueurId()."\">".htmlspecialchars($fj->getJoueur()->getNom()." ".$fj->getJoueur()->getPrenom())."</span>";
												}
						            		}
						        		?>
							  		</div>
								</div>
							</div>
						</div>
						<div class="row partie-grp-j" data-liste-pos-j="D">
							<div class="col">
								<div class="card">
							  		<div class="card-header">
							    		Défenseurs
							  		</div>
							  		<div class="card-body partieDiv drop-zone-eq" id="E1Def">
						  				<?php
											foreach ($f2 as $fj) {
												if ($fj->getPosabbr()=='D') {
													print "<span class=\"badge bg-vintage text-white nom-joueur\" data-pos=\"D\" data-formation=\"".$fj->getAlignementId()."\" id=\"j".$fj->getJoueurId()."\">".htmlspecialchars($fj->getJoueur()->getNom()." ".$fj->getJoueur()->getPrenom())."</span>";
												}
											}
						        		?>
							  		</div>
								</div>
							</div>
						</div>
						<div class="row partie-grp-j" data-liste-pos-j="A">
							<div class="col">
								<div class="card">
							  		<div class="card-header">
							    		Avants
							  		</div>
							  		<div class="card-body partieDiv drop-zone-eq" id="E1Avant">
						  				<?php
											foreach ($f2 as $fj) {
												if ($fj->getPosabbr()=='A') {
													print "<span class=\"badge bg-vintage text-white nom-joueur\" data-pos=\"A\" data-formation=\"".$fj->getAlignementId()."\" id=\"j".$fj->getJoueurId()."\">".htmlspecialchars($fj->getJoueur()->getNom()." ".$fj->getJoueur()->getPrenom())."</span>";
												}
											}
						        		?>
							  		</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<div class="col partie-eq formation" data-eq="<?php print $equipeLocale ?>"> 
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col col-2">
								<input class="form-control form-control-lg score" type="text" value="<?php print $partie->getPtsequipelocale(); ?>" data-eq="1">
							</div>
							<div class="col col-8">
								<h3 class="card-title" align="center"> Pâles</h3>
							</div>
						</div>
					</div> 
					<div class="card-body">
						<div class="row partie-grp-j data-liste-pos-j="G">
							<div class="col">
								<div class="card">
							  		<div class="card-header">
							    		Gardien
							  		</div>
							  		<div class="card-body partieDiv drop-zone-eq" id="E2gardien">
						  				<?php
											foreach ($f1 as $fj) {
												if ($fj->getPosabbr()=='G') {
								                print "<span class=\"badge bg-vintage text-white nom-joueur\" data-pos=\"G\" data-formation=\"".$fj->getAlignementId()."\" id=\"j".$fj->getJoueurId()."\">".htmlspecialchars($fj->getJoueur()->getNom()." ".$fj->getJoueur()->getPrenom())."</span>";
												}
												
						            		}
						        		?>
							  		</div>
								</div>
							</div>
						</div>
						<div class="row partie-grp-j" data-liste-pos-j="D">
							<div class="col">
								<div class="card">
							  		<div class="card-header">
							    		Défenseurs
							  		</div>
							  		<div class="card-body partieDiv drop-zone-eq" id="E2Def">
						  				<?php
											foreach ($f1 as $fj) {
												if ($fj->getPosabbr()=='D') {
								                print "<span class=\"badge bg-vintage text-white nom-joueur\" data-pos=\"D\" data-formation=\"".$fj->getAlignementId()."\" id=\"j".$fj->getJoueurId()."\">".htmlspecialchars($fj->getJoueur()->getNom()." ".$fj->getJoueur()->getPrenom())."</span>";
												}
												
						            		}
						        		?>
							  		</div>
								</div>
							</div>
						</div>
						<div class="row partie-grp-j" data-liste-pos-j="A">
							<div class="col">
								<div class="card">
							  		<div class="card-header">
							    		Avants
							  		</div>
							  		<div class="card-body partieDiv drop-zone-eq" id="E2Avant">
						  				<?php
											foreach ($f1 as $fj) {
												if ($fj->getPosabbr()=='A') {
								                print "<span class=\"badge bg-vintage text-white nom-joueur\" data-pos=\"A\" data-formation=\"".$fj->getAlignementId()."\" id=\"j".$fj->getJoueurId()."\">".htmlspecialchars($fj->getJoueur()->getNom()." ".$fj->getJoueur()->getPrenom())."</span>";
												}
												
						            		}
						        		?>
							  		</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
		<!-- Modal -->
		<div class="modal fade" id="confCreationModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Nouvelle partie</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<p>Aucune partie enregistrée pour cette date.</p>
						<p>Créer une partie ?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-submit" id="nouvelle-partie" data-dismiss="modal">Créer</button>
						<button type="button" class="btn btn-cancel" id="annuler-nouvelle-partie" data-dismiss="modal">Annuler</button>
					</div>
				</div>
			</div>
		</div>

	<?php
	} else {
	    print "Aucun joueur inscrit.";
	}

?>
<script type="text/javascript">

	$("#nouvelle-partie").on('click', function(event) {
		event.preventDefault();
		// $partie->save();
	});

	$("#annuler-nouvelle-partie").on('click', function(event) {
		event.preventDefault();
		window.history.go(-4);
		console.log("Annuler Nouvelle Partie");

	});

	$(".score").on('focus', function () {
        // Store the current value on focus and on change
        previous = this.value;
    }).change(function() {
        // Do something with the previous value after the change
		$.post( 'ajusterScore.php', 
				{
					partie : <?php if ($partie == null) {
						print -1;
					}
					else {
						print $partie->getId();
					}
					?>,
					equipe : $(this).data('eq'),
					score : $(this).val()
				}, 
				function(data) {

		});
	});

	$( ".nom-joueur" ).draggable({
       containment: 'document',
       cursor: 'grabbing',
       // helper: 'clone',
       opacity: 0.70,
       zIndex:10000,
       appendTo: "body"
	});


	$( ".drop-zone-eq" ).droppable({
	  accept: ".nom-joueur",
      drop: function( event, ui ) {
		console.log("drop");
		console.log("ui: ");
    	console.log(ui);

    	console.log("pos:"+ui.draggable.data('pos'));
    	console.log("Formation:"+ui.draggable.data('formation'));
    	console.log(event);
		// $(this).removeClass("border").removeClass("over");
		var dropped = ui.draggable;
		var droppedOn = $(this);
		var equipe = $(this).parents('.formation').data('eq');
		// .data(eq);    
		console.log("Equipe:");
    	console.log(equipe);
		$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);    

      }
    });
	$( ".drop-zone-res" ).droppable({
	  accept: ".nom-joueur",
      drop: function( event, ui ) {
		console.log("drop");
    	console.log(ui);
    	console.log(event);
		// $(this).removeClass("border").removeClass("over");
		var dropped = ui.draggable;
		var droppedOn = $(this);
		$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);    

      }
    });
</script>
