<?php
require 'database.php';

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $fout = 'Vul alle velden in.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fout = 'Vul een geldig e-mailadres in.';
    } elseif (strlen($password) < 8) {
        $fout = 'Je wachtwoord moet minimaal 8 tekens hebben.';
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password) 
                    VALUES (?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $hash]);

            header('Location: login.php?registered=1');
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $fout = 'Deze gebruikersnaam of dit e-mailadres bestaat al.';
            } else {
                $fout = 'Er ging iets mis. Probeer het opnieuw.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Account aanmaken</title>
</head>
<body>

<h1>Account aanmaken</h1>

<?php if ($fout !== ''): ?>
    <p><?= htmlspecialchars($fout) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Gebruikersnaam</label>
    <input type="text" name="username" required>

    <label>E-mailadres</label>
    <input type="email" name="email" required>

    <label>Wachtwoord</label>
    <input type="password" name="password"
           minlength="8" required>

    <button type="submit">Registreren</button>
</form>

<p>Heb je al een account?
    <a href="login.php">Inloggen</a>
</p>

</body>
</html>