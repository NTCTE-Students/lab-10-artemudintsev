<?php

// Кастомное исключение
class FileReadException extends Exception {}

// Функция чтения файла с обработкой ошибок
function readFileContents($filename) {
    if (!is_readable($filename)) {
        throw new FileReadException("Не удалось прочитать файл: $filename");
    }

    $content = file_get_contents($filename);
    echo "Содержимое файла:<br>$content<br>";
}

// --- Тестирование
try {
    // Пример успешного чтения
    file_put_contents('example.txt', 'Тестовое содержимое файла');
    readFileContents('example.txt');

    // Пример с ошибкой (файл не существует)
    readFileContents('non_existent_file.txt');

} catch (FileReadException $e) {
    echo "Ошибка при чтении файла: " . $e->getMessage() . "<br>";
    echo "Файл: " . $e->getFile() . "<br>";
    echo "Строка: " . $e->getLine() . "<br>";
} finally {
    echo "Завершение операции.<br>";
}
