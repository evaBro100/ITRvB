<?php

class Comment {
    private string $uuid;
    private string $postUuid;
    private string $authorUuid;
    private string $text;

    public function __construct(string $uuid, string $postUuid, string $authorUuid, string $text) {
        $this->uuid = $uuid;
        $this->postUuid = $postUuid;
        $this->authorUuid = $authorUuid;
        $this->text = $text;
    }
    
    public function getUuid(): string {
        return $this->uuid;
    }
}
