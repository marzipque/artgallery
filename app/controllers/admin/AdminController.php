<?php

namespace App\Controllers\Admin;

use App\Base\ControllerBase;
use App\Models\Artwork;
use App\Models\Author;

/**
 * Контроллер для управления административной панелью
 * 
 * Этот класс отвечает за обработку запросов, связанных с административными функциями,
 */
class AdminController extends ControllerBase
{
    private $artworkModel;
    private $authorModel;
    private $layout;

    public function __construct()
    {
        parent::__construct();
        $this->artworkModel = new Artwork();
        $this->authorModel = new Author();
        $this->layout = 'admin/layout';
    }

    /**
     * Отображает главную страницу административной панели
     */
    public function index(): void
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /auth');
            exit;
        }

        $authorsCount = count($this->authorModel->getAllAuthors());
        $lastModifiedTimeOfAuthors = $this->authorModel->getLastModifiedTime();

        $artworksCount = count($this->artworkModel->getAllArtworks());
        $lastModifiedTimeOfArtworks = $this->artworkModel->getLastModifiedTime();

        $this->render('admin/main', $this->layout, data: [
            'authorsCount' => $authorsCount,
            'artworksCount' => $artworksCount,
            'modifiedTimeOfAuthors' => $lastModifiedTimeOfAuthors,
            'modifiedTimeOfArtworks' => $lastModifiedTimeOfArtworks
        ]);
    }
}
