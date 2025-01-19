<?php

namespace App\Controllers;

use App\Base\ControllerBase;
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

    public function __construct()
    {
        parent::__construct();
        $this->authorModel = new Author();
    }

    /**
     * Отображает список всех авторов
     */
    public function index(): void
    {
        $authors = $this->authorModel->getAllAuthors();

        $this->render('authors', data: ['authors' => $authors]);
    }

    /**
     * Отображает информацию о конкретном авторе и его произведениях
     * 
     * @param int $id Идентификатор автора
     */
    public function show($id): void
    {
        $author = $this->authorModel->getAuthorById($id);
        $artworks = $this->authorModel->getAllArtworksByAuthor($id);

        $this->render('author', data: ['author' => $author, 'artworks' => $artworks]);
    }

    /**
     * Отображает всех авторов соотвествующих критериям поиска
     */
    public function search(): void
    {
        $searchQuery = $_POST['search'] ?? '';

        $authors = $this->authorModel->getAllAuthors();

        $filteredAuthors = array_filter($authors, function ($author) use ($searchQuery) {
            $matchesSearch = empty($searchQuery) || stripos($author['name'], $searchQuery) !== false;

            return $matchesSearch;
        });

        $this->render('authors', data: ['authors' => $filteredAuthors]);
    }
}
