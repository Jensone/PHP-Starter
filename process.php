<?php

use PHPMailer\PHPMailer\PHPMailer;
/**
 * Traitement du formulaire de prise de RDV pour le coach sportif
 * 1 - Récolter les données du formulaire [OK]
 * 2 - Validation des données du formulaire [OK]
 * 3 - Envoi de l'email []
 * 4 - Confirmation de l'envoi []
 * 5 - Nettoyer le formulaire []
 *
 */


// 1 - Récolter les données du formulaire

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'] ?? '';
    $lieu = $_POST['lieu'] ?? '';
    $heure = $_POST['heure'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';

    // var_dump($lieu);
    
    // Liste des messages d'erreur possible
    $messages = [
        "vide" => "Il y a des données manquantes.",
        "dateInvalide" => "Merci de sélectionner une date dans le futur.",
        "heureInvalide" => "Les séances ont lieu entre 8h et 22h.",
        "tropTard" => "Les séances peuvent êtres réservées minimum 2h en avance.",
        "lieuInvalide" => "Séléctionnez une salle dans la liste.",
        "nomInvalide" => "Les caractères spéciaux ne sont pas autorisés.",
        "emailInvalide" => "Seuls les fournisseurs communs sont autorisés (gmail, outlook...)",
        "telephoneInvalide" => "Le téléphone n'est pas valide.",
    ];

    // Initialisation d'un tableau pour récolter les erreurs
    $errors = [];

    if(empty($date)) {
        array_push($errors, $messages['vide']);
    } elseif(strtotime($date) < strtotime('today')) {
        array_push($errors, $messages['dateInvalide']);
    }

    // if elseif pour le reste des données
    
    
    // Envoi du mail au coach
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'e8a98412438662';
    $phpmailer->Password = 'e41ad837e4d83f';
    
    // Message du mail

    // Envoi du mail
    
    // Confirmation de l'envoi
    
    
    var_dump($errors);

} else {
    header("Location: index.php");
}
