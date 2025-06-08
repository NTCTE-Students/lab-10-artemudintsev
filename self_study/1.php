<?php

class ValidationException extends Exception {
    public function __construct($message = "Некорректный формат email", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new ValidationException("Email '$email' имеет неверный формат.");
    }
    echo "Email '$email' корректен.<br>";
}

try {
    $testEmail = "example@site.com";
    validateEmail($testEmail);
} catch (ValidationException $e) {
    echo "Ошибка валидации: " . $e->getMessage() . "<br>";
    echo "Файл: " . $e->getFile() . "<br>";
    echo "Строка: " . $e->getLine() . "<br>";
} finally {
    echo "Проверка завершена.<br>";
}