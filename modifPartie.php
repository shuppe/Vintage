<?php
	header('Content-type: text/html; charset=utf-8');
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
	use Propel\Runtime\Map\TableMap;
    include "generated-conf/config.php";
    include "includes/functions.php"
?>
<div class="page-header">
	<h1>Partie</h1>
</div>
<div class="card">
	<div class="card-header text-white bg-vintage">
		<h3 class="card-title  bg-vintage">Joueurs</h3>
	</div>
	<div class="card-body">
		<?php
		if (JoueurQuery::create()->count() > 10) {
		?>
			<div class="row groupe-partie">
				<div class="col">
					<div class="card">
				  		<div class="card-header">
				    		Réguliers
				  		</div>
				  		<div class="card-body partieDiv" id="jDispo" ondrop="drop(event, this)" ondragover="allowDrop(event)" >
				  				<?php
							        $joueurs = JoueurQuery::create()->orderByNom()->find();
									foreach ($joueurs as $joueur) {
										if ($joueur->getStatut() == 'R') { 
							                print "<span class=\"badge bg-vintage text-white nom-joueur\" id=\"j".$joueur->getId()."\" draggable=\"true\" ondragstart=\"drag(event)\" ondrop=\"\" ondragover=\"\" margin-left=\"5 !important\">".htmlspecialchars($joueur->getPrenom()." ".$joueur->getNom())."</span>";
						               }
				            		}
				        		?>

				  		</div>
			  		</div>
			  	</div>	
			  	<div class="col">
					<div class="card">
				  		<div class="card-header">
				    		Réservistes
				  		</div>
				  		<div class="card-body partieDiv" id="jDispo" ondrop="drop(event, this)" ondragover="allowDrop(event)" >
				  				<?php
							        // $joueurs = JoueurQuery::create()->orderByNom()->find();
									foreach ($joueurs as $joueur) {
										if ($joueur->getStatut() != 'R') { 
							                print "<span class=\"badge bg-vintage text-white nom-joueur\" id=\"j".$joueur->getId()."\" draggable=\"true\" ondragstart=\"drag(event)\" ondrop=\"\" ondragover=\"\" margin-left=\"5 !important\">".htmlspecialchars($joueur->getPrenom()." ".$joueur->getNom())."</span>";
										}						               
				            		}
				        		?>

				  		</div>
			  		</div>
				</div>
			</div>
			<div class="row groupe-partie">
				<div class="col">
					<h3 align="center">Équipe 1</h3>
					<div class="card">
				  		<div class="card-header">
				    		Gardiens
				  		</div>
				  		<div class="card-body partieDiv" id="E1gardien" ondrop="drop(event,this)" ondragover="allowDrop(event)">
				  		</div>
					</div>
				</div>
				<div class="col">
					<h3 align="center">Équipe 2</h3>
					<div class="card">
				  		<div class="card-header">
				    		Gardiens
				  		</div>
				  		<div class="card-body partieDiv" id="E2gardien" ondrop="drop(event,this)" ondragover="allowDrop(event)">
				  		</div>
					</div>
				</div>
			</div>
			<div class="row groupe-partie">
				<div class="col">
					<div class="card">
				  		<div class="card-header">
				    		Défenseurs
				  		</div>
				  		<div class="card-body partieDiv" id="E1Def" ondrop="drop(event,this)" ondragover="allowDrop(event)">
				  		</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
				  		<div class="card-header">
				    		Défenseurs
				  		</div>
				  		<div class="card-body partieDiv" id="E2Def" ondrop="drop(event,this)" ondragover="allowDrop(event)">
				  		</div>
					</div>
				</div>
			</div>
			<div class="row groupe-partie">
				<div class="col">
					<div class="card">
				  		<div class="card-header">
				    		Avants
				  		</div>
				  		<div class="card-body partieDiv" id="E1Avant" ondrop="drop(event,this)" ondragover="allowDrop(event)">
				  		</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
				  		<div class="card-header">
				    		Avants
				  		</div>
				  		<div class="card-body partieDiv" id="E2Avant" ondrop="drop(event,this)" ondragover="allowDrop(event)">
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
<script type="text/javascript">

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, el) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    el.appendChild(document.getElementById(data));
}

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
