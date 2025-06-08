<?php

// Базовое исключение валидации
class ValidationException extends Exception {}

// Отдельные исключения
class EmptyFieldException extends ValidationException {
    public function __construct($field) {
        parent::__construct("Поле '$field' не должно быть пустым.");
    }
}

class ShortPasswordException extends ValidationException {
    public function __construct($minLength) {
        parent::__construct("Пароль слишком короткий. Минимум: $minLength символов.");
    }
}

class InvalidEmailFormatException extends ValidationException {
    public function __construct($email) {
        parent::__construct("Неверный формат email: '$email'.");
    }
}

// Валидация формы
function validateRegistration($data) {
    $requiredFields = ['name', 'email', 'password'];

    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            throw new EmptyFieldException($field);
        }
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new InvalidEmailFormatException($data['email']);
    }

    if (strlen($data['password']) < 6) {
        throw new ShortPasswordException(6);
    }

    echo "Регистрация прошла успешно для пользователя '{$data['name']}'.<br>";
}

// --- Тест: данные регистрации
$formData = [
    'name' => 'Иван',
    'email' => 'ivan@example.com', // Неверный email
    'password' => '123456'          // Короткий пароль
];

try {
    validateRegistration($formData);
} catch (ValidationException $e) {
    echo "Ошибка регистрации: " . $e->getMessage() . "<br>";
} finally {
    echo "Процесс регистрации завершён.<br>";
}
