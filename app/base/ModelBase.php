<?php

namespace App\Base;

use PDO;
use PDOStatement;

/**
 * Базовый класс модели
 * 
 * Этот класс предоставляет основные методы для взаимодействия с базой данных,
 * включая выполнение произвольных SQL-запросов и операции CRUD (создание, чтение, обновление, удаление).
 */
class ModelBase
{
    protected $db;

    public function __construct()
    {
        $this->db = $GLOBALS['dbConnection'];
    }

    /**
     * Выполняет произвольный SQL-запрос
     * 
     * @param string $query SQL-запрос
     * @param array $params Параметры для запроса
     * 
     * @return PDOStatement Возвращает объект PDOStatement после выполнения запроса
     */
    protected function execute($query, $params = []): PDOStatement
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Получает все записи, соответствующие заданному запросу
     * 
     * @param string $query SQL-запрос
     * @param array $params Параметры для запроса
     * 
     * @return array Возвращает массив ассоциативных массивов с результатами запроса
     */
    protected function fetchAll($query, $params = []): array
    {
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получает одну запись, соответствующую заданному запросу
     * 
     * @param string $query SQL-запрос
     * @param array $params Параметры для запроса
     * 
     * @return array|null Возвращает ассоциативный массив с результатами запроса или null, если запись не найдена
     */
    protected function fetch($query, $params = []): array|null
    {
        $stmt = $this->execute($query, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Выполняет вставку записи в базу данных
     * 
     * @param string $query SQL-запрос для вставки
     * @param array $params Параметры для запроса
     * 
     * @return string Возвращает ID последней вставленной записи
     */
    protected function insert($query, $params = []): string
    {
        $this->execute($query, $params);
        return $this->db->lastInsertId();
    }

    /**
     * Обновляет существующую запись в базе данных
     * 
     * @param string $query SQL-запрос для обновления
     * @param array $params Параметры для запроса
     */
    protected function update($query, $params = []): void
    {
        $this->execute($query, $params);
    }

    /**
     * Удаляет запись из базы данных
     * 
     * @param string $query SQL-запрос для удаления
     * @param array $params Параметры для запроса
     */
    protected function delete($query, $params = []): void
    {
        $this->execute($query, $params);
    }
}