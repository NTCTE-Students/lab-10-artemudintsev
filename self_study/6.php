<?php

// Базовое исключение магазина
class ShopException extends Exception {}

// Ошибка: недостаточно средств
class InsufficientFundsException extends ShopException {
    public function __construct($balance, $price) {
        $message = "Недостаточно средств. Баланс: $balance, цена товара: $price.";
        parent::__construct($message);
    }
}

// Ошибка: товар отсутствует
class ProductNotFoundException extends ShopException {
    public function __construct($productName) {
        $message = "Товар '$productName' отсутствует в наличии.";
        parent::__construct($message);
    }
}

// Симуляция покупки
function purchaseProduct($productName, $balance) {
    $products = [
        "Книга" => 500,
        "Ноутбук" => 50000,
    ];

    if (!isset($products[$productName])) {
        throw new ProductNotFoundException($productName);
    }

    $price = $products[$productName];

    if ($balance < $price) {
        throw new InsufficientFundsException($balance, $price);
    }

    echo "Покупка '$productName' успешна за $price руб.<br>";
}

try {
    $userBalance = 300;       // Недостаточно денег
    $desiredProduct = "Книга";

    purchaseProduct($desiredProduct, $userBalance);
} catch (InsufficientFundsException | ProductNotFoundException $e) {
    echo "Ошибка покупки: " . $e->getMessage() . "<br>";
} catch (ShopException $e) {
    echo "Ошибка магазина: " . $e->getMessage() . "<br>";
} finally {
    echo "Процесс покупки завершён.<br>";
}
