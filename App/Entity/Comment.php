<?php

namespace App\Entity;


class Comment extends Entity
{
    protected ?int $id = null;
    protected ?string $comment = '';
    protected ?int $user_id = null;
    protected ?int $article_id = null;

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of article_id
     */
    public function getArticleId(): ?int
    {
        return $this->article_id;
    }

    /**
     * Set the value of article_id
     */
    public function setArticleId(?int $article_id): self
    {
        $this->article_id = $article_id;

        return $this;
    }

    public function validate(): array
    {
        $errors = [];
        if (empty($this->getComment())) {
            $errors['comment'] = 'Le champ comment ne doit pas être vide';
        }
        if (empty($this->getArticleId())) {
            $errors['article_id'] = 'Le champ article_id ne doit pas être vide';
        }
        if (empty($this->getUserId())) {
            $errors['user_id'] = 'Le champ user_id ne doit pas être vide';
        }
        return $errors;
    }
}
