<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Dotenv\Dotenv;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'] ?? '';
    $lieu = $_POST['lieu'] ?? '';
    $heure = $_POST['heure'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    
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

    // Validation des données
    if(empty($date) || empty($lieu) || empty($heure) || empty($nom) || empty($email) || empty($telephone)) {
        array_push($errors, $messages['vide']);
    }
    
    if(strtotime($date) < strtotime('today')) {
        array_push($errors, $messages['dateInvalide']);
    }
    
    $lieux_valides = [
        'FitnessPark Paris Rambuteau',
        'FitnessPark Paris Gare de Lyon',
        'FitnessPark Saint-Ouen',
        'FitnessPark Paris Chatelêt'
    ];
    if(!in_array($lieu, $lieux_valides)) {
        array_push($errors, $messages['lieuInvalide']);
    }

    function newMailCoaching(
        string $sender, 
        string $receiver, 
        string $content, 
        string $subject
    ) {
        $mail = new PHPMailer(true); // Objet PHPMailer
        try {
            // .env info
            $dotenv = new Dotenv();
            $dotenv->loadEnv(__DIR__ . '/../.env');

            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = $_ENV["MAILTRAP_USERNAME"];
            $mail->Password = $_ENV["MAILTRAP_PASSWORD"];

            $mail->setFrom($sender, 'Coach');
            $mail->addAddress($receiver);
            
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $content;

            $mail->send();
            
        } catch (Exception $e) {
            return '<p>Un problème est survenu lors de l\'envoi de votre mail:<br>' . $e->getMessage() . '</p>';
        }
    }

    if(empty($errors)) {
        // Envoi des emails
        $coach_email = "coach@'fitnesspark.com";
        
        $coach_content = "Nouveau rendez-vous :<br>" .
            "Date : $date<br>" .
            "Heure : $heure<br>" .
            "Lieu : $lieu<br>" .
            "Client : $nom<br>" .
            "Email : $email<br>" .
            "Téléphone : $telephone";

        $client_content = "Votre rendez-vous est confirmé :<br>" .
            "Date : $date<br>" .
            "Heure : $heure<br>" .
            "Lieu : $lieu";

        // Envoi au coach
        newMailCoaching($email, $coach_email, $coach_content, "Nouveau RDV avec $nom");
        
        // Envoi au client
        newMailCoaching($coach_email, $email, $client_content, "Confirmation de votre RDV de coaching");

        // Redirection avec message de succès
        header("Location: ../index.php?success=1");
        exit();
    } else {
        // Redirection avec erreurs
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
