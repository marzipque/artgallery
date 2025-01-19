<link rel="stylesheet" href="/css/admin/author.css">

<div class="container">

    <form id="form1" action="/admin/authors/edit/<?php echo htmlspecialchars($author['id']); ?>" method="POST" enctype="multipart/form-data" style="display: flex">
        <div class="author-info">
            <h2>Об авторе</h2>
            <p style="font-size: 20px;"><textarea rows="25" id="description" name="description" style="flex: 1; width: 100%; font-family: Montserrat"><?php echo htmlspecialchars($author['description']) ?></textarea></p>
            <h2>Список произведений</h2>
            <?php if (empty($authors)): ?>
                <?php foreach ($artworks as $artwork): ?>
                    <li><a href="/admin/gallery/edit/<?php echo htmlspecialchars($artwork['id']) ?>"><?php echo htmlspecialchars($artwork['title']) ?></a></li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Вы ещё не добавляли произвдения этого автора.</p>
            <?php endif; ?>
        </div>

        <div class="portrait">
            <div class="image-container">
                <img src="<?php echo htmlspecialchars($author['img']); ?>" alt="Портрет автора" style="width: 100%; border-radius: 8px;">
                <div class="overlay">Загрузить новое изображение</div>
                <input type="file" id="imageUpload" name="image" style="display: none;">
            </div>
            <ul style="font-size: 18px;">
                <ul style="list-style-type: none; padding: 0;">
                    <li>
                        <label>Имя:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($author['name']) ?>" style="font-family: Montserrat">
                    </li>
                    <li>
                        <label>Годы жизни:</label>
                        <input type="text" id="yearsOfLife" name="yearsOfLife" value="<?php echo htmlspecialchars($author['yearsOfLife']) ?>" style="font-family: Montserrat">
                    </li>
                    <li>
                        <label>Образование:</label>
                        <input type="text" id="education" name="education" value="<?php echo htmlspecialchars($author['education']) ?>" style="font-family: Montserrat">
                    </li>
                </ul>
            </ul>
        </div>
    </form>

</div>

<div class="controller">
    <div class="right">
        <input form="form1" type="submit" class="btn apply" value="Применить" style="width: 100px; margin-right: 10px">
        <input type="button" class="btn delete" value="Удалить" onclick="confirmDelete(<?php echo htmlspecialchars($author['id']); ?>)" style="width: 100px;">
    </div>
</div>

<script>
    document.querySelector('.image-container').addEventListener('click', function() {
        document.getElementById('imageUpload').click();
    });

    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.querySelector('.image-container img');
                img.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    function confirmDelete(authorId) {
        const confirmation = confirm("Вы уверены, что хотите удалить этого автора?");
        if (confirmation) {
            window.location.href = `/admin/authors/delete/${authorId}`;
        }
    }
</script>