<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title']) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/user/register_3.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= BASE_URL ?>image/home/logo.png">
</head>

<body>
    <div id="container">
        <header>
            <div id="title">
                <a href="<?= BASE_URL ?>">
                    <h1>GENSHIN SIMULATION</h1>
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="<?= BASE_URL ?>simulate/">Simulate</a></li>
                    <li><a href="<?= BASE_URL ?>info/">Detail</a></li>
                    <li><a href="<?= BASE_URL ?>user/login/">Login</a></li>
                    <li><a href="<?= BASE_URL ?>user/register/">Register</a></li>
                </ul>
            </nav>
        </header>

        <div id="registerContainer">
            <h1>Register</h1>
            <form action="<?= BASE_URL ?>user/registrasiAkun/" method="post" id="registerForm">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="password2" id="password2" placeholder="Ulangi Password" required>
                <button type="submit" name="submitRegister">Register</button>
            </form>
            <a href="<?= BASE_URL ?>user/login/">Sudah punya akun? Login</a>
        </div>
    </div>

    <?php if (isset($data['error-register'])): ?>
        <script>
            let message = "<?= htmlspecialchars($data['error-register']) ?>";
            alert(message);
        </script>
    <?php endif; ?>

    <?php if (isset($data['success-register'])): ?>
        <script>
            let message = "<?= htmlspecialchars($data['success-register']) ?>";
            alert(message);
        </script>
    <?php endif; ?>
</body>

</html>