<?php

namespace App\Models;

use App\Base\ModelBase;

/**
 * Класс Artwork
 * 
 * Этот класс представляет модель для работы с произведениями искусства в базе данных.
 * Он предоставляет методы для получения, создания, обновления и удаления записей о произведениях искусства.
 */
class Artwork extends ModelBase
{
    /**
     * Получает все произведения искусства
     * 
     * @return array Массив всех записей о произведениях искусства
     */
    public function getAllArtworks(): array
    {
        $artworks = $this->fetchAll("SELECT * FROM artworks");

        foreach ($artworks as &$artwork) {
            $artwork['img'] = 'data:image/jpeg;base64,' . base64_encode($artwork['img']);
        }
        unset($artwork);

        return $artworks;
    }

    /**
     * Получает произведение искусства по его ID
     * 
     * @param int $id ID произведения искусства
     * 
     * @return mixed Запись о произведении искусства или null, если не найдено
     */
    public function getArtworkById($id): mixed
    {
        $artwork = $this->fetch("SELECT * FROM artworks WHERE id = :id", [':id' => $id]);
        $artwork['img'] = 'data:image/jpeg;base64,' . base64_encode($artwork['img']);

        return $artwork;
    }

    /**
     * Добавляет новое произведение искусства
     * 
     * @param array $data Данные о произведении искусства, включая изображение, заголовок, автора и т.д.
     * 
     * @return bool Успех операции вставки
     */
    public function createArtwork($data): bool
    {
        $query = "INSERT INTO artworks (img, title, authorId, category, genre, material, size, technique, description) VALUES (:img, :title, :authorId, :category, :genre, :material, :size, :technique, :description)";
        return $this->insert($query, $data);
    }

    /**
     * Обновляет запись о произведении искусства в базе данных
     *  
     * @param int $id ID произведения искусства, которое необходимо обновить
     * @param array $data Данные для обновления произведения искусства
     */
    public function updateArtwork($id, $data): void
    {
        $data[':id'] = $id;
        $query = "UPDATE artworks SET img = :img, title = :title, authorId = :authorId, category = :category, genre = :genre, material = :material, size = :size, technique = :technique, description = :description WHERE id = :id";
        $this->update($query, $data);
    }

    /**
     * Удаляет запись о произведении искусства из базы данных
     * 
     * @param int $id ID произведения искусства, которое необходимо удалить
     */
    public function deleteArtwork($id): void
    {
        $this->delete("DELETE FROM artworks WHERE id = :id", [':id' => $id]); // Выполняет запрос для удаления произведения искусства по ID
    }

    /**
     * Получает массив случайных произведений исскуств
     * 
     * @param int $artworksCount Количество возвращаемых произведений искусства
     * 
     * @return array Произведения исскуства
     */
    public function getRandomArtworks($artworksCount): array
    {
        $artworks = $this->getAllArtworks();
        shuffle($artworks);

        return array_slice($artworks, 0, $artworksCount);
    }

    /**
     * Получает массив уникальных категорий произведений искусства
     * 
     * @return array Уникальные категории
     */
    public function getUniqueCategories(): array
    {
        return $this->fetchAll("SELECT DISTINCT category FROM artworks");
    }

    /**
     * Получает массив уникальных жанров произведений искусства
     * 
     * @return array Уникальные жанров
     */
    public function getUniqueGenres(): array
    {
        return $this->fetchAll("SELECT DISTINCT genre FROM artworks");
    }
}
