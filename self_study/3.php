<?php

class DivisionByZeroException extends Exception {
    public function __construct($message = "Деление на ноль невозможно", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

function divide($a, $b) {
    if ($b == 0) {
        throw new DivisionByZeroException("Нельзя делить $a на 0.");
    }
    return $a / $b;
}

try {
    $x = 10;
    $y = 0; // Делитель равен нулю
    $result = divide($x, $y);
    echo "Результат: $result<br>";
} catch (DivisionByZeroException $e) {
    echo "Ошибка: " . $e->getMessage() . "<br>";
    echo "Файл: " . $e->getFile() . "<br>";
    echo "Строка: " . $e->getLine() . "<br>";
} finally {
    echo "Операция деления завершена.<br>";
}
