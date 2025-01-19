<?php

namespace App\Controllers;

use App\Base\ControllerBase;
use App\Models\Artwork;
use App\Models\Author;

/**
 * Контроллер для управления галереей произведений искусства
 * 
 * Этот класс отвечает за обработку запросов, связанных с отображением галереи,
 * включая получение всех произведений искусства и их отображение на странице.
 */
class GalleryController extends ControllerBase
{
    private $artworkModel;
    private $authorModel;

    public function __construct()
    {
        parent::__construct();
        $this->artworkModel = new Artwork();
        $this->authorModel = new Author();
    }

    /**
     * Отображает список всех произведений искусства в галерее
     */
    public function index(): void
    {
        $artworks = $this->artworkModel->getAllArtworks();

        foreach ($artworks as &$artwork) {
            $artwork['author'] = $this->authorModel->getAuthorById($artwork['authorId']);
        }
        unset($artwork);

        $categories = $this->artworkModel->getUniqueCategories();
        $genres = $this->artworkModel->getUniqueGenres();
        $authors = $this->authorModel->getUniqueAuthors();

        $this->render('gallery', data: [
            'artworks' => $artworks,
            'categories' => $categories,
            'genres' => $genres,
            'authors' => $authors,
        ]);
    }

    /**
     * Отображает информацию о конкретном произведении искусства
     * 
     * @param int $id Идентификатор произведения искусства
     */
    public function show($id): void
    {
        $artwork = $this->artworkModel->getArtworkById($id);
        $author = $this->authorModel->getAuthorById($artwork['authorId']);

        $this->render('artwork', data: ['artwork' => $artwork, 'author' => $author]);
    }

    /**
     * Отображает все произведения искусства соотвествующие критериям поиска
     */
    public function search(): void
    {
        $searchQuery = $_POST['search'] ?? '';
        $category = $_POST['category'] ?? '';
        $genre = $_POST['genre'] ?? '';
        $author = $_POST['author'] ?? '';

        $artworks = $this->artworkModel->getAllArtworks();

        foreach ($artworks as &$artwork) {
            $artwork['author'] = $this->authorModel->getAuthorById($artwork['authorId']);
        }
        unset($artwork);

        $categories = $this->artworkModel->getUniqueCategories();
        $genres = $this->artworkModel->getUniqueGenres();
        $authors = $this->authorModel->getUniqueAuthors();

        $filteredArtworks = array_filter($artworks, function ($artwork) use ($searchQuery, $category, $genre, $author) {
            $matchesSearch = empty($searchQuery) || stripos($artwork['title'], $searchQuery) !== false;
            $matchesGenre = empty($genre) || $artwork['genre'] === $genre;
            $matchesAuthor = empty($author) || $artwork['author']['name'] === $author;
            $matchesCategory = empty($category) || $artwork['category'] === $category;

            return $matchesSearch && $matchesCategory && $matchesGenre && $matchesAuthor;
        });

        $this->render('gallery', data: [
            'artworks' => $filteredArtworks,
            'categories' => $categories,
            'genres' => $genres,
            'authors' => $authors,
        ]);
    }
}
