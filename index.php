<?php
require_once 'config/database.php';

if(isLoggedIn()) {
    redirect('pages/dashboard/index.php');
}

$error = '';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND is_active = TRUE");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['full_name'] = $user['full_name'];
        redirect('pages/dashboard/index.php');
    } else {
        $error = "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css?v=<?= @filemtime(__DIR__ . '/assets/css/style.css') ?>">
</head>
<body class="login-page" style="padding-top: 0;">
    <div class="login-card">
        <div class="brand-row">
            <div class="app-brand-mark"><i class="bi bi-ticket-detailed"></i></div>
            <h1><?= APP_NAME ?></h1>
            <p class="subtitle">Gestion des tickets et du parc informatique</p>
        </div>

        <?php if($error): ?>
            <div class="alert alert-danger d-flex align-items-center mb-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" placeholder="ex. admin" required autofocus value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>
            <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
            </button>
        </form>

        <div class="demo-accounts">
            Comptes démo :<br>
            <code>admin</code> / <code>password</code> ·
            <code>salah</code> / <code>password</code> ·
            <code>manager1</code> / <code>password</code>
        </div>
    </div>
</body>
</html>
