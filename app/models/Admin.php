<?php

namespace App\Models;

use App\Base\ModelBase;

/**
 * Класс Admin
 * 
 * Этот класс представляет модель для работы с учётными записями администраторов в базе данных.
 */
class Admin extends ModelBase
{
    /**
     * Проверяет, существует ли администратор с заданным логином и паролем
     * 
     * @param string $login Логин администратора
     * @param string $password Пароль администратора
     * 
     * @return array|null Возвращает данные администратора, если он найден, или null
     */
    public function authenticate($login, $password): array|null
    {
        $query = "SELECT * FROM admins WHERE login = :login";
        $admin = $this->fetch($query, ['login' => $login]);

        if ($admin && $password === $admin['password']) {
            return $admin;
        }

        return null;
    }

    /**
     * Проверяет, существует ли администратор с заданным идентификатором ВКонтакте
     * 
     * @param string $vkId Идентификатор ВКонтакте
     * 
     * @return array|null Возвращает данные администратора, если он найден, или null
     */
    public function vkAuthenticate($vkId): array|null
    {
        $query = "SELECT * FROM admins WHERE vkId = :vkId";
        return $this->fetch($query, ['vkId' => $vkId]);
    }
}
