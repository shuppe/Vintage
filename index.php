<!DOCTYPE html>
<html lang="fr">
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
<link href="./assets/icons/iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

<!-- Fontawsome core CSS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
    require __DIR__.'/vendor/autoload.php';
    use Propel\Runtime\Propel;
	include "generated-conf/config.php";
    // use \vintage\hockey\pickup\JoueurQuery;
    // use \JoueurQuery;
// header('Content-type: text/html; charset=utf-8');
// $rondeDeSelection = 1;
// require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cfgMySQL.inc.php");
// require (str_replace('//', '/', dirname(__FILE__) . '/') . "includes/cl_connect_mysql.inc.php");
// $phDB = new dbConnectMySQL();
// $cdBD = $phDB->connect();

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
<header>
	<!-- Fixed navbar -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-vintage">
				<a class="navbar-brand" href="#">
					<img alt="Vieux Patins" src="./assets/img/patins.png" width="60" height="60" class="d-inline-block">
					Ligue de Hockey Vintage
				</a>
				<button id="BTmenu" type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
				</button>
			<div id="navbarSupportedContent" class="collapse navbar-collapse">
				<ul class="menu navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="active nav-item">
						<a id="menuHome" class="nav-link" href="" data-topmenu="1">
							<i class="fas fa-home"></i>
							<!-- <span class="glyphicon glyphicon-home"></span> -->
						</a>
					</li>
					<li class="nav-item dropdown">
						<a id="menuCal" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-topmenu="2">Calendrier<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a id="menuCalNext" class="dropdown-item" href="">Prochain match</a></li>
							<li><a id="menuCalNew" class="dropdown-item" href="">Nouveau match</a></li>
							<li><a id="menuCalNew2" class="dropdown-item">Modif match</a></li>
							<li><a id="menuCalList" class="dropdown-item">Liste des matches</a></li>
						</ul></li>
					<li class="nav-item dropdown">
						<a id="menuJoueur" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-topmenu="3">Joueurs<span class="caret" /></span></a>
						<ul class="dropdown-menu">
							<li><a id="menuListeJoueur" class="dropdown-item">Liste des Joueurs</a></li>
							<li><a id="menuNouveauJoueur" class="dropdown-item">Nouveau Joueur</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="menuStats nav-link" data-topmenu="4">Stats</a>
					</li>
					<li class="nav-item dropdown">
						<a class="menuDivers nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-topmenu="5">Divers</a>
						<ul class="dropdown-menu">
							<li><a id="menuArenas" class="dropdown-item">Arénas</a></li>
						</ul>
					</li class="nav-item">
					<li><a href="#" class="nav-link">Login</a></li>
				</ul>
			</div>
	</nav>
</header>
<main class="container" role="main">
	<!-- Begin page content -->
	<div class="container">

		<div class="messages" id="msgContainer"></div>
		<div class="donnees" id="dataContainer"></div>
		<div class="messagesBas" id="msgContainerBottom"></div>
	</div>
</main>
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

       	$("#menuCalNew2").click(function() {
	   	    	$("#dataContainer").load("modifPartie.php", function(responseTxt, statusTxt, xhr){
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
    	$("#dataContainer").load("modifPartie.php", function(responseTxt, statusTxt, xhr){
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
