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
    <link rel="stylesheet" href="<?= BASE_URL ?>css/simulation/simulation.css">
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

        <form action="<?= BASE_URL ?>simulate/hasilSimulasi/" method="post">
            <div id="pilihKarakter">
                <div id="infoList">
                    <?php
                    $karakter = $data['data-karakter'];
                    $chunkedKarakter = array_chunk($karakter, 5);
                    foreach ($chunkedKarakter as $karakterGroups): ?>
                        <div class="sub-List">
                            <?php foreach ($karakterGroups as $karakter): ?>
                                <div class="infoContent">
                                    <button type="button" class="input_karakter_pertama" name="karakter-pertama" value="<?= $karakter['karakter_id'] ?>">
                                        <img src="<?= BASE_URL ?>image/karakter/icon/<?= $karakter['image_karakter'] ?>" alt="<?= $karakter['image_karakter']; ?>" style="height: 75px;">
                                        <h2><?= $karakter['nama_karakter'] ?><h2>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="infoList">
                    <?php
                    $karakter = $data['data-karakter'];
                    $chunkedKarakter = array_chunk($karakter, 5);
                    foreach ($chunkedKarakter as $karakterGroups): ?>
                        <div class="sub-List">
                            <?php foreach ($karakterGroups as $karakter): ?>
                                <div class="infoContent">
                                    <button type="button" class="input_karakter_kedua" name="karakter-kedua" value="<?= $karakter['karakter_id'] ?>">
                                        <img src="<?= BASE_URL ?>image/karakter/icon/<?= $karakter['image_karakter'] ?>" alt="<?= $karakter['image_karakter']; ?>" style="height: 75px;">
                                        <h2><?= $karakter['nama_karakter'] ?><h2>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <input type="number" id="fields_karakter_id_pertama" name="id_karakter_pertama" value="" required style="display: none;">
            <input type="number" id="fields_karakter_id_kedua" name="id_karakter_kedua" value="" required style="display: none;">

            <button 
                type="submit" 
                id="buttonReaksi" 
                name="button-reaksi" 
                <?= !isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] ? 'disabled' : '' ?>
            >
                Tombol Reaksi
            </button>
        </form>

        <footer>
            <div class="optionalPage"></div>
            <div class="copyright">&copy; 2024 Genshin Impact Simulator. All rights reserved.</div>
        </footer>
    </div>

    <script>
        const karakterButtonsPertama = document.querySelectorAll('.input_karakter_pertama');
        const karakterButtonsKedua = document.querySelectorAll('.input_karakter_kedua');
        const fieldsKarakterIdPertama = document.getElementById('fields_karakter_id_pertama');
        const fieldsKarakterIdKedua = document.getElementById('fields_karakter_id_kedua');
        const tombolReaksi = document.getElementById('buttonReaksi');

        let selectedButtonPertama = null;
        let selectedButtonKedua = null;

        const toggleButtonState = () => {
            karakterButtonsKedua.forEach(button => {
                button.disabled = fieldsKarakterIdPertama.value === button.value;
            });
            karakterButtonsPertama.forEach(button => {
                button.disabled = fieldsKarakterIdKedua.value === button.value;
            });
        };

        const updateBorder = (button, isSelected) => {
            button.parentElement.style.border = isSelected ? '1px solid yellow' : '2px solid #393E46';
        };

        const handleKarakterClick = (buttons, field, selectedButtonRef) => {
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    if (selectedButtonRef) {
                        updateBorder(selectedButtonRef, false);
                    }

                    if (field.value === button.value) {
                        field.value = '';
                        selectedButtonRef = null;
                    } else {
                        field.value = button.value;
                        updateBorder(button, true);
                        selectedButtonRef = button;
                    }

                    toggleButtonState();
                });
            });
        };

        handleKarakterClick(karakterButtonsPertama, fieldsKarakterIdPertama, selectedButtonPertama);
        handleKarakterClick(karakterButtonsKedua, fieldsKarakterIdKedua, selectedButtonKedua);

        toggleButtonState();

        tombolReaksi.addEventListener('click', (event) => {
            if (fieldsKarakterIdPertama.value === '' || fieldsKarakterIdKedua.value === '') {
                event.preventDefault();
                alert('Silakan pilih kedua karakter untuk melanjutkan.');
                return;
            }

            <?php if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']): ?>
                event.preventDefault();
                alert('Anda harus login untuk menggunakan fitur ini.');
                return;
            <?php endif; ?>
        });
    </script>
</body>

</html>
