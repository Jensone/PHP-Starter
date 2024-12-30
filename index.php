<?php
// VARIABLES & CONSTANTS
$nom = "Martin";
const SURNAME = "Matin";

// echo $nom . ' ' . SURNAME;

// TYPES
/**
 * string = "Martin"
 * integer = 20
 * float = 23.44405555
 * decimal(5,2) = 999.99
 * boolean = true or false
 * array = [$nom,20.55,"Martin"]
 * object = new stdClass()
 * text, varchar = Liés à une BDD
 */

// FUNCTIONS
function totalTva(
    int $ht, // 57
    int $tva,  // 20
    int $qt, // 10
    int $promo // 0
    ): int 
{
    $totalHt = $ht * $qt;
    // CONDITIONS
    if ($promo > 0) { $totalHt = $totalHt * $promo; }
    
    $totalTva = $totalHt * $tva / 100;
    return $totalTva + $totalHt;
}

// echo totalTva(57, 20, 10, 0);

// CONDITIONS
if (1 == 0) {
    echo "Le monde est à l'envers";
}

$annee = new DateTime('now');
//echo $annee->format('Y') === '2025' ? " Bonne année 2025 🎉" : "Ce n'est pas encore 2025";

// CLASSES & OBJECTS
class User 
{
    // Attributs = Propriétés = Variables dans la classe
    public string $nom;
    public string $prenom;
    public string $metier;

    //  Mutateur = Setters, c'est une Méthode (fonction)
    public function setNom(string $nom)
    {
        // $this fait référence à l'objet en cours, ici issue de la classe User
        $this->nom = $nom;
        return $this; // Ici on retoune l'information à l'objet
    }
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
    public function setMetier(string $metier)
    {
        $this->metier = $metier;
        return $this;
    }
}

$user = new User(); // Instanciation d'un objet issu de la classe User
// Hydration de l'objet $user
$user
    ->setNom('Martin')
    ->setPrenom('Matin')
    ->setMetier('Chaudronnier')
    ;

// Débogage de l'objet $user
var_dump($user);

?>