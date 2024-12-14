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
    <link rel="stylesheet" href="<?= BASE_URL ?>css/info/info_3.css">
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

        <div id="infoList">
            <div class="sub-List">
                <div class="infoContent">
                    <img src="<?= BASE_URL ?>image/karakter/card/logo-karakter.png" alt="logoKarakter">
                    <h2>KARAKTER</h2>
                    <p>Karakter memiliki base elemen, skill, dan role masing masing yang unik</p>
                    <div class="infoButton">
                        <a href="<?= BASE_URL ?>info/infoKarakter/"><button>Detail info</button></a>
                    </div>
                </div>

                <div class="infoContent">
                    <img src="<?= BASE_URL ?>image/elemental/hydro.png" alt="logoElemental">
                    <h2>ELEMENTAL</h2>
                    <p>Ada 7 elemntal yang mewakili unsur - unsur alam yang bisa bereaksi menghasilkan beebrapa elemntal reaction</p>
                    <div class="infoButton">
                        <a href="<?= BASE_URL ?>info/infoElemental/"><button>Detail info</button></a>
                    </div>
                </div>

                <div class="infoContent">
                    <img src="<?= BASE_URL ?>image/weapon/logo-weapon.png" alt="logoWeapon">
                    <h2>WEAPON</h2>
                    <p>Weapon bersinergi dengan elemental milik karakter untuk meningkatkan skill aktif dan efek unik</p>
                    <div class="infoButton">
                        <a href="<?= BASE_URL ?>info/infoWeapon/"><button>Detail info</button></a>
                    </div>
                </div>

                <div class="infoContent">
                    <img src="<?= BASE_URL ?>image/artifact/logo-artifact.png" alt="logoArtifact">
                    <h2>ARTIFACT</h2>
                    <p>Artifact bersinergi dengan elemental milik karakter untuk menigkatkan base atribute milik karakter</p>
                    <div class="infoButton">
                        <a href="<?= BASE_URL ?>info/infoArtifact/"><button>Detail info</button></a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="copyright">© 2024 Genshin Impact Simulator. All rights reserved.</div>
        </footer>
    </div>
</body>

</html>