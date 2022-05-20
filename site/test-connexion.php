<?php
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style2.css" media="screen" type="text/css" />
    </head>
    <body style='background:#fff;'>
        <div id="content">
            <?php
                if(isset($_SESSION['username'])){
                    $user = $_SESSION['username'];
                    echo "Bonjour $user, vous êtes connecté";
                }
            ?>
        </div>
    </body>
</html>
