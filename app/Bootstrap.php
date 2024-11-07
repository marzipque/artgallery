<?php

require_once 'config/config.php';

require_once 'base/ControllerBase.php';
require_once 'base/ModelBase.php';

require_once 'models/Artwork.php';
require_once 'models/Author.php';

require_once 'core/DBConnector.php';
require_once 'core/Router.php';

$db = App\Core\DBConnector::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$GLOBALS['dbConnection'] = $db->getConnection();

$router = new App\Core\Router();

$router->addRoute('GET', '', 'MainController', 'index');
$router->addRoute('GET', '/', 'MainController', 'index');
$router->addRoute('GET', '/gallery', 'GalleryController', 'index');
$router->addRoute('GET', '/authors', 'AuthorsController', 'index');
$router->addRoute('GET', '/author/{id}', 'AuthorController', 'index');
$router->addRoute('GET', '/artwork/{id}', 'ArtworkController', 'index');

$router->resolve();