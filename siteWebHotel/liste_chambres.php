

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php'?>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/filtre-chambres.js"></script>
    <title>Liste des chambres</title>
</head>

<body>
<?php require_once 'includes/header.php'?>

<div class="container_ListeChambre">
    <h1>Liste des Chambres</h1>

    <form method="post" action="">
        <!-- Choix du filtre de type de chambre-->
        <label for="typeChambre">Type de Chambre :</label>
        <select name="typeChambre" id="typeChambre">
            <option value="tous">Tous</option>
            <option value="Chambre Standard">Chambre Standard</option>
            <option value="Suite de Luxe">Suite de Luxe</option>
            <option value="Chambre Familiale">Chambre Familiale</option>
        </select>

        <!-- Choix du prix de la chambre -->
        <label for="prixChambre">Prix :</label>
        <select name="prixChambre" id="prixChambre">
            <option value="tous">Tous</option>
            <option value="100">Prix 100$</option>
            <option value="150">Prix 150$</option>
            <option value="200">Prix 200$</option>
            
        </select>

        <!-- Bouton de filtrage -->
        <input type="submit" name="filtrer" value="Filtrer">
    </form>

    <?php
        // Lire le contenu du fichier JSON
        $json_data = file_get_contents(__DIR__ . '/public/data/chambres.json');

        // Convertir le JSON en tableau PHP
        $chambres = json_decode($json_data, true);

        // Vérifier si le formulaire a été soumis
        if (isset($_POST['filtrer'])) {
            // Récupérer les valeurs des filtres
            $typeChambre = $_POST['typeChambre'];
            $prixChambre = $_POST['prixChambre'];

            // Filtrer les chambres en fonction des valeurs des filtres
            $chambresFiltres = array_filter($chambres, function ($chambre) use ($typeChambre, $prixChambre) {
                // Vérifier si la chambre correspond au type sélectionné (ou si le type est "Tous")
                $typeMatch = ($typeChambre === 'tous' || $chambre['nom'] === $typeChambre);

                // Vérifier si la chambre correspond au prix sélectionné (ou si le prix est "Tous")
                $prixMatch = ($prixChambre === 'tous' || $chambre['prix'] == $prixChambre);

                // Retourner vrai si la chambre correspond à la fois au type et au prix sélectionnés
                return $typeMatch && $prixMatch;
            });

            // Utiliser les chambres filtrées pour afficher la liste
            if (!empty($chambresFiltres)) {
                echo '<ul>';
                foreach ($chambresFiltres as $chambre) {
                    echo '<li>';
                    echo '<img src="' . $chambre['photos'][0] . '" alt="' . $chambre['nom'] . '" class="image_chambre">';
                    echo '<h2>' . $chambre['nom'] . '</h2>';
                    echo '<p>Prix : ' . $chambre['prix'] . ' $</p>';
                    echo '<a href="detail_chambre.php?id=' . $chambre['id'] . '" class="lien-detail">Voir les détails</a>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>Aucune chambre correspondant aux critères de filtrage.</p>';
            }
        } else {
            // Si le formulaire n'a pas été soumis, afficher toutes les chambres
            if (!empty($chambres)) {
                echo '<ul>';
                foreach ($chambres as $chambre) {
                    echo '<li>';
                    echo '<img src="' . $chambre['photos'][0] . '" alt="' . $chambre['nom'] . '" class="image_chambre">';
                    echo '<h2>' . $chambre['nom'] . '</h2>';
                    echo '<p>Prix : ' . $chambre['prix'] . ' $</p>';
                    echo '<a href="detail_chambre.php?id=' . $chambre['id'] . '" class="lien-detail">Voir les détails</a>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>Aucune chambre disponible pour le moment.</p>';
            }
        }
    ?>
</div>

<?php require_once 'includes/footer.php'?>
</body>

</html>