<?php

namespace App\Controllers\Admin;

use App\Base\ControllerBase;
use App\Models\Admin;
use PDOException;

/**
 * Контроллер для обработки аутентификации администраторов
 * 
 * Этот класс отвечает за управление процессами аутентификации администраторов,
 * включая вход в систему через стандартные учетные данные и через VK ID,
 * а также выход из системы.
 */
class AuthController extends ControllerBase
{
    private $adminModel;
    private $layout;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = new Admin();
        $this->layout = '';
    }

    /**
     * Отображает страницу аутентификации администратора
     */
    public function index(): void
    {
        $this->render('admin\auth', '');
    }

    /**
     * Обрабатывает процесс аутентификации администратора
     */
    public function auth(): void
    {
        $login = $_POST['username'];
        $password = $_POST['password'];

        try {
            $admin = $this->adminModel->authenticate($login, $password);
        } catch (PDOException) {
            $error = 'Неверный логин или пароль.';
            $this->render('admin/auth', $this->layout, ['error' => $error]);
            exit;
        }

        if ($admin) {
            $_SESSION['admin'] = $admin;
            header('Location: /admin');
            exit;
        } else {
            $error = 'Неверный логин или пароль.';
            $this->render('admin/auth', $this->layout, ['error' => $error]);
        }
    }

    /**
     * Обрабатывает авторизацию через VK ID
     */
    public function vkAuth(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['user_id']) || !isset($data['access_token'])) {
            echo json_encode(['success' => false, 'message' => 'Недостаточно данных для авторизации.']);
            return;
        }

        $userId = $data['user_id'];
        $accessToken = $data['access_token'];

        $admin = $this->adminModel->vkAuthenticate($userId);

        if ($admin) {
            $_SESSION['admin'] = $admin;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Доступ запрещен.']);
        }
    }

    /**
     * Обрабатывает выход администратора из системы
     */
    public function logout(): void
    {
        session_destroy();
        header('Location: /');
    }
}
