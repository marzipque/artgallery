<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Класс для подключения к базе данных (реализован через Singleton)
 * 
 * Этот класс обеспечивает единый доступ к соединению с базой данных,
 * используя паттерн Singleton для предотвращения создания нескольких экземпляров.
 */
class DBConnector
{
    private static $instance = null;
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $connection;              

    /**
     * Конструктор класса
     * 
     * @param string $host Хост базы данных
     * @param string $db_name Имя базы данных
     * @param string $username Имя пользователя для подключения
     * @param string $password Пароль для подключения
     */
    private function __construct($host, $db_name, $username, $password)
    {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }

    /**
     * Получает экземпляр класса
     * 
     * @param string $host Хост базы данных
     * @param string $db_name Имя базы данных
     * @param string $username Имя пользователя для подключения
     * @param string $password Пароль для подключения
     * 
     * @return DBConnector Возвращает единственный экземпляр класса DBConnector
     */
    public static function getInstance($host, $db_name, $username, $password): DBConnector
    {
        if (self::$instance == null) {
            self::$instance = new DBConnector($host, $db_name, $username, $password);
        }
        return self::$instance;
    }

    /**
     * Устанавливает соединение с базой данных
     * 
     * @throws PDOException Если не удалось установить соединение
     */
    private function connect(): void
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Соединение успешно установлено!";
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
    }

    /**
     * Получает объект соединения
     * 
     * @return PDO Возвращает объект соединения с базой данных
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
