<!DOCTYPE html>
<html lang="CA-fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description"
	content="Site web de la ligue de hockey Vintage de Ahutsic">
<meta name="author" content="Sylvain Huppé">
<link rel="icon" href="patins.ico">

<title>VHL - Vintage Hockey League</title>

<!-- Bootstrap core CSS -->
<link href="./dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="vhl.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="./assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="./assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

<!-- <script type="text/javascript" src="poolDesSeries.js"></script> -->
	<?php
// header('Content-type: text/html; charset=utf-8');
$rondeDeSelection = 1;
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
$phDB = new dbConnectMySQL();
$cdBD = $phDB->connect();

// require_once("./includes/config_core.inc.php");
/*
 * try {
 * $cdBD = new PDO('mysql:host='.DB_MYSQL_HOST.';dbname='.DB_MYSQL_DB.';charset=utf8',DB_MYSQL_LOGIN, DB_MYSQL_PASS);
 *
 * if($cdBD == null)
 * {
 * echo "<h2> Connexion non-établie</h2>";
 * die();
 * }
 * }
 *
 * // catch (PDOException $e)
 * // {
 * // echo "PDOException:". $e->getMessage();
 * // }
 * catch (Exception $e)
 * {
 * print "Exception:";
 * print_r($e);
 * die();
 * }
 */
?>

</head>

<body>

	<!-- Fixed navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button id="BTmenu" type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<img class="navbar-brand" alt="Vieux Patins"
					src="./assets/img/patins.png"> <a class="navbar-brand">Ligue de
					Hockey Vintage</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="menu nav navbar-nav">
					<li class="active"><a id="menuHome" class="navbar-leaf"
						data-topmenu="1"><span class="glyphicon glyphicon-home"></span></a>
					</li>
					<li><a id="menuCal" class="dropdown-toggle" data-toggle="dropdown"
						data-topmenu="2">Calendrier<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a id="menuCalNext" class="navbar-leaf">Prochain match</a></li>
							<li><a id="menuCalNew" class="navbar-leaf">Nouveau match</a></li>
							<li><a id="menuCalList" class="navbar-leaf">Liste des matches</a></li>
						</ul></li>
					<li><a id="menuJoueur" class="dropdown-toggle"
						data-toggle="dropdown" data-topmenu="3">Joueurs<span class="caret" /></span></a>
						<ul class="dropdown-menu">
							<li><a id="menuListeJoueur" class="navbar-leaf">Liste des Joueurs</a></li>
							<li><a id="menuNouveauJoueur" class="navbar-leaf">Nouveau Joueur</a></li>
						</ul></li>
					<li><a class="menuStats" class="navbar-leaf" data-topmenu="4">Stats</a>
					</li>
					<li><a class="menuDivers dropdown-toggle" data-toggle="dropdown"
						data-topmenu="5">Divers<span class="caret" /></span></a>
						<ul class="dropdown-menu">
							<li><a id="menuArenas" class="navbar-leaf">Arénas</a></li>
						</ul></li>
					<li><a href="#" class="navbar-leaf"><span
							class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<!-- Begin page content -->
	<div class="container">

		<div class="messages" id="msgContainer"></div>
		<div class="donnees" id="dataContainer"></div>
		<div class="messagesBas" id="msgContainerBottom"></div>
	</div>
	<footer class="footer">
		<div class="container">
			<p class="text-muted">
				<span class="glyphicon glyphicon-copyright-mark"></span>Copyright
				infoSH 2017
			</p>
		</div>
	</footer>


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function()
    {
        /*
    	$(".ronde").click(function() {
    		var myClasses = $(this).classList;
    		console.log(this);
    		console.log($(this).data("ronde"));
    		console.log(myClasses);
			$rondeDeSelection = $(this).data("ronde");
    		//alert(myClasses.length + " " + myClasses[0]);
	    	$("#dataContainer").load("predictions.php", {'rondeDeSelection' : $rondeDeSelection}, function(responseTxt, statusTxt, xhr){
        	});
    	    		});
		*/
		
        	$("#menuHome").click(function() {
 	   	    	$("#dataContainer").load("accueil.html");
        	});
		
       	$("#menuCalNew").click(function() {
	   	    	$("#dataContainer").load("ajouterPartie.php", function(responseTxt, statusTxt, xhr){
        	});
    	});

       	$("#menuListeJoueur").click(function(){
	    	    	$("#dataContainer").load("listeJoueurs.php", function(responseTxt, statusTxt, xhr){
	            	});
    	    });

        	$("#menuNouveauJoueur").click(function(){
    	    	$("#dataContainer").load("modifJoueur.php");
	    });
        $('.menu li').click(function(e) {
            $('#BTMenu').click();
            $('.menu li.active').removeClass('active');
        	  var $this = $(this);
        	  if (!$this.hasClass('active')) {
        	    $this.addClass('active');
        	  }
        	  e.preventDefault();
        	});
    	$("#dataContainer").load("ajouterPartie.php", function(responseTxt, statusTxt, xhr){
        	});
    	$(".navbar-leaf").click(function() {
            if($('.navbar-toggle').css('display') !='none'){
                $(".navbar-toggle").trigger( "click" );
            }
    		//$('.navbar-collapse').collapse('hide');
    	});

    });

/*    
    $('body').on('click', '#frmSubmit', function() {     		  

        $.post( "crudJoueur.php",
  		  {
	  	nom: $('#nom').val(),
	  	prenom: 	$('#prenom').val(),
	  	email: 	$('#email').val()
	  },
	    function(data)
	     {
	        //if success then just output the text to the status div then clear the form inputs to prepare for new data
	        $("#dataContainer").empty().append(data);
	      });
 });
 */     		    
	function getPage(page) {
		$("#dataContainer").load(page, function(responseTxt, statusTxt, xhr){
    	});
	};
    	</script>
	<script src="./dist/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="./assets/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>
