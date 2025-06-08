<?php

class DatabaseConnectionException extends Exception {
    public function __construct($message = "Ошибка подключения к базе данных", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

function connectToDatabase($dsn, $user, $password) {
    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Подключение успешно<br>";
        return $pdo;
    } catch (PDOException $e) {
        throw new DatabaseConnectionException("Ошибка подключения: " . $e->getMessage());
    }
}

try {
    // Неверные данные для симуляции ошибки
    $dsn = "mysql:host=localhost;dbname=nonexistent_db;charset=utf8mb4";
    $user = "wrong_user";
    $password = "wrong_pass";

    $db = connectToDatabase($dsn, $user, $password);
} catch (DatabaseConnectionException $e) {
    echo "Исключение: " . $e->getMessage() . "<br>";
    echo "Файл: " . $e->getFile() . "<br>";
    echo "Строка: " . $e->getLine() . "<br>";
} finally {
    echo "Попытка подключения завершена.<br>";
}
