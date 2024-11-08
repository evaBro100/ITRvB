<?php

namespace lab3;

class Article
{
    public int $id;
    public int $authorId;
    public string $title;
    public string $content;

    public function __construct(int $id, int $authorId, string $title, string $content)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->title = $title;
        $this->content = $content;
    }
}
