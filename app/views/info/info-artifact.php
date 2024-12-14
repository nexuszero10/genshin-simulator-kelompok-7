<?php
session_start();

if (!isset($_SESSION['user_logged_in']) && isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    require_once __DIR__ . '/../../models/User_model.php';
    $userModel = new User_model();

    $userId = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $user = $userModel->getUserById($userId);
    if ($user && $key === hash('sha256', $user['username'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/info/info_3.css">
    <link rel="icon" href="<?= BASE_URL ?>img/home/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
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
                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true): ?>
                        <li><a href="<?= BASE_URL ?>user/logoutAkun/">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>user/login/">Login</a></li>
                        <li><a href="<?= BASE_URL ?>user/register/">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <div id="infoList" style="width: 90% ;">
            <?php
            $artifact = $data['data-artifact'];
            $chunkedArtifact = array_chunk($artifact, 3);
            foreach ($chunkedArtifact as $artifactGroups): ?>
                <div class="sub-List">
                    <?php foreach ($artifactGroups as $artifact): ?>
                        <div class="infoContent">
                        <img src="<?= BASE_URL ?>image/artifact/<?= $artifact['image'] ?>" alt="<?= $artifact['image']; ?>" style="height: 300px;;">
                        <h2><?= $artifact['artifact_name']?><h2>
                        <p style="font-size: 15px;"><?= $artifact['deskripsi_efek_artifact'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Genshin Impact Simulator. All rights reserved.</div>
        </footer>
    </div>
</body>

</html>