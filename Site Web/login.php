<html>

    <head>
       <meta charset="utf-8">
       <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
       <link rel="stylesheet" href="style2.css" media="screen" type="text/css" />
    </head>

    <body>
        <div id="logz">
            
            <form action="verification.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >

                <?php

                    $auth=GetValue($_SESSION,'auth');

                    if ($auth!='ok') { // Pas de variable de session = pas identifié !
                        $user=GetValue($_REQUEST,'user'); // Envoyé d'un formulaire
                        $pass=GetValue($_REQUEST,'pass'); // Envoyé d'un formulaire
                    if (auth($user,$pass)) {
                        $_SESSION['auth']='ok'; // Sauvegarde dans la session
                        $_SESSION['user']=$user;
                    } else {
                    afficheLoginForm();
                    }
                    }
                ?>
                
                
                <p>Multicast ~ Votre hébergeur</p>
                
            </form>
        </div>
    </body>





</html>