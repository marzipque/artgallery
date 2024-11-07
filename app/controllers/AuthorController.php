<?php

namespace App\Controllers;

use App\Base\ControllerBase;
use App\Models\Author;

/**
 * Контроллер для управления авторами
 * 
 * Этот класс отвечает за обработку запросов, связанных с авторами произведений искусства,
 * включая отображение информации о конкретном авторе и его произведениях.
 */
class AuthorController extends ControllerBase
{
    private $authorModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->authorModel = new Author();
    }

    /**
     * Отображает информацию о конкретном авторе и его произведениях
     * 
     * @param int $id Идентификатор автора
     */
    public function index($id): void
    {
        $author = $this->authorModel->getAuthorById($id);
        $artworks = $this->authorModel->getAllArtworksByAuthor($id);

        $this->render('author', data: ['author' => $author, 'artworks' => $artworks]);
    }
}
