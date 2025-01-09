<?php 

class Post {
    private string $uuid;
    private string $authorUuid;
    private string $title;
    private string $text;

    public function __construct(string $uuid, string $authorUuid, string $title, string $text) {
        $this->uuid = $uuid;
        $this->authorUuid = $authorUuid;
        $this->title = $title;
        $this->text = $text;
    }
    
    public function getUuid(): string {
        return $this->uuid;
    }
}