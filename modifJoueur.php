<div class="page-header">
	<h1>Joueur</h1>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Ajout de joueur</h3>
	</div>
	<div class="panel-body">
		<form id="form-joueur">

			<div class="row">
				<div class="form-group col-xs-4">
					<label for="prenom">Prénom:</label> <input type="text"
						class="form-control" id="prenom" name="prenom">
				</div>
				<div class="form-group col-xs-4">
					<label for="nom">Nom:</label> <input type="text"
						class="form-control" id="nom" name="nom">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-xs-6">
					<label for="email">Courriel:</label> <input type="email"
						class="form-control" id="email" name="email">
				</div>
				<div class="form-group col-xs-2">
					<label for="phone">Téléphone:</label> <input type="text"
						class="form-control" id="phone" name="phone">
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<fieldset class="col-xs-2">
						<legend class="col-form-legend ">Statut</legend>
						<div class="radio">
							<label><input type="radio" name="statut" value="P">Régulier</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="statut" value="R">Réserviste</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="statut" value="I" checked>Indéterminé</label>
						</div>
					</fieldset>
					<fieldset class="col-xs-2">
						<legend class="col-form-legend">Position</legend>
						<div class="checkbox">
							<label><input type="checkbox" name="positions[]" value="A">Attaquant</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="positions[]" value="D">Défenseur</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="positions[]" value="G">Gardien</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8">
					<button type="submit" class="btn btn-default" id="frmSubmit">Submit</button>
					<button type="cancel" class="btn" id="frmCancel">Annuler</button>
				</div>
			</div>
		</form>

	</div>
</div>
<script type="text/javascript">

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
