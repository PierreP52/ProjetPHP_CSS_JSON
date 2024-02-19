<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php'?>
    <link rel="stylesheet" href="public/css/style.css">
    <title>Liste des chambres</title>
</head>

<body>
    <?php require_once 'includes/header.php'?>

    <div class="container_ListeChambre">
        <?php
            // Vérifier si l'ID de la chambre est passé dans l'URL
            if (isset($_GET['id'])) {
                // Lire le contenu du fichier JSON
                $json_data = file_get_contents(__DIR__ . '/public/data/chambres.json');
                
                // Convertir le JSON en tableau PHP
                $chambres = json_decode($json_data, true);

                // Récupérer l'ID de la chambre depuis l'URL
                $chambre_id = $_GET['id'];

                // Vérifier si la chambre avec l'ID spécifié existe
                if (isset($chambres[$chambre_id])) {
                    $chambre = $chambres[$chambre_id];
                    echo '<h1>' . $chambre['nom'] . '</h1>';
                    echo '<p>Description : ' . $chambre['description'] . '</p>';
                    echo '<p>Prix : ' . $chambre['prix'] . ' $</p>';

                    // Afficher la galerie de photos
                    echo '<h2>Galerie de Photos</h2>';
                    echo '<div class="gallery">';
                    foreach ($chambre['photos'] as $photo) {
                        echo '<img src="' . $photo . '" alt="' . $chambre['nom'] . '" class="image_chambreDetail">';
                    }
                    echo '</div>';
                } else {
                    echo '<p>La chambre demandée n\'existe pas.</p>';
                }
            } else {
                echo '<p>Aucun ID de chambre spécifié.</p>';
            }
            ?>
    </div>
    <?php require_once 'includes/footer.php'?>
</body>

</html>