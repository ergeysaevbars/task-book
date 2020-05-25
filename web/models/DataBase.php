<?php

/**
 * Класс для работы с БД
 * @author Tanat
 */
final class DataBase {

    private $_db;
    private $_connectStr;
    private static $_instance;

    private function __construct() {
        $this->getParams();
        $this->_connectStr = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $this->_db = new PDO($this->_connectStr, DB_USER, DB_PASS);
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $this->_db->exec("set names utf8");
    }

    private function getParams()
    {
        return require_once ROOT."/web/config/db_params.php";
    }

    /**
     * Получение экземпляра класса
     * @return DataBase - экземпляр класса DataBase
     */
    public static function getInstace() {
        if (self::$_instance == NULL) {
            self::$_instance = new DataBase();
        }

        return self::$_instance;
    }

    private function __clone() {

    }

    /**
     * Функция выборки данных
     * @param string $query - Подготовленный запрос
     * @param string $params - параметры
     * @return array - Возвращает результат в виде ассоциированного массива
     */
    public function select($query, $params = NULL) {
        $stmt = $this->_db->prepare($query);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    /**
     * Функция добавления новой записи
     * @param streing $query - запрос
     * @param array $params - параметры
     * @return boolean
     */
    public function insert($query, $params = NULL) {
        $stmt = $this->_db->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * Функция обновления записи
     * @param streing $query - запрос
     * @param array $params - параметры
     * @return boolean
     */
    public function update($query, $params = NULL) {
        $stmt = $this->_db->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * Функция удаления записи
     * @param streing $query - запрос
     * @param array $params - параметры
     * @return boolean
     */
    public function delete($query, $params = NULL) {
        $stmt = $this->_db->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * Функция возвращает id добавленной записи
     * @return int
     */
    public function lastInsertId() {
        return $this->_db->lastInsertId();
    }

    /**
     * Начало транзакции
     */
    public function beginTransaction() {
        $this->_db->beginTransaction();
    }

    /**
     * Фиксация транзакции
     */
    public function commitTransaction() {
        $this->_db->commit();
    }

    /**
     * Откат транзакции
     */
    public function rollBackTransaction() {
        $this->_db->rollBack();
    }

}
