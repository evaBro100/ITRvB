<?php

namespace lab3;

class Comment
{
    public int $id;
    public int $authorId;
    public int $articleId;
    public string $content;

    public function __construct(int $id, int $authorId, int $articleId, string $content)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->articleId = $articleId;
        $this->content = $content;
    }
}
