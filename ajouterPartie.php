<?php
header('Content-type: text/html; charset=utf-8');
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/functions.php");
$phDB = new dbConnectMySQL();
$phDB->connect();

//joueurs
$joueurs = $phDB->liendb->query("SELECT * FROM Joueur");
$option_joueurs = "<option value=\"\" disabled selected hidden>&nbsp;</option>\n";
if ($joueurs !== FALSE && $joueurs->rowCount() > 0) {
    while ($joueur = $joueurs->fetch()) {
        $option_joueurs .= "<option value='" . $joueur['id'] . "'>" . $joueur['prenom'] . " " . $joueur['nom'] . "</option>\n";
    }
}

$arenas = $phDB->liendb->query("SELECT * FROM Arena");
$option_arenas = "<option value=\"\" disabled selected hidden>&nbsp;</option>\n";
if ($arenas !== FALSE && $arenas->rowCount() > 0) {
    while ($arena = $arenas->fetch()) {
        $option_arenas .= "<option value='" . $arena['id'] . "'>" . $arena['Nom'] . "</option>\n";
    }
}

$j_init = 0;
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Nouvelle partie</h3>
	</div>
	<div class="panel-body">
		<form id="form-partie" class="form-horizontal" data-changed="false">
			<div id="donneesPartie">
				<input type="hidden" id="frmPartieId" name="frmPartieId"> 
				<input type="hidden" id="frmPartieIdEquipeL" name="frmPartieIdEquipeL">
				<input type="hidden" id="frmPartieIdEquipeV" name="frmPartieIdEquipeV">
			</div>
			<div class="form-group">
				<div class="col-md-6">
<!--					<div class='input-group date' id='datetimepicker3'>
                    	<input type='text' class="form-control" />
                    	<span class="input-group-addon">
                        	<span class="glyphicon glyphicon-time"></span>
                    	</span>
                	</div>
-->
					<label for="date" class="control-label">Date:</label>
					<input type="date" class="form-control" id="datePartie" name="datePartie">
<!--		<script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
-->
				</div>
				<div class="col-md-6">
					<label for="arena" class="control-label">Arena:</label> <select
						class="form-control" id="arena" name="arena">
						<?php echo $option_arenas; ?>
					</select>
				</div>

			</div>

			<div class="form-group">
				<div class="col-md-6 comp-equipe">
					<Label>Équipe 1</Label>
				</div>
				<div class="col-md-6 comp-equipe">
					<Label>Équipe 2</Label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12 comp-positon">
					<Label>Gardien</Label>
				</div>
				<div class="col-md-6 comp-equipe">
					
					<?php
    $j_pos = $j_init;
    while (++ $j_pos <= 1) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e1-j" . $j_pos . "\" name=\"e1-j" . $j_pos . "\" data-equipe=\"1\" data-joueur=\""
        		. $j_pos ."\" data-pos=\"G\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>
				</div>
				<div class="col-md-6 comp-equipe">
					<?php
    $j_pos = $j_init;
    while (++ $j_pos <= 1) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e2-j" . $j_pos . "\" name=\"e2-j" . $j_pos . "\" data-equipe=\"2\" data-joueur=\""
        		. $j_pos ."\" data-pos=\"G\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12 comp-positon">
					<Label>Attaquants</Label>
				</div>
				<div class="col-md-6 comp-equipe">
					
					<?php
    $j_init = $j_pos;
    while (++ $j_pos <= 8) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e1-j" . $j_pos . "\" name=\"e1-j" . $j_pos . "\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>

				</div>
				<div class="col-md-6 comp-equipe">
					<?php
    $j_pos = $j_init;
    while (++ $j_pos <= 8) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e2-j" . $j_pos . "\" name=\"e2-j" . $j_pos . "\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12 comp-positon">
					<Label>Défenseurs</Label>
				</div>
				<div class="col-md-6 comp-equipe">
					
					<?php
    $j_init = $j_pos;
    while (++ $j_pos <= 13) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e1-j" . $j_pos . "\" name=\"e1-j" . $j_pos . "\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>

				</div>
				<div class="col-md-6 comp-equipe">
					<?php
    $j_pos = $j_init;
    while (++ $j_pos <= 13) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e2-j" . $j_pos . "\" name=\"e2-j" . $j_pos . "\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12 comp-positon">
					<Label>Extras</Label>
				</div>
				<div class="col-md-6 comp-equipe">
					
					<?php
    $j_init = $j_pos;
    while (++ $j_pos <= 16) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e1-j" . $j_pos . "\" name=\"e1-j" . $j_pos . "\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>

				</div>
				<div class="col-md-6 comp-equipe">
					<?php
    $j_pos = $j_init;
    while (++ $j_pos <= 16) {
        echo "<select class=\"comp-eq-j form-control\" id=\"e2-j" . $j_pos . "\" name=\"e2-j" . $j_pos . "\">\n";
        echo $option_joueurs;
        echo "</select>" . "\n";
    }
    ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<button type="submit" class="btn btn-default checkChangedbutton"
						id="frmSubmit">Save</button>
					<button type="cancel" class="btn" id="frmCancel">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">

