<?php
session_start();
require("funcs/connexion-base.php");
require("funcs/func-tableau.php");
if (isset($_POST["type"]) && isset($_POST["ram"]) && isset($_POST["cpu"])) {
    $type = htmlspecialchars($_POST["type"]);
    $cpu = htmlspecialchars($_POST["cpu"]);
    $ram = htmlspecialchars($_POST["ram"]);
    $sql = "SELECT * FROM multicast.serveurs WHERE `type`=' ".$type."' AND `cpu`=".$cpu." AND `ram`=".$ram." AND `idLocation` IS NULL AND `enService` IS NOT NULL;";   

};

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Louer un serveur</title>
    <link rel="stylesheet" href="css/style3.css">
    <script src="funcs/jquery-3.6.0.min.js"></script>
    <script src="funcs/func-tableau.js"></script>
</head>

<nav>

    <div class="onglets">
        <a href="index.php">🏠 Accueil</a>
    </div>

</nav>


<div id="loc">

    <h1> Espace location de serveur </h1>

</div>



<body>



    <div id="selection">

        <select id="choix_type" onclick="choix_type()">
            <option value="--">Choix du type de serveur :</option>
            <option value=" de Jeu 🎮">Jeu</option>
            <option value=" de Stockage 💾">Stockage</option>
            <option value=" Web ☁️">Web</option>
        </select>

        <select id="choix_cpu" onclick="cpu()">
            <option value="--">Choix puissance Cpu (coeurs) :</option>
            <option value="Cpu 1 (8 coeurs)">8</option>
            <option value="Cpu 2 (16 coeurs)">16</option>
            <option value="Cpu 3 ⚡ (32 coeurs)">32</option>
        </select>

        <select id="choix_ram" onclick="ram()">
            <option value="--">Choix de la ram (Go) :</option>
            <option value="Ram 1 (32 Go)">32</option>
            <option value="Ram 2 (128 Go)">128</option>
            <option value="Ram 3 ⚡ (256 Go)">256</option>
        </select>

        <button onclick="choix()">Je veux !</button>

    </div>

    <div id="table"></div>

    <div class="anim">



        <div id="type-f"></div> <br>
        <div id="cpu-f"></div><br>
        <div id="ram-f"></div>

        </h2>

    </div>


    <script>
        // Affichage 

        <?php
        if (isset($_POST["type"]) && isset($_POST["ram"]) && isset($_POST["cpu"])) {
        tableau($db,$sql);
        echo "Table()";
        }   
        ?>

        function choix_type() {
            //Type
            var type = "Un serveur" + document.getElementById("choix_type").value;
            document.getElementById("type-f").innerText = type;
        }

        function cpu() {
            //Cpu
            var cpu = "Avec le CPU : " + document.getElementById("choix_cpu").value;
            document.getElementById("cpu-f").innerText = cpu;
        }

        function ram() {
            var ram = "Avec la RAM : " + document.getElementById("choix_ram").value;
            document.getElementById("ram-f").innerText = ram;
        }

        function choix() {
            var type = $('#choix_type option:selected').text();
            var cpu = parseInt($('#choix_cpu option:selected').text());
            var ram = parseInt($('#choix_ram option:selected').text());
            console.log("SELECT * FROM multicast.serveurs WHERE `type`='" + type + "' AND `cpu`=" + cpu + " AND `ram`=" + ram + " AND `idLocation` IS NULL AND `enService` IS NOT NULL;");
            var url = "louer.php";
            parametre = {type,cpu,ram};
            submit_post(url, parametre);
        }

        // Requête POST :
        function submit_post(url,para) {
            var formul = document.createElement("form");
            formul.method = "POST";
            formul.action = url;

            var input1 = document.createElement("input");
            input1.type = "hidden"; 
            input1.name = "type"; 
            input1.value = para["type"]; 
            formul.appendChild(input1); 

            var input2 = document.createElement("input"); 
            input2.type = "hidden";
            input2.name = "cpu";
            input2.value = para["cpu"];
            formul.appendChild(input2);

            var input3 = document.createElement("input"); 
            input3.type = "hidden";
            input3.name = "ram";
            input3.value = para["ram"];
            formul.appendChild(input3);

            document.body.appendChild(formul); 

            formul.submit(); // Soumission du formulaire
        }
    </script>
</body>

<footer>



</footer>


</html>