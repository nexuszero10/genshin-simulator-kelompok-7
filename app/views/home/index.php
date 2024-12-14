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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/home/index_3.css">
    <link rel="icon" href="<?= BASE_URL ?>image/home/logo.png">
</head>

<body>
    <div id="container">
        <header>
            <div id="title">
            <a href="<?= BASE_URL ?>"><h1>GENSHIN SIMULATION</h1></a>
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

        <div id="sliderContainer">
            <button class="arrow prev" onclick="prevSlide()">&#10094;</button>
            <div id="slider">
                <div class="slide">
                    <img src="<?= BASE_URL ?>image/home/poster1.png" alt="poster1">
                    <br>
                    <h2>Gnehsin Impact</h2>
                </div>
                <div class="slide">
                    <img src="<?= BASE_URL ?>image/home/poster2.png" alt="poster2">
                    <br>
                    <h2>Yelan</h2>
                </div>
                <div class="slide">
                    <img src="<?= BASE_URL ?>image/home/poster3.png" alt="poster3">
                    <br>
                    <h2>Raiden Shogun</h2>
                </div>
                <div class="slide">
                    <img src="<?= BASE_URL ?>image/home/poster4.png" alt="poster4">
                    <br>
                    <h2>Yae Miko</h2>
                </div>
            </div>
            <button class="arrow next" onclick="nextSlide()">&#10095;</button>
        </div>
    </div>
    <script src="<?= BASE_URL ?>javascript/home/index.js"></script>
</body>

</html>