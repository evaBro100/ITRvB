<?php

require_once __DIR__ . '/../vendor/autoload.php';

use lab3\User;
use lab3\Article;
use lab3\Comment;
use Faker\Factory;

$faker = Factory::create();

// Пример использования класса User
$user = new User(1, $faker->firstName, $faker->lastName);
echo "User: {$user->firstName} {$user->lastName}\n";

// Пример использования класса Article
$article = new Article(1, $user->id, $faker->sentence, $faker->paragraph);
echo "Article: {$article->title}\n";

// Пример использования класса Comment
$comment = new Comment(1, $user->id, $article->id, $faker->sentence);
echo "Comment: {$comment->content}\n";
