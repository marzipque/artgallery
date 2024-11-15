<link rel="stylesheet" href="/css/artwork.css">

<section id="artwork-section" style="position: relative;">
    <a href="/gallery" class="gallery-link">
        <img src="/assets/icons/arrow-left-icon.svg" alt="Вернуться в галерею" class="gallery-icon">
        Галерея
    </a>

    <img src="<?php echo htmlspecialchars($artwork['img']); ?>" alt="Картина" class="artwork" id="artwork">
    <div class="zoom" id="zoom"></div>
</section>

<section id="description-section">
    <div class="description-container">
        <div class="description">
            <h2>Краткое описание</h2>
            <p style="font-size: 18px;"><?php echo htmlspecialchars($artwork['description']) ?></p>
        </div>
        <div class="splitter"></div>
        <div class="description">
            <h2>Характеристики</h2>
            <ul class="characteristics-list">
                <li>Название картины: <?php echo htmlspecialchars($artwork['title']) ?></li>
                <li>Автор: <a href="/author/<?php echo htmlspecialchars($author['id']) ?>"> <?php echo htmlspecialchars($author['name']) ?> </a></li>
                <li>Жанр: <?php echo htmlspecialchars($artwork['genre']) ?></li>
                <li>Категория: <?php echo htmlspecialchars($artwork['category']) ?></li>
                <li>Техника исполнения: <?php echo htmlspecialchars($artwork['technique']) ?></li>
                <li>Год создания: <?php echo htmlspecialchars($artwork['yearOfCreation']) ?></li>
                <li>Материал: <?php echo htmlspecialchars($artwork['material']) ?></li>
                <li>Размер: <?php echo htmlspecialchars($artwork['size'] . ' см.') ?></li>
            </ul>
        </div>
    </div>
</section>

<script src="/js/zoom.js"></script>