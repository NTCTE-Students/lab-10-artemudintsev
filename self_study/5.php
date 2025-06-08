<?php

class CustomLoggedException extends Exception {
    public function __construct($message = "Произошла ошибка", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

function riskyOperation() {
    throw new CustomLoggedException("Тестовая ошибка для логирования.");
}

function logException(Throwable $e, $logFile = __DIR__ . '/../error.log') {
    $logMessage = "[" . date('Y-m-d H:i:s') . "] "
                . $e->getMessage() . " в файле " . $e->getFile()
                . " на строке " . $e->getLine() . PHP_EOL;
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

try {
    riskyOperation();
} catch (CustomLoggedException $e) {
    echo "Произошла ошибка: " . $e->getMessage() . "<br>";
    logException($e);
} finally {
    echo "Операция завершена.<br>";
}
