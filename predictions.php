<?php

function cmp($a, $b)
{
    if ($a['totalPoints'] == $b['totalPoints']) {
        return 0;
    }
    return ($a['totalPoints'] < $b['totalPoints']) ? - 1 : 1;
}

function cmp_r($a, $b)
{
    if ($a['totalPoints'] == $b['totalPoints']) {
        return 0;
    }
    return ($a['totalPoints'] > $b['totalPoints']) ? - 1 : 1;
}

header('Content-type: text/html; charset=utf-8');
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
$phDB = new dbConnectMySQL();
$phDB->connect();
$incGagnant = 5;
$incMatches = 5;

if ($_POST['rondeDeSelection'])
    $rondeDeSelection = $_POST['rondeDeSelection'];

$q = "SELECT pr.idParticipant, pa.prenom, pa.nom, pr.`Ronde`, pr.`serieNo`, pr.idgagnant, pr.`nombreParties` ";
$q = $q . "FROM (`Prediction` pr left outer join Equipe e on pr.idgagnant = e.id ), Resultat r, Participant pa ";
$q = $q . "WHERE pr.annee = 2015 and pr.ronde =" . $rondeDeSelection . " and pr.`idParticipant` = pa.id ";
$q = $q . "and pr.serieNo = r.serieNo and pr.ronde = r.ronde ";
$q = $q . "order by pr.idParticipant, pr.serieNo";
$qresult = $phDB->liendb->query($q);
$participant = null;
while ($row = $qresult->fetch()) {
    $participants[$row['idParticipant']][$row['serieNo']] = $row;
}

$qr = "SELECT r.ronde, r.serieNo, r.idEquipe1, e1.abbrev equipe1, r.idEquipe2, e2.abbrev equipe2, r.gagnant idGagnant, r.matches ";
$qr = $qr . "FROM Resultat r, Equipe e1, Equipe e2 ";
$qr = $qr . "WHERE r.annee = 2015 and r.ronde = " . $rondeDeSelection . " and r.idEquipe1 = e1.id and r.idEquipe2 = e2.id ";
$qresult = $phDB->liendb->query($qr);
$resultat = null;
while ($row = $qresult->fetch()) {
    $resultat[$row['serieNo']] = $row;
}

$debug = FALSE;
if ($debug) {
    $strRes = print_r($resultat, TRUE);
    $strPart = print_r($participants, TRUE);
}

if ($resultat && count($resultat) > 0) {
    if (count($participants) > 0) {
        
        foreach ($participants as &$participant) {
            $participant['totalPoints'] = 0;
            
            for ($i = 1; $i <= count($resultat); $i ++) {
                if ($participant[$i]['idgagnant'] && $participant[$i]['idgagnant'] == $resultat[$i]['idGagnant']) {
                    $participant['totalPoints'] += $incGagnant;
                    if ($participant[$i]['nombreParties'] == $resultat[$i]['matches']) {
                        $participant['totalPoints'] += $incMatches;
                    }
                }
            }
        } // foreach( $participants as $participant)
        unset($participant);
        usort($participants, 'cmp_r');
    }
}

echo "<div class=\"page-header\">\n";
echo "	<h1>Points</h1>\n";
echo "</div>\n";

echo "  <div class=\"panel panel-primary\">\n";
if ($resultat && count($resultat) > 0) {
    echo "	<div class=\"panel-heading\">\n";
    echo "		<h3 class=\"panel-title\">Ronde " . $resultat[1]['ronde'] . "</h3>\n";
    echo "	</div>\n";
    echo "	<div class=\"panel-body\">\n";
    
    if ($debug)
        echo $strRes;
    
    echo "		<div class=\"table-responsive\">\n";
    echo "		<table class=\"table table-responsive\">\n";
    echo "			<tr>\n";
    echo "				<th colspan=2 class=\"fixed-column\">Participant</th>\n";
    
    foreach ($resultat as $serie) {
        echo "				<th class=\"predict-grille-e1\">" . $serie['equipe1'] . "</th>\n";
        echo "				<th class=\"predict-grille-e2\">" . $serie['equipe2'] . "</th>\n";
    }
    
    echo "				<th class=\"predict-grille-pts\">Points</th>\n";
    echo "			</tr>\n";
    
    if ($debug) {
        echo "			<tr>\n";
        echo $strPart;
        echo "			</tr>\n";
    }
    
    if (count($participants) > 0) {
        
        foreach ($participants as $participant) {
            echo "<tr>";
            echo "<td class=\"fixed-column\">" . htmlspecialchars($participant[1]['prenom']) . "</td>";
            echo "<td class=\"fixed-column\">" . htmlspecialchars($participant[1]['nom']) . "</td>";
            
            for ($i = 1; $i <= count($resultat); $i ++) {
                echo "<td class=\"predict-grille-e1";
                if ($participant[$i]['idgagnant'] == $resultat[$i]['idEquipe1']) {
                    if ($resultat[$i]['idEquipe1'] == $resultat[$i]['idGagnant']) {
                        echo " predict-gagnant";
                        if ($participant[$i]['nombreParties'] == $resultat[$i]['matches']) {
                            echo " predict-matches";
                        }
                    }
                    echo "\">";
                    echo htmlspecialchars($participant[$i]['nombreParties']);
                } else {
                    echo "\">&nbsp;";
                }
                echo "</td>";
                echo "<td class=\"predict-grille-e2";
                if ($participant[$i]['idgagnant'] == $resultat[$i]['idEquipe2']) {
                    if ($resultat[$i]['idEquipe2'] == $resultat[$i]['idGagnant']) {
                        echo " predict-gagnant";
                        if ($participant[$i]['nombreParties'] == $resultat[$i]['matches']) {
                            echo " predict-matches";
                        }
                    }
                    echo "\">";
                    echo htmlspecialchars($participant[$i]['nombreParties']);
                } else {
                    echo "\">&nbsp;";
                }
                echo "</td>";
            }
            echo "<td class=\"predict-grille-pts sommaire-total\">";
            echo $participant['totalPoints'];
            echo "</td>";
            echo "</tr>";
        } // foreach( $participants as $participant)
    } else {
        echo "<tr>";
        $hcolumns = 16 / (pow(2, ($rondeDeSelection - 1))) + 3;
        echo "<td colspan=" . $hcolumns . ">Aucun participant.</td>";
        echo "</tr>";
    }
    echo "		</table>\n";
    echo "	</div>\n"; // table-responsive
    echo "	</div>\n"; // panel-body
} else {
    echo "	<div class=\"panel-heading\">\n";
    echo "		<h3 class=\"panel-title\">Ronde " . $rondeDeSelection . "</h3>\n";
    echo "	</div>\n";
    echo "	<div class=\"panel-body\">\n";
    echo "Cette ronde n'est pas encore débutée.\n";
    echo "	</div>\n";
    echo "	</div>\n"; // panel-body
}
echo "</div>\n"; // panel-primary

?>
