<?php

class User {
    private string $uuid;
    private string $username;
    private string $firstName;
    private string $lastName;

    public function __construct(string $uuid, string $username, string $firstName, string $lastName) {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    
    public function getUuid(): string {
        return $this->uuid;
    }
}
