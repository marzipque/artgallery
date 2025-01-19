<link rel="stylesheet" href="/css/admin/author.css">

<div class="container">

    <form id="form1" action="/admin/authors/add" method="POST" enctype="multipart/form-data" style="display: flex">
        <div class="author-info">
            <h2>Об авторе</h2>
            <p style="font-size: 20px;"><textarea rows="25" id="description" name="description" style="flex: 1; width: 100%; font-family: Montserrat"></textarea></p>
            <h2>Список произведений</h2>
            <p>Список отобразятся автоматически, когда вы добавите произведения этого автора.</p>
        </div>

        <div class="portrait">
            <div class="image-container">
                <img src="/assets/icons/author-icon.svg" alt="Портрет автора" style="width: 100%; border-radius: 8px;">
                <div class="overlay">Загрузить новое изображение</div>
                <input type="file" id="imageUpload" name="image" style="display: none;">
            </div>
            <ul style="font-size: 18px;">
                <ul style="list-style-type: none; padding: 0;">
                    <li>
                        <label>Имя:</label>
                        <input type="text" id="name" name="name" style="font-family: Montserrat">
                    </li>
                    <li>
                        <label>Годы жизни:</label>
                        <input type="text" id="yearsOfLife" name="yearsOfLife" style="font-family: Montserrat">
                    </li>
                    <li>
                        <label>Образование:</label>
                        <input type="text" id="education" name="education" style="font-family: Montserrat">
                    </li>
                </ul>
            </ul>
        </div>
    </form>

</div>

<div class="controller">
    <div class="right">
        <input form="form1" type="submit" class="btn apply" value="Добавить" style="width: 100px;">
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
</script>