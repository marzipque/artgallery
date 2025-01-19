<?php

namespace App\Controllers\Admin;

use App\Base\ControllerBase;
use App\Models\Artwork;

/**
 * Контроллер для управления галереей произведений искусства
 * 
 * Этот класс отвечает за обработку запросов, связанных с отображением списка произведений искусства
 * в административной панели
 */
class GalleryController extends ControllerBase
{
    private $artworkModel;
    private $layout;

    public function __construct()
    {
        parent::__construct();
        $this->artworkModel = new Artwork();
        $this->layout = 'admin/layout';
    }

    /**
     * Отображает список всех произведений искусства в галерее
     */
    public function index(): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        $artworks = $this->artworkModel->getAllArtworks();

        $this->render('admin/gallery', $this->layout, data: ['artworks' => $artworks]);
    }

    /**
     * Обрабатывает добавление произвдения искусства
     */
    public function add(): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $authorId = (int)$_POST['authorId'] ?? '';
            $genre = $_POST['genre'] ?? '';
            $category = $_POST['category'] ?? '';
            $technique = $_POST['technique'] ?? '';
            $yearOfCreation = $_POST['yearOfCreation'] ?? '';
            $material = $_POST['material'] ?? '';
            $size = $_POST['size'] ?? '';
            $description = $_POST['description'] ?? '';
            $img = $this->loadImage();

            $data = [
                ':title' => $title,
                ':img' => $img,
                ':authorId' => $authorId,
                ':genre' => $genre,
                ':category' => $category,
                ':technique' => $technique,
                ':yearOfCreation' => $yearOfCreation,
                ':material' => $material,
                ':size' => $size,
                ':description' => $description
            ];

            $this->artworkModel->createArtwork($data);

            header('Location: /admin/gallery');
            exit;
        }

        $this->render('admin/artwork_add', $this->layout);
    }

    /**
     * Обрабатывает изменение существующего произведения искусства
     * 
     * @param int $id Номер произведения
     */
    public function edit($id): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $authorId = $_POST['authorId'] ?? '';
            $genre = $_POST['genre'] ?? '';
            $category = $_POST['category'] ?? '';
            $technique = $_POST['technique'] ?? '';
            $yearOfCreation = $_POST['yearOfCreation'] ?? '';
            $material = $_POST['material'] ?? '';
            $size = $_POST['size'] ?? '';
            $description = $_POST['description'] ?? '';

            $data = [
                ':title' => $title,
                ':authorId' => $authorId,
                ':genre' => $genre,
                ':category' => $category,
                ':technique' => $technique,
                ':yearOfCreation' => $yearOfCreation,
                ':material' => $material,
                ':size' => $size,
                ':description' => $description
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $img = $this->loadImage();
                $data[':img'] = $img;
            }

            $this->artworkModel->updateArtwork($id, $data);

            header("Location: /admin/gallery");
            exit;
        }

        $artworks = $this->artworkModel->getArtworkById($id);

        $this->render('admin/artwork_edit', $this->layout, data: [
            'artwork' => $artworks
        ]);
    }

    /**
     * Обрабатывает удаление существующего произвдеения искусства
     * 
     * @param int $id Номер произведения
     */
    public function delete($id): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        $this->artworkModel->deleteArtwork($id);

        header('Location: /admin/gallery');
    }

    /**
     * Загружет новое изображение автора
     * 
     * @return string|null Строка изображения
     */
    private function loadImage(): string|null
    {
        $img = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileType = $_FILES['image']['type'];

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($fileType, $allowedTypes)) {
                $img = file_get_contents($fileTmpPath);
            } else {
                $_SESSION['error'] = 'Неподдерживаемый тип файла. Пожалуйста, загрузите изображение в формате JPEG, PNG или GIF.';
                header('Location: /admin/gallery');
                exit;
            }
        } else {
            $_SESSION['error'] = 'Ошибка загрузки изображения. Пожалуйста, попробуйте снова.';
            header('Location: /admin/gallery');
            exit;
        }

        return $img;
    }
}
