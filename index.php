<?php 

$title = "Accueil";
$description = "Coach Sportif, page de prise de RDV pour des séance de sport chez FitnessPark";

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

<?php include './components/header.php'; ?>
<?php $modal && include $modal; ?>
    
    <h1>Coach Sportif</h1>
    <p>Bienvenue sur ma page de prise de RDV</p>
    
    <article>
        <header>
            <p align="center">
                Remplissez le formulaire ci-dessous pour réserver votre séance de sport
            </p>
        </header>

        <?php include './components/form.php'; ?>

        <footer>
            <p align="center">
                Une validation de votre séance sera envoyée à votre adresse email
            </p>
        </footer>
    </article>

<?php include './components/footer.php'; ?>
