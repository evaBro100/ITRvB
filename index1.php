<?php

//классы интернет-магазина
class Product {
    public $id;
    public $name;
    public $price;
    public $description;
    public $category;
    public $stock;

    public function changePrice($newPrice) {
        $this->price = $newPrice;
    }

    public function updateStock($newStock) {
        $this->stock = $newStock;
    }

    public function getShortDescription() {
        return $this->name . " - " . $this->price . " руб.";
    }
}

class Cart {
    public $products = [];
    public $totalPrice = 0;

    public function addProduct(Product $product, $quantity) {
        $this->products[] = ['product' => $product, 'quantity' => $quantity];
        $this->totalPrice += $product->price * $quantity;
    }

    public function removeProduct($productId) {
        foreach ($this->products as $index => $item) {
            if ($item['product']->id === $productId) {
                $this->totalPrice -= $item['product']->price * $item['quantity'];
                unset($this->products[$index]);
                break;
            }
        }
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }
}

class Review {
    public $productId;
    public $userId;
    public $rating;
    public $comment;

    public function getSummary() {
        return "Оценка: " . $this->rating . " | Комментарий: " . substr($this->comment, 0, 50) . "...";
    }
}

class User {
    public $id;
    public $name;
    public $email;
    public $isAdmin;

    public function getUserInfo() {
        return "Имя: " . $this->name . " | Email: " . $this->email;
    }
}

class ContactForm {
    public $name;
    public $email;
    public $message;

    public function validate() {
        return !empty($this->name) && filter_var($this->email, FILTER_VALIDATE_EMAIL) && !empty($this->message);
    }

    public function send() {
        if ($this->validate()) {
            return "Сообщение отправлено!";
        } else {
            return "Ошибка валидации данных формы.";
        }
    }
}

//наследование
class Customer extends User {
    public $purchaseHistory = [];
    public $cart;

    public function addPurchase($product) {
        $this->purchaseHistory[] = $product;
    }

    public function viewPurchaseHistory() {
        return $this->purchaseHistory;
    }

    public function addReview(Product $product, $rating, $comment) {
        return new Review($product->id, $this->id, $rating, $comment);
    }
}

class AdminUser extends User {
    public function addProduct($id, $name, $price, $description, $category, $stock) {
        return new Product($id, $name, $price, $description, $category, $stock);
    }

    public function deleteProduct($productId) {
        return "Продукт с ID " . $productId . " удален.";
    }

    public function manageUsers() {
        return "Управление пользователями доступно.";
    }
}
?>