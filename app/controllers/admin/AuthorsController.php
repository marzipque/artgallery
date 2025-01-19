<?php

namespace App\Controllers\Admin;

use App\Base\ControllerBase;
use App\Models\Artwork;
use App\Models\Author;

/**
 * Контроллер для управления списком авторов
 * 
 * Этот класс отвечает за обработку запросов, связанных с отображением списка авторов,
 * включая получение всех авторов из базы данных и отображение их на странице.
 */
class AuthorsController extends ControllerBase
{
    private $authorModel;
    private $layout;

    public function __construct()
    {
        parent::__construct();
        $this->authorModel = new Author();
        $this->layout = 'admin/layout';
    }

    /**
     * Отображает список всех авторов
     */
    public function index(): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        $authors = $this->authorModel->getAllAuthors();

        $this->render('admin/authors', $this->layout, data: ['authors' => $authors]);
    }

    /**
     * Обрабатывает добавление нового автора
     */
    public function add(): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $education = $_POST['education'] ?? '';
            $yearsOfLife = $_POST['yearsOfLife'] ?? '';
            $description = $_POST['description'] ?? '';
            $img = $this->loadImage();

            $data = [
                ':name' => $name,
                ':img' => $img,
                ':education' => $education,
                ':yearsOfLife' => $yearsOfLife,
                ':description' => $description
            ];

            $this->authorModel->createAuthor($data);

            header('Location: /admin/authors');
            exit;
        }

        $this->render('admin/author_add', $this->layout);
    }

    /**
     * Обрабатывает изменение существующего автора
     * 
     * @param int $id Номер автора
     */
    public function edit($id): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $education = $_POST['education'];
            $yearsOfLife = $_POST['yearsOfLife'];
            $description = $_POST['description'];

            $data = [
                ':name' => $name,
                ':education' => $education,
                ':yearsOfLife' => $yearsOfLife,
                ':description' => $description
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $img = $this->loadImage();
                $data[':img'] = $img;
            }

            $this->authorModel->updateAuthor($id, $data);

            header("Location: /admin/authors");
            exit;
        }

        $artworks = $this->authorModel->getAllArtworksByAuthor($id);
        $author = $this->authorModel->getAuthorById($id);

        $this->render('admin/author_edit', $this->layout, data: [
            'author' => $author,
            'artworks' => $artworks
        ]);
    }

    /**
     * Обрабатывает удаление существующего автора
     * 
     * @param int $id Номер автора
     */
    public function delete($id): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        $this->authorModel->deleteAuthor($id);

        header('Location: /admin/authors');
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
                header('Location: /admin/authors');
                exit;
            }
        } else {
            $_SESSION['error'] = 'Ошибка загрузки изображения. Пожалуйста, попробуйте снова.';
            header('Location: /admin/authors');
            exit;
        }

        return $img;
    }
}
