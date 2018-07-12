<?php
$q = "SELECT r.ronde, r.serieNo, e1.ville equipe1, e2.ville equipe2, g.ville victorieux, r.matches ";
$q = $q . "FROM (Resultat r left outer join Equipe g on r.gagnant = g.id), Equipe e1, Equipe e2 ";
$q = $q . "WHERE r.idEquipe1 = e1.id and r.idEquipe2 = e2.id ";
header('Content-type: text/html; charset=utf-8');
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
$phDB = new dbConnectMySQL();
$phDB->connect();
$qresult = $phDB->liendb->query($q);
$NombreRondes = 0;
$NombreRangees = $qresult->rowCount();
for ($i = 0; $i < $NombreRangees; $i ++) {
    $row = $qresult->fetch();
    if ($NombreRondes != $row["ronde"]) {
        $NombreRondes = $row["ronde"];
        $serie = 0;
    }
    $tournoi[$row["ronde"]][$serie ++] = $row;
}
echo "<div class=\"page-header\">\n";
echo "	<h1>Résultats</h1>\n";
echo "</div>\n";
echo "			<div class=\"row\">";
foreach ($tournoi as $ronde) {
    
    echo "	<div class=\"col-md-6\">";
    echo "  <div class=\"panel panel-primary\">\n";
    echo "	<div class=\"panel-heading\">\n";
    echo "		<h3 class=\"panel-title\">Ronde " . $ronde[0]['ronde'] . "</h3>\n";
    echo "	</div>\n";
    echo "	<div class=\"panel-body\">\n";
    echo "		<div class=\"table-responsive\">\n";
    echo "		<table class=\"table table-responsive resultats\">\n";
    echo "			<tr>\n";
    echo "				<th>Série</th>\n";
    echo "				<th colspan=2>Équipe 1</th>\n";
    echo "				<th colspan=2>Équipe 2</th>\n";
    echo "				<th>Nombre de matches</th>\n";
    echo "			</tr>\n";
    foreach ($ronde as $serie) {
        echo "<tr>";
        echo "<td style=\"text-align:center\">" . htmlspecialchars($serie['serieNo']) . "</td>";
        if ($serie['equipe1'] == $serie['victorieux']) {
            echo "<td class=\"success\" width=\"25px\"><span class=\"glyphicon glyphicon-ok\" style=\"color:green\"></span></td><td class=\"success\">";
        } else {
            echo "<td width=\"25px\">&nbsp;</td><td>";
        }
        echo htmlspecialchars($serie['equipe1']) . "</td>";
        if ($serie['equipe2'] == $serie['victorieux']) {
            echo "<td class=\"success\">";
        } else {
            echo "<td>";
        }
        echo htmlspecialchars($serie['equipe2']);
        if ($serie['equipe2'] == $serie['victorieux']) {
            echo "</td><td class=\"success\" width=\"25px\"><span class=\"glyphicon glyphicon-ok\" style=\"color:green\"></span></td>";
        } else {
            echo "</td><td width=\"25px\">&nbsp;</td>";
        }
        echo "<td style=\"text-align:center\">" . htmlspecialchars($serie['matches']) . "</td>";
        echo "</tr>";
    }
    
    echo "		</table>\n";
    echo "	</div>\n"; // table-responsive
    if ($ronde[0]['ronde'] == 2) {
        echo "<div id=\"ronde2Div\"></div>";
    }
    
    echo "	</div>\n"; // panel-body
    echo "</div>\n"; // panel-primary
    
    echo "	</div>\n"; // col-md-6
}
echo "	</div>\n"; // row
                  // else {
                  // echo "<h3>Aucun résultat disponible</h3>";
                  // }
echo "\n";
?>
