<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/user/login_3.css">
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

        <div id="loginContainer">
            <h1>Login</h1>
            <form action="<?= BASE_URL ?>user/loginAkun/" method="post" id="loginForm">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
                <button type="submit" name="submitLogin">Login</button>
                <div class="optionLogin">
                    <div class="cookieCheckbox">
                        <input type="checkbox" name="remember" id="rememberMe">
                        <label for="rememberMe">Remember Me</label>
                    </div>
                </div>
            </form>
            <a href="<?= BASE_URL ?>user/register/">Belum punya akun ? Regstrasi</a>
        </div>

    </div>

    <?php if (isset($data['error-login'])): ?>
        <script>
            let message = "<?= htmlspecialchars($data['error-login']) ?>";
            alert(message);
        </script>
    <?php endif; ?>

    <?php if (isset($data['success-login'])): ?>
        <script>
            let message = "<?= htmlspecialchars($data['success-login']) ?>";
            alert(message);
            window.location.href = "<?= BASE_URL ?>";
        </script>
    <?php endif; ?>
</body>

</html>