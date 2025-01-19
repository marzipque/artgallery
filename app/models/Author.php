<?php

namespace App\Models;

use App\Base\ModelBase;

/**
 * Класс Author
 * 
 * Этот класс представляет модель для работы с авторами в базе данных.
 * Он предоставляет методы для получения, создания, обновления и удаления записей об авторах.
 */
class Author extends ModelBase
{
    /**
     * Получает всех авторов
     * 
     * @return array Массив всех записей об авторах
     */
    public function getAllAuthors(): array
    {
        $authors = $this->fetchAll("SELECT * FROM authors");

        foreach ($authors as &$author) {
            $author['img'] = 'data:image/jpeg;base64,' . base64_encode($author['img']);
        }
        unset($author);

        return $authors;
    }

    /**
     * Получает автора по его ID
     * 
     * @param int $id ID автора
     * 
     * @return mixed Запись об авторе или null, если не найдено
     */
    public function getAuthorById($id): mixed
    {
        $author = $this->fetch("SELECT * FROM authors WHERE id = :id", [':id' => $id]);
        if ($author) {
            $author['img'] = 'data:image/jpeg;base64,' . base64_encode($author['img']);
        }

        return $author;
    }

    /**
     * Добавляет нового автора
     * 
     * @param array $data Данные об авторе, включая имя, изображение, образование, годы жизни и описание
     * 
     * @return bool Успех операции вставки
     */
    public function createAuthor($data): bool
    {
        $query = "INSERT INTO authors (name, img, education, yearsOfLife, description) VALUES (:name, :img, :education, :yearsOfLife, :description)";
        return $this->insert($query, $data);
    }

    /**
     * Обновляет запись об авторе в базе данных
     * 
     * @param int $id ID автора, которого необходимо обновить
     * @param array $data Данные для обновления автора
     */
    public function updateAuthor($id, $data): void
    {
        $data[':id'] = $id;

        if (isset($data['img'])) {
            // Если есть изображение, обновляем с учетом поля img
            $query = "UPDATE authors SET name = :name, img = :img, education = :education, yearsOfLife = :yearsOfLife, description = :description WHERE id = :id";
        } else {
            // Если изображения нет, обновляем без поля img
            $query = "UPDATE authors SET name = :name, education = :education, yearsOfLife = :yearsOfLife, description = :description WHERE id = :id";
        }

        $this->update($query, $data);
    }

    /**
     * Удаляет запись об авторе из базы данных
     * 
     * @param int $id ID автора, которого необходимо удалить
     */
    public function deleteAuthor($id): void
    {
        $this->delete("DELETE FROM authors WHERE id = :id", [':id' => $id]);
    }

    /**
     * Получает массив всех произведений искусства конкретного автора
     * 
     * @param int $id ID автора
     * 
     * @return array Произведения искусства конкретного автора
     */
    public function getAllArtworksByAuthor($id): array
    {
        $query = "SELECT * FROM artworks WHERE authorId = :authorId";

        return $this->fetchAll($query, [':authorId' => $id]);
    }

    /**
     * Получает массив уникальных авторов
     * 
     * @return array Уникальные авторы
     */
    public function getUniqueAuthors(): array
    {
        return $this->fetchAll("SELECT DISTINCT name FROM authors");
    }

    /**
     * Получает дату и время последнего изменения таблицы authors
     * 
     * @return string|null Возвращает дату и время последнего изменения или null, если не найдено
     */
    public function getLastModifiedTime(): ?string
    {
        $query = "
            SELECT UPDATE_TIME
            FROM information_schema.tables
            WHERE TABLE_SCHEMA = :schema AND TABLE_NAME = :table
        ";

        $params = [
            'schema' => 'artgallery',
            'table' => 'authors'
        ];

        $result = $this->fetch($query, $params);
        return $result ? $result['UPDATE_TIME'] : null;
    }
}
