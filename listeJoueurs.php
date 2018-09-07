<?php
	header('Content-type: text/html; charset=utf-8');
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
	use Propel\Runtime\Map\TableMap;
    include "generated-conf/config.php";
    include "includes/functions.php"
?>
<div class="page-header">
	<h1>Joueurs</h1>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Joueurs</h3>
	</div>
	<div class="panel-body">
	<?php
	if (JoueurQuery::create()->count() > 0) {
	?>
	<div class="table-responsive">
			<table class="table-hover table-striped liste-joueurs">
				<colgroup>
					<col class="col-md-4" />
					<col class="col-md-4" />
					<col class="col-md-2" />
					<col class="col-md-2" />
					<col class="col-md-2" />
					<col class="col-md-2" />
				</colgroup>
				<tbody class="table-striped">
					<tr>
						<th>Nom</th>
						<th>Courriel</th>
						<th>Téléphone</th>
						<th>Présence</th>
						<th>Numéro</th>
						<th>Positions</th>
					</tr>
	<?php
        $joueurs = JoueurQuery::create()->orderByNom()->find();
	foreach ($joueurs as $joueur) {
        $joueurArray = $joueur->toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = true);
            
            ?>
			<tr class="joueur">
						<td>
							<a href="#" class="joueurUpdate" data-id="<?php print ($joueur->getId()); ?>"><?php print htmlspecialchars($joueurArray['Prenom']." ".$joueurArray['Nom']); ?></a>
							<!--  -->
						</td>
						<td class="courriel"><a
							href="mailto:<?php print htmlspecialchars($joueur->getCourriel()); ?>"> <?php print htmlspecialchars($joueur->getCourriel()); ?> </a>
						</td>
						<td> <?php print htmlspecialchars(format_phone('canada', $joueur->getTelephone())); ?> </td>
						<td> <?php print htmlspecialchars($joueur->getNomStatut()); ?> </td> 
						<td style='text-align: center;'> <?php print htmlspecialchars($joueur->getNumero()); ?> </td>
						<td>
						<?php
			            $positions = $joueur->getPositionJoueurs();
			            foreach ($positions as $pos) {
			                print "<span class=\"badge badge-pill\">".$pos->getAbbrpos()."</span>";
			            }
			            ?>
 				</td>
				<td>
					<a href="#" class="joueurUpdate" data-id="<?php print ($joueur->getId()); ?>"><span class="oi oi-delete" title="delete" aria-hidden="true"></span></a>
					<!-- <button type="button" class="btn btn-danger"></button> -->
				</td>
					</tr>
			<?php
        }
        ?>
		</tbody>
			</table>
		</div>
		<?php
    } else {
        print "Aucun joueur inscrit.";
    }

?>
</div>
</div>
<script type="text/javascript">

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
