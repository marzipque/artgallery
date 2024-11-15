<section class="banner-section" style="background-image: url('/assets/banners/banner-authors.jpg')">
    <div class="banner-content">
        <h1 style="font-size: 100px;">АВТОРЫ</h1>
        <p style="font-size: 30px;">ИССЛЕДУЙТЕ БИОГРАФИИ И ТВОРЧЕСТВО ВЫДАЮЩИХСЯ АВТОРОВ, КОТОРЫЕ ОСТАВЛИИ СЛЕД В ИСКУССТВЕ</p>
    </div>
</section>

<section class="content-section">
    <form action="/authors" method="GET" class="filters-panel">
        <div class="filters-search">
            <input type="text" name="search" class="filters-search-input" placeholder="Поиск..."
                value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button type="submit" class="filters-search-button" style="margin-left: 10px;">Найти</button>
        </div>
    </form>

    <?php if (empty($authors)): ?>
        <div class="card-collection-empty">
            <img src="/assets/icons/empty-list-icon.svg" alt="АВТОРЫ НЕ НАЙДЕНЫ" class="card-collection-empty-image">
            <p>К СОЖАЛЕНИЮ, НЕ УДАЛОСЬ НАЙТИ НИ ОДНОГО АВТОРА, СООТВЕТСВУЮЩЕГО ВАШЕМУ ЗАПРОСУ...</p>
        </div>
    <?php else: ?>
        <div class="card-collection">
            <?php foreach ($authors as $author): ?>
                <div class="card-item">
                    <a href="/author/<?php echo $author['id']; ?>">
                        <img src="<?php echo htmlspecialchars($author['img']); ?>" alt="<?php echo $author['name']; ?>" class="card-item-image">
                        <h2 class="card-item-title"><?php echo htmlspecialchars($author['name']); ?></h2>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>