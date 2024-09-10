<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "e-commerce";
$connection = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Initialisation des variables
$nom = "";
$description = "";
$categorie = "";
$marque = "";
$image_url = "";
$prix = "";
$errorMessage = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $categorie = $_POST["categorie"];
    $marque = $_POST["marque"];
    $image_url = $_FILES["image_url"]["name"];
    $prix = $_POST["prix"];

    do {
        // Valider les champs du formulaire
        if (empty($nom) || empty($description) || empty($categorie) || empty($marque) || empty($image_url) || empty($prix)) {
            $errorMessage = "Tous les champs sont requis";
            break;
        }

        // Upload de l'image dans le répertoire "uploads"
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file);

        // Insertion des données dans la table produits
        $sql = "INSERT INTO produits (nom, description, categorie, marque, image_url, prix) VALUES ('$nom', '$description', '$categorie', '$marque', '$image_url', '$prix')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Erreur lors de l'ajout du produit: " . $connection->error;
            break;
        }

        // Réinitialiser les champs après la soumission réussie
        $nom = "";
        $description = "";
        $categorie = "";
        $marque = "";
        $image_url = "";
        $prix = "";
        $successMessage = "Produit ajouté avec succès";

    } while (false);
}

?>

<html>
<head>
  <meta charset="utf-8">
  
  <link rel="stylesheet" type="text/css" href="st.css">
</head>

<body>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="http://blog.stackfindover.com/" rel="dofollow">Stackfindover</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
            <form id="stripe-login" method="post" enctype="multipart/form-data">
                <!-- Nom du produit -->
                <div class="field padding-bottom--24">
                  <input type="text" name="nom" placeholder="Nom du produit" value="<?php echo $nom; ?>"> 
                </div>
                
                <!-- Description du produit -->
                <div class="field padding-bottom--24">
                  <input type="text" name="description" placeholder="Description" value="<?php echo $description; ?>">
                </div>

                <!-- Catégorie du produit -->
                <div class="field padding-bottom--24">
                  <input type="text" name="categorie" placeholder="Catégorie" value="<?php echo $categorie; ?>">
                </div>

                <!-- Marque du produit -->
                <div class="field padding-bottom--24">
                  <input type="text" name="marque" placeholder="Marque" value="<?php echo $marque; ?>">
                </div>

                <!-- Image du produit -->
                <div class="field padding-bottom--24">
                  <input type="file" name="image_url" accept="image/*">
                </div>

                <!-- Prix du produit -->
                <div class="field padding-bottom--24">
                  <input type="number" name="prix" placeholder="Prix" value="<?php echo $prix; ?>" step="0.01">
                </div>

                <!-- Message d'erreur -->
                <?php if (!empty($errorMessage)): ?>
                  <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                <?php endif; ?>

                <!-- Message de succès -->
                <?php if (!empty($successMessage)): ?>
                  <div class="alert alert-success"><?php echo $successMessage; ?></div>
                <?php endif; ?>

                <!-- Bouton de soumission -->
                <div class="field padding-bottom--24">
                  <input type="submit" value="Ajouter le produit">
                </div>
              
              </form>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
</body>

</html>
