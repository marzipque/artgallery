<link rel="stylesheet" href="/css/admin/gallery.css">

<h1>Список произведений искусства</h1>

<div>
    <button class="content-button" onclick="window.location.href='/admin/gallery/add'">
        <img src="/assets/icons/add-icon.svg" alt="Добавить" style="height: 16px; width: 16px; vertical-align: middle; margin-right: 5px;">
    </button>
    <button class="content-button" onclick="window.location.reload()">
        <img src="/assets/icons/refresh-icon.svg" alt="Обновить" style="height: 16px; width: 16px; vertical-align: middle; margin-right: 5px;">
    </button>
</div>

<table>
    <thead>
        <tr>
            <th>Номер</th>
            <th>Название</th>
            <th>Изображение</th>
            <th>Автор</th>
            <th>Дата создания</th>
            <th>Категория</th>
            <th>Жанр</th>
            <th>Материал</th>
            <th>Техника</th>
            <th>Размер</th>
            <th>Описание</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($artworks as $artwork): ?>
            <tr onclick="window.location.href='/admin/gallery/edit/<?= $artwork['id'] ?>'">
                <td><?= $artwork['id'] ?></td>
                <td><?= htmlspecialchars($artwork['title']) ?></td>
                <td><img src="<?= $artwork['img'] ?>" style="height: 100px; width: auto" alt="Изображение"></td>
                <td><?= htmlspecialchars($artwork['authorId']) ?></td>
                <td><?= htmlspecialchars($artwork['yearOfCreation']) ?></td>
                <td><?= htmlspecialchars($artwork['category']) ?></td>
                <td><?= htmlspecialchars($artwork['genre']) ?></td>
                <td><?= htmlspecialchars($artwork['material']) ?></td>
                <td><?= htmlspecialchars($artwork['technique']) ?></td>
                <td><?= htmlspecialchars($artwork['size']) ?></td>
                <td><?= htmlspecialchars($artwork['description']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>