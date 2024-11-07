<?php

namespace App\Controllers;

use App\Base\ControllerBase;
use App\Models\Artwork;
use App\Models\Author;

/**
 * Контроллер для управления главной страницей приложения
 * 
 * Этот класс отвечает за обработку запросов, связанных с отображением главной страницы,
 * включая получение популярных произведений искусства для отображения.
 */
class MainController extends ControllerBase
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
     * Отображает главную страницу приложения
     */
    public function index(): void
    {
        $artworks = $this->artworkModel->getRandomArtworks(5);

        foreach ($artworks as &$artwork) {
            $artwork['author'] = $this->authorModel->getAuthorById($artwork['authorId']);
        }
        unset($artwork);

        $this->render('main', data: ['artworks' => $artworks]);
    }
}
