<?php 

$modal = ''; // Déclaration de la variable modal

if (isset($_SESSION)) { // Est-ce que SESSION est définie ?
    if (count($_SESSION['errors']) > 0) { // Errrors contient des données ?
        $modal = './modals/errors.php'; // Oui, on affiche le modal Error
    }
};

if(isset($_GET['success'])) { // Est-ce que $_GET['success'] est définie ?
    $modal = './modals/success.php'; // Oui, on affiche le modal Success
};

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Sportif</title>
    <link rel="shortcut icon" href="https://api.iconify.design/material-symbols:sports-handball.svg?color=%23000000" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">    
        <?php $modal && include $modal; ?>

        <h1>Coach Sportif</h1>
        <p>Bienvenue sur ma page de prise de RDV</p>

        <article>
            <header>
                <p align="center">
                    Remplissez le formulaire ci-dessous pour réserver votre séance de sport
                </p>
            </header>
            <form action="./utils/process.php" method="POST">
                <fieldset>
                    <legend>Informations de votre séance</legend>
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" >
                    <label for="lieu">Lieu</label>
                    <select id="lieu" name="lieu" required>
                        <option value="FitnessPark Paris Rambuteau">FitnessPark Paris Rambuteau</option>
                        <option value="FitnessPark Paris Gare de Lyon">FitnessPark Paris Gare de Lyon</option>
                        <option value="FitnessPark Saint-Ouen">FitnessPark Saint-Ouen</option>
                        <option value="FitnessPark Paris Chatelêt">FitnessPark Paris Chatelêt</option>
                    </select>
                    <label for="heure">Heure</label>
                    <input type="time" id="heure" name="heure" value="10:00" required>
                </fieldset>
                <fieldset>
                    <legend>Vos informations de contact</legend>
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="Martin" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="martin@gmail.com" required>
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" value="0123456789" required>
                </fieldset>
                <button type="submit">Valider</button>
            </form>
            <footer>
                <p align="center">
                    Une validation de votre séance sera envoyée à votre adresse email
                </p>
            </footer>
        </article>
    </main>
</body>
</html>