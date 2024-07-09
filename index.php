<?php
//session_start();
// Détails de la connexion à la base de données
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "MODCOD";

// Créer une connexion
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    // Redirection vers une autre page sécurisée si l'utilisateur est déjà authentifié
    header("Location: temp.html");
    exit;
}

// Traitement du formulaire lorsque le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Requête pour vérifier les informations d'identification
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // L'utilisateur existe, vérifier le statut
        $row = $result->fetch_assoc();
        if (($is_admin && $row['status'] == 'admin') || (!$is_admin && $row['status'] != 'admin')) {
            // Authentification réussie, enregistrer l'utilisateur en session
            $_SESSION['username'] = $input_username;
            $_SESSION['status'] = $row['status'];
            header("Location: temp.html");
            exit;
        } else {
            $error_message = "Vous n'avez pas les droits d'administrateur.";
        }
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'authentification</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <header>
            <img src="logo.png" alt="Logo">
            <h2>Connexion</h2>
        </header>

        <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php if(isset($error_message)) : ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="is_admin" name="is_admin">
                <label for="is_admin">Se connecter en tant qu'administrateur</label>
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
