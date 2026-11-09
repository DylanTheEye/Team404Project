
<?php
session_start();
require_once 'database.php';

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $fout = 'Vul je gebruikersnaam en wachtwoord in.';
    } else {
        $stmt = $pdo->prepare(
                'SELECT id, username, password FROM users WHERE username = ?'
        );

        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: ./index.php');
            exit;
        } else {
            $fout = 'Gebruikersnaam of wachtwoord is onjuist.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="auth.css">
</head>

<body>

<div class="auth-container">
    <div class="auth-card">

        <div class="auth-icon">✦</div>

        <h1>Welkom terug!</h1>

        <p class="subtitle">
            Fijn dat je er weer bent. Log in op je account.
        </p>

        <?php if (isset($_GET['registered'])): ?>
            <div class="message success">
                Je account is succesvol aangemaakt!
                Je kunt nu inloggen.
            </div>
        <?php endif; ?>

        <?php if ($fout !== ''): ?>
            <div class="message error">
                <?= htmlspecialchars($fout) ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label for="username">Gebruikersnaam</label>

            <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Vul je gebruikersnaam in"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                    required
            >

            <label for="password">Wachtwoord</label>

            <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Vul je wachtwoord in"
                    required
            >

            <button type="submit">
                Inloggen
            </button>

        </form>

        <p class="switch-page">
            Nog geen account?
            <a href="register.php">Maak hier een account aan</a>
        </p>

    </div>
</div>

</body>
</html>