(function () {

    var previous;

/*	$(".form-control").change(function() {

    	if ( $(this).closest('form').attr("data-changed") == "false") {
			alert("Tombe dans le if. data-changed: " + $(this).closest('form').attr("data-changed"));
			$(this).closest('form').attr("data-changed",'true');
			$.post( 'insererPartie.php', 
				{
					datePartie: $("#datePartie").val();
					arena: $("#arena").val();
				}, 
				function(data) {

        		//if success then just output the text to the status div then clear the form inputs to prepare for new data
        
    				$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
           			$("#success-alert").slideUp(500);
	        		});
        		});
		}
		else {
			alert("Tombe dans le else. data-changed: " + $(this).closest('form').attr("data-changed"));
		}
	});
*/
	$('.checkChangedbutton').click(function() {
		e.preventDefault();
		if($(this).closest('form').data('changed')) {

	 		$.post( "", $("#form-partie").serialize(), function(data) {

        		//if success then just output the text to the status div then clear the form inputs to prepare for new data
        		$("#dataContainer").empty().append(data);
        
    			//$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            	//$("#success-alert").slideUp(500);
        		//});
        
      		});

		}
	     //do something
	});

    $(".comp-eq-j").on('focus', function () {
        // Store the current value on focus and on change
        previous = this.value;
    }).change(function() {
        // Do something with the previous value after the change
    	if ( $(this).closest('form').attr("data-changed") == "false") {
			//alert("Tombe dans le if. data-changed: " + $(this).closest('form').attr("data-changed"));
			$(this).closest('form').attr("data-changed",'true');
			$.post( 'insererPartie.php', 
				{
					datePartie : $('#datePartie').val(),
					arena : $("#arena").val()
				}, 
				function(data) {

        		//if success then just output the text to the status div then clear the form inputs to prepare for new data
        			var reponse=data.split("---split---");
        			$("#msgContainerBottom").empty().append(reponse[0]);
        			$("#donneesPartie").empty().append(reponse[1]);
    				//$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
           			//$("#success-alert").slideUp(500);
	        		//});
        		});
		}
		else {

			var $elem = $(this);

			var $equipe=$elem.data("equipe");
			var $position=$elem.data("pos");
			var $noJoueur=$elem.data("joueur");
			
			$.post( 'remplacerJoueur.php', 
				{
					idPartie : $('#frmPartieId').val(),
					idEquipe : ($equipe==1 ? $('#frmPartieIdEquipeL').val() : $('#frmPartieIdEquipeV').val()),
					idJoueur : $elem.val(),
					position : $position,
					posGrid : $noJoueur

				}, 
				function(data) {

        		//if success then just output the text to the status div then clear the form inputs to prepare for new data
        			$("#msgContainerBottom").empty().append(data);
    				//$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
           			//$("#success-alert").slideUp(500);
	        		//});
        		});

                
		}

        // Make sure the previous value is updated
        previous = this.value;
    });

})();

</script>
