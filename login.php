<?php
session_start();
require 'database.php';

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare(
        'SELECT id, username, password 
         FROM users 
         WHERE username = ?'
    );

    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: home.php');
        exit;
    } else {
        $fout = 'Gebruikersnaam of wachtwoord is onjuist.';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
</head>
<body>

<h1>Inloggen</h1>

<?php if (isset($_GET['registered'])): ?>
    <p>Je account is aangemaakt. Je kunt nu inloggen.</p>
<?php endif; ?>

<?php if ($fout !== ''): ?>
    <p><?= htmlspecialchars($fout) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Gebruikersnaam</label>
    <input type="text" name="username" required>

    <label>Wachtwoord</label>
    <input type="password" name="password" required>

    <button type="submit">Inloggen</button>
</form>

<p>Nog geen account?
    <a href="register.php">Registreren</a>
</p>

</body>
</html>