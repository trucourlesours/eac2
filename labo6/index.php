<?php
var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labo6</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        table{
            background-color:<?= $_POST['couleur']; ?>
        }
    </style>
</head>
<body>
    <h2>Irigaray</h2>
    <form action="" method="post">
        <table>
            <tr><td>Entrez votre nom:</td><td><input type="text" name="le_nom"></td></tr>
            <tr><td>Entrez votre prénom:</td><td><input type="text" name="le_prenom"></td></tr>
            <tr><td>Entrez votre mot de passe:</td><td><input type="password" name="mdp"></td></tr>
            <tr><td>Entrez votre date de naissance:</td><td><input type="date" name="ddn"></td></tr>
            <tr><td>Entrez votre adresse mail:</td><td><input type="email" name="email"></td></tr>
            <tr>
                <td>Niveau d'études</td>
                <td>
                    <select name="etudes">
                        <option value="pri">Niveau Primaire</option>
                        <option value="sec">Niveau Secondaire</option>
                        <option value="uni">Niveau Universitaire</option>
                    </select>
                </td>
            </tr>
            <tr><td>Entrez votre sexe:</td>
                <td>
                    <input type="radio" name="sexe" value="f">Je suis une femme<br/>
                    <input type="radio" name="sexe" value="m">Je suis un homme
                </td>
            </tr>
            <tr><td>Entrez votre couleur préférée:</td><td><input type="color" name="couleur"></td></tr>
            <tr><td>Entrez vos activités:</td>
                <td>
                    <input type="checkbox" name="hobby[]" value="spo">Sport<br/>
                    <input type="checkbox" name="hobby[]" value="mus">Musique<br/>
                    <input type="checkbox" name="hobby[]" value="game">Jeu vidéo
                </td>
            </tr>
            <tr>
			    <td>Entrez votre message</td>
                <td>
                    <textarea name="msg" cols="30" rows="6"></textarea>
                <td>
		    </tr>
            <tr><td></td><td><input type="submit" value="Envoyer"></td></tr>
        </table>
    </form>

    <br/><br/>
    <?php
        if(!empty($_POST['le_nom']) &&
           !empty($_POST['le_prenom']) &&
           !empty($_POST['mdp']) &&
           !empty($_POST['ddn']) &&
           !empty($_POST['email'])){

            /* Gestion date de naissance */

            $dt = new DateTime($_POST['ddn']);

            $jour = $dt->format('j');
            $annee = $dt->format('Y');
            $mois = $dt->format('F');

            /* Gestion des études */
            $etudes = $_POST['etudes'];
            switch($etudes){
                case 'pri':$etudes = "Primaire";break;
                case 'sec':$etudes = "Secondaire";break;
                case 'uni':$etudes = "Universitaire";break;
            }

            /* Gestion du sexe */
            $titre="";
            if(isset($_POST['sexe'])){
                if($_POST['sexe'] == "m"){
                    $titre = "Monsieur";
                }
                else{
                    $titre = "Madame";
                }
            }

            print("<div id='reponse'>Bonjour ".$titre." ".$_POST['le_prenom']." ".$_POST['le_nom']."<br/>
        Votre mot de passe est: ".$_POST['mdp']."<br/>Vous êtes né le ".$jour." ".$mois." ".$annee."<br/>
        Votre adresse mail est : ".$_POST['email']."<br/>
        Votre niveau d'études actuel est :".$etudes);
        
        if(isset($_POST['hobby'])){
            print("<br/>Vos activités favorites sont:<br/>");
            foreach ($_POST['hobby'] as $value) {
                switch($value){
                    case "spo":print("Le Sport<br/>");break;
                    case "mus":print("La Musique<br/>");break;
                    case "game":print("Les jeux vidéo<br/>");break;
                }
            }
        }
        if(!empty($_POST['msg'])){
            print("<br/><br/>Merci pour votre message!!");
        }

        }//si les champs ne sont pas vides

    ?>

</body>
</html>