<?php

require_once 'config/config.php';

require_once 'base/ControllerBase.php';
require_once 'base/ModelBase.php';

require_once 'models/Artwork.php';
require_once 'models/Author.php';
require_once 'models/Admin.php';

require_once 'core/DBConnector.php';
require_once 'core/Router.php';

$db = App\Core\DBConnector::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$GLOBALS['dbConnection'] = $db->getConnection();

$router = new App\Core\Router();

$router->addRoute('GET', '', 'MainController', 'index');
$router->addRoute('GET', '/', 'MainController', 'index');
$router->addRoute('GET', '/gallery', 'GalleryController', 'index');
$router->addRoute('GET', '/gallery/{id}', 'GalleryController', 'show');
$router->addRoute('POST', '/gallery', 'GalleryController', 'search');
$router->addRoute('GET', '/authors', 'AuthorsController', 'index');
$router->addRoute('GET', '/authors/{id}', 'AuthorsController', 'show');
$router->addRoute('POST', '/authors', 'AuthorsController', 'search');

$router->addRoute('GET', '/auth', 'Admin\AuthController', 'index');
$router->addRoute('POST', '/auth', 'Admin\AuthController', 'auth');
$router->addRoute('POST', '/auth/vk', 'Admin\AuthController', 'vkAuth');

$router->addRoute('GET', '/admin', 'Admin\AdminController', 'index');
$router->addRoute('GET', '/admin/logout', 'Admin\AuthController', 'logout');
$router->addRoute('GET', '/admin/gallery', 'Admin\GalleryController', 'index');
$router->addRoute('GET', '/admin/gallery/add', 'Admin\GalleryController', 'add');
$router->addRoute('POST', '/admin/gallery/add', 'Admin\GalleryController', 'add');
$router->addRoute('GET', '/admin/gallery/edit/{id}', 'Admin\GalleryController', 'edit');
$router->addRoute('POST', '/admin/gallery/edit/{id}', 'Admin\GalleryController', 'edit');
$router->addRoute('GET', '/admin/gallery/delete/{id}', 'Admin\GalleryController', 'delete');
$router->addRoute('GET', '/admin/authors', 'Admin\AuthorsController', 'index');
$router->addRoute('GET', '/admin/authors/add', 'Admin\AuthorsController', 'add');
$router->addRoute('POST', '/admin/authors/add', 'Admin\AuthorsController', 'add');
$router->addRoute('GET', '/admin/authors/edit/{id}', 'Admin\AuthorsController', 'edit');
$router->addRoute('POST', '/admin/authors/edit/{id}', 'Admin\AuthorsController', 'edit');
$router->addRoute('GET', '/admin/authors/delete/{id}', 'Admin\AuthorsController', 'delete');

$router->resolve();
