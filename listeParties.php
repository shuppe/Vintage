<?php
    header('Content-type: text/html; charset=utf-8');
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
    use Propel\Runtime\Map\TableMap;

    include "generated-conf/config.php";
    include "includes/functions.php"
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Parties</h3>
    </div>
    <div class="card-body">
    <?php
    if (PartieQuery::create()->count() > 0) {
        ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped liste-parties text-center">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Aréna</th>
                        <th>Équipe Locale</th>
                        <th>Équipe Visiteure</th>
                        <th>Supprimer ?</th>
                    </tr>
                <thead>
                <tbody>
        <?php
        $parties = PartieQuery::create()->orderByDatepartie()->find();
        foreach ($parties as $partie) {
            ?>
            <tr class="partie">
                <td>
                    <a class="btn partieUpdate" href="" 
                        data-id="<?php print($partie->getId()); ?>" 
                        data-date="<?php print($partie->getDatepartie()->format('Y-m-d')); ?>" 
                        role="button">
                        <?php print($partie->getDatepartie()->format('Y-m-d')); ?>
                    </a>
                </td>
                <td class="arena text-center">
                    <a class="btn partieUpdate" href="" 
                        data-id="<?php print($partie->getId()); ?>" 
                        data-date="<?php print($partie->getDatepartie()->format('Y-m-d')); ?>" 
                        role="button">
                        <?php print(ArenaQuery::create()->findPk($partie->getArenano())->getNom()); ?>
                    </a>
                </td>
                <td class="text-center"> 
                    <a class="btn partieUpdate" href="" 
                        data-id="<?php print($partie->getId()); ?>" 
                        data-date="<?php print($partie->getDatepartie()->format('Y-m-d')); ?>" 
                        role="button"><?php print($partie->getPtsequipelocale()); ?> 
                    </a>
                </td>
                <td>
                    <a class="btn partieUpdate" href=""
                        data-id="<?php print($partie->getId()); ?>"
                        data-date="<?php print($partie->getDatepartie()->format('Y-m-d')); ?>" 
                        role="button"> <?php print($partie->getPtsequipevisite()); ?> 
                    </a>
                </td> 
                <td>
                    <a href="" class="partieDelete" data-id="<?php print($partie->getId()); ?>">
                    <button type="button" class="btn btn-danger">X</button></a>
                </td>
            </tr>
        <?php
        } ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        print "Aucune partie au calendrier.";
    }

?>
</div>
</div>
<script type="text/javascript">

$(".partieUpdate").click(function(e){ 
    console.log('partieUpdate');
    e.preventDefault();
    var $elem = $(this);
    console.log($elem);
  $.post( "modifPartie.php", { datePartie: $elem.data("date") },
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

$(".partieDelete").click(function(e){ 

e.preventDefault();
var $elem = $(this);
$.post( "modifPartie.php", { id: $elem.data("id") },
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
