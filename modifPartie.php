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
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Joueurs</h3>
	</div>
	<div class="panel-body">
		<?php
		if (JoueurQuery::create()->count() > 0) {
		?>
			<div class="card">
		  		<div class="card-header">
		    		Disponibles
		  		</div>
		  		<div class="card-body partieDiv" id="jDispo" ondrop="drop(event, this)" ondragover="allowDrop(event)" >
		  				<?php
					        $joueurs = JoueurQuery::create()->orderByNom()->find();
							foreach ($joueurs as $joueur) {
				                print "<span class=\"badge bg-info\" id=\"j".$joueur->getId()."\" draggable=\"true\" ondragstart=\"drag(event)\" ondrop=\"\" ondragover=\"\" >".htmlspecialchars($joueur->getPrenom()." ".$joueur->getNom())."</span>";
		            		}
		        		?>

		  		</div>
			</div>
			<div class="card">
		  		<div class="card-header">
		    		Avants
		  		</div>
		  		<div class="card-body partieDiv" id="jAvant" ondrop="drop(event,this)" ondragover="allowDrop(event)">
		  			&nbsp;
		  			&nbsp;
		  			&nbsp;
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
