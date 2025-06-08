<?php

class FileMissingException extends Exception {}
class InvalidFormatException extends Exception {}

function processFile($filename) {
    if (!file_exists($filename)) {
        throw new FileMissingException("Файл '$filename' не найден.");
    }

    $content = file_get_contents($filename);
    if (strpos($content, "INVALID") !== false) {
        throw new InvalidFormatException("Файл '$filename' содержит недопустимый формат.");
    }

    echo "Файл '$filename' обработан успешно.<br>";
}

// --- Тестирование
try {
    $testFile = "bad_file.txt";

    // Для демонстрации: создаём файл с плохим содержимым
    file_put_contents($testFile, "INVALID DATA");

    processFile($testFile);

    // Удалим файл после теста
    unlink($testFile);

} catch (FileMissingException | InvalidFormatException $e) {
    echo "Обнаружена ошибка: " . $e->getMessage() . "<br>";
} finally {
    echo "Операция обработки завершена.<br>";
}
