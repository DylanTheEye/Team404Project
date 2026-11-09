<?php
session_start();
require_once __DIR__ . '/database.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$fouten = [];

$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        $fouten[] = 'Vul een gebruikersnaam in.';
    } elseif (strlen($username) > 25) {
        $fouten[] = 'Je gebruikersnaam mag maximaal 25 tekens bevatten.';
    }

    if ($email === '') {
        $fouten[] = 'Vul een e-mailadres in.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fouten[] = 'Vul een geldig e-mailadres in.';
    } elseif (strlen($email) > 25) {
        $fouten[] = 'Je e-mailadres mag maximaal 25 tekens bevatten.';
    }

    if ($password === '') {
        $fouten[] = 'Vul een wachtwoord in.';
    } elseif (strlen($password) < 8) {
        $fouten[] = 'Je wachtwoord moet minimaal 8 tekens bevatten.';
    }

    if (empty($fouten)) {
        try {
            $checkUsername = $pdo->prepare(
                    'SELECT id FROM users WHERE username = ? LIMIT 1'
            );
            $checkUsername->execute([$username]);

            $checkEmail = $pdo->prepare(
                    'SELECT id FROM users WHERE email = ? LIMIT 1'
            );
            $checkEmail->execute([$email]);

            if ($checkUsername->fetch()) {
                $fouten[] = 'Deze gebruikersnaam is al in gebruik.';
            }

            if ($checkEmail->fetch()) {
                $fouten[] = 'Dit e-mailadres is al in gebruik.';
            }

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

        } catch (PDOException $e) {
            $fouten[] = 'Registreren is niet gelukt. Controleer je gegevens en probeer opnieuw.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account aanmaken | Stop de ontkoking</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<div class="auth-container">
    <main class="auth-card">

        <div class="auth-icon">✦</div>

        <h1>Account aanmaken</h1>

        <p class="subtitle">
            Maak een account aan en ontdek onze website.
        </p>

        <?php if (!empty($fouten)): ?>
            <div class="message error" role="alert">
                <strong>Er ging iets mis:</strong>
                <ul>
                    <?php foreach ($fouten as $fout): ?>
                        <li><?= htmlspecialchars($fout, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">

            <label for="username">Gebruikersnaam</label>
            <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Kies een gebruikersnaam"
                    maxlength="25"
                    autocomplete="username"
                    value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>"
                    required
            >

            <label for="email">E-mailadres</label>
            <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="naam@voorbeeld.nl"
                    maxlength="25"
                    autocomplete="email"
                    value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                    required
            >

            <label for="password">Wachtwoord</label>
            <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimaal 8 tekens"
                    minlength="8"
                    autocomplete="new-password"
                    required
            >

            <button type="submit">Account aanmaken</button>

        </form>

        <p class="switch-page">
            Heb je al een account?
            <a href="login.php">Log hier in</a>
        </p>

    </main>
</div>

</body>
</html>