<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animaux</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: <?php print($bg); ?>;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #222;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        img {
            width: <?php print($taille_img); ?>px;
            border-radius: <?php print($arrondi); ?>px;
        }
        .carte {
            display: inline-block;
            border: 2px solid #ddd;
            padding: 10px;
            margin: 10px;
            text-align: center;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<h1 style="text-align:center;">Les Animaux</h1>

<!-- ZONE FAVORIS -->
<fieldset style="margin: 20px; padding: 10px;">
    <legend>Mes animaux favoris :</legend>
    <?php
    if(isset($_POST['favoris'])){
        foreach($_POST['favoris'] as $favori){
            print($favori . "<br>");
        }
    } else {
        print("Aucun favori sélectionné");
    }
    ?>
</fieldset>

<!-- FORMULAIRE -->
<div style="margin: 20px;">
<form action="" method="POST">

    <table style="width:400px;">

        <!-- FILTRE PAR ESPECE -->
        <tr>
            <td>Filtrer par espèce :</td>
            <td>
                <select name="espece">
                    <option value="">-- Tous --</option>
                    <option value="chien">Chien</option>
                    <option value="chat">Chat</option>
                    <option value="lapin">Lapin</option>
                    <option value="oiseau">Oiseau</option>
                </select>
            </td>
        </tr>

        <!-- MODE AFFICHAGE -->
        <tr>
            <td>Mode d'affichage :</td>
            <td>
                <input type="radio" name="affichage" value="tableau"> Tableau<br>
                <input type="radio" name="affichage" value="cartes"> Cartes<br>
            </td>
        </tr>

        <!-- TAILLE DES IMAGES -->
        <tr>
            <td>Taille des images :</td>
            <td>
                <input type="number" name="taille_img" min="50" max="300" value="100">
            </td>
        </tr>

        <!-- COULEUR DE FOND -->
        <tr>
            <td>Couleur de fond :</td>
            <td>
                <input type="radio" name="bg" value="white"> Blanc<br>
                <input type="radio" name="bg" value="#f0f8ff"> Bleu clair<br>
                <input type="radio" name="bg" value="#f5f5dc"> Beige<br>
            </td>
        </tr>

        <!-- ARRONDI DES IMAGES -->
        <tr>
            <td>Images arrondies :</td>
            <td>
                <input type="checkbox" name="arrondi" value="50"> Oui
            </td>
        </tr>

        <!-- FAVORIS -->
        <tr>
            <td>Mes favoris :</td>
            <td>
                <input type="checkbox" name="favoris[]" value="Chien"> Chien<br>
                <input type="checkbox" name="favoris[]" value="Chat"> Chat<br>
                <input type="checkbox" name="favoris[]" value="Lapin"> Lapin<br>
                <input type="checkbox" name="favoris[]" value="Oiseau"> Oiseau<br>
            </td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="appliquer" value="Appliquer"></td>
        </tr>

    </table>
</form>
</div>

<!-- AFFICHAGE DES ANIMAUX -->
<div style="margin: 20px;">

<?php if($affichage == "cartes"): ?>

    <!-- MODE CARTES -->
    <?php while($ligne = mysqli_fetch_assoc($result)): ?>
    <div class="carte">
        <img src="images/<?= $ligne['image'] ?>">
        <p><strong><?= $ligne['nom'] ?></strong></p>
        <p><?= $ligne['espece'] ?></p>
        <p><?= $ligne['age'] ?> ans</p>
    </div>
    <?php endwhile; ?>

<?php else: ?>

    <!-- MODE TABLEAU -->
    <table>
        <tr>
            <th>Photo</th>
            <th>Nom</th>
            <th>Espèce</th>
            <th>Age</th>
        </tr>
        <?php while($ligne = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><img src="images/<?= $ligne['image'] ?>"></td>
            <td><?= $ligne['nom'] ?></td>
            <td><?= $ligne['espece'] ?></td>
            <td><?= $ligne['age'] ?> ans</td>
        </tr>
        <?php endwhile; ?>
    </table>

<?php endif; ?>

</div>

</body>
</html>