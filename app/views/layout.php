<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/card-collection.css">
    <link rel="stylesheet" href="/css/filters.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="/assets/logo.svg" alt="Art Gallery">
            <span>ART GALLERY</span>
        </div>
        <div class="menu-icon" onclick="toggleSidebar()">☰</div>
    </header>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <img src="/assets/logo.svg" alt="Art Gallery" style="height: 200px;">
            <span>ART GALLERY</span>
        </div>
        <ul>
            <li><a href="/">ГЛАВНАЯ СТРАНИЦА</a></li>
            <li><a href="/gallery">ВЕБ-ГАЛЕРЕЯ</a></li>
            <li><a href="/authors">АВТОРЫ</a></li>
        </ul>
    </div>

    <main>
        <?php include($content) ?>
    </main>

    <footer>
        <div class="footer-content">
            <div class="quote">
                <p><em>«Искусство смывает с души пыль повседневной жизни».</em></p>
                <p class="author">Пабло Пикассо</p>
            </div>
            <div class="copyright">
                <img src="/assets/logo.svg" alt="Art Gallery" style="height: 210px; margin-left: 20px">
                <p>&copy; <?= date('Y') ?> Art Gallery. Все права защищены.</p>
            </div>
            <div class="social-section">
                <p class="social-title">Присоединяйтесь к нам в социальных сетях!</p>
                <div class="social-icons">
                    <a href="#"><img src="/assets/icons/ok-icon.svg" alt="OK"></a>
                    <a href="#"><img src="/assets/icons/vk-icon.svg" alt="VK"></a>
                    <a href="#"><img src="/assets/icons/telegram-icon.svg" alt="Telegram"></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>

</html>