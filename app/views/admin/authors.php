<link rel="stylesheet" href="/css/admin/authors.css">

<h1>Список авторов</h1>

<div>
    <button class="content-button" onclick="window.location.href='/admin/authors/add'">
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
            <th>Имя</th>
            <th>Портрет</th>
            <th>Годы жизни</th>
            <th>Образование</th>
            <th>Описание</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($authors as $author): ?>
            <tr onclick="window.location.href='/admin/authors/edit/<?= $author['id'] ?>'">
                <td><?= $author['id'] ?></td>
                <td><?= htmlspecialchars($author['name']) ?></td>
                <td><img src="<?= $author['img'] ?>" style="height: 100px; width: auto" alt="Портрет"></td>
                <td><?= htmlspecialchars($author['yearsOfLife']) ?></td>
                <td><?= htmlspecialchars($author['education']) ?></td>
                <td><?= htmlspecialchars($author['description']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>