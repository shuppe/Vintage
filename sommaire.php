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

$q = "SELECT pr.idParticipant, pa.prenom, pa.nom, pr.`Ronde`, pr.`serieNo`, pr.idgagnant, pr.`nombreParties` ";
$q = $q . "FROM `Prediction` pr, Resultat r, Participant pa, Equipe e ";
$q = $q . "WHERE pr.annee = 2015 and pr.`idParticipant` = pa.id ";
$q = $q . "and pr.serieNo = r.serieNo and pr.ronde = r.ronde and pr.idgagnant = e.id ";
$q = $q . "order by pr.idParticipant, pr.serieNo";
$qresult = $phDB->liendb->query($q);
$participants = null;
while ($row = $qresult->fetch()) {
    $participants[$row['idParticipant']][$row['Ronde']][$row['serieNo']] = $row;
}

$qr = "SELECT r.ronde, r.serieNo, r.idEquipe1, r.idEquipe2, r.gagnant idGagnant, r.matches ";
$qr = $qr . "FROM Resultat r ";
$qr = $qr . "WHERE r.annee = 2015";
$qresult = $phDB->liendb->query($qr);
$resultat = null;
while ($row = $qresult->fetch()) {
    $resultat[$row['ronde']][$row['serieNo']] = $row;
}

$debug = FALSE;
if ($debug) {
    $strRes = print_r($resultat, TRUE);
    $strPart = print_r($participants, TRUE);
}

if ($resultat && count($resultat) > 0) {
    if (count($participants) > 0) {
        
        foreach ($participants as &$participant) {
            $pointsPart = 0;
            for ($ronde = 1; $ronde <= 4; $ronde ++) {
                $pointsRonde = 0;
                if ($resultat[$ronde]) {
                    for ($i = 1; $i <= count($resultat[$ronde]); $i ++) {
                        if ($participant[$ronde][$i] && $participant[$ronde][$i]['idgagnant'] == $resultat[$ronde][$i]['idGagnant']) {
                            $pointsRonde += $incGagnant;
                            if ($participant[$ronde][$i]['nombreParties'] == $resultat[$ronde][$i]['matches']) {
                                $pointsRonde += $incMatches;
                            }
                        }
                    }
                }
                $participant[$ronde]['pointsRonde'] = $pointsRonde;
                $pointsPart += $pointsRonde;
            }
            $participant['totalPoints'] = $pointsPart;
        } // foreach( $participants as $participant)
    }
}
unset($participant);
// arsort($participants);
usort($participants, 'cmp_r');

echo "<div class=\"page-header\">\n";
echo "	<h1>Sommaire</h1>\n";
echo "</div>\n";

echo "  <div class=\"panel panel-primary\">\n";
if ($resultat && count($resultat) > 0) {
    echo "	<div class=\"panel-heading\">\n";
    echo "		<h3 class=\"panel-title\">Sommaire</h3>\n";
    echo "	</div>\n";
    echo "	<div class=\"panel-body\">\n";
    if ($debug)
        echo $strRes;
    echo "		<div class=\"table-responsive\">\n";
    echo "		<table class=\"table table-responsive\">\n";
    echo "			<tr>\n";
    echo "				<th class=\"predict-grille-pts\">Rang</th>\n";
    echo "				<th colspan=2 class=\"fixed-column\">Participant</th>\n";
    for ($ronde = 1; $ronde <= 4; $ronde ++) {
        echo "				<th class=\"predict-grille-e1\">Ronde " . $ronde . "</th>\n";
    }
    echo "				<th class=\"predict-grille-pts\">Total</th>\n";
    echo "			</tr>\n";
    if ($debug) {
        echo "			<tr>\n";
        echo $strPart;
        echo "			</tr>\n";
    }
    if (count($participants) > 0) {
        $rang = 0;
        foreach ($participants as $participant) {
            $pointsPart = 0;
            echo "<tr>";
            echo "<td class=\"fixed-column predict-grille-pts\">" . ++ $rang . "</td>";
            echo "<td class=\"fixed-column\">" . htmlspecialchars($participant[1][1]['prenom']) . "</td>";
            echo "<td class=\"fixed-column\">" . htmlspecialchars($participant[1][1]['nom']) . "</td>";
            
            for ($ronde = 1; $ronde <= 4; $ronde ++) {
                $pointsRonde = 0;
                echo "<td class=\"predict-grille-e1";
                if ($ronde % 2 == 1)
                    echo " info";
                echo "\">";
                echo $participant[$ronde]['pointsRonde'];
                echo "</td>";
            }
            echo "<td class=\"predict-grille-pts sommaire-total\">";
            echo $participant['totalPoints'];
            echo "</td>";
            echo "</tr>";
        } // foreach( $participants as $participant)
    } else {
        echo "<tr>";
        echo "<td>Aucun participant.</td>";
        echo "</tr>";
    }
    echo "		</table>\n";
    echo "	</div>\n"; // table-responsive
} else {
    echo "	<div class=\"panel-heading\">\n";
    echo "		<h3 class=\"panel-title\">Sommaire</h3>\n";
    echo "	</div>\n";
    echo "Aucune donnée\n";
}
echo "	</div>\n"; // panel-body
echo "</div>\n"; // panel-primary
echo "\n";
?>
