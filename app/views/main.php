<section class="banner-section" style="background-image: url('/assets/banners/banner-main.jpg')">

    <div class="banner-content">
        <h1 style="font-size: 100px;">ART GALLERY</h1>
        <p style="font-size: 30px;">ИССЛЕДУЙТЕ МИР ИСКУССТВА ВМЕСТЕ С НАМИ</p>
    </div>

</section>

<section class="content-section">

    <h1 style="text-align: center;">ПОДБОРКА ДЛЯ ВАС</h1>
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