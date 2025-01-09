<?php

interface PostsRepositoryInterface {
    public function get(string $uuid): ?Post;
    public function save(Post $post): void;
}

interface CommentsRepositoryInterface {
    public function get(string $uuid): ?Comment;
    public function save(Comment $comment): void;
}
