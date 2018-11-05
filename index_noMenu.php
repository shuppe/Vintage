<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Site web de la ligue de hockey Vintage de Ahutsic">
    <meta name="author" content="Sylvain Huppé">
    <link rel="icon" href="patins.ico">

    <title>VHL - Vintage Hockey League</title>


    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/icons/iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <link href="./assets/js/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">

    <!-- Fontawsome core CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="vhl.css" rel="stylesheet">

    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <?php
require __DIR__ . '/vendor/autoload.php';

    require "generated-conf/config.php";
?>

</head>

<body>
    <div class="container">
        <div class="messages" id="msgContainer"></div>
        <div class="donnees" id="dataContainer"></div>
        <div class="messagesBas" id="msgContainerBottom"></div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- <script src="./assets/js/jquery-ui-1.12.1.custom/jquery-1.12.4.js"></script> -->
    <script src="./assets/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function()

            {

                $("#dataContainer").load("listeParties.php", function(responseTxt, statusTxt, xhr) {});

            });
    </script>
    <script src="./dist/js/bootstrap.min.js"></script>

    </body>

</html>