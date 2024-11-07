<?php

namespace App\Controllers;

use App\Base\ControllerBase;
use App\Models\Artwork;
use App\Models\Author;

/**
 * Контроллер для управления произведениями искусства
 * 
 * Этот класс отвечает за обработку запросов, связанных с произведениями искусства,
 * включая отображение информации о конкретной картине.
 */
class ArtworkController extends ControllerBase
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
     * Отображает информацию о конкретном произведении искусства
     * 
     * @param int $id Идентификатор произведения искусства
     */
    public function index($id): void
    {
        $artwork = $this->artworkModel->getArtworkById($id);
        $author = $this->authorModel->getAuthorById($artwork['authorId']);

        $this->render('artwork', data: ['artwork' => $artwork, 'author' => $author]);
    }
}
