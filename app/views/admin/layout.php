<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin/layout.css">
</head>

<body>
    <div class="sidebar">
        <img src="/assets/icons/administrator-icon.svg" alt="Администратор" />
        <h3 style="align-self: center;"><?php echo $_SESSION['admin']['name'] ?></h3>
        <div class="separator"></div>
        <button onclick="location.href='/admin'">Главная</button>
        <button onclick="location.href='/admin/authors'">Авторы</button>
        <button onclick="location.href='/admin/gallery'">Галерея</button>
        <button class="logout" onclick="location.href='/admin/logout'">Выход</button>
    </div>

    <div class="content">
        <?php include($content); ?>
    </div>
</body>

</html>