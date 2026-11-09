
<?php
session_start();
require_once 'database.php';

$fouten = [];

$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Controleren of alle velden zijn ingevuld
    if ($username === '') {
        $fouten[] = 'Vul een gebruikersnaam in.';
    }

    if ($email === '') {
        $fouten[] = 'Vul een e-mailadres in.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fouten[] = 'Vul een geldig e-mailadres in.';
    }

    if ($password === '') {
        $fouten[] = 'Vul een wachtwoord in.';
    } elseif (strlen($password) < 8) {
        $fouten[] = 'Je wachtwoord moet minimaal 8 tekens bevatten.';
    }

    // Alleen controleren als de invoer geldig is
    if (empty($fouten)) {

        // Gebruikersnaam controleren
        $checkUsername = $pdo->prepare(
                'SELECT id FROM users WHERE username = ?'
        );
        $checkUsername->execute([$username]);

        // E-mailadres controleren
        $checkEmail = $pdo->prepare(
                'SELECT id FROM users WHERE email = ?'
        );
        $checkEmail->execute([$email]);

        $usernameBestaat = $checkUsername->fetch();
        $emailBestaat = $checkEmail->fetch();

        // Beide controles uitvoeren en alle fouten tonen
        if ($usernameBestaat) {
            $fouten[] = 'Deze gebruikersnaam is al in gebruik.';
        }

        if ($emailBestaat) {
            $fouten[] = 'Dit e-mailadres is al in gebruik.';
        }

        // Alleen registreren als er geen fouten zijn
        if (empty($fouten)) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                    'INSERT INTO users (username, email, password)
                 VALUES (?, ?, ?)'
            );

            $stmt->execute([$username, $email, $hash]);

            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account aanmaken</title>
    <link rel="stylesheet" href="auth.css">
</head>

<body>

<div class="auth-container">
    <div class="auth-card">

        <div class="auth-icon">✦</div>

        <h1>Account aanmaken</h1>
        <p class="subtitle">
            Maak een account aan en ontdek onze website.
        </p>

        <?php if (!empty($fouten)): ?>
            <div class="message error">
                <strong>Er ging iets mis:</strong>

                <ul>
                    <?php foreach ($fouten as $fout): ?>
                        <li><?= htmlspecialchars($fout) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label for="username">Gebruikersnaam</label>
            <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Kies een gebruikersnaam"
                    maxlength="25"
                    value="<?= htmlspecialchars($username) ?>"
                    required
            >

            <label for="email">E-mailadres</label>
            <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="naam@voorbeeld.nl"
                    maxlength="25"
                    value="<?= htmlspecialchars($email) ?>"
                    required
            >

            <label for="password">Wachtwoord</label>
            <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimaal 8 tekens"
                    minlength="8"
                    required
            >

            <button type="submit">
                Account aanmaken
            </button>

        </form>

        <p class="switch-page">
            Heb je al een account?
            <a href="login.php">Log hier in</a>
        </p>

    </div>
</div>

</body>
</html>
`