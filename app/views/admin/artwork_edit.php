<form id="form1" action="/admin/gallery/edit/<?php echo htmlspecialchars($artwork['id']); ?>" method="POST" enctype="multipart/form-data">
    <section id="artwork-section" style="position: relative;">
        <div class="image-container">
            <img src="<?php echo htmlspecialchars($artwork['img']); ?>" alt="Картина" class="artwork" id="artwork">
            <div class="overlay">Загрузить новое изображение</div>
            <input type="file" id="imageUpload" name="image" style="display: none;">
        </div>
    </section>

    <section id="description-section">
        <div class="description-container">
            <div class="description" style="margin-right: 30px;">
                <h2>Краткое описание</h2>
                <textarea rows="10" name="description" style="width: 100%; font-size: 18px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; "><?php echo htmlspecialchars($artwork['description']) ?></textarea>
            </div>
            <div class="splitter"></div>
            <div class="description">
                <h2>Характеристики</h2>
                <ul class="characteristics-list">
                    <li>
                        <label for="title">Название картины:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($artwork['title']) ?>">
                    </li>
                    <li>
                        <label for="author">Ноемер автора:</label>
                        <input type="text" id="authorId" name="authorId" value="<?php echo htmlspecialchars($artwork['authorId']) ?>">
                    </li>
                    <li>
                        <label for="genre">Жанр:</label>
                        <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($artwork['genre']) ?>">
                    </li>
                    <li>
                        <label for="category">Категория:</label>
                        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($artwork['category']) ?>">
                    </li>
                    <li>
                        <label for="technique">Техника исполнения:</label>
                        <input type="text" id="technique" name="technique" value="<?php echo htmlspecialchars($artwork['technique']) ?>">
                    </li>
                    <li>
                        <label for="yearOfCreation">Год создания:</label>
                        <input type="text" id="yearOfCreation" name="yearOfCreation" value="<?php echo htmlspecialchars($artwork['yearOfCreation']) ?>">
                    </li>
                    <li>
                        <label for="material">Материал:</label>
                        <input type="text" id="material" name="material" value="<?php echo htmlspecialchars($artwork['material']) ?>">
                    </li>
                    <li>
                        <label for="size">Размер:</label>
                        <input type="text" id="size" name="size" value="<?php echo htmlspecialchars($artwork['size']) ?>">
                    </li>
                </ul>
            </div>
        </div>
    </section>
</form>


<div class="controller">
    <div class="right">
        <input form="form1" type="submit" class="btn apply" value="Применить" style="width: 100px; margin-right: 10px">
        <input type="button" class="btn delete" value="Удалить" onclick="confirmDelete(<?php echo htmlspecialchars($artwork['id']); ?>)" style="width: 100px;">
    </div>
</div>

<style>
    section {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 20px;
        margin: 20px;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        position: relative;
    }

    .artwork {
        max-width: 50%;
        max-height: 50%;
        margin-right: 20px;
        position: relative;
        cursor: none;
    }

    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 100%;
        height: 100%;
    }

    .image-container img {
        transition: opacity 0.3s ease;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(128, 128, 128, 0.5);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-container:hover img {
        opacity: 0.5;
    }

    .image-container:hover .overlay {
        opacity: 1;
    }

    .description-container {
        display: flex;
        width: 100%;
    }

    .description {
        flex: 1;
        padding: 10px;
    }

    .splitter {
        width: 2px;
        background-color: #ccc;
        margin: 0 10px;
    }

    h2 {
        margin-bottom: 10px;
    }

    .characteristics-list {
        list-style-type: none;
        padding: 0;
        font-size: 18px;
    }

    .characteristics-list li {
        margin: 5px 0;
        display: flex;
        align-items: center;
    }

    .characteristics-list label {
        flex: 0 0 200px;
        margin-right: 10px;
    }

    .characteristics-list input {
        flex: 1;
        padding: 5px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

    .controller {
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        margin-left: 15px;
        margin-right: 15px;
        padding: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .btn {
        display: block;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .delete {
        background-color: red;
        color: white;
    }

    .apply {
        background-color: #007bff;
        color: white;
    }

    .right {
        display: flex;
        align-items: center;
    }
</style>

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

    function confirmDelete(artworkId) {
        const confirmation = confirm("Вы уверены, что хотите удалить это произведение?");
        if (confirmation) {
            window.location.href = `/admin/gallery/delete/${artworkId}`;
        }
    }
</script>