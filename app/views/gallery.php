<section class="banner-section" style="background-image: url('/assets/banners/banner-gallery.jpg')">

    <div class="banner-content">
        <h1 style="font-size: 100px;">ГАЛЕРЕЯ</h1>
        <p style="font-size: 30px;">КАЖДОЕ ПРОИЗВЕДЕНИЕ — ЭТО ИСТОРИЯ, ЖДУЩАЯ СВОЕГО ЗРИТЕЛЯ...</p>
    </div>

</section>

<section class="content-section">

    <form action="/gallery" method="GET" class="filters-panel">
        <div class="filters-search">
            <input type="text" name="search" class="filters-search-input" placeholder="Поиск...">
            <button type="submit" class="filters-search-button">Найти</button>
        </div>
        <div class="filters-parameters-dropdowns">
            <div class="filter-item">
                <select name="category" class="app-select">
                    <option value="">Любой</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category']) ?>"><?= htmlspecialchars($category['category']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-item">
                <select name="genre" class="app-select">
                    <option value="">Любой</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= htmlspecialchars($genre['genre']) ?>"><?= htmlspecialchars($genre['genre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-item">
                <select name="author" class="app-select">
                    <option value="">Любой</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= htmlspecialchars($author['name']) ?>"><?= htmlspecialchars($author['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </form>

    <div class="cards-collection">
        <?php foreach ($artworks as $artwork): ?>
            <div class="card-item">
                <a href="/artwork/<?php echo $artwork['id']; ?>">
                    <img src="<?php echo htmlspecialchars($artwork['img']); ?>" alt="<?php echo $artwork['title']; ?>" class="card-item-image">
                    <h2 class="card-item-title"><?php echo htmlspecialchars($artwork['title']); ?></h2>
                    <hr class="card-item-splitter">
                    <p class="card-item-author"><?php echo htmlspecialchars($artwork['author']['name']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</section>