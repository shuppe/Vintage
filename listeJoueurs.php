<?php
header('Content-type: text/html; charset=utf-8');
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/functions.php");
$phDB = new dbConnectMySQL();
$phDB->connect();
$result = $phDB->liendb->query("SELECT * FROM Joueur order by nom");
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
if ($result !== FALSE) {
    if ($result->rowCount() > 0) {
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
        $i = 0;
        while ($row = $result->fetch()) {
            if ($row['statut'] == 'R')
                $presence = 'Régulier';
            else if ($row['statut'] == 'S')
                $presence = 'Réserviste';
            else
                $presence = 'Indéterminé';
            
            $positions = $phDB->liendb->query("SELECT p.* FROM Position p, PositionJoueur pj where pj.idJoueur=" . $row['id'] . " and p.abbr = pj.position");
            ?>
			<tr class="joueur">
						<td>
							<a href="#" class="joueurUpdate" data-id="<?php print ($row['id']); ?>"><?php print htmlspecialchars($row['prenom']." ".$row['nom']); ?></a>
							<!--  -->
						</td>
						<td class="courriel"><a
							href="mailto:<?php print htmlspecialchars($row['courriel']); ?>"> <?php print htmlspecialchars($row['courriel']); ?> </a>
						</td>
						<td> <?php print htmlspecialchars(format_phone('canada', $row['telephone'])); ?> </td>
						<td> <?php print htmlspecialchars($presence); ?> </td>
						<td style='text-align: center;'> <?php print htmlspecialchars($row['numero']); ?> </td>
						<td>
					<?php
            while ($positions !== FALSE && $positions->rowCount() > 0 && $posJoueur = $positions->fetch()) {
                print $posJoueur['abbr'] . " ";
            }
            ?>
				</td>
				<td>
					<span class="oi oi-delete" title="delete" aria-hidden="true">x</span>
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
} else {
    print "Erreur de script";
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
<?php  $phDB->disconnect(); ?>
