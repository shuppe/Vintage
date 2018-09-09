<?php
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
	use Propel\Runtime\Map\TableMap;
    include "generated-conf/config.php";

	$joueurArray=[];
    $pos = array();
    if (isset($_POST['id'])) {
        $joueur = JoueurQuery::create()->findPk($_POST['id']);
        $joueurArray = $joueur->toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = true);
        // $joueurArray = $joueur->toArray();
        echo "<BR><BR>joueurArray: ";
        print_r($joueurArray);
        echo "<BR><BR>positionsArray: ";

        print_r($joueurArray['Positionjoueurs'] );
        $positionsArray = $joueurArray['Positionjoueurs'];
        echo "<BR><BR>positionsArray (foreach): ";

        foreach ($positionsArray as $key => $value) {
        	array_push($pos, $value['Abbrpos']); 
        }
        echo "<BR><BR>pos: ";
        print_r($pos);
	}
?>
<div class="page-header">
	<h1>Joueur</h1>
</div>
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Ajout de joueur</h3>
	</div>
	<div class="card-body">
		<form id="form-joueur" data-changed="false">
			<input type="hidden" class="form-control" id="id" name="id" value="<?php print $joueurArray['Id'] ?>">

			<div class="row">
				<div class="form-group col-xs-4">
					<label for="prenom">Prénom:</label> <input type="text"
						class="form-control" id="prenom" name="prenom" value="<?php print $joueurArray['Prenom'] ?>">
				</div>
				<div class="form-group col-xs-4">
					<label for="nom">Nom:</label> <input type="text"
						class="form-control" id="nom" name="nom" value="<?php print $joueurArray['Nom'] ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-xs-6">
					<label for="email">Courriel:</label> <input type="email"
						class="form-control" id="email" name="email" value="<?php print $joueurArray['Courriel'] ?>">
				</div>
				<div class="form-group col-xs-2">
					<label for="phone">Téléphone:</label> <input type="text"
						class="form-control" id="phone" name="phone" value="<?php print $joueurArray['Telephone'] ?>">
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<fieldset class="col-xs-2">
						<legend class="col-form-legend ">Statut</legend>
						<div class="radio">
							<label><input type="radio" name="statut" value="R" <?php echo ($joueurArray['Statut']=='R')?'checked':'' ?>>Régulier</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="statut" value="S" <?php echo ($joueurArray['Statut']=='S')?'checked':'' ?>>Réserviste</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="statut" value="I" <?php echo ($joueurArray['Statut']=='I' || $joueurArray['Statut'] == null)?'checked':'' ?>>Indéterminé</label>
						</div>
					</fieldset>
					<fieldset class="col-xs-2">
						<legend class="col-form-legend">Position</legend>
						<div class="checkbox">
							<label><input type="checkbox" name="positions[]" value="A" <?php echo in_array('A',$pos)?'checked':'' ?>>Attaquant</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="positions[]" value="D" <?php echo in_array('D',$pos)?'checked':'' ?>>Défenseur</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="positions[]" value="G" <?php echo in_array('G',$pos)?'checked':'' ?>>Gardien</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8">
					<button type="submit" class="btn btn-default checkChangedbutton" id="frmSubmit">Submit</button>
					<button type="cancel" class="btn" id="frmCancel">Annuler</button>
				</div>
			</div>
		</form>

	</div>
</div>
<script type="text/javascript">
/*
	$('.checkChangedbutton').click(function() {
		e.preventDefault();
		if($(this).closest('form').data('changed')) {

	 		$.post( "", $("#form-joueur").serialize(), function(data) {

        		//if success then just output the text to the status div then clear the form inputs to prepare for new data
        		$("#dataContainer").empty().append(data);
        
    			//$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            	//$("#success-alert").slideUp(500);
        		//});
        
      		});

		}
	     //do something
	});
*/

$("#frmSubmit").click(function(e){ 

	e.preventDefault();
  $.post( "crudJoueur.php", $("#form-joueur").serialize(),
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
