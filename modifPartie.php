<?php
header('Content-type: text/html; charset=utf-8');
require __DIR__.'/vendor/autoload.php';
use Propel\Runtime\Propel;
use Propel\Runtime\Map\TableMap;
require "generated-conf/config.php";
require "includes/functions.php";

$option_arenas = "<option value=\"\" disabled selected hidden>&nbsp;</option>\n";
if (ArenaQuery::create()->count() > 0) {
    $arenas=ArenaQuery::create()->find();
    foreach ($arenas as $arena) {
        $option_arenas .= $arena->asListOption();
    }
}

if (isset($_POST['datePartie'])) {
    $partie = PartieQuery::create()->findOneByDatepartie($_POST['datePartie']);
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
                    <input type="date" class="form-control" id="datePartie" name="datePartie"
                    value="<?php print($partie->getDatepartie('Y-m-d')); ?>">
                </div>
                <div class="col">
                    <label for="arena" class="control-label">Arena:</label> 
                    <select class="form-control custom-select" id="arena" name="arena"
                    value="" >
                        <?php echo $option_arenas; ?>
                    </select>
                </div>
            </div>
        </div>	
    </div>
    <div class="card invisible" id="formations">
        <div class="card-header text-white bg-vintage">
            <h3 class="card-title  bg-vintage">Joueurs</h3>
        </div>
        <div class="card">
            
        </div>
        <div class="card-body" id="joueursContainer">
        </div>
    </div>
</form>
<script type="text/javascript">

$( "#datePartie").change(function() {

    // e.preventDefault();
    $.post( "createFormations.php", $("#form-partie").serialize(),
    function(data)
     {
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
        $("#joueursContainer").empty().append(data);
        $("#formations").hide().removeClass('invisible').slideDown('fast');
        // $("#arena").val($partie.getArenano());
    });
        
  });

$(document).ready(function () {
    <?php if (isset($partie)) { ?>
        $('#arena').val(<?php print($partie->getArenano()); ?>);
        $('#arena').trigger('change');
        // $('#datePartie').trigger('change');
        <?php
    }
?>
});
// $( "#datePartie").change(function() {

// 	$("#joueursContainer").load("createFormations.php", function(responseTxt, statusTxt, xhr){
// 	});

// 	$("#formations").hide().removeClass('invisible').slideDown('fast');
// })

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