<html>

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <?php
    // if(isset($_SESSION(['username']) && $_SESSION['username']==='admin'){
    //   echo"<link rel="stylesheet" href="css/style2.css" media="screen" type="text/css" />";
    // }
    //  else {
    //      echo"<link rel="stylesheet" href="css/404.css" media="screen" type="text/css" />";
    //   }
    ?>
    <link rel="stylesheet" href="css/style2.css" media="screen" type="text/css" />
</head>

<nav>

    <div class="onglets">
        <a href="index.php">🏠 Accueil</a>
    </div>

</nav>

<body>
    <div class="gestion">
        <h1>Pannel de gestion et d'administration des serveurs et des clients</h1>
        <h2>Recherche par :</h2>
        <button onclick="filtre_text()">Texte</button>
        <button onclick="filtre()">Filtres</button>

        <div id="filterz">
            <h1></h1>

        </div>

        <table>
            <tr id="desc">
                <td id="desc">$CLIENT</td>
                <td id="desc">Type</td>
                <td id="desc">Cpu</td>
                <td id="desc">Ram</td>
                <td id="desc">Durée abonnement</td>
                <td id="desc">Utilisation bande passante</td>
                <td id="desc">Etat</td>
            </tr>
            <tr id="client">
                <td id="client">Serveur numéro $ID_Serveur</td>
                <td id="client">Jeu</td>
                <td id="client">Cpu $num_cpu</td>
                <td id="client">$RAM,go</td>
                <td id="client">$Durée_abonnement</td>
                <td id="client">$Utilisation bp</td>
                <td id="client">Loué</td>
            </tr>
        </table>




    </div>

<script>
    function filtre_text(){
        console.log("Filtrage par texte");
        var utilisateur = window.prompt("Nom du client :");
        console.log("Cherchement du client : "+utilisateur);
    }

    function filtre(){
        console.log("Filtrage");
    }



</script>







</body>



<footer>
    <p>RT1 builded and &#128011 Powered.</p>
</footer>



</html>
