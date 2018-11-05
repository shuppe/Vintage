<?php
	header('Content-type: text/html; charset=utf-8');
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
	use Propel\Runtime\Map\TableMap;
    include "generated-conf/config.php";

	if (isset($_POST['partie'])) {
			// $partie = PartieQuery::create()->findPk(4);
            $partie = PartieQuery::create()->findPk($_POST['partie']);
            if ($_POST['equipe']==1)
                $partie->setPtsequipelocale($_POST['score']);
            else
                $partie->setPtsequipevisite($_POST['score']);
            $partie->save();
        }
?>