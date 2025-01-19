<link rel="stylesheet" href="/css/author.css">

<div class="container">

    <div class="author-info">
        <a href="/authors" class="authors-link">
            <img src="/assets/icons/arrow-left-icon.svg" alt="Вернуться к авторам" class="authors-link-icon">
            Авторы
        </a>
        <h2>Об авторе</h2>
        <p style="font-size: 20px;"><?php echo htmlspecialchars($author['description']) ?></p>
        <h2>Список произведений</h2>
        <ul style="font-size: 20px;">
            <?php foreach ($artworks as $artwork): ?>
                <li><a href="/gallery/<?php echo htmlspecialchars($artwork['id']) ?>"><?php echo htmlspecialchars($artwork['title']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="portrait">
        <img src="<?php echo htmlspecialchars($author['img']); ?>" alt="Портрет автора" style="width: 100%; border-radius: 8px;">
        <ul style="font-size: 18px;">
            <li>Имя: <?php echo htmlspecialchars($author['name']) ?></li>
            <li>Годы жизни: <?php echo htmlspecialchars($author['yearsOfLife']) ?></li>
            <li>Образование: <?php echo htmlspecialchars($author['education']) ?></li>
        </ul>
    </div>

</div>