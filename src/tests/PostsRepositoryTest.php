<?php

namespace App\Tests;


use App\Post;
use App\Repositories\PostsRepository;
use PHPUnit\Framework\TestCase;
use PDO;
use App\UUID;

class PostsRepositoryTest extends TestCase
{
  private PDO $pdo;
  private PostsRepository $repository;

  protected function setUp(): void
  {
    $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../database.sqlite');
    // Очистка таблицы перед каждым тестом
    $this->pdo->exec('DELETE FROM posts WHERE uuid = "test_uuid"');

    $this->repository = new PostsRepository($this->pdo);
  }

  public function testItSavesPostToRepository(): void
  {
    $testUuid = new Uuid('00000000-0000-0000-0000-000000000001');
    $authorUuid = new Uuid('00000000-0000-0000-0000-000000000002');

    $post = new Post(
      $testUuid,
      $authorUuid,
      'Тестовое название',
      'Тестовый текст'
    );

    $this->repository->save($post);

    $statement = $this->pdo->prepare(
      'SELECT * FROM posts WHERE uuid = :uuid'
    );
    $statement->execute([
      ':uuid' => (string)$testUuid,
    ]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $this->assertEquals((string)$testUuid, $result['uuid']);
    $this->assertEquals((string)$authorUuid, $result['author_uuid']);
    $this->assertEquals('Тестовое название', $result['title']);
    $this->assertEquals('Тестовый текст', $result['text']);
  }

  public function testItFindsPostByUuid(): void
  {
    $uuid = Uuid::random();
    $authorUuid = Uuid::random();

    $this->pdo->exec(
      "INSERT INTO posts (uuid, author_uuid, title, text) 
            VALUES ('$uuid', '$authorUuid', 'Название', 'Текст')"
    );

    $post = $this->repository->get($uuid);

    $this->assertEquals($uuid, $post->getUuid());
    $this->assertEquals($authorUuid, $post->getAuthorUuid());
    $this->assertEquals('Название', $post->getTitle());
    $this->assertEquals('Текст', $post->getContent());
  }

  public function testItThrowsExceptionWhenPostNotFound(): void
  {
    $uuid = Uuid::random();

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Пост не найден: $uuid");

    $this->repository->get($uuid);
  }
}
