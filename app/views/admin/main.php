<link rel="stylesheet" href="/css/admin/main.css">

<h1>Панель администратора</h1>
<p class="greeting">Добро пожаловать, <strong><?= $_SESSION['admin']['name'] ?></strong>!</p>

<section class="dashboard-info">
    <h2>Напоминалка</h2>
    <p>Эта панель предназначена для управления содержимым вашего сайта. Здесь вы можете добавлять, редактировать и удалять авторов и произведения искусства.</p>
</section>

<section class="dashboard-cards">
    <div class="card">
        <h2>Список авторов</h2>
        <p>Общее количество записей: <strong><?= $authorsCount ?? 0; ?></strong></p>
        <p>Дата последнего изменения: <strong><?= $lastModifiedTimeOfAuthors ?? 'Неизвестно'; ?></strong></p>
        <a href="/admin/authors" class="button">Перейти к авторам</a>
    </div>

    <div class="card">
        <h2>Список произведений искусства</h2>
        <p>Общее количество записей: <strong><?= $artworksCount ?? 0; ?></strong></p>
        <p>Дата последнего изменения: <strong><?= $lastModifiedTimeOfArtworks ?? 'Неизвестно'; ?></strong></p>
        <a href="/admin/gallery" class="button">Перейти к произведениям искусства</a>
    </div>
</section>