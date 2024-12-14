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
    <link rel="stylesheet" href="<?= BASE_URL ?>css/simulation/result.css">
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

        <div id="resultContainer">
            <div id="infoKarakter">
                <div id="karakter-pertama">
                    <img src="<?= BASE_URL ?>/image/karakter/card/<?= isset($data['data_karakter_pertama']['image_karakter']) ? $data['data_karakter_pertama']['image_karakter'] : 'default.png' ?>" alt="karakter1">
                    <p>
                        <?= isset($data['data_karakter_pertama']['nama_karakter']) ? $data['data_karakter_pertama']['nama_karakter'] : 'Data tidak tersedia' ?>
                        -
                        <?= isset($data['data_karakter_pertama']['elemental_nama']) ? $data['data_karakter_pertama']['elemental_nama'] : 'Data tidak tersedia' ?>
                    </p>
                </div>
                <div id="karakter-kedua">
                    <img src="<?= BASE_URL ?>/image/karakter/card/<?= isset($data['data_karakter_kedua']['image_karakter']) ? $data['data_karakter_kedua']['image_karakter'] : 'default.png' ?>" alt="karakter2">
                    <p>
                        <?= isset($data['data_karakter_kedua']['nama_karakter']) ? $data['data_karakter_kedua']['nama_karakter'] : 'Data tidak tersedia' ?>
                        -
                        <?= isset($data['data_karakter_kedua']['elemental_nama']) ? $data['data_karakter_kedua']['elemental_nama'] : 'Data tidak tersedia' ?>
                    </p>
                </div>
            </div>

            <div id="hasilReaksi">
                <p>Elemental Reaction</p>
                <p><?= isset($data['elemental_reaction']['reaction']) ? $data['elemental_reaction']['reaction'] : 'Tidak ada reaksi elemental' ?></p>
            </div>

            <div id="rekomendasi">
                <div id="weapon">
                    <img src="<?= BASE_URL ?>/image/weapon/<?= isset($data['rekomendasi_weapon'][0]['image']) ? $data['rekomendasi_weapon'][0]['image'] : 'default.png' ?>" alt="weapon">
                    <h2><?= isset($data['rekomendasi_weapon'][0]['weapon_name']) ? $data['rekomendasi_weapon'][0]['weapon_name'] : 'Tidak ada rekomendasi weapon' ?></h2>
                    <p><?= isset($data['rekomendasi_weapon'][0]['deskripsi_efek_weapon']) ? $data['rekomendasi_weapon'][0]['deskripsi_efek_weapon'] : 'Tidak ada deskripsi' ?></p>
                </div>
                <div id="artifact">
                    <img src="<?= BASE_URL ?>/image/artifact/<?= isset($data['rekomendasi_artifact'][0]['image']) ? $data['rekomendasi_artifact'][0]['image'] : 'default.png' ?>" alt="weapon">
                    <h2><?= isset($data['rekomendasi_artifact'][0]['artifact_name']) ? $data['rekomendasi_artifact'][0]['artifact_name'] : 'Tidak ada rekomendasi artifact' ?></h2>
                    <p><?= isset($data['rekomendasi_artifact'][0]['deskripsi_efek_artifact']) ? $data['rekomendasi_artifact'][0]['deskripsi_efek_artifact'] : 'Tidak ada deskripsi' ?></p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="optionalPage">
        </div>
        <div class="copyright">&copy; 2024 Genshin Impact Simulator. All rights reserved.</div>
    </footer>
</body>

</html>