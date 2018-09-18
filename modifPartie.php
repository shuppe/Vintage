<?php
	header('Content-type: text/html; charset=utf-8');
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
	use Propel\Runtime\Map\TableMap;
    include "generated-conf/config.php";
    include "includes/functions.php";

	$option_arenas = "<option value=\"\" disabled selected hidden>&nbsp;</option>\n";
	if (ArenaQuery::create()->count() > 0) {
		$arenas=ArenaQuery::create()->find();
		$arenaList=$arenas->toArray();
		foreach ($arenaList as $arena) {
			$option_arenas .= "<option value='" . $arena['Id'] . "'>" . $arena['Nom'] . "</option>\n";
		}
	}

?>
<form id="form-partie" class="form-horizontal" data-changed="false">
	<div id="donneesPartie">
		<input type="hidden" id="frmPartieId" name="frmPartieId"> 
		<input type="hidden" id="frmPartieIdEquipeL" name="frmPartieIdEquipeL">
		<input type="hidden" id="frmPartieIdEquipeV" name="frmPartieIdEquipeV">
	</div>
	<div class="page-header">
		<h1>Partie</h1>
	</div>
	<div class="card">
		<div class="card-header text-white bg-vintage">
			<h3 class="card-title  bg-vintage">Info Partie</h3>
		</div>
		<div class="card-body">
			<div class="row partie-grp-p">
				<div class="col">
					<label for="date" class="control-label">Date:</label>
					<input type="date" class="form-control" id="datePartie" name="datePartie">
				</div>
				<div class="col">
					<label for="arena" class="control-label">Arena:</label> 
					<select class="form-control custom-select" id="arena" name="arena">
						<?php echo $option_arenas; ?>
					</select>
				</div>
			</div>
		</div>	
	</div>
	<div class="card">
		<div class="card-header text-white bg-vintage">
			<h3 class="card-title  bg-vintage">Joueurs</h3>
		</div>
		<div class="card">
			
		</div>
		<div class="card-body">
			<?php
			if (JoueurQuery::create()->count() > 10) {
				    if (isset($_POST['id'])) {
				        $partie = PartieQuery::create()->findPk(1);
					} else {
						$partie = new Partie();
					}
				        $partieArray = $partie->toArray();
				        echo "<BR><BR>partieArray: ";
				        print_r($partieArray);

			?>
				<div class="row partie-grp-j">
					<div class="col">
						<div class="card">
					  		<div class="card-header">
					    		Réguliers
					  		</div>
					  		<div class="card-body partieDiv dropZone" id="jDispo">
					  				<?php
								        $joueurs = JoueurQuery::create()->orderByNom()->find();
										foreach ($joueurs as $joueur) {
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
					  		<div class="card-body partieDiv dropZone" id="jDispo">
					  				<?php
								        // $joueurs = JoueurQuery::create()->orderByNom()->find();
										foreach ($joueurs as $joueur) {
											if ($joueur->getStatut() != 'R') { 
								                print "<span class=\"badge bg-vintage text-white nom-joueur\" id=\"j".$joueur->getId()."\">".htmlspecialchars($joueur->getPrenom()." ".$joueur->getNom())."</span>";
											}						               
					            		}
					        		?>

					  		</div>
				  		</div>
					</div>
				</div>
				<div class="row partie-eq">
					<div class="col partie-eq" data-eq="1">
						<div class="card">
							<div class="card-header text-white bg-vintage">
								<h3 class="card-title" align="center">Foncés</h3>
							</div> 
							<div class="card-body">
								<div class="row partie-grp-j data-liste-pos-j="G">
									<div class="col">
										<div class="card">
									  		<div class="card-header">
									    		Gardien
									  		</div>
									  		<div class="card-body partieDiv dropZone" id="E1gardien">
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
									  		<div class="card-body partieDiv dropZone" id="E1Def">
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
									  		<div class="card-body partieDiv dropZone" id="E1Avant">
									  		</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<div class="col partie-eq" data-eq="2"> 
						<div class="card">
							<div class="card-header">
								<h3 class="card-title" align="center">Pâles</h3>
							</div> 
							<div class="card-body">
								<div class="row partie-grp-j data-liste-pos-j="G">
									<div class="col">
										<div class="card">
									  		<div class="card-header">
									    		Gardien
									  		</div>
									  		<div class="card-body partieDiv dropZone" id="E2gardien">
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
									  		<div class="card-body partieDiv dropZone" id="E2Def">
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
									  		<div class="card-body partieDiv dropZone" id="E2Avant">
									  		</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 
				</div>
			<?php
		    } else {
		        print "Aucun joueur inscrit.";
		    }

			?>
		</div>
	</div>
</form>
<script type="text/javascript">

$( ".nom-joueur" ).draggable({
       containment: 'document',
       cursor: 'grabbing',
       // helper: 'clone',
       opacity: 0.70,
       zIndex:10000,
       appendTo: "body"
   });


$( ".dropZone" ).droppable({
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
<!--
$(".joueurUpdate").click(function(e){ 

	e.preventDefault();
	var $elem = $(this);
  $.post( "modifJoueur.php", { id: $elem.data("id") },
 /*{
  	nom: $('#nom').val(),
  	prenom: 	$('#prenom').val(),
  	email: 	$('#email').val(),
  	positions: $('#positions').val()
  },*/
    function(data)
     {
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
        $("#dataContainer").empty().append(data);
        
    		$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
        
      });

}); 


</script>
 -->